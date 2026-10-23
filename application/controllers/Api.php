<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Small read-only JSON API for the Lauwba Academy app.
 *
 * The online course app must never connect to this database directly, so
 * trainer data is exposed here and consumed over HTTP.
 */
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->output->set_content_type('application/json');
    }

    /**
     * GET /api/trainers
     *
     * Optional query params: page, per_page.
     */
    public function trainers()
    {
        if (! $this->authorized()) {
            return;
        }

        $perPage = (int) $this->input->get('per_page');
        $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 50;

        $page = max(1, (int) $this->input->get('page'));
        $offset = ($page - 1) * $perPage;

        $total = (int) $this->db
            ->where('is_active', 'Y')
            ->count_all_results('tutor');

        if ($this->db->field_exists('nomor_urut', 'tutor')) {
            $this->db->order_by('nomor_urut', 'ASC');
        }

        $rows = $this->db
            ->where('is_active', 'Y')
            ->order_by('id_tutor', 'ASC')
            ->limit($perPage, $offset)
            ->get('tutor')
            ->result();

        $data = array_map([$this, 'transform'], $rows);

        $this->respond([
            'data' => $data,
            'meta' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => $total > 0 ? (int) ceil($total / $perPage) : 1,
            ],
        ]);
    }

    /**
     * GET /api/trainers/{id}
     *
     * Accepts the numeric tutor id or the generated slug.
     */
    public function trainer($id = null)
    {
        if (! $this->authorized()) {
            return;
        }

        if ($id === null || $id === '') {
            $this->respond(['message' => 'Trainer id is required.'], 400);
            return;
        }

        $row = null;

        if (ctype_digit((string) $id)) {
            $row = $this->db
                ->where('id_tutor', (int) $id)
                ->where('is_active', 'Y')
                ->get('tutor')
                ->row();
        }

        if ($row === null) {
            // Slug lookup. The table has no slug column, so match in PHP.
            foreach ($this->db->where('is_active', 'Y')->get('tutor')->result() as $candidate) {
                if ($this->slug($candidate->nama) === $id) {
                    $row = $candidate;
                    break;
                }
            }
        }

        if ($row === null) {
            $this->respond(['message' => 'Trainer not found.'], 404);
            return;
        }

        $this->respond(['data' => $this->transform($row)]);
    }

    /**
     * GET /api/trainers/{id}/avatar
     *
     * Serves the trainer's avatar image directly. Supports data URI (base64)
     * stored in MySQL, local files, and external URLs.
     * Publicly accessible so browsers can load it via <img> tags.
     */
    public function trainer_avatar($id = null)
    {
        if ($id === null || $id === '') {
            $this->output->set_status_header(404);
            return;
        }

        $row = null;

        if (ctype_digit((string) $id)) {
            $row = $this->db
                ->select('gambar, nama')
                ->where('id_tutor', (int) $id)
                ->where('is_active', 'Y')
                ->get('tutor')
                ->row();
        }

        if ($row === null) {
            foreach ($this->db->where('is_active', 'Y')->get('tutor')->result() as $candidate) {
                if ($this->slug($candidate->nama) === $id) {
                    $row = $candidate;
                    break;
                }
            }
        }

        if ($row === null || empty($row->gambar)) {
            $this->output->set_status_header(404);
            return;
        }

        $image = trim((string) $row->gambar);

        // Case 1: Data URI (base64)
        if (preg_match('#^data:image/([a-zA-Z0-9.+-]+);base64,(.*)$#s', $image, $match)) {
            $format = strtolower($match[1]);
            $mime = ($format === 'jpg' || $format === 'jpeg') ? 'image/jpeg' : 'image/'.$format;
            $binary = base64_decode($match[2]);

            $this->output
                ->set_status_header(200)
                ->set_content_type($mime)
                ->set_header('Cache-Control: public, max-age=604800')
                ->set_output($binary);
            return;
        }

        // Case 2: Full HTTP URL
        if (preg_match('#^https?://#i', $image)) {
            redirect($image, 'location', 302);
            return;
        }

        // Case 3: Local file on disk
        $path = FCPATH.'foto_banner/'.$image;
        if (file_exists($path)) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $mime = ($ext === 'png') ? 'image/png' : 'image/jpeg';
            $this->output
                ->set_status_header(200)
                ->set_content_type($mime)
                ->set_header('Cache-Control: public, max-age=604800')
                ->set_output(file_get_contents($path));
            return;
        }

        $this->output->set_status_header(404);
    }

    /**
     * GET /api/categories
     *
     * Training categories from the main website (kategori1).
     */
    public function categories()
    {
        if (! $this->authorized()) {
            return;
        }

        $query = $this->db->where('aktif', 'Y');
        if ($this->db->field_exists('seq', 'kategori1')) {
            $query->order_by('seq', 'ASC');
        }

        $rows = $query
            ->order_by('id_kategori', 'ASC')
            ->get('kategori1')
            ->result();

        $counts = array();

        foreach ($this->db
            ->select('id_kategori, COUNT(*) AS total')
            ->where_not_in('id_jenis', $this->excludedCourseIds())
            ->group_by('id_kategori')
            ->get('jenis')
            ->result() as $countRow) {
            $counts[(int) $countRow->id_kategori] = (int) $countRow->total;
        }

        $data = array();

        foreach ($rows as $row) {
            $data[] = $this->transformCategory($row, $counts[(int) $row->id_kategori] ?? 0);
        }

        $this->respond(array(
            'data' => $data,
            'meta' => array('total' => count($data)),
        ));
    }

    /**
     * GET /api/courses
     *
     * Public course catalog from the main website. A course is a `jenis`
     * (training program); each course owns one or more `kelas` rows that carry
     * the schedule and the price options.
     */
    public function courses()
    {
        if (! $this->authorized()) {
            return;
        }

        $query = $this->db
            ->where_not_in('id_jenis', $this->excludedCourseIds());

        if ($this->db->field_exists('seq', 'jenis')) {
            $query->order_by('seq', 'ASC');
        }

        $rows = $query
            ->order_by('id_jenis', 'ASC')
            ->get('jenis')
            ->result();

        $categories = $this->categoryMap();
        $classes = $this->classesByJenis();
        $tutors = $this->tutorMap();

        $data = array();

        foreach ($rows as $row) {
            $data[] = $this->transformCourse(
                $row,
                $categories[(int) $row->id_kategori] ?? null,
                $classes[(int) $row->id_jenis] ?? array(),
                $tutors
            );
        }

        $this->respond(array(
            'data' => $data,
            'meta' => array('total' => count($data)),
        ));
    }

    /**
     * GET /api/courses/{id|slug}
     */
    public function course($id = null)
    {
        if (! $this->authorized()) {
            return;
        }

        if ($id === null || $id === '') {
            $this->respond(array('message' => 'Course id is required.'), 400);
            return;
        }

        $row = null;

        if (ctype_digit((string) $id)) {
            $row = $this->db->where('id_jenis', (int) $id)->get('jenis')->row();
        }

        if ($row === null) {
            foreach ($this->db->get('jenis')->result() as $candidate) {
                $slug = trim((string) $candidate->judul_seo);

                if ($slug === $id
                    || (string) $candidate->routes === $id
                    || (string) $candidate->routes === $id.'.html'
                    || $this->slug($candidate->judul) === $id) {
                    $row = $candidate;
                    break;
                }
            }
        }

        if ($row === null) {
            $this->respond(array('message' => 'Course not found.'), 404);
            return;
        }

        $categories = $this->categoryMap();
        $classes = $this->classesByJenis();
        $tutors = $this->tutorMap();

        $this->respond(array(
            'data' => $this->transformCourse(
                $row,
                $categories[(int) $row->id_kategori] ?? null,
                $classes[(int) $row->id_jenis] ?? array(),
                $tutors
            ),
        ));
    }

    /**
     * GET /api/kelas
     *
     * All class rows from the main website with their schedule and price
     * options. Optionally filter by `jenis_id`. Used by the online course app
     * to map its own (local) courses to the prices of the main website.
     */
    public function classes()
    {
        if (! $this->authorized()) {
            return;
        }

        $jenisId = (int) $this->input->get('jenis_id');

        $query = $this->db;

        if ($this->db->field_exists('seq', 'kelas')) {
            $query->order_by('seq', 'ASC');
        }

        $query->order_by('id_kelas', 'ASC');

        if ($jenisId > 0) {
            $query = $query->where('id_jenis', $jenisId);
        }

        $rows = $query->get('kelas')->result();

        $tutors = $this->tutorMap();
        $jenisMap = array();

        foreach ($this->db->get('jenis')->result() as $row) {
            $jenisMap[(int) $row->id_jenis] = $row;
        }

        $data = array();

        foreach ($rows as $row) {
            $class = $this->transformClass($row, $tutors);

            $shirtTitle = '';

            $jenisRow = $jenisMap[(int) $row->id_jenis] ?? null;

            if ($jenisRow !== null) {
                $title = trim(html_entity_decode(strip_tags((string) $jenisRow->judul), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $shirtTitle = trim((string) $jenisRow->judul_seo) !== '' ? trim((string) $jenisRow->judul_seo) : $title;

                $class['jenis'] = array(
                    'id' => (int) $jenisRow->id_jenis,
                    'title' => $title,
                    'slug' => $shirtTitle,
                );
            } else {
                $class['jenis'] = null;
            }

            $prices = $class['prices'];
            $priceFrom = null;

            foreach ($prices as $price) {
                if ($priceFrom === null || $price['price'] < $priceFrom) {
                    $priceFrom = $price['price'];
                }
            }

            $class['price_from'] = $priceFrom;

            $data[] = $class;
        }

        $this->respond(array(
            'data' => $data,
            'meta' => array('total' => count($data)),
        ));
    }

    /**
     * GET /api/contact
     *
     * Contact details and office locations for the online course app.
     */
    public function contact()
    {
        if (! $this->authorized()) {
            return;
        }

        $row = null;

        if ($this->db->table_exists('kontak')) {
            $row = $this->db->order_by('id', 'ASC')->limit(1)->get('kontak')->row();
        }

        $defaults = array(
            'email' => 'info@lauwba.com',
            'telepon' => '0274-4435 9440',
            'whatsapp' => '08 222 1 777 206',
            'whatsapp_pesan' => 'Maaf Bu, Mau Konsultasi tentang training/kursus di Lauwba...',
            'facebook_label' => 'Lauwba Techno Indonesia',
            'facebook_url' => 'http://www.facebook.com/LauwbaTechno',
            'twitter_label' => '@lauwbatechno',
            'twitter_url' => 'https://twitter.com/@lauwbatechno',
            'instagram_label' => '@lauwba_techno',
            'instagram_url' => 'https://www.instagram.com/lauwba_techno/',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31623.24957438492!2d110.3843626181536!3d-7.799755351345503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5765d4d95351%3A0x5175f045ca1816c!2sLauwba+Techo+Indonesia+Wilayah+Yogykarta!5e0!3m2!1sid!2sid!4v1509164706236',
        );

        $locations = array();

        foreach ($this->db->order_by('id', 'ASC')->get('alamat')->result() as $location) {
            $city = trim((string) $location->daerah);
            $address = trim(strip_tags((string) $location->alamat));

            if ($city === '' && $address === '') {
                continue;
            }

            $locations[] = array(
                'city' => $city,
                'address' => html_entity_decode($address, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            );
        }

        $social = array();

        foreach (array('facebook', 'twitter', 'instagram') as $platform) {
            $url = $this->contactValue($row, $platform.'_url', $defaults[$platform.'_url']);

            if ($url === '') {
                continue;
            }

            $social[] = array(
                'platform' => $platform,
                'label' => $this->contactValue($row, $platform.'_label', $defaults[$platform.'_label']),
                'url' => $url,
            );
        }

        $whatsapp = $this->contactValue($row, 'whatsapp', $defaults['whatsapp']);
        $address = $locations !== array()
            ? $locations[0]['address']
            : 'Lantai 2 IT Training Center Room Lauwba Techno, Jl. Kusumanegara No 224 Yogyakarta';

        $this->respond(array(
            'data' => array(
                'email' => $this->contactValue($row, 'email', $defaults['email']),
                'phone' => $this->contactValue($row, 'telepon', $defaults['telepon']),
                'whatsapp' => $whatsapp,
                'whatsapp_number' => $this->whatsappNumber($whatsapp),
                'whatsapp_message' => $this->contactValue($row, 'whatsapp_pesan', $defaults['whatsapp_pesan']),
                'address' => $address,
                'map_embed' => $this->contactValue($row, 'maps_embed', $defaults['maps_embed']),
                'social' => $social,
                'locations' => $locations,
            ),
        ));
    }

    private function contactValue($row, $field, $default = '')
    {
        if ($row === null) {
            return $default;
        }

        return trim((string) ($row->{$field} ?? ''));
    }

    private function whatsappNumber($value)
    {
        $number = preg_replace('/\D+/', '', (string) $value);

        if ($number !== '' && substr($number, 0, 1) === '0') {
            $number = '62'.substr($number, 1);
        }

        return $number;
    }

    private function authorized()
    {
        $expected = (string) $this->config->item('lauwba_api_key');
        $provided = (string) $this->input->get_request_header('X-API-Key', true);

        if ($provided === '') {
            $provided = (string) $this->input->get('api_key');
        }

        if ($expected === '' || ! hash_equals($expected, $provided)) {
            $this->respond(['message' => 'Unauthorized.'], 401);
            return false;
        }

        return true;
    }

    private function transform($row)
    {
        $image = trim((string) $row->gambar);
        $avatar = null;

        if ($image !== '') {
            if (preg_match('#^https?://#i', $image)) {
                $avatar = $image;
            } elseif (! preg_match('#^data:image/#i', $image) && file_exists(FCPATH.'foto_banner/'.$image)) {
                $avatar = base_url('foto_banner/'.rawurlencode($image));
            } else {
                $avatar = base_url('api/trainers/'.(int) $row->id_tutor.'/avatar');
            }
        }

        $role = html_entity_decode(strip_tags((string) ($row->jabatan ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (trim($role) === '') {
            $role = html_entity_decode(strip_tags((string) $row->tentang), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $title = trim($role);
        $bio = trim(html_entity_decode(strip_tags((string) ($row->descriptions ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        return [
            'id' => (int) $row->id_tutor,
            'slug' => $this->slug($row->nama),
            'name' => trim((string) $row->nama),
            'title' => $title !== '' ? $title : null,
            'bio' => $bio !== '' ? $bio : null,
            'avatar' => $avatar,
            'is_active' => $row->is_active === 'Y',
            'sort_order' => (int) ($row->nomor_urut ?? 0),
        ];
    }

    /**
     * Special programs that the main website does not list as regular courses.
     * They are price/class options rather than standalone catalog items.
     */
    private function excludedCourseIds()
    {
        return array(25, 26, 27, 34, 35);
    }

    private function categoryMap()
    {
        $map = array();

        $query = $this->db;
        if ($this->db->field_exists('seq', 'kategori1')) {
            $query->order_by('seq', 'ASC');
        }

        foreach ($query->order_by('id_kategori', 'ASC')->get('kategori1')->result() as $row) {
            $map[(int) $row->id_kategori] = $row;
        }

        return $map;
    }

    private function classesByJenis()
    {
        $map = array();

        $query = $this->db;
        if ($this->db->field_exists('seq', 'kelas')) {
            $query->order_by('seq', 'ASC');
        }

        foreach ($query
            ->order_by('id_kelas', 'ASC')
            ->get('kelas')
            ->result() as $row) {
            $map[(int) $row->id_jenis][] = $row;
        }

        return $map;
    }

    private function tutorMap()
    {
        $map = array();

        foreach ($this->db->where('is_active', 'Y')->get('tutor')->result() as $row) {
            $map[(int) $row->id_tutor] = $row;
        }

        return $map;
    }

    private function transformCategory($row, $courseCount = 0)
    {
        $name = trim(html_entity_decode(strip_tags((string) $row->nama_kategori), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $slug = trim((string) $row->kategori_seo);

        return array(
            'id' => (int) $row->id_kategori,
            'slug' => $slug !== '' ? $slug : $this->slug($name),
            'name' => $name,
            'image' => $this->imageUrl($row->img ?? ''),
            'course_count' => (int) $courseCount,
            'is_active' => (string) ($row->aktif ?? 'Y') === 'Y',
            'sort_order' => (int) ($row->seq ?? 0),
        );
    }

    private function transformCourse($row, $categoryRow, array $classes, array $tutors)
    {
        $title = trim(html_entity_decode(strip_tags((string) $row->judul), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $slug = trim((string) $row->judul_seo);
        $type = trim((string) $row->jenis);
        $priceFrom = null;
        $priceFromOriginal = null;
        $duration = null;
        $firstTrainer = null;
        $transformedClasses = array();

        foreach ($classes as $classRow) {
            $class = $this->transformClass($classRow, $tutors);
            $transformedClasses[] = $class;

            if ($duration === null && $class['duration'] !== '') {
                $duration = $class['duration'];
            }

            if ($firstTrainer === null && $class['trainers'] !== array()) {
                $firstTrainer = $class['trainers'][0];
            }

            foreach ($class['prices'] as $price) {
                if ($priceFrom === null || $price['price'] < $priceFrom) {
                    $priceFrom = $price['price'];
                    $priceFromOriginal = $price['original_price'] > $price['price']
                        ? $price['original_price']
                        : $price['price'];
                }
            }
        }

        if ($priceFrom === null && (int) $row->hrg > 0) {
            $priceFrom = (int) $row->hrg;
            $priceFromOriginal = (int) $row->hrg_coret > $priceFrom
                ? (int) $row->hrg_coret
                : $priceFrom;
        }

        $typeLabel = 'Training';

        if ($type === 'akademi') {
            $typeLabel = 'Akademi';
        } elseif ($type === 'sertifikasi') {
            $typeLabel = 'Sertifikasi';
        }

        return array(
            'id' => (int) $row->id_jenis,
            'slug' => $slug !== '' ? $slug : $this->slug($title),
            'title' => $title,
            'summary' => $this->summary($row->isi_jenis),
            'description' => (string) $row->isi_jenis,
            'thumbnail' => $this->imageUrl($row->gambar),
            'category' => $categoryRow !== null ? $this->transformCategory($categoryRow) : null,
            'type' => $type !== '' ? $type : 'training',
            'type_label' => $typeLabel,
            'level' => null,
            'duration' => $duration,
            'class_count' => count($transformedClasses),
            'classes' => $transformedClasses,
            'price_from' => $priceFrom,
            'price_from_original' => $priceFromOriginal,
            'has_discount' => $priceFrom !== null && $priceFromOriginal > $priceFrom,
            'trainer' => $firstTrainer,
            'is_published' => true,
            'registration_open' => true,
            'sort_order' => (int) ($row->seq ?? 0),
        );
    }

    private function transformClass($row, array $tutors)
    {
        $prices = $this->priceOptions($row);
        $trainers = array();

        foreach (array('id_tutor', 'id_tutor1') as $field) {
            $tutorId = (int) ($row->{$field} ?? 0);

            if ($tutorId > 0 && isset($tutors[$tutorId])) {
                $trainers[$tutorId] = $this->transform($tutors[$tutorId]);
            }
        }

        $labelParts = array_filter(array(
            trim((string) $row->hari),
            trim((string) $row->durasi),
            trim((string) $row->tempat),
        ), function ($value) {
            return $value !== '';
        });

        $altParts = array_filter(array(
            trim((string) $row->hari1),
            trim((string) $row->durasi1),
            trim((string) $row->tempat1),
        ), function ($value) {
            return $value !== '';
        });

        $scheduleAlt = null;

        if ($altParts !== array() || (int) $row->biaya1 > 0) {
            $scheduleAlt = array(
                'label' => implode(' · ', $altParts),
                'day' => trim((string) $row->hari1),
                'time_start' => trim((string) $row->jam_mulai1),
                'time_end' => trim((string) $row->jam_akhir1),
                'place' => trim((string) $row->tempat1),
                'duration' => trim((string) $row->durasi1),
                'city' => trim((string) $row->kota),
                'price' => (int) $row->biaya1,
                'min_students' => (int) $row->minmal1,
            );
        }

        return array(
            'id' => (int) $row->id_kelas,
            'label' => implode(' · ', $labelParts),
            'day' => trim((string) $row->hari),
            'time_start' => trim((string) $row->jam_mulai),
            'time_end' => trim((string) $row->jam_akhir),
            'place' => trim((string) $row->tempat),
            'duration' => trim((string) $row->durasi),
            'city' => trim((string) $row->kota),
            'note' => trim(html_entity_decode(strip_tags((string) $row->keterangan), ENT_QUOTES | ENT_HTML5, 'UTF-8')),
            'min_students' => (int) $row->minmal,
            'prices' => $prices,
            'trainers' => array_values($trainers),
            'schedule_alt' => $scheduleAlt,
        );
    }

    private function priceOptions($row)
    {
        $definitions = array(
            'regular' => array('Reguler Offline', 'biaya', 'biaya_coret'),
            'regular_online' => array('Reguler Online', 'biaya_reg_online', 'biaya_reg_online_coret'),
            'private' => array('Private', 'biaya_private', 'biaya_private_coret'),
            'private_online' => array('Private Online', 'biaya_private_online', 'biaya_private_online_coret'),
            'in_house' => array('In-House', 'biaya_inhouse', 'biaya_inhouse_coret'),
            'incubator' => array('Incubator', 'biaya_incubator', 'biaya_incubator_coret'),
            'out_of_town' => array('Luar Kota', 'biaya_luar_kota', null),
            'private_out_of_town' => array('Private Luar Kota', 'biaya_private_off_luar_kota', 'biaya_private_off_luar_kota_coret'),
        );

        $prices = array();

        foreach ($definitions as $key => $definition) {
            $price = (int) ($row->{$definition[1]} ?? 0);

            if ($price <= 0) {
                continue;
            }

            $original = $definition[2] !== null
                ? (int) ($row->{$definition[2]} ?? 0)
                : 0;

            $prices[] = array(
                'key' => $key,
                'label' => $definition[0],
                'price' => $price,
                'original_price' => $original > $price ? $original : 0,
            );
        }

        return $prices;
    }

    private function summary($html)
    {
        $text = html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim(preg_replace('/\s+/', ' ', $text));

        if (mb_strlen($text) > 200) {
            $text = rtrim(mb_substr($text, 0, 200)).'...';
        }

        return $text;
    }

    private function imageUrl($filename)
    {
        $image = trim((string) $filename);

        if ($image === '') {
            return null;
        }

        if (preg_match('#^https?://#i', $image)) {
            return $image;
        }

        $path = FCPATH.'foto_banner/'.$image;

        return file_exists($path)
            ? base_url('foto_banner/'.rawurlencode($image))
            : null;
    }

    /**
     * GET /api/videos
     *
     * Video testimoni (YouTube) from the main-site `video` table, rendered
     * as a 6-item testimonial video strip on the Academy site.
     */
    public function videos()
    {
        if (! $this->authorized()) {
            return;
        }

        $videos = array();

        if ($this->db->table_exists('video')) {
            foreach ($this->db->where('aktif', 'Y')->limit(24)->get('video')->result() as $row) {
                $link = trim((string) ($row->link ?? ''));

                if ($link === '') {
                    continue;
                }

                // `link` holds a bare YouTube id (may end with a legacy "Y" flag).
                if (preg_match('/([A-Za-z0-9_-]{11})/', $link, $match)) {
                    $videos[] = array(
                        'title' => (string) ($row->jdl_video ?? ''),
                        'youtube_id' => $match[1],
                    );
                }
            }
        }

        $this->respond(array('data' => array_slice($videos, 0, 12)));
    }

    private function slug($name)
    {
        return url_title(trim((string) $name), 'dash', true);
    }

    /**
     * GET /api/client-logos
     *
     * Corporate client logos (tb_logo from the accounting DB) used by the
     * Lauwba Academy homepage carousel. Falls back to a curated list when
     * the local/dev copy has no rows or the accounting DB is unreachable.
     */
    public function client_logos()
    {
        if (! $this->authorized()) {
            return;
        }

        $base = array(
            'kemenag-ri.jpg' => 'Kementerian Agama RI',
            'kementrian-ketenagakerjaan-ri.png' => 'Kementerian Ketenagakerjaan RI',
            'kemenkes.png' => 'Kementerian Kesehatan',
            'kementrian-perindustrian.png' => 'Kementerian Perindustrian',
            'kemkominfo.png' => 'Kominfo',
            'bpjs-ketenagakerjaan.png' => 'BPJS Ketenagakerjaan',
            'bpjs-kesehatan.png' => 'BPJS Kesehatan',
            'badan-pemeriksa-keuangan-republik-indonesia.jpg' => 'BPK RI',
            'badan-kepegawaian-negara.png' => 'Badan Kepegawaian Negara',
            'angkasapura.png' => 'Angkasa Pura',
            'bp-batam.jpg' => 'BP Batam',
            'kab-gowa.png' => 'Kabupaten Gowa',
            'kab-kolaka.png' => 'Kabupaten Kolaka',
            'iob-timur-leste.png' => 'IOB Timur Leste',
            'baznas-ri.png' => 'Baznas RI',
            'amana-tour-jogja-umroh.png' => 'Amana Tour Jogja',
        );

        $logos = array();

        try {
            $accounting = $this->load->database('accounting', TRUE);

            if ($accounting !== null && $accounting->table_exists('tb_logo')) {
                foreach ($accounting->where('deleted', 0)->order_by('sequence', 'ASC')->get('tb_logo')->result() as $row) {
                    $file = trim((string) $row->file);

                    if ($file === '') {
                        continue;
                    }

                    $logos[] = array(
                        'name' => (string) $row->logo_name !== '' ? (string) $row->logo_name : ($base[$file] ?? pathinfo($file, PATHINFO_FILENAME)),
                        'url' => base_url('logo/'.rawurlencode($file)),
                    );
                }
            }
        } catch (\Throwable $e) {
            // ignore, fallback below
        }

        if (empty($logos)) {
            foreach ($base as $file => $name) {
                $logos[] = array(
                    'name' => $name,
                    'url' => base_url('logo/'.rawurlencode($file)),
                );
            }
        }

        $this->respond(array('data' => $logos));
    }

    private function respond(array $payload, $status = 200)
    {
        $this->output
            ->set_status_header($status)
            ->set_output(json_encode($payload));
    }
}
