<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


// Optional: kasih Cloudflare header biar dia mikir 2x buat ngecache
header("Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0");
header("CF-Cache-Status: BYPASS");
header("CDN-Cache-Control: no-store");
header("Vary: *");

date_default_timezone_set("Asia/Jakarta");

class Webservices extends CI_Controller{
    
    private $bulan = ['1','2','3','4','5','6','7','8','9','10','11','12',];
    private $bulanKata = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    
    function get_latest_news(){
        // $res = $this->db->query("SELECT id_news, ket_news, jdl_news, nama_kategori, foto_news, judul_seo, post_on FROM news LEFT JOIN kategori ON news.id_kategori=kategori.id_kategori ORDER BY post_on DESC LIMIT 25")->result();
        $page = empty($this->input->get('page')) ? 0 : $this->input->get('page');
        $getLimit = $this->db->query("SELECT * FROM kategori WHERE kategori_seo IN ('berita')")->row();
        $data['kategori'] = $getLimit->nama_kategori;
        $idKategori = $getLimit->id_kategori;
        $multiplier = 20;
        $limit = $page*$multiplier;
        $res = $this->db->query("SELECT * FROM `news` WHERE id_kategori IN ('$idKategori') ORDER BY post_on DESC LIMIT $limit, $multiplier")->result();
        if(sizeof($res) > 0){
            $data['data'] = array();
            foreach($res as $r){
             $result = array();
             $result['id'] = $r->id_news;
             $result['jdl_news'] = $r->jdl_news;
             $result['post_on'] = $this->etc->getWeekday(date_format(date_create($r->post_on), "d-m-Y H:i")). ', '.  date_format(date_create($r->post_on), "d-m-Y H:i");
             $result['nama_kategori'] = $r->nama_kategori;
             $result['foto_news'] = base_url("../news/").$r->foto_news;
             $result['judul_seo'] = $r->judul_seo;
             array_push($data['data'], $result);
            }
            
            $data['message'] = "data ditemukan";
            $data['error'] = 200;
        }else{
            $data['message'] = "belum ada data";
            $data['error'] = 404;
        }
        
        echo json_encode($data);
    }
    
    function getRandomPendaftar(){
        $pendaftar = $this->db->query("SELECT pendaftar.*, jenis.judul FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis ORDER BY RAND() LIMIT 1")->row_array();
        $pendaftar['nama_lengkap'] = "<b>".strtoupper($pendaftar['nama_lengkap'])."</b>";
        $pendaftar['instansi'] = "<i>".strtoupper($pendaftar['instansi'])."</i>";
        echo json_encode($pendaftar);
    }
    
    function search_news(){
        $q = $this->input->get("q");
        $res = $this->db->query("SELECT id_news, ket_news, jdl_news, nama_kategori, foto_news, judul_seo, post_on 
        FROM news INNER JOIN kategori ON news.id_kategori=kategori.id_kategori
        WHERE jdl_news LIKE '%$q%'
        ORDER BY post_on DESC LIMIT 25")->result();
        if(sizeof($res) > 0){
            $data['data'] = array();
            foreach($res as $r){
             $result = array();
             $result['id'] = $r->id_news;
             $result['jdl_news'] = $r->jdl_news;
             $result['post_on'] = $this->etc->getWeekday(date_format(date_create($r->post_on), "d-m-Y H:i")). ', '.  date_format(date_create($r->post_on), "d-m-Y H:i");
             $result['nama_kategori'] = $r->nama_kategori;
             $result['foto_news'] = base_url("../news/").$r->foto_news;
             $result['judul_seo'] = $r->judul_seo;
             array_push($data['data'], $result);
            }
            
            $data['message'] = "data ditemukan";
            $data['error'] = 200;
        }else{
            $data['message'] = "belum ada data";
            $data['error'] = 404;
        }
        
        echo json_encode($data);
    }
    
    function get_kelas($showInLkp = 0){
        $selectedKelas = (!empty($this->input->get("id"))) ? $this->input->get("id") : [];
        if($showInLkp == '1'){
            $show = "AND show_in_lkp IN ('Y')" ;
        }
        if(!empty($selectedKelas)){
            $id = "";
            foreach($selectedKelas as $key=>$i){
                $id .= "'".$i."'";
                if($key < sizeof($selectedKelas)-1){
                    $id.=",";
                }
            }
             $res = $this->db->query("SELECT *, LEFT(isi_jenis, 200) as isi_jenis FROM kelas INNER JOIN jenis ON kelas.id_jenis=jenis.id_jenis WHERE kelas.id_jenis NOT IN($id) $show ORDER BY kelas.biaya ASC")->result();
             if(sizeof($res) > 0){
                $data['data'] = array();
                foreach($res as $r){
                 $result = array();
                 $result['id_jenis'] = $r->id_jenis;
                 $result['judul'] = $r->judul;
                 $result['isi_jenis'] = strip_tags($r->isi_jenis);
                 $result['gambar'] = base_url("/foto_berita/").$r->gambar;
                 $result['routes'] = $r->routes;
                 $result['harga'] = $this->etc->rp($r->biaya);
                 $result['coret'] = $this->etc->rp($r->biaya_coret);
                 array_push($data['data'], $result);
                }
                
                $data['message'] = "data ditemukan";
                $data['error'] = 200;
            }else{
                $data['message'] = "belum ada data";
                $data['error'] = 404;
            }
        }else{
            $res = $this->db->query("SELECT *, LEFT(isi_jenis, 200) as isi_jenis FROM kelas INNER JOIN jenis ON kelas.id_jenis=jenis.id_jenis WHERE kelas.id_jenis NOT IN('1') $show ORDER BY kelas.biaya ASC")->result();
            if(sizeof($res) > 0){
                $data['data'] = array();
                foreach($res as $r){
                 $result = array();
                 $result['id_jenis'] = $r->id_jenis;
                 $result['judul'] = $r->judul;
                 $result['isi_jenis'] = strip_tags($r->isi_jenis);
                 $result['gambar'] = base_url("/foto_berita/").$r->gambar;
                 $result['routes'] = $r->routes;
                 $result['harga'] = $this->etc->rp($r->biaya);
                 $result['coret'] = $this->etc->rp($r->biaya_coret);
                 array_push($data['data'], $result);
                }
                
                $data['message'] = "data ditemukan";
                $data['error'] = 200;
            }else{
                $data['message'] = "belum ada data";
                $data['error'] = 404;
            }
        }
        
        echo json_encode($data);
    }
    
    function get_detail_kelas(){
        header('Access-Control-Allow-Origin: *');
        $routes = $this->input->post_get("q");
        $res = $this->db->query("SELECT * FROM kelas INNER JOIN jenis ON kelas.id_jenis=jenis.id_jenis WHERE kelas.id_jenis IN($routes) ORDER BY kelas.biaya ASC")->row();
        echo json_encode($res);
    }
    
    function get_detail_news($id){
        $r= $this->db->query("SELECT * FROM news INNER JOIN kategori ON news.id_kategori=kategori.id_kategori WHERE id_news IN ('$id')")->row();
        if(sizeof($r) > 0){
             $data = array();
             $result = array();
             $result['id'] = $r->id_news;
             $result['jdl_news'] = $r->jdl_news;
             $result['post_on'] = $this->etc->getWeekday(date_format(date_create($r->post_on), "d-m-Y H:i")). ', '.  date_format(date_create($r->post_on), "d-m-Y H:i");
             $result['nama_kategori'] = $r->nama_kategori;
             $result['foto_news'] = base_url("../news/").$r->foto_news;
             $result['judul_seo'] = $r->judul_seo;
             $result['ket_news'] = str_replace("&nbsp;", "", strip_tags($r->ket_news));
            //  $result['ket_news'] = $r->ket_news;
             $data = $result;
            
            $data['message'] = "data ditemukan";
            $data['error'] = 200;
        }else{
            $data['message'] = "belum ada data";
            $data['error'] = 404;
        }
        
        echo json_encode($data);
    }
    
    
    function get_team($useImage = 0){
        header("Content-Type: application/json");
        if($useImage == 1){
            $res = $this->db->query("SELECT tutor.id_tutor, tutor.nama, tentang, descriptions, lauwbaco_presensi_kar.users.username FROM `tutor`
            LEFT JOIN lauwbaco_presensi_kar.users ON tutor.id_tutor = lauwbaco_presensi_kar.users.id_tutor GROUP BY lauwbaco_presensi_kar.users.id_tutor
            ORDER BY id_tutor DESC")->result();
        }else{
            $res = $this->db->query("SELECT *,  gambar as gambar FROM `tutor` ORDER BY id_tutor DESC")->result();
        }
        echo json_encode($res);
    }
    
    function get_detail_training(){
        header("Content-Type: application/json");
        $pendaftaran = $this->input->get('resi');
        $res = $this->db->query("SELECT * FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE pendaftar.id IN ('$pendaftaran')")->row();
        echo json_encode($res);
    }
    
    function get_report_pendaftar(){
        header("Content-Type: application/json");
        $year = $this->input->get('tahun');
        $month = $this->input->get('bulan');
        $spt = $this->input->get('spt');
        
        if(!empty($month)){
            $res = $this->db->query("SELECT pendaftar.id, pendaftar.nama_lengkap, pendaftar.daftar_pada, history_trans.jumlah_bayar, history_trans.transaksi_pada,
                                    jenis.judul, (harga-random) as kontribusi FROM `history_trans`  
                                    INNER JOIN pendaftar ON id_daftar=pendaftar.id
                                    INNER JOIN jenis ON pendaftar.training=jenis.id_jenis
                                    WHERE YEAR(transaksi_pada) IN ('$year') 
                                    AND MONTH(transaksi_pada) IN ('$month') ORDER BY transaksi_pada DESC")->result();    
        }else{
            if($spt == 'true'){
                  $res = $this->db->query("SELECT pendaftar.id, pendaftar.nama_lengkap, pendaftar.daftar_pada, history_trans.jumlah_bayar, history_trans.transaksi_pada,
                                    jenis.judul, (harga-random) as kontribusi FROM `history_trans`  
                                    INNER JOIN pendaftar ON id_daftar=pendaftar.id
                                    INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
                                    WHERE YEAR(transaksi_pajak)  IN ('$year') ORDER BY transaksi_pajak DESC")->result();
            }else{
            $res = $this->db->query("SELECT pendaftar.id, pendaftar.nama_lengkap, pendaftar.daftar_pada, history_trans.jumlah_bayar, history_trans.transaksi_pada,
                                    jenis.judul, (harga-random) as kontribusi FROM `history_trans`  
                                    INNER JOIN pendaftar ON id_daftar=pendaftar.id
                                    INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
                                    WHERE YEAR(transaksi_pada)  IN ('$year') ORDER BY transaksi_pada DESC")->result();
            }
        }
        $data = [];
        $total = 0;
        foreach($res as $r){
            $tmp = [];
            $tmp['id'] = $r->id;
            $tmp['nama_lengkap'] = $r->nama_lengkap;
            $tmp['daftar_pada'] = date_format(date_create($r->daftar_pada), "d/m/Y");
            $tmp['jumlah_bayar'] = $r->jumlah_bayar;
            $tmp['transaksi_pada'] = date_format(date_create($r->transaksi_pada), "d/m/Y");
            $tmp['judul'] = $r->judul;
            $tmp['kontribusi'] = $r->kontribusi;
            $total += $r->jumlah_bayar;
            
            array_push($data, $tmp);
        }
        
        echo json_encode(['data' =>$data, 'total' => $total]);
    }
    
    function getTotalTransSetiapBulan1Tahun($year){
        $spt = $this->input->get('spt');
        if($spt == 'true'){
            $qq = $this->db->query("SELECT MONTH(transaksi_pajak) as bulan, 
            SUM(jumlah_bayar) as total FROM `history_trans` 
            INNER JOIN pendaftar ON id_daftar=pendaftar.id 
            INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
            WHERE YEAR(transaksi_pajak) IN ('$year') 
            GROUP BY MONTH(transaksi_pajak) 
            ORDER BY transaksi_pajak ASC")->result();
        }else{
            $qq = $this->db->query("SELECT MONTH(transaksi_pada) as bulan, 
            SUM(jumlah_bayar) as total FROM `history_trans` 
            INNER JOIN pendaftar ON id_daftar=pendaftar.id 
            INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
            WHERE YEAR(transaksi_pada) IN ('$year') 
            GROUP BY MONTH(transaksi_pada) 
            ORDER BY transaksi_pada ASC")->result();
        }
        
        $data['item'] = [];
        $total = 0;
        foreach($this->bulan as $b){
            $tmp = [];
            $isExist = array_filter(
            $qq,
            function ($e) use (&$b) {
                return $e->bulan == $b;
            });
            
            if(empty($isExist)){
                $tmp['bulan'] = $b;
                $tmp['total'] = 0;
            }else{
               foreach($isExist as $b){
                   $tmp['bulan'] = $b->bulan;
                   $tmp['total'] = $b->total;
               }
            }
            
            array_push($data['item'], $tmp);
        }
        // foreach($qq as $q){
        //     $tmp = [];
        //     $tmp['bulan'] = $q->bulan;
        //     $tmp['total'] = $q->total;
        //     $total += $q->total;
            
        //     array_push($data['item'], $tmp);
        // }
        // $data['total'] = $total;
        
        echo json_encode($data);
    }
    
    function testimoni(){
        header("Content-Type: application/json");
        $limit = (!empty($this->input->get("limit"))) ? "LIMIT ". $this->input->get("limit") : "";
        $res = $this->db->query("SELECT * FROM testimoni ORDER BY tanggal DESC $limit")->result();
        $resp = [];
        foreach($res as $data){
            $tmp = [];
            $tmp['nama_pemberi'] = $data->nama_pemberi;
            $tmp['testimoni'] = strip_tags($data->testimoni);
            $tmp['foto'] = base_url('testimoni/').$data->foto;
            $tmp['tanggal'] = $data->tanggal;
            array_push($resp, $tmp);
        }
        echo json_encode($resp);
    }
    
    function get_kelas_lainnya($id){
        $res = $this->db->query("SELECT judul, judul_seo, LEFT(isi_jenis, 200) as isi_jenis, gambar, hrg, hrg_coret, routes  FROM jenis WHERE id_kategori IN ('$id')")->result();
        $resp = [];
        foreach($res as $data){
            $tmp = [];
            $tmp['judul'] = $data->judul;
            $tmp['judul_seo'] = $data->judul_seo;
            $tmp['isi_jenis'] = strip_tags($data->isi_jenis);
            $tmp['gambar'] = base_url('foto_berita/').$data->gambar;
            $tmp['hrg'] = $data->hrg;
            $tmp['hrg_coret'] = $data->hrg_coret;
            $tmp['routes'] = $data->routes;
            array_push($resp, $tmp);
        }
        echo json_encode($resp);
    }
    
    function get_detail_kelas_lain($seo){
        $res = $this->db->query("SELECT * FROM jenis WHERE routes IN ('$seo')")->row();
        echo json_encode($res);
    }
    
    function get_tutor($idTutor){
        header('Access-Control-Allow-Origin: *');
        $res = $this->db->query("SELECT * FROM tutor WHERE id_tutor IN ('$idTutor')")->row();
        echo json_encode($res);
        
    }
    
    function album(){
        $idAlbum = $this->input->get("id");
        $limit = (!empty($this->input->get("limit"))) ? "LIMIT ". $this->input->get("limit") : "";
        $orderBy = (!empty($this->input->get("order"))) ? "ORDER BY ". $this->input->get("order") : "";
        // var_dump(is_array($idAlbum));
        if(is_array($idAlbum)){
            $id = "";
            foreach($idAlbum as $key=>$i){
                $id .= "'".$i."'";
                if($key < sizeof($idAlbum)-1){
                    $id.=",";
                }
            }
            
            $res = $this->db->query("SELECT *, CONCAT('" . base_url('img_galeri/') . "', gbr_gallery) as gbr_gallery FROM gallery INNER JOIN album ON gallery.id_album=album.id_album WHERE gallery.id_album IN ($id) $orderBy $limit")->result();
            // echo "SELECT *, CONCAT('" . base_url('img_galeri/') . "', gbr_gallery) as gbr_gallery FROM gallery INNER JOIN album ON gallery.id_album=album.id_album WHERE gallery.id_album IN ($id) $orderBy $limit";
            echo json_encode($res);
        }else{
            $res = $this->db->query("SELECT *, CONCAT('" . base_url('img_galeri/') . "', gbr_gallery) as gbr_gallery  FROM gallery INNER JOIN album ON gallery.id_album=album.id_album WHERE gallery.id_album IN ('$idAlbum') $orderBy $limit")->result();
            echo json_encode($res);
        }
    }
    
    function jadwal(){
        echo $this->load->view('module_jadwal', NULL, TRUE);
        // header('Access-Control-Allow-Origin: *');
        // $alamat = $this->db->query("SELECT * FROM alamat ORDER BY id ASC")->result();
        // $jwl = [];
        // $data =[];
        // $i = 0;
        // foreach($alamat as $key=>$a){
        //     $t = [];
        //     $t['nama'] = $a->daerah;
        //     $t['jadwal'] = [];
        //     $jadwal = $this->db->query("SELECT * FROM jadwal WHERE kota_pelaksanaan IN ('$a->daerah') AND active IN ('Y')")->result();
        //     foreach($jadwal as $j){
        //         $tmp = [];
        //         $tmp['tanggal'] = $j->tanggal;
        //         $tmp['keterangan'] = $j->keterangan;
        //         $tmp['query'] = "SELECT * FROM jadwal WHERE kota_pelaksanaan IN ('$a->daerah') AND active IN ('Y')";
        //         array_push($t['jadwal'], $tmp);
        //     }
        //     array_push($jwl, $t);
        //     $i++;
        // }
        
        // echo json_encode($jwl);
    }
    function alamat(){
        $alamat = $this->db->query("SELECT * FROM alamat ORDER BY id ASC")->result();
        $data = [];
        foreach($alamat as $key=>$a){
           $t = [];
           $t['nama'] = $a->daerah;
           $t['alamat'] = strip_tags($a->alamat);
           array_push($data, $t);
        }
        echo json_encode($data);
    }
    function kotaPelaksanaan(){
        $alamat = $this->db->query("SELECT * FROM alamat ORDER BY id ASC")->result();
        $data['kota'] = [];
        foreach($alamat as $key=>$a){
           $t = [];
           $t['nama'] = $a->daerah;
           $t['alamat'] = strip_tags($a->alamat);
           array_push($data['kota'], $t);
        }
        echo json_encode($data);
    }
    
    function get_popup(){
        $forwho = $this->input->get("forwho");
        $popUp = $this->db->query("SELECT *, CONCAT('https://lauwba.com/sliderimages/', foto) as foto FROM popup_image WHERE forwho IN ('$forwho')")->row();
        echo json_encode($popUp);
    }
    
    function pendaftarDetail($idPendaftar){
        $p = $this->db->query("SELECT *, (harga-random) as kontribusi FROM `pendaftar` 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis  WHERE id = '$idPendaftar'")->row();
        $conf = ['Y' => "Ya", 'N' => 'Belum'];
        $id = $p->id;
        $qdibayar = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM `history_trans` WHERE id_daftar IN ('$id')")->row();
        $dibayar = (!empty($qdibayar)) ? $qdibayar->dibayar : 0;
        $kontrib =  ($p->kontribusi > 0) ? $p->kontribusi: 0;
        $tutor = $p->selected_trainer;
        $trainer = $this->db->query("SELECT id_tutor, nama FROM tutor WHERE id_tutor IN ('$tutor')")->row();
        $sisa = $dibayar-$kontrib;
        $tmp = [];
        $tmp['key'] = ($start++)+1;
        $tmp['id'] = $p->id;
        $tmp['kontribusi'] = $kontrib;
        $tmp['nama_lengkap'] = $p->nama_lengkap;
        $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
        $tmp['jadwal_inhouse'] = (object) [];
        if($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg"){
            $jdwl = $this->db->query("SELECT * FROM jadwal WHERE id IN ('$p->jadwal')")->row();
            $j = "";
            if(!empty($jdwl)){
                $j = "($jdwl->tanggal)";
            }
            $tmp['pilihan_kelas'] = $p->pilihan_kelas. " ".$j;
            $tmp['jadwal'] = $j;
        }else if($p->pilihan_kelas == 'private-offline' || $p->pilihan_kelas == 'private-online'){
            $tmp['pilihan_kelas'] = $p->pilihan_kelas;
            $tmp['private_kota_pelaksanaan'] = $p->private_kota_pelaksanaan;
            $tmp['alamat_private_offline'] = ($p->pilihan_kelas == 'private-offline') ? $p->alamat_private_offline : 'Online';
            $tmp['jadwal'] = $p->private_tanggal_mulai;
        }else if($p->pilihan_kelas == 'in-house'){
            $tmp['pilihan_kelas'] = $p->pilihan_kelas;
            $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
            $tmp['in_house_jumlah_peserta'] = $p->in_house_jumlah_peserta;
            $tmp['jadwal_inhouse'] = ['tanggal_mulai' => $p->in_house_tanggal_mulai, 'tanggal_selesai' => $p->in_house_tanggal_selesai];
        }else if($p->pilihan_kelas == 'inkubator'){
            $tmp['pilihan_kelas'] = $p->pilihan_kelas;
            $tmp['jadwal'] = $p->inkubator_tanggal_mulai;
            $tmp['durasi'] = $p->durasi;
        }
        $promo = $this->db->query("SELECT * FROM tb_voucher WHERE kode_voucher = '$p->voucher'")->row();
        $tmp['telepon'] = str_replace(' ', '', $p->nomor_telepon);
        $tmp['kelas'] = $p->judul;
        $tmp['konfirmasi'] = !empty($conf[$p->conf]) ? $conf[$p->conf] : "Belum";
        $tmp['konfirmasi_pembayaran'] = $p->conf;
        $tmp['dibayar'] = $dibayar;
        $tmp['from'] = $p->from;
        $tmp['potongan_voucher'] = (!empty($promo->nominal)) ? $promo->nominal : 0;
        $tmp['harga_normal'] = $p->random + $kontrib + $promo->nominal;
        $tmp['sisa'] = $sisa;
        $tmp['kota'] = $p->kota;
        $tmp['in_house_jumlah_peserta'] = $p->in_house_jumlah_peserta;
        $tmp['random'] = $p->random;
        $tmp['keterangan'] = $p->keterangan;
        $tmp['motivasi'] = $p->motivasi;
        $tmp['keterangan'] = $p->keterangan;
        $tmp['email'] = $p->email;
        $tmp['instansi'] = $p->instansi;
        $tmp['jabatan'] = $p->jabatan;
        $tmp['training_id'] = $p->training;
        $tmp['tahu_darimana'] = $p->tahu_darimana;
        $tmp['custom_jadwal'] = $p->custom_jadwal;
        $tmp['selected_trainer'] = $p->selected_trainer;
        $tmp['tutor'] = $trainer;
        
         echo json_encode($tmp);
    }
    
    function pendaftar($count = false){
        $page = (!empty($this->input->get('page'))) ? $this->input->get('page') : 0;
        $limit = (!empty($this->input->get('limit'))) ? $this->input->get('limit') : 25;
        $isRegister = (!empty($this->input->get('is_register'))) ? $this->input->get('is_register') : 'Y';
        $tahun = $this->input->get("tahun");
        $terms = (!empty($this->input->get('terms')) && $this->input->get('terms') != "null") ? $this->input->get('terms') : "";
        $from = $this->input->get('from');
        
        if($isRegister == "Y"){
            $where = "WHERE is_register IN ('Y')";
        }else{
            $where = "WHERE is_register IN ('N') AND is_archieved = '0'";
        }
        if(!empty($terms)){
            $where .= "AND nama_lengkap LIKE '%$terms%'";
        }
        
        if(!empty($tahun)){
            $where .= "AND YEAR(daftar_pada) IN ('$tahun')";
        }
        $start = $page*$limit;
        if($count){
            $pendaftar = $this->db->query("SELECT pendaftar.*, jenis.judul, (harga-random) as kontribusi FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis $where  ORDER BY pendaftar.daftar_pada DESC")->result();
        }else{
            $pendaftar = $this->db->query("SELECT *, (harga-random) as kontribusi FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis  $where ORDER BY pendaftar.daftar_pada DESC LIMIT $start,$limit")->result();
        }
        $data = [];
        $conf = ['Y' => "Ya", 'N' => 'Belum'];
        foreach($pendaftar as $key=>$p){
            $id = $p->id;
            $qdibayar = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM `history_trans` WHERE id_daftar IN ('$id')")->row();
            $dibayar = (!empty($qdibayar)) ? $qdibayar->dibayar : 0;
            $kontrib =  ($p->kontribusi > 0) ? $p->kontribusi: 0;
            $tutor = $p->selected_trainer;
            $trainer = $this->db->query("SELECT id_tutor, nama FROM tutor WHERE id_tutor IN ('$tutor')")->row();
            $sisa = $dibayar-$kontrib;
            $tmp = [];
            $tmp['key'] = ($start++)+1;
            $tmp['id'] = $p->id;
            $tmp['kontribusi'] = $kontrib;
            $tmp['kontribusi_formatted'] = "Rp. ". $this->etc->rps($kontrib);
            $tmp['nama_lengkap'] = $p->nama_lengkap;
            $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
            if($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg"){
                $jdwl = $this->db->query("SELECT * FROM jadwal WHERE id IN ('$p->jadwal')")->row();
                $j = "";
                if(!empty($jdwl)){
                    $j = "($jdwl->tanggal)";
                }
                $tmp['pilihan_kelas'] = $p->pilihan_kelas. " ".$j;
                $tmp['jadwal'] = $j;
            }else if($p->pilihan_kelas == 'private-offline' || $p->pilihan_kelas == 'private-online'){
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['private_kota_pelaksanaan'] = $p->private_kota_pelaksanaan;
                $tmp['alamat_private_offline'] = ($p->pilihan_kelas == 'private-offline') ? $p->alamat_private_offline : 'Online';
                $tmp['jadwal'] = date_format(date_create($p->private_tanggal_mulai) , "d/m/Y");
            }else if($p->pilihan_kelas == 'in-house'){
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['in_house_jumlah_peserta'] = $p->in_house_jumlah_peserta;
                $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                $tmp['jadwal_inhouse'] = ['tanggal_mulai' => date_format(date_create($p->in_house_tanggal_mulai) , "d/m/Y"), 
                'tanggal_selesai' => date_format(date_create($p->in_house_tanggal_selesai) , "d/m/Y")];
            }else if($p->pilihan_kelas == 'inkubator'){
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['jadwal'] = date_format(date_create($p->inkubator_tanggal_mulai) , "d/m/Y");
            }
            if($p->from == "LKP UNIKOM" && ($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg")){
                $getJadwal = $this->db->query("SELECT * FROM lauwbaco_admin_lkp.jadwal WHERE id_jadwal IN ('".$p->jadwal."')")->row();
                $tmp['jadwal'] = $getJadwal->hari_pelaksanaan." (". date_format(new DateTime($getJadwal->jam_mulai), 'H:i')." - ". date_format(new DateTime($getJadwal->jam_selesai), 'H:i').")";
            }
            $tmp['telepon'] = str_replace(' ', '', $p->nomor_telepon);
            $tmp['telepon'] = (substr((int) $tmp['telepon'], 0, 2) != 62) ? "62". (int) $tmp['telepon'] : $tmp['telepon'];
            $tmp['kelas'] = $p->judul;
            $tmp['konfirmasi'] = !empty($conf[$p->conf]) ? $conf[$p->conf] : "Belum";
            $tmp['konfirmasi_pembayaran'] = $p->conf;
            $tmp['dibayar'] = ($dibayar > $kontrib) ? $kontrib : $dibayar ;
            $tmp['from'] = $p->from;
            $tmp['sisa'] = $sisa;
            $tmp['kota'] = $p->kota;
            $tmp['keterangan'] = $p->keterangan;
            $tmp['motivasi'] = $p->motivasi;
            $tmp['keterangan'] = $p->keterangan;
            $tmp['email'] = $p->email;
            $tmp['instansi'] = $p->instansi;
            $tmp['jabatan'] = $p->jabatan;
            $tmp['training_id'] = $p->training;
            $tmp['tahu_darimana'] = $p->tahu_darimana;
            $tmp['custom_jadwal'] = $p->custom_jadwal;
            $tmp['selected_trainer'] = $p->selected_trainer;
            $tmp['tutor'] = $trainer;
            
            array_push($data, $tmp);
        }
        $this->output
            ->set_header("Access-Control-Allow-Origin: *")
            ->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE")
            ->set_header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With")
            ->set_header("Expires: Thu, 01 Jan 1970 00:00:00 GMT")
            ->set_header("Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0")
            ->set_header("Pragma: no-cache")
            ->set_header("CF-Cache-Status: BYPASS")
            ->set_header("Content-Type: application/json")
            ->set_header("Expires: 0");
        if($count){
            echo json_encode(['jumlah'=> sizeof($data)]);
        }else{
            echo json_encode($data);
        }
    }
    
    function gantiTrainer(){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        $where = ['id' => $re->id];
        $data = ['selected_trainer' => $re->selected_trainer];
        
        $upd = $this->crud->updateArray('pendaftar', $data, $where);
        if($upd){
            echo json_encode(['message' => "Trainer berhasil diganti", 'code' => 200]);
        }else{
            echo json_encode(['message' => "Trainer gagal diganti", 'code' => 500]);
        }
    }
    
    function get_history_transaksi($nomorPendaftaran){
        $pendaftar = $this->db->query("SELECT *, (pendaftar.harga-pendaftar.random) as kontribusi FROM `pendaftar` 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
        WHERE pendaftar.id IN ('$nomorPendaftaran') 
        ORDER BY pendaftar.daftar_pada DESC")->row();
        
        $data = ['nama_lengkap'=>$pendaftar->nama_lengkap, 'kontribusi' => $pendaftar->kontribusi, 'training' => $pendaftar->judul];
        $history = [];
            
        $histori = $this->db->query("SELECT * FROM history_trans WHERE id_daftar IN ('$nomorPendaftaran')")->result();
        $total = 0;
        if(!empty($histori)){
            foreach($histori as $h){
                $trans = [];
                $trans['jumlah_bayar'] = $h->jumlah_bayar;
                $trans['id'] = $h->id;
                $trans['transaksi_pada'] = date_format(date_create($h->transaksi_pada), 'd/m/Y');
                $total +=$h->jumlah_bayar;
                array_push($history, $trans);
            }
        }
        $sisa = (($pendaftar->kontribusi - $total)<= 0) ? 0 : $pendaftar->kontribusi - $total;
        $data['sisa'] = $sisa;
        echo json_encode(['data'=>(object) $data, 'history' => $history]);
        
    }
    
    function get_pendaftar_lunas($count = false){
        $pendaftar = $this->db->query("SELECT pendaftar.*,jenis.judul, (harga-random) as kontribusi, pendaftar.id as id_pendaftar FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis ORDER BY pendaftar.daftar_pada DESC LIMIT 200")->result();
        $data = [];
        $key = 0;
        foreach($pendaftar as $p){
            $pembayaran = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM history_trans WHERE id_daftar IN ('".$p->id."')")->row()->dibayar;
            $kontribusi = $p->kontribusi;
            if(($pembayaran == $kontribusi || $pembayaran > $kontribusi) || $kontribusi < 0){
                $tmp = [];
                $tmp['key'] = ++$key;
                $tmp['id'] = $p->id_pendaftar;
                $tmp['kontribusi'] = ($p->kontribusi > 0) ? $p->kontribusi: 0;
                $tmp['pembayaran'] = $pembayaran;
                $tmp['kontribusi_formatted'] = "Rp. ". $this->etc->rps($tmp['kontribusi']);
                $tmp['nama_lengkap'] = $p->nama_lengkap;
                $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                $tmp['from'] = $p->from;
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['telepon'] = str_replace(' ', '', $p->nomor_telepon);
                $tmp['kelas'] = $p->judul;
                if($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg"){
                    $jdwl = $this->db->query("SELECT * FROM jadwal WHERE id IN ('$p->jadwal')")->row();
                    $j = "";
                    if(!empty($jdwl)){
                        $j = "($jdwl->tanggal)";
                    }
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas. " ".$j;
                    $tmp['jadwal'] = $j;
                }else if($p->pilihan_kelas == 'private-offline' || $p->pilihan_kelas == 'private-online'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['private_kota_pelaksanaan'] = $p->private_kota_pelaksanaan;
                    $tmp['alamat_private_offline'] = ($p->pilihan_kelas == 'private-offline') ? $p->alamat_private_offline : 'Online';
                    $tmp['jadwal'] = $p->private_tanggal_mulai;
                }else if($p->pilihan_kelas == 'in-house'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                    $tmp['jadwal_inhouse'] = ['tanggal_mulai' => $p->in_house_tanggal_mulai, 'tanggal_selesai' => $p->in_house_tanggal_selesai];
                }else if($p->pilihan_kelas == 'inkubator'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                    $tmp['in_house_jumlah_peserta'] = $p->in_house_jumlah_peserta;
                    $tmp['jadwal'] = $p->inkubator_tanggal_mulai;
                }
                $tmp['from'] = $p->from;
                $tmp['email'] = $p->email;
                $tmp['instansi'] = $p->instansi;
                $tmp['jabatan'] = $p->jabatan;
                $tmp['kota'] = $p->kota;
                $tmp['keterangan'] = $p->keterangan;
                $tmp['motivasi'] = $p->motivasi;
                $tmp['tahu_darimana'] = $p->tahu_darimana;
                $tmp['custom_jadwal'] = $p->custom_jadwal;
                $tmp['training_id'] = $p->training;
                $tmp['selected_trainer'] = $p->selected_trainer;
                $tmp['tutor'] = $trainer;
                array_push($data, $tmp);
            }
        }
        if($count){
            echo json_encode(['jumlah'=> sizeof($data)]);
        }else{
            echo json_encode($data);
        }
    }
    
    function get_pendaftar_hutang($count = false){
        $pendaftar = $this->db->query("SELECT pendaftar.*, jenis.judul, (harga-random) as kontribusi FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis ORDER BY pendaftar.daftar_pada  DESC LIMIT 200")->result();
        $data = [];
        $key = 0;
        foreach($pendaftar as $p){
            $pembayaran = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM history_trans WHERE id_daftar IN ('".$p->id."')")->row()->dibayar;
            $kontribusi = $p->kontribusi;
            
            if(($pembayaran < $kontribusi && !empty($pembayaran)) && $kontribusi > 0){
            $sisa = ($kontribusi > 0 ) ? $pembayaran-$kontribusi : 0;
                $tmp = [];
                $tmp['key'] = ++$key;
                $tmp['kontribusi'] = $p->kontribusi;
                $tmp['kontribusi_formatted'] = "Rp. ". $this->etc->rps($tmp['kontribusi']);
                $tmp['id'] = $p->id;
                $tmp['pembayaran'] = $pembayaran;
                $tmp['nama_lengkap'] = $p->nama_lengkap;
                $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['telepon'] = str_replace(' ', '', $p->nomor_telepon);
                $tmp['sisa'] = $sisa;
                $tmp['kelas'] = $p->judul;
                 if($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg"){
                $jdwl = $this->db->query("SELECT * FROM jadwal WHERE id IN ('$p->jadwal')")->row();
                $j = "";
                if(!empty($jdwl)){
                    $j = "($jdwl->tanggal)";
                }
                $tmp['pilihan_kelas'] = $p->pilihan_kelas. " ".$j;
                $tmp['jadwal'] = $j;
            }else if($p->pilihan_kelas == 'private-offline' || $p->pilihan_kelas == 'private-online'){
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['private_kota_pelaksanaan'] = $p->private_kota_pelaksanaan;
                $tmp['alamat_private_offline'] = ($p->pilihan_kelas == 'private-offline') ? $p->alamat_private_offline : 'Online';
                $tmp['jadwal'] = $p->private_tanggal_mulai;
            }else if($p->pilihan_kelas == 'in-house'){
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                $tmp['jadwal_inhouse'] = ['tanggal_mulai' => $p->in_house_tanggal_mulai, 'tanggal_selesai' => $p->in_house_tanggal_selesai];
            }else if($p->pilihan_kelas == 'inkubator'){
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                $tmp['in_house_jumlah_peserta'] = $p->in_house_jumlah_peserta;
                $tmp['jadwal'] = $p->inkubator_tanggal_mulai;
            }
                $tmp['from'] = $p->from;
                $tmp['email'] = $p->email;
                $tmp['instansi'] = $p->instansi;
                $tmp['jabatan'] = $p->jabatan;
                $tmp['tahu_darimana'] = $p->tahu_darimana;
                $tmp['kota'] = $p->kota;
                $tmp['keterangan'] = $p->keterangan;
                $tmp['motivasi'] = $p->motivasi;
                $tmp['custom_jadwal'] = $p->custom_jadwal;
                $tmp['training_id'] = $p->training;
                $tmp['selected_trainer'] = $p->selected_trainer;
                $tmp['tutor'] = $trainer;
                array_push($data, $tmp);
            }
        }
        if($count){
            echo json_encode(['jumlah'=> sizeof($data)]);
        }else{
            echo json_encode($data);
        }
    }
    
    function get_pendaftar_belum_conf($count = false){
        $pendaftar = $this->db->query("SELECT pendaftar.*, jenis.judul, (harga-random) as kontribusi FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis ORDER BY pendaftar.daftar_pada  DESC LIMIT 200")->result();
        $data = [];
        $key = 0;
        foreach($pendaftar as $p){
            $pembayaran = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM history_trans WHERE id_daftar IN ('".$p->id."')")->row()->dibayar;
            $kontribusi = $p->kontribusi;
            if(($pembayaran == 0 || empty($pembayaran)) && $kontribusi > 0){
                $tmp = [];
                $tmp['key'] = ++$key;
                $tmp['id'] = $p->id;
                $tmp['kontribusi'] = $p->kontribusi;
                $tmp['email'] = $p->email;
                $tmp['pembayaran'] = $pembayaran;
                $tmp['nama_lengkap'] = $p->nama_lengkap;
                $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                $tmp['telepon'] = str_replace(' ', '', $p->nomor_telepon);
                $tmp['kelas'] = $p->judul;
                if($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg"){
                    $jdwl = $this->db->query("SELECT * FROM jadwal WHERE id IN ('$p->jadwal')")->row();
                    $j = "";
                    if(!empty($jdwl)){
                        $j = "($jdwl->tanggal)";
                    }
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas. " ".$j;
                    $tmp['jadwal'] = $j;
                }else if($p->pilihan_kelas == 'private-offline' || $p->pilihan_kelas == 'private-online'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['private_kota_pelaksanaan'] = $p->private_kota_pelaksanaan;
                    $tmp['alamat_private_offline'] = ($p->pilihan_kelas == 'private-offline') ? $p->alamat_private_offline : 'Online';
                    $tmp['jadwal'] = $p->private_tanggal_mulai;
                }else if($p->pilihan_kelas == 'in-house'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                    $tmp['jadwal_inhouse'] = ['tanggal_mulai' => $p->in_house_tanggal_mulai, 'tanggal_selesai' => $p->in_house_tanggal_selesai];
                }else if($p->pilihan_kelas == 'inkubator'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['in_house_kota_pelaksanaan'] = $p->in_house_kota_pelaksanaan;
                    $tmp['in_house_jumlah_peserta'] = $p->in_house_jumlah_peserta;
                    $tmp['jadwal'] = $p->inkubator_tanggal_mulai;
                }
                $tmp['from'] = $p->from;
                $tmp['email'] = $p->email;
                $tmp['instansi'] = $p->instansi;
                $tmp['jabatan'] = $p->jabatan;
                $tmp['kota'] = $p->kota;
                $tmp['keterangan'] = $p->keterangan;
                $tmp['motivasi'] = $p->motivasi;
                $tmp['tahu_darimana'] = $p->tahu_darimana;
                $tmp['custom_jadwal'] = $p->custom_jadwal;
                $tmp['training_id'] = $p->training;
                $tmp['selected_trainer'] = $p->selected_trainer;
                $tmp['tutor'] = $trainer;
                array_push($data, $tmp);
            }
        }
        if($count){
            echo json_encode(['jumlah'=> sizeof($data)]);
        }else{
            echo json_encode($data);
        }
    }
    
    
    function get_laporan_pendaftar_hutang_lunas_tahunan($isLunas = false){
        $year = $this->input->get('year');
        $pendaftar = $this->db->query("SELECT pendaftar.*, jenis.judul, (harga-random) as kontribusi FROM `pendaftar` 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
        where YEAR(pendaftar.daftar_pada) IN ('$year')
        ORDER BY pendaftar.daftar_pada DESC")->result();   
        
        // GROUP BY nama_lengkap 
        
        $data = [];
        $title = "";
        $total = 0;
        $titleFooter = "";
        foreach($pendaftar as $p){
            $pembayaran = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM history_trans WHERE id_daftar IN ('".$p->id."')")->row()->dibayar;
            $kontribusi = $p->kontribusi;
            $sisa = ($kontribusi > 0 && ($kontribusi - $pembayaran > 0)) ? $kontribusi - $pembayaran : 0;
            if($isLunas == 1){
                if(($pembayaran == $kontribusi || $pembayaran > $kontribusi) || $kontribusi < 0){
                    $title = "Laporan Pendaftar Lunas tahun $year";
                    $titleFooter = "Total yang sudah bayar";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = (!empty($pembayaran)) ? $total+=$pembayaran : 0;
                    
                    array_push($data, $tmp);
                }
            }else if ($isLunas == 0){
                if(($pembayaran < $kontribusi && !empty($pembayaran)) && $kontribusi > 0){
                    $title = "Laporan Pendaftar Belum Lunas tahun $year";
                    $titleFooter = "Total yang belum bayar";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = $total+=$sisa;
                    
                    array_push($data, $tmp);
                }
            }else if ($isLunas == 2){
                if(($pembayaran == 0 || empty($pembayaran)) && $kontribusi > 0){
                    $title = "Laporan Pendaftar Belum Bayar tahun $year";
                    $titleFooter = "Total yang belum bayar";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = $total+=$sisa;
                    
                    array_push($data, $tmp);
                }
            }
        }
        echo json_encode([ 'title' => $title, 'grand_total' =>$total, 'data' =>$data, 'footer_total' =>$titleFooter]);
    }
    
    function get_laporan_pendaftar_tahunan(){
        $year = $this->input->get('year');
        $month = $this->input->get('month');
        if(!empty($month)){
            $pendaftar = $this->db->query("SELECT *, (harga-random) as kontribusi FROM `pendaftar` 
            INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
            where YEAR(pendaftar.daftar_pada) IN ('$year') AND MONTH(pendaftar.daftar_pada) IN ('$month')
            ORDER BY pendaftar.daftar_pada DESC")->result(); 
            $title = "Laporan Semua Peserta Bulan ".sprintf("%02d", $month)." tahun $year";
        }else{
            $pendaftar = $this->db->query("SELECT *, (harga-random) as kontribusi FROM `pendaftar` 
            INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
            where YEAR(pendaftar.daftar_pada) IN ('$year')
            ORDER BY pendaftar.daftar_pada DESC")->result(); 
            $title = "Laporan Semua Peserta tahun $year";
        }
         
        
        $data = [];
        $total = 0;
        $totalHutang = 0;
        $titleFooter = "";
         $conf = ['Y' => "Ya", 'N' => 'Belum'];
         foreach($pendaftar as $p){
            $qdibayar = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM history_trans WHERE id_daftar IN ('".$p->id."')")->row();
            $pembayaran = !empty($qdibayar) ? $qdibayar->dibayar : 0;
            $kontribusi = $p->kontribusi;
            $tglMulai = "";
            if(!empty($p->private_tanggal_mulai)){
                $tglMulai = $p->private_tanggal_mulai;
            }else if(!empty($p->in_house_tanggal_mulai)){
                $tglMulai = $p->in_house_tanggal_mulai;
            }
            $sisa = ($kontribusi > 0) ? $pembayaran-$kontribusi : 0;
            
                    $titleFooter = "Total Akhir";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['tanggal_mulai'] = (empty($tglMulai)) ? "" : date_format(date_create($tglMulai) , "d/m/Y");
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = (!empty($pembayaran)) ? $total+=$pembayaran : 0;
                    $tmp['konfirmasi'] = !empty($conf[$p->conf]) ? $conf[$p->conf] : "Belum";
                    $tmp['total_sisa'] = $totalHutang += $sisa;
                    
                    array_push($data, $tmp);
         }
        echo json_encode([ 'title' => $title,'total_bayar' => $total, 'grand_total' =>$total+$totalHutang,'total_hutang' => $totalHutang, 'data' =>$data, 'footer_total' =>$titleFooter,'footer_bayar' =>"Jumlah Yang Sudah Dibayarkan",
        'footer_hutang' => "Jumlah Yang Belum Dibayarkan" ]);
    }
    
    
    function get_detail_pendaftar($nomorPendaftar){
        $res = $this->db->query("SELECT DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, (harga-random) as kontribusi, 
                                 nama_lengkap, nomor_telepon, instansi, jabatan, pilihan_kelas, email, training, inkubator_tanggal_mulai, alamat_private_offline,
                                 tahu_darimana, motivasi, keterangan, DATE_FORMAT(private_tanggal_mulai, '%d/%m/%Y') as private_tanggal_mulai, 
                                 private_kota_pelaksanaan, 
                                 in_house_kota_pelaksanaan, DATE_FORMAT(in_house_tanggal_mulai, '%d/%m/%Y') as in_house_tanggal_mulai,
                                 DATE_FORMAT(in_house_tanggal_selesai, '%d/%m/%Y') as in_house_tanggal_selesai, in_house_jumlah_peserta,
                                 jadwal, custom_jadwal, `from`, conf
                                 FROM pendaftar WHERE id IN ('$nomorPendaftar')")->row_array();
        $field = $this->db->query("SELECT `COLUMN_NAME` as kolom  FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                   WHERE `TABLE_SCHEMA`='lauwbaco_latest_lauwba'  
                                   AND `TABLE_NAME`='pendaftar';")->result_array();
        $kontribusi = ['kolom'=>'kontribusi'];
        // echo "<pre>";                
        array_push($field, $kontribusi);
        $data = [];
        foreach($field as $f){
            $key = $f['kolom'];

            if(array_key_exists($key, $res)){
            $tmp = [];
            $tmp["key"] = ucfirst(str_replace("_", " ", $key));
            if($key == "nomor_telepon"){
                $tmp["value"] = str_replace(' ', '', $res[$key]);
            }else if($key == "jadwal"){
                if(strtolower($res["pilihan_kelas"]) == "inkubator" || strtolower($res["pilihan_kelas"]) == "private-online" || strtolower($res["pilihan_kelas"]) == "private-offline"){
                    if($res['custom_jadwal'] != '0000-00-00'){
                        $tmp['value'] = $res['custom_jadwal'];
                    }
                }else{
                    $jadwal = $this->db->query("SELECT * FROM jadwal WHERE id IN ('".$res[$key]."')")->row()->tanggal;
                    $tmp["value"] = $jadwal;    
                }
            }else if($key == "email"){
                $tmp["value"] = $res[$key];
            }else if($key == "training"){
                $training = $this->db->query("SELECT * FROM jenis WHERE id_jenis IN ('".$res[$key]."')")->row()->judul;
                $tmp["value"] = $training;
            }else if($key != "Custom jadwal"){
                $tmp["value"] = strtoupper($res[$key]);
            }
            array_push($data, $tmp);
            }
            
        }
        
        echo json_encode($data);
    }
    
     function new_get_detail_pendaftar($nomorPendaftar){
        $field = "*";
        $check = $this->db->query("SELECT jenis.judul, pendaftar.* FROM pendaftar INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE id IN ('$nomorPendaftar')")->row();
        if($check->pilihan_kelas == "reg"){
            $field = "nama_lengkap, email, nomor_telepon, instansi, jabatan, kota, judul, (harga-random) as kontribusi, DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, tahu_darimana, motivasi, keterangan, custom_jadwal, conf, `from`";
        }else if($check->pilihan_kelas == "private-offline"){
            $field = "nama_lengkap, email, nomor_telepon,judul, private_tanggal_mulai,alamat_private_offline, private_kota_pelaksanaan, instansi, jabatan, (harga-random) as kontribusi, DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, tahu_darimana, motivasi, keterangan, custom_jadwal, conf, `from`";
        }else if($check->pilihan_kelas == "private-online"){
            $field = "nama_lengkap, email, nomor_telepon,judul, private_tanggal_mulai, private_kota_pelaksanaan, instansi, jabatan, (harga-random) as kontribusi, DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, tahu_darimana, motivasi, keterangan, custom_jadwal, conf, `from`";
        }else if($check->pilihan_kelas == "reg-online"){
            $field = "nama_lengkap, email, nomor_telepon, instansi, jabatan, kota,judul, (harga-random) as kontribusi, DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, tahu_darimana, motivasi, keterangan, custom_jadwal, conf, `from`";
        }else if($check->pilihan_kelas == "in-house"){
            $field = "nama_lengkap, email, nomor_telepon, instansi, jabatan, kota,judul, (harga-random) as kontribusi, in_house_kota_pelaksanaan, in_house_tanggal_mulai, in_house_tanggal_selesai,in_house_jumlah_peserta, DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, tahu_darimana, motivasi, keterangan, custom_jadwal, conf, `from`";
        }else if($check->pilihan_kelas == "inkubator"){
            $field = "nama_lengkap, email, nomor_telepon, instansi, jabatan, kota,judul,inkubator_tanggal_mulai, durasi, (harga-random) as kontribusi, DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, tahu_darimana, motivasi, keterangan, custom_jadwal, conf, `from`";
        }
        // $res = $this->db->query("SELECT DATE_FORMAT(daftar_pada, '%d/%m/%Y') as daftar_pada, (harga-random) as kontribusi, 
        //                          nama_lengkap, nomor_telepon, instansi, jabatan, pilihan_kelas, email, training, inkubator_tanggal_mulai, alamat_private_offline,
        //                          tahu_darimana, motivasi, keterangan, DATE_FORMAT(private_tanggal_mulai, '%d/%m/%Y') as private_tanggal_mulai, 
        //                          private_kota_pelaksanaan, 
        //                          in_house_kota_pelaksanaan, DATE_FORMAT(in_house_tanggal_mulai, '%d/%m/%Y') as in_house_tanggal_mulai,
        //                          DATE_FORMAT(in_house_tanggal_selesai, '%d/%m/%Y') as in_house_tanggal_selesai, in_house_jumlah_peserta,
        //                          jadwal, custom_jadwal, conf
        //                          FROM pendaftar WHERE id IN ('$nomorPendaftar')")->row_array();
        $res = $this->db->query("SELECT $field FROM pendaftar INNER JOIN jenis ON pendaftar.training=jenis.id_jenis  WHERE id IN ('$nomorPendaftar')")->row_array();
        $field = $this->db->query("SELECT `COLUMN_NAME` as kolom  FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                   WHERE `TABLE_SCHEMA`='lauwbaco_latest_lauwba'  
                                   AND `TABLE_NAME` IN ('pendaftar', 'jenis'); ")->result_array();
        $kontribusi = ['kolom'=>'kontribusi'];
        
        array_push($field, $kontribusi);
        $openTag = "<table class='table table-bordered table-striped table-sm'>";
        $content = "";
        $closeTag = "</table>";
        foreach($field as $f){
            $key = $f['kolom'];
            if(array_key_exists($key, $res)){
                $content.="<tr>";
                $content.="<td class='text-capitalize font-weight-bold'>".str_replace("_", " ", $key)."</td>";
                if($key == "kontribusi"){
                    $content.="<td class=''>Rp. ".$this->etc->rps($res[$key])."</td>";
                }else {
                    $content.="<td class=''>".($res[$key])."</td>";
                }
                $content.="</tr>";
            }
        }
        
        if($check->from == "LKP UNIKOM"){
            $getJadwal = $this->db->query("SELECT * FROM lauwbaco_admin_lkp.jadwal WHERE id_jadwal IN ('".$check->jadwal."')")->row();
            $content.= "<tr>
            <td class='text-capitalize font-weight-bold'>Jadwal dari LKP</td>
            <td><i>".$getJadwal->hari_pelaksanaan." (". date_format(new DateTime($getJadwal->jam_mulai), 'H:i')." - ". date_format(new DateTime($getJadwal->jam_selesai), 'H:i').")</i></td>
            </tr>";
        }
        
        echo json_encode(['data' => $openTag.$content.$closeTag, "from" => $check->from]);
     }
    
    function konfirmasiPendaftar($nomorPendaftar){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        
        $updateDataPeserta = ['selected_trainer' => $re->trainer, 'custom_jadwal' => $re->custom_jadwal, 'conf'=> 'Y'];
        $whereUpdateDataPeserta = ['id' => $nomorPendaftar];
        $pembayaran = ['id_daftar' => $nomorPendaftar, 'jumlah_bayar' => $re->nominal, 'transaksi_pada'=> $re->transaksi_pada];
        // echo "<pre>";
        
        //updateArray($table, $data, $where)
        $upd = $this->crud->updateArray("pendaftar", $updateDataPeserta, $whereUpdateDataPeserta);
        // print_r($updateDataPeserta);
        // print_r($whereUpdateDataPeserta);
        
        //insert($table, $data)
        $ins = $this->crud->insert("history_trans", $pembayaran);
        // print_r($pembayaran);
        
        if($upd > 0 && $ins > 0){
            echo json_encode(['message' => 'Pembayaran Berhasil', 'code' => 200]);
        }else{
            echo json_encode(['message' => 'Terjadi Kesalahan', 'code' => 500]);
        }
    }
    
    function terimaPembayaran($nomorPendaftaran){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        $nominal = $re->nominal;
        $data = ['id_daftar' => $nomorPendaftaran, 'jumlah_bayar' => $nominal, 'transaksi_pada' => $re->transaksi_pada];
        $ins = $this->crud->insert('history_trans', $data);
        $check  = $this->db->query("SELECT * FROM pendaftar WHERE id IN ('$nomorPendaftaran')")->row();
        $upd = ['is_register' => 'Y', 'conf' => 'Y'];
        if($check->is_register == "N"){
               $this->crud->updateArray('pendaftar', $upd, ['id' => $nomorPendaftaran]);
        }
        if($ins > 0){
            echo json_encode(['message' => 'Pembayaran Berhasil', 'code' => 200]);
            
        }else{
            echo json_encode(['message' => 'Terjadi Kesalahan', 'code' => 500]);
        }
    }
    
    function editPembayaran(){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        
        $idPembayaran = $re->id_pembayaran;
        $nominal = $re->nominal;
        $transaksi_pada = $re->transaksi_pada;
        
        $where = ['id' => $idPembayaran];
        $data = ['jumlah_bayar' => $nominal, 'transaksi_pada' => $transaksi_pada];
        if($nominal == 0){
            $up = $this->crud->deleteArray('history_trans', $where);
        }else{
            $up = $this->crud->updateArray('history_trans', $data, $where);
        }
        if($up > 0){
            echo json_encode(['message' => 'Perubahan Berhasil', 'code' => 200]);
        }else{
            echo json_encode(['message' => 'Terjadi Kesalahan', 'code' => 500]);
        }
    }
    
    function deletePembayaran(){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        
        $idPembayaran = $re->id_pembayaran;
        $nominal = $re->nominal;
        $transaksi_pada = $re->transaksi_pada;
        
        $where = ['id' => $idPembayaran];
        $data = ['jumlah_bayar' => $nominal, 'transaksi_pada' => $transaksi_pada];
        $up = $this->crud->deleteArray('history_trans', $where);
        if($up > 0){
            echo json_encode(['message' => 'Perubahan Berhasil', 'code' => 200]);
        }else{
            echo json_encode(['message' => 'Terjadi Kesalahan', 'code' => 500]);
        }
    }
    
    function hapus_pendaftar($nomorPendaftar){
        $where = ['id' => $nomorPendaftar];
        $whereHisTrans = ['id_daftar' => $nomorPendaftar];
        $delHistory = $this->crud->deleteArray('history_trans', $whereHisTrans);
        $del = $this->crud->deleteArray('pendaftar', $where);
        if($del> 0){
            echo json_encode(['message' => 'Hapus Data Berhasil', 'code' => 200]);
        }else{
            echo json_encode(['message' => 'Terjadi Kesalahan', 'code' => 500]);
        }
    }
    
    function get_laporan_pendaftar_hutang_lunas_bulan_tahun($isLunas = false){
        $year = $this->input->get('year');
        $month = $this->input->get("month");
        $pendaftar = $this->db->query("SELECT *, (harga-random) as kontribusi FROM `pendaftar` 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis 
        where YEAR(pendaftar.daftar_pada) IN ('$year') AND MONTH(pendaftar.daftar_pada) IN ('$month') 
        ORDER BY pendaftar.daftar_pada DESC")->result(); 
        $data = [];
        $title = "";
        $total = 0;
        $titleFooter = "";
        foreach($pendaftar as $p){
            $pembayaran = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM history_trans WHERE id_daftar IN ('".$p->id."')")->row()->dibayar;
            $kontribusi = $p->kontribusi;
            $sisa = ($kontribusi > 0 && ($kontribusi - $pembayaran > 0)) ? $kontribusi - $pembayaran : 0;
            if($isLunas == 1){
                if(($pembayaran == $kontribusi || $pembayaran > $kontribusi) || $kontribusi < 0){
                    $title = "Laporan Pendaftar Lunas bulan ". $this->getBulanIndonesia($month-1). " " .$year;
                    $titleFooter = "Total yang sudah bayar";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = (!empty($pembayaran)) ? $total+=$pembayaran : 0;
                    
                    array_push($data, $tmp);
                }
            }else if ($isLunas == 0){
                if(($pembayaran < $kontribusi && !empty($pembayaran)) && $kontribusi > 0){
                    $title = "Laporan Pendaftar Belum Lunas bulan ". $this->getBulanIndonesia($month-1). " " .$year;
                    $titleFooter = "Total yang belum bayar";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = $total+=$sisa;
                    
                    array_push($data, $tmp);
                }
            }else if ($isLunas == 2){
                if(($pembayaran == 0 || empty($pembayaran)) && $kontribusi > 0){
                    $title = "Laporan Pendaftar Belum Bayar bulan ". $this->getBulanIndonesia($month-1). " " .$year;
                    $titleFooter = "Total yang belum bayar";
                    $tmp = [];
                    $tmp['key'] = ++$key;
                    $tmp['kontribusi'] = ($p->kontribusi < 0) ? "0" : $p->kontribusi;
                    $tmp['pembayaran'] = (!empty($pembayaran)) ? $pembayaran : 0;
                    $tmp['nama_lengkap'] = $p->nama_lengkap;
                    $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['kelas'] = $p->judul;
                    $tmp['dari'] = (empty($from)) ? "Lauwba Techno Indonesia" : $from;
                    $tmp['sisa'] = $sisa;
                    $tmp['total'] = $total+=$sisa;
                    
                    array_push($data, $tmp);
                }
            }
        }
        echo json_encode([ 'title' => $title, 'grand_total' =>$total, 'data' =>$data, 'footer_total' =>$titleFooter]);
    }
    
    
    function getKelasTrainer(){
        $idTrainer = $this->input->get('trainer');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $selectedTrainer = "";
        $formattedBulan = sprintf('%02d', $bulan);
        
         //count kelas
        $trainerObj = $this->getTrainer();
        $dataTrainer = [];
        $trainer = [];
        foreach($trainerObj as $t){
          $dataTrainer[$t->nama] = [];
          array_push($trainer, $t->nama);
        }
        
        $jumlahKelas = [];
        
        $data['data'] = [];
        if($idTrainer == "all" || empty($idTrainer)){
            $getProgressInCurrentMonth = $this->db->query("SELECT lauwbaco_latest_lauwba.pendaftar.id, selected_trainer, daftar_pada, nama_lengkap, pilihan_kelas, jenis.judul, tutor.nama
            FROM lauwbaco_latest_lauwba.pendaftar 
            INNER JOIN jenis ON lauwbaco_latest_lauwba.pendaftar.training = lauwbaco_latest_lauwba.jenis.id_jenis
            INNER JOIN lauwbaco_presensi_kar.tb_progress ON lauwbaco_latest_lauwba.pendaftar.id=lauwbaco_presensi_kar.tb_progress.id_peserta 
            INNER JOIN lauwbaco_latest_lauwba.tutor ON lauwbaco_latest_lauwba.pendaftar.selected_trainer = lauwbaco_latest_lauwba.tutor.id_tutor
            WHERE lauwbaco_presensi_kar.tb_progress.added_on LIKE '%/$formattedBulan/$tahun'
            GROUP BY lauwbaco_latest_lauwba.pendaftar.id;")->result();
        }else{
            $getProgressInCurrentMonth = $this->db->query("SELECT lauwbaco_latest_lauwba.pendaftar.id, selected_trainer,  daftar_pada, nama_lengkap, pilihan_kelas, jenis.judul, tutor.nama
            FROM lauwbaco_latest_lauwba.pendaftar 
            INNER JOIN jenis ON lauwbaco_latest_lauwba.pendaftar.training = lauwbaco_latest_lauwba.jenis.id_jenis
            INNER JOIN lauwbaco_presensi_kar.tb_progress ON lauwbaco_latest_lauwba.pendaftar.id=lauwbaco_presensi_kar.tb_progress.id_peserta 
            INNER JOIN lauwbaco_latest_lauwba.tutor ON lauwbaco_latest_lauwba.pendaftar.selected_trainer = lauwbaco_latest_lauwba.tutor.id_tutor
            WHERE lauwbaco_latest_lauwba.pendaftar.selected_trainer = '$idTrainer' AND lauwbaco_presensi_kar.tb_progress.added_on LIKE '%/$formattedBulan/$tahun'
            GROUP BY lauwbaco_latest_lauwba.pendaftar.id;")->result();
        }
        $totalKeseluruhanKelas = 0;
        foreach($getProgressInCurrentMonth as $prog){
            $getFirstMeet = $this->db->query("SELECT * FROM lauwbaco_presensi_kar.tb_progress WHERE id_peserta = '$prog->id' ORDER BY id_progress ASC LIMIT 1")->row();
            if(!empty($getFirstMeet) && strpos($getFirstMeet->added_on, "$formattedBulan/$tahun") !== false){
                $tmp = [];
                $tmp['tanggal_daftar'] = $prog->daftar_pada;
                $tmp['tanggal_mulai'] = $getFirstMeet->added_on;
                $tmp['nama'] = $prog->nama_lengkap;
                $tmp['kelas'] = $prog->pilihan_kelas;
                $tmp['training'] = $prog->judul;
                $tmp['trainer'] = $prog->nama;
                
                $search = $prog->nama;
                $key = array_search($search, $trainer);
                array_push($dataTrainer[$trainer[$key]], time());
                array_push($data['data'], $tmp);
                $totalKeseluruhanKelas++;
            }
        }
        $selectedTrainer = ($idTrainer == "all" || empty($idTrainer)) ? '' : $getProgressInCurrentMonth[0]->nama; 
        foreach($dataTrainer as $key=>$da){
            $jumlah = (!empty($da)) ? sizeof($da) : 0;
            if(!empty($jumlah) && $jumlah > 0){
                $tmp = [];
                $tmp['nama'] = $key;
                $tmp['jumlah'] = sizeof($da);
                $tmp['color'] = $this->rand_color();
                array_push($jumlahKelas, $tmp);
            }
        }
        $data['message'] = 'data ditemukan';
        $data['total_kelas'] = $totalKeseluruhanKelas;
        $data['title'] = ($idTrainer == "all" || empty($idTrainer)) ? 'Laporan kelas semua Trainer Bulan '. $this->getBulanIndonesia($bulan-1). " $tahun" : "Laporan Kelas oleh $selectedTrainer Bulan ". $this->getBulanIndonesia($bulan-1). " $tahun";
        $data['jumlah_kelas'] = $jumlahKelas;
        
        die(json_encode($data));
    }
    
    // function getKelasTrainer(){
    //     $idTrainer = $this->input->get('trainer');
    //     $bulan = $this->input->get('bulan');
    //     $tahun = $this->input->get('tahun');
    //     $selectedTrainer = "";
        
    //      //count kelas
    //     $trainerObj = $this->getTrainer();
    //     $dataTrainer = [];
    //     $trainer = [];
    //     foreach($trainerObj as $t){
    //       $dataTrainer[$t->nama] = [];
    //       array_push($trainer, $t->nama);
    //     }
        
    //     $jumlahKelas = [];
        
    //     if($idTrainer == "all"){
    //     $res = $this->db->query("SELECT * FROM `pendaftar`
    //                             INNER JOIN tutor ON pendaftar.selected_trainer=tutor.id_tutor
    //                             INNER JOIN jenis ON pendaftar.training=jenis.id_jenis
    //                             AND MONTH(custom_jadwal) IN ('$bulan')
    //                             AND YEAR(custom_jadwal) IN ('$tahun')")->result();
                                
    //     $selectedTrainer = "Semua Trainer";
    //     }else{
    //     $res = $this->db->query("SELECT * FROM `pendaftar`
    //                             INNER JOIN tutor ON pendaftar.selected_trainer=tutor.id_tutor
    //                             INNER JOIN jenis ON pendaftar.training=jenis.id_jenis
    //                             WHERE pendaftar.selected_trainer IN ('$idTrainer')
    //                             AND MONTH(pendaftar.custom_jadwal) IN ('$bulan')
    //                             AND YEAR (pendaftar.custom_jadwal) IN ('$tahun')")->result();
    //     $selectedTrainer = $res[0]->nama;    
                                
    //     }                  
    //     if(!empty($res)){
    //         $data = [];
    //         foreach($res as $r){
    //             $tmp = [];
    //             $tmp['tanggal_daftar'] = date_format(date_create($r->daftar_pada), "d/m/Y");
    //             $tmp['tanggal_mulai'] = date_format(date_create($r->custom_jadwal), "d/m/Y");
    //             $tmp['nama'] = $r->nama_lengkap;
    //             $tmp['kelas'] = $r->pilihan_kelas;
    //             $tmp['training'] = $r->judul;
    //             $tmp['trainer'] = $r->nama;
                
    //             $search = $r->nama;
    //             $key = array_search($search, $trainer);
    //             array_push($dataTrainer[$trainer[$key]], time());
                
    //             array_push($data, $tmp);
    //         }
            
            
    //         foreach($dataTrainer as $key=>$da){
    //             $jumlah = (!empty($da)) ? sizeof($da) : 0;
    //             if(!empty($jumlah) && $jumlah > 0){
    //                 $tmp = [];
    //                 $tmp['nama'] = $key;
    //                 $tmp['jumlah'] = sizeof($da);
    //                 $tmp['color'] = $this->rand_color();
    //                 array_push($jumlahKelas, $tmp);
    //             }
    //         }
            
            
    //         echo json_encode(['data' => $data, 'message'=> 'data ditemukan', 'total_kelas'=> sizeof($res), 'title'=> "Laporan Kelas oleh $selectedTrainer Bulan ". $this->getBulanIndonesia($bulan-1). " $tahun", 'jumlah_kelas' => $jumlahKelas]);
    //     }else{
    //         echo json_encode(['message' => "Tidak ada data"]);
    //     }
    // }
    
     function getKelasTrainerRange(){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        $idTrainer = $re->trainer;
        $dateDari = $re->dari_tanggal;
        $dateSampai = $re->sampai_tanggal;
        $selectedTrainer = "";
        
        $monthYearMulai = date_format(date_create($dateDari) , '/m/Y');
        $monthYearSampai = date_format(date_create($dateSampai) , '/m/Y');
        
        
         //count kelas
        $trainerObj = $this->getTrainer();
        $dataTrainer = [];
        $trainer = [];
        foreach($trainerObj as $t){
          $dataTrainer[$t->nama] = [];
          array_push($trainer, $t->nama);
        }
        
        $jumlahKelas = [];
        
        $data['data'] = [];
        if($idTrainer == "all" || empty($idTrainer)){
            $getProgressInCurrentMonth = $this->db->query("SELECT lauwbaco_latest_lauwba.pendaftar.id, selected_trainer, daftar_pada, nama_lengkap, pilihan_kelas, jenis.judul, tutor.nama
            FROM lauwbaco_latest_lauwba.pendaftar 
            INNER JOIN lauwbaco_latest_lauwba.jenis ON lauwbaco_latest_lauwba.pendaftar.training = lauwbaco_latest_lauwba.jenis.id_jenis
            INNER JOIN lauwbaco_presensi_kar.tb_progress ON lauwbaco_latest_lauwba.pendaftar.id=lauwbaco_presensi_kar.tb_progress.id_peserta 
            INNER JOIN lauwbaco_latest_lauwba.tutor ON lauwbaco_latest_lauwba.pendaftar.selected_trainer = lauwbaco_latest_lauwba.tutor.id_tutor
            WHERE lauwbaco_presensi_kar.tb_progress.time_stamp BETWEEN '$dateDari' AND '$dateSampai'
            GROUP BY lauwbaco_latest_lauwba.pendaftar.id;")->result();
        }else{
            $getProgressInCurrentMonth = $this->db->query("SELECT lauwbaco_latest_lauwba.pendaftar.id, selected_trainer,  daftar_pada, nama_lengkap, pilihan_kelas, jenis.judul, tutor.nama
            FROM lauwbaco_latest_lauwba.pendaftar 
            INNER JOIN lauwbaco_latest_lauwba.jenis ON lauwbaco_latest_lauwba.pendaftar.training = lauwbaco_latest_lauwba.jenis.id_jenis
            INNER JOIN lauwbaco_presensi_kar.tb_progress ON lauwbaco_latest_lauwba.pendaftar.id=lauwbaco_presensi_kar.tb_progress.id_peserta 
            INNER JOIN lauwbaco_latest_lauwba.tutor ON lauwbaco_latest_lauwba.pendaftar.selected_trainer = lauwbaco_latest_lauwba.tutor.id_tutor
            WHERE lauwbaco_latest_lauwba.pendaftar.selected_trainer = '$idTrainer' AND 
            lauwbaco_presensi_kar.tb_progress.time_stamp BETWEEN '$dateDari' AND '$dateSampai'
            GROUP BY lauwbaco_latest_lauwba.pendaftar.id;")->result();
        }
        $totalKeseluruhanKelas = 0;
        foreach($getProgressInCurrentMonth as $prog){
            if($idTrainer == "all" || empty($idTrainer)){
                $getFirstMeet = $this->db->query("SELECT * FROM lauwbaco_presensi_kar.tb_progress WHERE id_peserta = '$prog->id' ORDER BY id_progress ASC LIMIT 1")->row();
                if(!empty($getFirstMeet) && (strpos($getFirstMeet->added_on, "$monthYearMulai") !== false ||strpos($getFirstMeet->added_on, "$monthYearSampai") !== false)){
                    $tmp = [];
                    $tmp['tanggal_daftar'] = $prog->daftar_pada;
                    $tmp['tanggal_mulai'] = $getFirstMeet->added_on;
                    $tmp['nama'] = $prog->nama_lengkap;
                    $tmp['kelas'] = $prog->pilihan_kelas;
                    $tmp['training'] = $prog->judul;
                    $tmp['trainer'] = $prog->nama;
                    
                    $search = $prog->nama;
                    $key = array_search($search, $trainer);
                    array_push($dataTrainer[$trainer[$key]], time());
                    array_push($data['data'], $tmp);
                    $totalKeseluruhanKelas++;
                }
            }else{
                if($prog->selected_trainer == $idTrainer){
                    $getFirstMeet = $this->db->query("SELECT * FROM lauwbaco_presensi_kar.tb_progress WHERE id_peserta = '$prog->id' ORDER BY id_progress ASC LIMIT 1")->row();
                    if(!empty($getFirstMeet) && (strpos($getFirstMeet->added_on, "$monthYearMulai") !== false ||strpos($getFirstMeet->added_on, "$monthYearSampai") !== false)){
                        $tmp = [];
                        $tmp['tanggal_daftar'] = $prog->daftar_pada;
                        $tmp['tanggal_mulai'] = $getFirstMeet->added_on;
                        $tmp['nama'] = $prog->nama_lengkap;
                        $tmp['kelas'] = $prog->pilihan_kelas;
                        $tmp['training'] = $prog->judul;
                        $tmp['trainer'] = $prog->nama;
                        
                        $search = $prog->nama;
                        $key = array_search($search, $trainer);
                        array_push($dataTrainer[$trainer[$key]], time());
                        array_push($data['data'], $tmp);
                        $totalKeseluruhanKelas++;
                    }
                }
            }
            
        }
        $selectedTrainer = ($idTrainer == "all" || empty($idTrainer)) ? '' : $getProgressInCurrentMonth[0]->nama; 
        foreach($dataTrainer as $key=>$da){
            $jumlah = (!empty($da)) ? sizeof($da) : 0;
            if(!empty($jumlah) && $jumlah > 0){
                $tmp = [];
                $tmp['nama'] = $key;
                $tmp['jumlah'] = sizeof($da);
                $tmp['color'] = $this->rand_color();
                array_push($jumlahKelas, $tmp);
            }
        }
        $data['message'] = 'data ditemukan';
        $data['total_kelas'] = $totalKeseluruhanKelas;
        $data['title'] = ($idTrainer == "all" || empty($idTrainer)) ? 'Laporan kelas semua Trainer Bulan '. $this->getBulanIndonesia($bulan-1). " $tahun" : "Laporan Kelas oleh $selectedTrainer Bulan ". $this->getBulanIndonesia($bulan-1). " $tahun";
        $data['jumlah_kelas'] = $jumlahKelas;
        
        die(json_encode($data));
    }
    
    function exTrainer($search){
        $trainerObj = $this->getTrainer();
        $dataTrainer = [];
        $trainer = [];
        foreach($trainerObj as $t){
          $dataTrainer[$t->nama] = [];
          array_push($trainer, $t->nama);
        }
        
        
        $key = array_search($search, $trainer);
        array_push($dataTrainer[$trainer[$key]], time());
        
        
        foreach($dataTrainer as $key=>$da){
          $jumlah = (!empty($da)) ? sizeof($da) : 0;
          echo $key. "==>> ". $jumlah;
          echo "<br>";
        }


        // print_r($trainer);
    }
    
     function sendNotification(){
        $re = file_get_contents("php://input");
        $json = json_decode($re);
        
        // print_r($json);
        
        $content = array(
                     "en" => 'English Message'
                     );

        $fields = array(
                        'app_id' => '8bad0d73-ade4-484e-9e8c-7a75f277be3e',
                        'included_segments' => array('All'),
                        'data' => array("foo" => "bar"),
                        'contents' => array("en" => "Test Lagi"),
                        'headings' => array("en"=>"etc"),
                        );
    
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic NmVhZTVhMWMtZWI5Yi00MDYzLWIwMTEtYTQ4YmY5NGEyYjBi'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        echo json_encode($response);
    }
    
    function getVideo(){
        $video = $this->crud->select('video')->result();
        echo json_encode($video);
    }
    
    function getHarga(){
        $uuid = (!empty($id)) ? $id :  $this->input->get('uuid');
        $harga = $this->db->query("SELECT * FROM kelas WHERE id_jenis IN ('$uuid')")->row();
        echo json_encode($harga);
    }
    
    function rekomendasiKelasLain(){
        $idKategori = $this->input->get('kategori');
        $kelas = $this->crud->select_join('kelas', 'jenis', 'id_jenis', "WHERE  jenis.id_kategori IN('$idKategori') AND kelas.id_jenis NOT IN('1') ORDER BY kelas.biaya ASC")->result();
        echo json_encode($kelas);
    }
    
    function getTransaksi(){
        $tahun = $this->input->get("tahun");
        $page = $this->input->get("page");
        $now = (!empty($page)) ? $page : 0;
        $step = 25;
        $nextRange = $now * $step;
        $result = $this->db->query("SELECT 
        CONCAT('pendaftaran') as `from`,
        history_trans.id,
        pendaftar.nama_lengkap, 
        history_trans.jumlah_bayar, 
        history_trans.transaksi_pada, 
        history_trans.transaksi_pajak,
        jenis.judul FROM history_trans 
        INNER JOIN pendaftar ON history_trans.id_daftar=pendaftar.id 
        INNER JOIN jenis ON pendaftar.training= jenis.id_jenis 
        WHERE YEAR(history_trans.transaksi_pada) IN ('$tahun') ORDER BY history_trans.transaksi_pada DESC")->result_array();
        $data = [];
        foreach($result as $rs){
            $rs['time_stamp'] = strtotime($rs['transaksi_pada']);
            $rs['transaksi_pada'] = date_format(date_create($rs['transaksi_pada']), 'd/m/Y');
            $rs['raw_date'] = date_format(date_create($rs['transaksi_pada']), 'Y-m-d');
            if(!empty($rs['transaksi_pajak']))
                $rs['transaksi_pajak'] = date_format(date_create($rs['transaksi_pajak']), 'd/m/Y');
            
            $data[] = $rs;
        }
        
        // $trans = file_get_contents("https://lauwba.com/accouting-rest-api/index.php/Spt/getTransaksiMasuk/$tahun");
        // $de = json_decode($trans, true);
        // $final = array_merge($data, $de['data']);
        $final = $data;
        usort($final, function($a, $b) {
            return $a['time_stamp'] - $b['time_stamp'];
        });
        $slice = array_slice($final, $nextRange, $step);
        if(!empty($slice)){
            die(json_encode(['message'=> 'Data ditemukan', 'code' => 200, 'data' => $slice, 'tahun' => $tahun]));
        }else{
            die(json_encode(['message' => 'Tidak ada data', 'code' => 500]));
        }
        
    }
    
    function updateTransaksiUntukPajak(){
        
        $json = file_get_contents("php://input");
        $decode = json_decode($json);
        $idTrans = $decode->idTrans;
        if(!empty($decode->tanggal)){
            $tanggalTransaksiPajak = $decode->tanggal;
        }else{
            $tanggalTransaksiPajak = NULL;
        }
        $from = $decode->from;
        if($from == 'accounting'){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://lauwba.com/accouting-rest-api/index.php/spt/updateTransaksiPajak");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
                     http_build_query(['idTrans' => $idTrans, 'tanggal' => $tanggalTransaksiPajak]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            curl_close ($ch);
            
            $resDec = json_decode($res);
            die(json_encode($resDec));
        }else{
            $data = [
            'transaksi_pajak' => $tanggalTransaksiPajak
            ];
            $where = ['id' => $idTrans];
            
            $upd = $this->crud->updateArray('history_trans', $data, $where);
            if($upd){
                die(json_encode(['message' =>'Transaksi Berhasil Diupdate', 'code' => 200]));
            }else{
                die(json_encode(['message' =>'Transaksi Gagal Diupdate', 'code' => 500]));
            }
        }
    }
    
    function getPesertaByAsalPendaftaran(){
        $from = $this->input->get('from');
        $where = '';
        if(!empty($from)){
            $where .="WHERE `from` = '$from'";
        }
        $page = (!empty($this->input->get('page'))) ? $this->input->get('page') : 0;
        $limit = (!empty($this->input->get('limit'))) ? $this->input->get('limit') : 25;
        $start = $page*$limit;
        $pendaftar = $this->db->query("SELECT *, (harga-random) as kontribusi FROM `pendaftar` INNER JOIN jenis ON pendaftar.training=jenis.id_jenis $where ORDER BY pendaftar.daftar_pada DESC LIMIT $start,$limit")->result();
        
        $data = [];
        if(!empty($pendaftar)){
            $conf = ['Y' => "Ya", 'N' => 'Belum'];
            foreach($pendaftar as $key=>$p){
                $id = $p->id;
                $qdibayar = $this->db->query("SELECT SUM(jumlah_bayar) as dibayar FROM `history_trans` WHERE id_daftar IN ('$id')")->row();
                $dibayar = (!empty($qdibayar)) ? $qdibayar->dibayar : 0;
                $kontrib =  ($p->kontribusi > 0) ? $p->kontribusi: 0;
                $tutor = $p->selected_trainer;
                $trainer = $this->db->query("SELECT id_tutor, nama FROM tutor WHERE id_tutor IN ('$tutor')")->row();
                $sisa = $dibayar-$kontrib;
                $tmp = [];
                $tmp['key'] = ($start++)+1;
                $tmp['id'] = $p->id;
                $tmp['kontribusi'] = $kontrib;
                $tmp['nama_lengkap'] = $p->nama_lengkap;
                $tmp['daftar_pada'] = date_format(date_create($p->daftar_pada) , "d/m/Y");
                if($p->pilihan_kelas == "reg-online" || $p->pilihan_kelas == "reg"){
                    $jdwl = $this->db->query("SELECT * FROM jadwal WHERE id IN ('$p->jadwal')")->row();
                    $j = "";
                    if(!empty($jdwl)){
                        $j = "($jdwl->tanggal)";
                    }
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas. " ".$j;
                    $tmp['jadwal'] = $j;
                }else if($p->pilihan_kelas == 'private-offline' || $p->pilihan_kelas == 'private-online'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['jadwal'] = $p->private_tanggal_mulai;
                }else if($p->pilihan_kelas == 'in-house'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['jadwal_inhouse'] = ['tanggal_mulai' => $p->in_house_tanggal_mulai, 'tanggal_selesai' => $p->in_house_tanggal_selesai];
                }else if($p->pilihan_kelas == 'inkubator'){
                    $tmp['pilihan_kelas'] = $p->pilihan_kelas;
                    $tmp['jadwal'] = $p->inkubator_tanggal_mulai;
                }
                $tmp['telepon'] = str_replace(' ', '', $p->nomor_telepon);
                $tmp['kelas'] = $p->judul;
                $tmp['konfirmasi'] = !empty($conf[$p->conf]) ? $conf[$p->conf] : "Belum";
                $tmp['konfirmasi_pembayaran'] = $p->conf;
                $tmp['dibayar'] = $dibayar;
                $tmp['from'] = $p->from;
                $tmp['sisa'] = $sisa;
                $tmp['training_id'] = $p->training;
                $tmp['selected_trainer'] = $p->selected_trainer;
                $tmp['tutor'] = $trainer;
                
                array_push($data, $tmp);
            }
         
        }
        die(json_encode($data));
    }
    
    function archievedSuratPenawaran($idPendaftaran){
        $where = ['id' => $idPendaftaran];
        $data = ['is_archieved' => '1'];
        
        $upd = $this->db->where($where)->update('pendaftar', $data);
        if($upd){
            die(json_encode(['message' => 'data berhasil dihapus', 'code' => 200]));
        }else{
            die(json_encode(['message' => 'data gagal dihapus', 'code' => 500]));
        }
    }
    
    function getKategoriKelas(){
        $kategori = $this->db->query("SELECT jenis.judul, jenis.id_jenis, kelas.* FROM jenis 
        INNER JOIN kelas ON kelas.id_jenis = jenis.id_jenis
        WHERE jenis.id_jenis NOT IN('34', '35', '26', '27', '25', '42') ORDER BY jenis.judul ASC")->result();
        $data = [];
        foreach($kategori as $ktr){
            $ktr->biaya_in_house_per_person = json_decode($ktr->biaya_in_house_per_person);
            $data[] = $ktr;
        }
        if(!empty($data)){
            die(json_encode(['message' => 'data ditemukan', 'kategori' => $data, 'code' => 200]));
        }else{
            die(json_encode(['message' => 'data ditemukan', 'kategori' => null, 'code' => 404]));
        }
    }
    
    function getKelasKategori(){
        $kategori = $this->db->query("SELECT * FROM kategori1 WHERE id_kategori NOT IN ('1', '10', '5') ORDER BY kategori1.nama_kategori ASC")->result();
        $data = [];
        foreach($kategori as $ktr){
            $data[] = $ktr;
        }
        if(!empty($data)){
            die(json_encode(['message' => 'data ditemukan', 'kategori' => $data, 'code' => 200]));
        }else{
            die(json_encode(['message' => 'data ditemukan', 'kategori' => null, 'code' => 404]));
        }
    }
    
    
    function listPengajuanAfililasi(){
        $data = $this->db->query("SELECT akun_user.nama, akun_user.nomor_telepon, akun_user.bank, akun_user.rekening, akun_user.atas_nama_rekening, history_affiliate.*
        FROM 
        history_affiliate 
        INNER JOIN akun_user ON history_affiliate.affiliate_code=akun_user.affiliate_code
        WHERE history_affiliate.status IN ('PENDING', 'PROCESS', 'REJECT', 'DONE') ORDER BY created_at DESC")->result();
        if(!empty($data)){
            $dd = [];
            foreach($data as $ff){
                $p = $this->db->query("SELECT pendaftar.*, (harga-random) as kontribusi, jenis.judul as kelas
                FROM pendaftar
                INNER JOIN jenis ON pendaftar.training = jenis.id_jenis
                WHERE pendaftar.id = '$ff->id_pendaftaran'")->row();
                $tmp = $ff; 
                $tmp->created_at = date('d/m/Y', strtotime($ff->created_at));
                $tmp->update_at = date('d/m/Y', strtotime($ff->update_at));
                $tmp->peserta = $p;
                if(!empty($p)){
                    $kontrib =  ($p->kontribusi > 0) ? $p->kontribusi: 0;
                    $tmp->peserta->kontribusi_formatted = "Rp. ". $this->etc->rps($kontrib);
                    $tmp->peserta->kontribusi = $kontrib;
                    $tmp->peserta->telepon = $p->nomor_telepon;
                }
                array_push($dd, $tmp);
            }
            die(json_encode(['message' => 'Data ditemukan', 'code' => 200, 'pengajuan' => $dd]));
        }else{
            die(json_encode(['message' => 'Belum ada data', 'code' => 404]));
        }
    }
    
    function updatePengajuanAfiliasiById(){
        $json = file_get_contents("php://input");
        $re = json_decode($json);
        $idTrans = $re->id_trans;
        $paramProcess = $re->status_trans;
        if(!empty($idTrans) && !empty($paramProcess)){
            $updData = ['status' => $paramProcess];
            $where = ['transaksi_number' => $idTrans];
            
            $upd = $this->db->where($where)->update("history_affiliate", $updData);
            if($upd){
                die(json_encode(['message' => 'data berhasil di update', 'code' => 200]));
            }else{
                die(json_encode(['message' => 'gagal mengupdate data', 'code' => 500]));
            }
        }else{
            die(json_encode(['message' => 'bad request', 'code' => 400]));
        }
    }
    
    function updateStatusPengajuanAfiliasiDone(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, X-API-KEY');
        
        $note = $this->input->post('note');
        $idTrans = $this->input->post('id_trans');
        $config['upload_path'] = './assets/images/bukti_transfer/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '1000000';
        $config['overwrite'] = true;
        if(!empty($slug)){
            $config['file_name'] = $idTrans;
        }
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $foto = $this->upload->data();
            $fileName = $foto['file_name'];
            
            $data = [
                "bukti_bayar" => $fileName,
                "status" => 'DONE', 
                "note" => $note
            ];
            $where = ['transaksi_number' => $idTrans];
            
            $ins = $this->db->where($where)->update("history_affiliate", $data);
            if($ins){
                die(json_encode(['message' => 'data berhasil diubah', 'code' => 200]));
            }else{
                die(json_encode(['message' => 'data gagal ', 'code' => 403]));
            }
        } else {
            die(json_encode(['message' => 'data gagal diubah', 'code' => 500, 'data' => $this->upload->display_errors()]));
        }
    }
    
    
    function updateSettingAffiliasi(){
        $req = file_get_contents("php://input");
        $json = json_decode($req);
        $nilai = $json->nilai;
        $kunci = $json->kunci;
        $dataupd = ['nilai' => str_replace(".", "", $nilai)];
        $where = ['kunci' => $kunci];
        
        $updSettingAfiliasi = $this->db->where($where)->update('settings', $dataupd);
        if($updSettingAfiliasi){
            die(json_encode(['message' => 'data berhasil diubah', 'code' => 200]));
        }else{
            die(json_encode(['message' => 'data gagal ', 'code' => 403]));
        }
    }
    
    
    function getSettings(){
        $data = $this->db->query("SELECT * FROM settings")->result();
        if(!empty($data)){
            die(json_encode(['message' => 'ditemukan', 'code' => 200, 'data' => $data]));
        }else{
            die(json_encode(['message' => 'Tidak ada data', 'code' => 404]));
        }
    }
    
    function getMemberOnlyNonTraining(){
        $res = $this->db->query("SELECT akun_user.*, pendaftar.email as email_peserta FROM `akun_user` 
        LEFT JOIN pendaftar ON akun_user.email=pendaftar.email WHERE pendaftar.email is null ORDER BY akun_user.created_at DESC")->result();
        if(!empty($res)){
            $rr = [];
            foreach($res as $r){
                $r->created_at = date('d/m/Y', strtotime($r->created_at));
                $r->nomor_telepon = (!empty($r->nomor_telepon)) ? "62". (int) str_replace("+62", "", $r->nomor_telepon) : '';
                $r->status_akun = ($r->is_archieved == '1') ? "non aktif" : 'aktif';
                $rr[] = $r;
            }
            $data = ['message' => 'ditemukan', 'code' => 200, 'jumlah'=> count($rr), 'data' => $rr];
            die(json_encode($data));
        }else{
            die(json_encode(['message' => 'Tidak ada data', 'code' => 404]));
        }
    }
    
    function updateStatusMemberMyLauwba(){
        $id = $this->input->get('id');
        $stts = $this->input->get('status');
        $data = ['is_archieved' => $stts];
        $where = ['id' => $id];
        $upd = $this->db->where($where)->update('akun_user', $data);
        if($upd){
            die(json_encode(['message' => 'data berhasil diubah', 'code' => 200]));
        }else{
            die(json_encode(['message' => 'data gagal ', 'code' => 403]));
        }
    }
    
    private function getTrainer(){
        return $this->db->query("SELECT * FROM `tutor` ORDER BY id_tutor DESC")->result();
    }
    
    private function getBulanIndonesia($idBulan) {
        $bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        return $bulan[$idBulan];
    }
    
    private function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
    
}