<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
  

    public function index() {
        $data['bimtek'] = $this->crud->select_where('jenis', "id_kategori='1'")->result();
        $data['produk'] = $this->crud->select_other('produk', 'ORDER BY date_added DESC LIMIT 5')->result();
        $data['album'] = $this->crud->select('album')->result();
        $this->load->view('headfoot/doctype', $data);
        $this->load->view('page_home', $data);
    }
    
    function jadwal_lengkap(){
        $dt = date("Y-m-d");
        $year = $this->etc->dateFormat($dt, "Y");
        $bulanNumber = $this->etc->dateFormat($dt, "n");
        $now = $this->etc->bulanOnly($this->etc->dateFormat($dt, "n"));
        
        
        $nextDd = $this->etc->dateAdd($dt, "1 months", "Y-m-d");
        $nextMonthNumber = $this->etc->dateFormat($nextDd, "n");
        $nextMonth = $this->etc->bulanOnly($this->etc->dateFormat($nextDd, "m"));
        $nextYear = $this->etc->dateFormat($nextDd, "Y");
        $jadwalBulanIni = $this->db->query("SELECT * FROM jadwal WHERE bulan IN ('$bulanNumber') AND tahun IN ('$year') AND active IN ('Y')")->result();
        $jadwalBulanDepan = $this->db->query("SELECT * FROM jadwal WHERE bulan IN ('$nextMonthNumber') AND tahun IN ('$nextYear') AND active IN ('Y')")->result();
        $data['jadwal'] = array("sekarang" => $jadwalBulanIni, 'judul_sekarang' => "$now $year", "bulan_depan" =>$jadwalBulanDepan, "judul_bulan_depan" => "$nextMonth $nextYear");
        // $data['jadwal'] = $this->crud->select_other('jadwal', "LEFT JOIN jenis ON jadwal.id_jenis=jenis.id_jenis LEFT JOIN kelas on jenis.id_jenis=kelas.id_jenis  WHERE jadwal.active IN ('Y')  GROUP BY jadwal.kota_pelaksanaan  ORDER BY tanggal ASC")->result();
        $data['detail'] = (object) array("judul" => "Jadwal Training/Kursus", "isi_jenis"=> "Jadwal Lengkap Training/Kursus Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_jadwal', $data);
    }

    function team() {
        $data['team'] = $this->crud->select_other('tutor', 'WHERE is_active IN ("Y") order by nomor_urut ')->result();
        $data['detail'] = (object) array("judul" => "Team Lauwba Techno Indonesia", "isi_jenis"=> "IT Training dan Developer Team Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_teams', $data);
    }
    
    function video($param = null) {
        $data['detail'] = (object) array("judul" => "Video Lauwba Techno Indonesia", "isi_jenis"=> "IT Training dan Developer Team Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_videos', $data);
    }
    
    //pendaftaran
    function daftar(){
        $data['detail'] = (object) array("judul" => "Form Pendaftaran Kursus/Training Lauwba Techno Indonesia", "isi_jenis" => "Form Pendaftaran Kursus/Training Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $data['kota'] = $this->db->query("SELECT * FROM alamat")->result();
        $data['training'] = $this->db->query("SELECT * FROM jenis WHERE id_jenis NOT IN ('34', '35', '25', '26', '27')")->result();
        $data['used_header'] = ($this->input->post_get("used_header") == "0") ? false: true;
        $data['used_footer'] = ($this->input->post_get("used_footer") == "0") ? false : true;
        $this->load->view('page_register', $data);
    }
    
    //test purpose only
    function daftar_test(){
    $dataHarga = [];
      
        $harga = $this->db->query("SELECT kelas.*, jenis.judul, jenis.id_jenis, jenis.id_kategori, jenis.routes 
        FROM kelas INNER JOIN jenis on kelas.id_jenis=jenis.id_jenis INNER JOIN kategori1 on jenis.id_kategori=kategori1.id_kategori WHERE jenis.id_jenis NOT IN ('34', '35', '25', '26', '27') GROUP BY kelas.id_kelas")->result();
        foreach($harga as $hrg){
          $dataHarga[$hrg->routes] = $hrg;
          $dataHarga[$hrg->routes]->biaya_in_house_per_person = json_decode($hrg->biaya_in_house_per_person);
        }
        $data['detail'] = (object) array("judul" => "Form Pendaftaran Kursus/Training Lauwba Techno Indonesia", "isi_jenis" => "Form Pendaftaran Kursus/Training Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $data['kota'] = $this->db->query("SELECT * FROM alamat")->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori1 WHERE id_kategori NOT IN ('1', '10', '5') ORDER BY kategori1.nama_kategori ASC")->result();
        $data['training'] = $this->db->query("SELECT * FROM jenis WHERE id_jenis NOT IN ('34', '35', '25', '26', '27')")->result();
        $data['used_header'] = ($this->input->post_get("used_header") == "0") ? false: true;
        $data['used_footer'] = ($this->input->post_get("used_footer") == "0") ? false : true;
        $data['harga'] = json_encode($dataHarga);
        $this->load->view('page_register_test', $data);

    }
    
    function proses_pendaftaran(){
        header('Access-Control-Allow-Origin: *');
        //global var
        $selectedTraining = "";
        $nama = $this->input->post_get("nama-lengkap");
        $from = (!empty($this->input->post_get("from"))) ? $this->input->post_get("from") : "Lauwba Techno Indonesia";
        $tel = $this->input->post_get("nomor-hape");
        $instansi = $this->input->post_get("nama-instansi");
        $jabatan = $this->input->post_get("jabatan");
        $kota = $this->input->post_get("kota");
        $training = $this->input->post_get("training");
        
        $harga = $this->input->post_get("harga");
        $tahu = $this->input->post_get("tahu-darimana");
        $motivasi = $this->input->post_get("motivasi");
        $keterangan = $this->input->post_get("keterangan");
        $pilihanKelas = $this->input->post_get("pilihan-kelas");
        $email = $this->input->post_get("email");
        $nextid = $this->input->post_get("nextid");
        $voucher = $this->input->post_get('voucher');
        $potongan = $this->getDiskon($voucher);
        
        //private
        $trainingPrivate = $this->input->post_get('training-private-offline');
        $trainingPrivateOnline = $this->input->post_get('training-private-online');
        
        //reg online
        $trainingRegOnline = $this->input->post_get('training-reg-online');
        
        //in house training
        $kotaPelaksanaanInHouse = $this->input->post_get('kota-in-house');
        $tanggalMulaiInHouse = $this->input->post_get('tanggal-mulai-in-house');
        $tanggaSelesaiInHouse = $this->input->post_get('tanggal-selesai-in-house');
        $trainingInHouse = $this->input->post_get('training-in-house');
        $jumlahPeserta = $this->input->post_get('jumlah-peserta');
        
        
        //inkubator
        $durasi = $this->input->post_get("durasi-kelas-inkubator");
        $trainInkubator = $this->input->post_get('training-inkubator');
        $tanggalMulaiInkubator = "";
        $alamatLuarkota = "";
        if($pilihanKelas == "private-offline"){
            $selectedTraining = $trainingPrivate;
            $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-offline');
            $kotaPrivate = $this->input->post_get('kota-private-offline');
            $alamatLuarkota = $this->input->post_get('alamat-private-offline');
        }else if($pilihanKelas == "private-online"){
            $selectedTraining = $trainingPrivateOnline;
            $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-online');
            $kotaPrivate = "";
        }else if($pilihanKelas == "reg"){
            $selectedTraining = $training;
            $tanggalMulaiPrivate = "";
            $kotaPrivate = "";
            $jadwal = $this->input->post_get("jadwal");
        }else if($pilihanKelas == "reg-online"){
            $selectedTraining = $trainingRegOnline;
            $tanggalMulaiPrivate = "";
            $kotaPrivate = "";
            $jadwal = $this->input->post_get("jadwal-reg-online");
        }else if($pilihanKelas == "in-house"){
            $selectedTraining = $trainingInHouse;
            $tanggalMulaiPrivate = "";
            $kotaPrivate = "";
        }else if($pilihanKelas == "inkubator"){
             $selectedTraining = $trainInkubator;
             $tanggalMulaiPrivate = "";
             $kotaPrivate = "";
             $tanggalMulaiInkubator = $this->input->post_get('tanggal-mulai-inkubator');
        }
        
        // if(!empty($trainingPrivate)){
        //     $selectedTraining = $trainingPrivate;
        //     $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-offline');
        //     $kotaPrivate = $this->input->post_get('kota-private-offline');
        // }else if(!empty($trainingPrivateOnline)){
        //     $selectedTraining = $trainingPrivateOnline;
        //     $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-online');
        //     $kotaPrivate = "";
        // }else if(!empty($trainingInHouse)){
        //     $selectedTraining = $trainingInHouse;
        //     $tanggalMulaiPrivate = "";
        //     $kotaPrivate = "";
        // }else if(!empty($trainInkubator)){
        //     $selectedTraining = $trainInkubator;
        // }else if(!empty($training)){
        //     $selectedTraining = $training;
        //     $tanggalMulaiPrivate = "";
        //     $kotaPrivate = "";
        // }
        
        $nextid = $this->db->query("SELECT MAX(id)+1 as nextid FROM `pendaftar`ORDER BY id LIMIT 1")->row()->nextid;
        $harga1 = str_replace("Rp", "", $harga);
        $harga2 = str_replace(" ", "", $harga1);
        $harga3 = str_replace(".", "", $harga2);
        $telBesih1 = str_replace("(","", $tel);
        $telBesih2 = str_replace(")","", $telBesih1);
        $telBesih3 = str_replace("-","", $telBesih2);
        $telBesih4 = str_replace(" ","", $telBesih3);
        
        $data = array(
            'id' => $nextid,
            'nama_lengkap'=>$nama,
            'nomor_telepon'=>$telBesih3,
            'instansi'=>$instansi,
            'random' => $this->etc->randomunik(),
            'email' => $email,
            'jabatan'=>$jabatan,
            'kota'=>$kota,
            'training'=>$selectedTraining,
            'jadwal'=>$jadwal,
            'harga'=>$harga3,
            'tahu_darimana'=>$tahu,
            'durasi' => $durasi,
            'from'=>$from,
            'motivasi'=>$motivasi,
            'voucher' => $voucher,
            'keterangan'=>$keterangan,
            'private_tanggal_mulai' => $tanggalMulaiPrivate,
            'private_kota_pelaksanaan' => $kotaPrivate,
            'in_house_kota_pelaksanaan' => $kotaPelaksanaanInHouse,
            'in_house_tanggal_mulai' => $tanggalMulaiInHouse,
            'in_house_tanggal_selesai' => $tanggaSelesaiInHouse,
            'in_house_jumlah_peserta' => $jumlahPeserta,
            'pilihan_kelas' => $pilihanKelas,
            'inkubator_tanggal_mulai' => $tanggalMulaiInkubator,
            'alamat_private_offline' => $alamatLuarkota
            );
            
            // print_r($data);
        if($potongan > 0){
        }
        $res = $this->crud->insert("pendaftar", $data);
        if($res > 0){
            if(!empty($email)){
                $this->do_send_mail($email, $nextid, "Payment Invoice", $from);
            }else{
                echo json_encode(array("message" => "Pendaftaran Berhasil.", 'nextid'=> $nextId, "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
    }
    
    function jadwal($kota){
        $year = date('Y');
        header('Access-Control-Allow-Origin: *');
        $from = $this->input->get('frm');
        if(!empty($from) && strtolower($from) == 'lkp'){
            //lkp request
            $hurufABesar = 65;
            $res = $this->db->query("SELECT * FROM lauwbaco_admin_lkp.jadwal");
            if($res->num_rows() > 0){
                echo "<option value=''>--Silahkan Pilih--</option>";
                foreach($res->result() as $rs){
                    echo "<option value='$rs->id_jadwal'>
                    <span class='font-weight-bold'>". chr($hurufABesar++). ". </span> <i>". $rs->hari_pelaksanaan." (". date_format(new DateTime($rs->jam_mulai), 'H:i')." - ". date_format(new DateTime($rs->jam_selesai), 'H:i').")</i></option>";
                }
            }else{
                echo "<script>";
                echo "alert('Terjadi Kesalahan')";
                echo "<script>";
            }
        }else{
            $res = $this->db->query("SELECT * FROM `jadwal` WHERE kota_pelaksanaan LIKE '%$kota%' AND active IN ('Y') AND tahun IN('$year') AND keterangan NOT IN ('full booked')");
            if($res->num_rows() > 0){
                    echo "<option value=''>--Silahkan Pilih--</option>";
                foreach($res->result() as $rs){
                    echo "<option value='$rs->id'>$rs->tanggal</option>";
                }
            }else{
                echo "<script>";
                echo "alert('Terjadi Kesalahan')";
                echo "<script>";
            }
        }
        
        
    }
    
    function biaya_luar_kota($jenis, $luarKota = 0, $online = NULL){
        header('Access-Control-Allow-Origin: *');
        $from = $this->input->get('req');
        $data = [];
        if(strtolower($from) == 'lkp'){
             if($online == NULL){
                if($luarKota == 0){
                    $data = $this->db->query("SELECT biaya as biaya, biaya_coret as coret FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
                    $msg = "<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small>";
                }else{
                    $data = $this->db->query("SELECT biaya_luar_kota as biaya FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
                    $msg ="<small class='badge badge-success text-center'>". $this->etc->rp($data->row()->biaya)."</small>";
                }
            }else{
                $data = $this->db->query("SELECT biaya_reg_online as biaya, biaya_reg_online_coret as coret FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
                $msg = "<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small>";
            }
            
            if($data->num_rows() > 0){
                echo json_encode(array(
                    "biaya"=>$this->etc->rp($data->row()->biaya),
                    'biaya_clear' => $data->row()->biaya,
                    "biaya_text" => $msg. "<small class='hemat'></small>"));
            }else{
                echo json_encode("Tidak ada data");
            }
        }else{
            if($online == NULL){
                if($luarKota == 0){
                    $data = $this->db->query("SELECT biaya as biaya, biaya_coret as coret FROM kelas WHERE id_jenis IN ('$jenis')");
                    $msg = "<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small>";
                }else{
                    $data = $this->db->query("SELECT biaya_luar_kota as biaya FROM kelas WHERE id_jenis IN ('$jenis')");
                    $msg ="<small class='badge badge-success text-center'>". $this->etc->rp($data->row()->biaya)."</small>";
                }
            }else{
                $data = $this->db->query("SELECT biaya_reg_online as biaya, biaya_reg_online_coret as coret FROM kelas WHERE id_jenis IN ('$jenis')");
                $msg = "<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small>";
            }
            if($data->num_rows() > 0){
                echo json_encode(array(
                    "biaya"=>$this->etc->rp($data->row()->biaya),
                    'biaya_clear' => $data->row()->biaya,
                    "biaya_text" => $msg. "<small class='hemat'></small>"));
            }else{
                echo json_encode("Tidak ada data");
            }
        }
    }
    
    function biaya_private($jenis, $luarKotaStats = "0"){
        header('Access-Control-Allow-Origin: *');
        
        $from = $this->input->get('req');
        if(strtolower($from) == 'lkp'){
            if($luarKotaStats == "1"){
                $luarKota = $this->db->query("SELECT biaya_private_off_luar_kota as coret, biaya_private_off_luar_kota_coret as biaya FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
                if($luarKota->num_rows() > 0){
                    echo json_encode(array(
                        "biaya" => $this->etc->rp($luarKota->row()->biaya), 
                        "biaya_clear" => $luarKota->row()->biaya,
                        "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($luarKota->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($luarKota->row()->biaya)."</small><small class='hemat'></small>"));
                }else{
                    echo json_encode("Tidak ada data");
                }
            }else{
                $data = $this->db->query("SELECT biaya_private as biaya, biaya_private_coret as coret FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
                if($data->num_rows() > 0){
                    echo json_encode(array(
                        "biaya" => $this->etc->rp($data->row()->biaya), 
                        "biaya_clear" => $data->row()->biaya,
                        "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small><small class='hemat'></small>"));
                }else{
                    echo json_encode("Tidak ada data");
                }
            }
        }else{
            if($luarKotaStats == "1"){
                $luarKota = $this->db->query("SELECT biaya_private_off_luar_kota as coret, biaya_private_off_luar_kota_coret as biaya FROM kelas WHERE id_jenis IN ('$jenis')");
                if($luarKota->num_rows() > 0){
                    echo json_encode(array(
                        "biaya" => $this->etc->rp($luarKota->row()->biaya), 
                        "biaya_clear" => $luarKota->row()->biaya,
                        "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($luarKota->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($luarKota->row()->biaya)."</small><small class='hemat'></small>"));
                }else{
                    echo json_encode("Tidak ada data");
                }
            }else{
                $data = $this->db->query("SELECT biaya_private as biaya, biaya_private_coret as coret FROM kelas WHERE id_jenis IN ('$jenis')");
                if($data->num_rows() > 0){
                    echo json_encode(array(
                        "biaya" => $this->etc->rp($data->row()->biaya), 
                        "biaya_clear" => $data->row()->biaya,
                        "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small><small class='hemat'></small>"));
                }else{
                    echo json_encode("Tidak ada data");
                }
            }
        }
    }
    
    function biaya_private_online($jenis){
        header('Access-Control-Allow-Origin: *');
        $from = $this->input->get('req');
        if(strtolower($from) == 'lkp'){
            
             $data = $this->db->query("SELECT biaya_private_online as biaya, biaya_private_online_coret as coret FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
            if($data->num_rows() > 0){
                echo json_encode(array(
                    "biaya" => $this->etc->rp($data->row()->biaya), 
                    "biaya_clear" => $data->row()->biaya,
                    "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small><small class='hemat'></small>"));
            }else{
                echo json_encode("Tidak ada data");
            }
        }else{
            $data = $this->db->query("SELECT biaya_private_online as biaya, biaya_private_online_coret as coret FROM kelas WHERE id_jenis IN ('$jenis')");
            if($data->num_rows() > 0){
                echo json_encode(array(
                    "biaya" => $this->etc->rp($data->row()->biaya), 
                    "biaya_clear" => $data->row()->biaya,
                    "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center  biaya-formatted'>". $this->etc->rp($data->row()->biaya)."</small><small class='hemat'></small>"));
            }else{
                echo json_encode("Tidak ada data");
            }
        }
    }
    function biaya_incubator($jenis, $durasi){
        header('Access-Control-Allow-Origin: *');
        $from = $this->input->get('req');
        if(strtolower($from) == 'lkp'){
            
             $data = $this->db->query("SELECT biaya_incubator as biaya, biaya_incubator_coret as coret FROM lauwbaco_admin_lkp.kelas WHERE id_jenis IN ('$jenis')");
            if($data->num_rows() > 0){
                echo json_encode(array("biaya" => $this->etc->rp($data->row()->biaya), 
                "biaya_clear" =>$data->row()->biaya,
                "total" => $this->etc->rp($data->row()->biaya*$durasi),
                "total_clear" => $data->row()->biaya*$durasi,
                "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center biaya-formatted'>". $this->etc->rp($data->row()->biaya).
                "</small><br><small class='font-weight-bold small'>Kontribusi diatas adalah Kontribusi Per Bulannya</small><br><small class='font-weight-bold small'>Total Kontribusi</small><br><small class='badge badge-success text-center  total-formatted'>". $this->etc->rp($data->row()->biaya*$durasi).
                "</small><small class='hemat'></small>"
                ));
            }else{
                echo json_encode("Tidak ada data");
            }
        }else{
            $data = $this->db->query("SELECT biaya_incubator as biaya, biaya_incubator_coret as coret FROM kelas WHERE id_jenis IN ('$jenis')");
            if($data->num_rows() > 0){
                echo json_encode(array("biaya" => $this->etc->rp($data->row()->biaya), 
                "biaya_clear" =>$data->row()->biaya,
                "total" => $this->etc->rp($data->row()->biaya*$durasi),
                "total_clear" => $data->row()->biaya*$durasi,
                "biaya_text" =>"<small class='text-danger font-weight-bold'><del>". $this->etc->rp($data->row()->coret)."</del></small> <small class='badge badge-success text-center biaya-formatted'>". $this->etc->rp($data->row()->biaya).
                "</small><br><small class='font-weight-bold small'>Kontribusi diatas adalah Kontribusi Per Bulannya</small><br><small class='font-weight-bold small'>Total Kontribusi</small><br><small class='badge badge-success text-center  total-formatted'>". $this->etc->rp($data->row()->biaya*$durasi).
                "</small><small class='hemat'></small>"
                ));
            }else{
                echo json_encode("Tidak ada data");
            }
        }
    }
    
    //end of pendaftaran
    function contact() {
        $this->load->view('headfoot/doctype');
        $data['team'] = $this->crud->select_other('tutor', 'order by id_tutor desc')->result();
        $data['static'] = $this->crud->select_where('halamanstatis', "id_halaman='28'")->row();
        $this->load->view('page_contacts', $data);
    }

    function portofolio() {
        $data['all_it'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('20', '21', '22') order by seq asc")->result();
        $data['all_proj'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('17', '18', '26') order by seq asc")->result();
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by seq asc")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by seq asc")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by seq asc")->result();
        $data['android'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='17' order by seq asc")->result();
        $data['desktop'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('26', '18') order by seq asc")->result();
        $data['detail'] = (object) array("judul" => "Semua Portofolio", "isi_jenis" => "Semua Portofolio Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_portofolio', $data);
    }
    
    function portofolio_selengkapnya($idAlbum){
        if($idAlbum == "it-training"){
        $title = "Portofolio IT Training";
        $data['all_it'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('20', '21', '22') order by seq asc")->result();
        $data['all_proj'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('17', '18', '26') order by seq asc")->result();
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by seq asc")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by seq asc")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by seq asc")->result();
        $data['project'] = false;
        }else if($idAlbum == 'web-desktop-apps'){
            $title = "Portofolio Web & Desktop Apps";
            $data['title'] = "Portofolio Web & Desktop Apps";
            $data['project'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('26', '18') order by seq asc")->result();
        }else if($idAlbum == 'mobile-apps'){
            $title = "Portofolio Mobile Apps";
            $data['title'] = "Portofolio Mobile Apps";
            $data['project'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='17' order by seq asc")->result();
        }
        $data['detail'] = (object) array("judul" => $title, "isi_jenis" => $title);
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_portofolio_selengkapnya', $data);
    }

    function static_page($param, $id) {
        $data['static'] = $this->crud->select_where('halamanstatis', "id_halaman='$param'")->row();
        $this->load->view('headfoot/doctype', $data);
        $this->load->view('page_static', $data);
        // print_r($data);
    }
    
    function invoice($nomorPendaftaran){
        if(!is_numeric($nomorPendaftaran)){
            $this->invoiceProject($nomorPendaftaran);
        }else{
            $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
            WHERE pendaftar.id='$nomorPendaftaran'")->row();
            
            if(empty($data['detail'])){
                echo '<script>alert(`Data pendaftar tidak ditemukan`); window.close();</script>';
                return;
            }
            if($data['detail']->from == "LKP UNIKOM"){
                 $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
            INNER JOIN jenis
            ON pendaftar.training = jenis.id_jenis 
            INNER JOIN kelas 
            ON jenis.id_jenis=kelas.id_jenis 
            WHERE pendaftar.id='$nomorPendaftaran'")->row();
                $this->load->view("invoices-lkp", $data);
            }else{
                $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
                INNER JOIN`jenis` 
                ON pendaftar.training = jenis.id_jenis 
                INNER JOIN kelas 
                ON jenis.id_jenis=kelas.id_jenis 
                WHERE pendaftar.id='$nomorPendaftaran'")->row();
                $this->load->view("invoices", $data);
            }
        }
    }
    
    private function invoiceProject($idPendaftaran){
        $data['detail'] = $this->db->query("SELECT * FROM pendaftar_project WHERE uuid = '$idPendaftaran'")->row();
        $this->load->view('invoices-project', $data);
    }

    function soft_dev($param = null) {
        $first = explode(".", $param);
        $data['static'] = $this->crud->select_other('halamanstatis', "WHERE judul_seo='$first[0]'")->row();
        $data['detail'] = (object) array("judul" => str_replace("-", ' ', $first[0]), "isi_jenis"=> "Semua Portofolio Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_static', $data);
    }

    function kursus($param = null) {
        $data['testimoni'] = $this->crud->select('testimoni')->result();
        if ($param == "all") {
            $data['kelas'] = $this->crud->select_other('jenis', "join kategori1 ON jenis.id_kategori=kategori1.id_kategori"
                            . " JOIN kelas ON jenis.id_jenis=kelas.id_jenis ORDER BY jenis.seq ASC")->result();
            $isi = "Training/Kursus " . $data['kelas'][0]->nama_kategori;
            $data['dir'] = "../../";
            $data['detail'] = (object) array("judul" => $isi, "isi_jenis" => $isi);
            $this->load->view('headfoot/doctypedetail', $data);
            $this->load->view('page_software_dev', $data);
        } else {

            $first = explode(".", $param);

            $data['kelas'] = $this->crud->select_other('jenis', "join kategori1 ON jenis.id_kategori=kategori1.id_kategori"
                            . " JOIN kelas ON jenis.id_jenis=kelas.id_jenis "
                            . " WHERE kategori1.kategori_seo='$first[0]' AND id_subkategori NOT IN ('1') ORDER BY jenis.seq ASC")->result();
            $isi = "Training/Kursus " . $data['kelas'][0]->nama_kategori;
            $data['dir'] = "../";
            $data['detail'] = (object) array("judul" => $isi, "isi_jenis" => $isi);
            $this->load->view('headfoot/doctypedetail', $data);
            $this->load->view('page_software_dev', $data);
        }
    }

    function profile($params) {
        $this->load->view('headfoot/doctype');
        $data['static'] = $this->crud->select_other('halamanstatis', "WHERE judul_seo='$params'")->row();
        $this->load->view('page_static', $data);
    }

    function product($seo) {
        $data['products'] = $this->crud->select_other('produk', "WHERE judul_seo='$seo'")->row();
        $data['produk'] = $this->crud->select_other('produk', 'ORDER BY date_added DESC LIMIT 5')->result();
        $id_produk = $data['products']->id_produk;
        $data['tag'] = $this->crud->select_other("tag", "WHERE id_kolom='$id_produk'")->result();
        $title['detail'] = (object) array("judul" => $data['products']->nama_produk, "isi_jenis" => $data['products']->deskripsi);
        $this->load->view('headfoot/doctypedetail', $title);
        $this->load->view('page_produk_details', $data);
    }
    
    function pkl(){
        $this->load->view('pkl/index');   
    }
    
    private function do_send_mail($username, $nomorPendaftaran, $subject = "Payment Invoice", $from)
	{
		// $from_email = "sigitsuryono0225@gmail.com";
		$config = Array(
			'protocol' => 'mail',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => '587',
			'smtp_user' => 'payment.lauwba@gmail.com',
			'smtp_pass' => 'admin>_<',
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'charset' => 'utf-8'
		);
		
		$data['detail'] = $this->db->query("SELECT * FROM pendaftar 
        WHERE pendaftar.id='$nomorPendaftaran'")->row();
        // print_r($data);
        // die;
        if($data['detail']->from == "LKP UNIKOM"){
             $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
        INNER JOIN lauwbaco_admin_lkp.jenis
        ON pendaftar.training = lauwbaco_admin_lkp.jenis.id_jenis 
        INNER JOIN lauwbaco_admin_lkp.kelas 
        ON lauwbaco_admin_lkp.jenis.id_jenis=kelas.id_jenis 
        WHERE pendaftar.id='$nomorPendaftaran'")->row();
           $msg = $this->load->view("invoices-mail-lkp", $data, TRUE);	
        }else{
            $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
            INNER JOIN`jenis` 
            ON pendaftar.training = jenis.id_jenis 
            INNER JOIN kelas 
            ON jenis.id_jenis=kelas.id_jenis 
            WHERE pendaftar.id='$nomorPendaftaran'")->row();
            $msg = $this->load->view("invoices-mail", $data, TRUE);
        }

		$this->load->library('email', $config);
// 		$this->email->set_header('Content-Type', 'text/html');
		$this->email->set_newline("\r\n");

		$this->email->from("payment.lauwba@gmail.com");
		$this->email->to($username);
		$this->email->subject($subject);
		$this->email->message($msg);

		//Send mail
		if ($this->email->send()) {
            echo json_encode(array("message" => "Pendaftaran Berhasil. Invoice Telah Dikirimkan Ke Email anda. Pastikan Email anda benar.", "error" => 200, 'nextid'=>$nomorPendaftaran));
		    $this->sendNotification($data['detail']->nama_lengkap);
		} else {
			echo $this->email->print_debugger();
			// print("Email gagal terkirim.");
		}
	}
	
	function sendNotification($message){
        // $re = file_get_contents("php://input");
        // $json = json_decode($re);
        
        // print_r($json);
        
        $content = array(
                     "en" => 'English Message'
                     );

        $fields = array(
                        'app_id' => '8bad0d73-ade4-484e-9e8c-7a75f277be3e',
                        'included_segments' => array('All'),
                        'data' => array("foo" => "bar"),
                        'contents' => array("en" => $message),
                        'headings' => array("en"=>"Pendaftar Baru"),
                        );
    
        $fields = json_encode($fields);
        // print("\nJSON sent:\n");
        // print($fields);
    
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
    
        // echo json_encode($response);
    }
	
	function testimoni(){
        $title['detail'] = (object) array("judul" => "Testimoni", "isi_jenis" => "Testimoni Lengka Lauwba Techno Indonesia");
	    $data['testimoni'] = $this->db->query("SELECT * FROM testimoni ORDER BY tanggal DESC")->result();
        $this->load->view('headfoot/doctypedetail', $title);
	    $this->load->view('page_testimoni', $data);
	}
	
	function getPopupSettings(){
        header('Access-Control-Allow-Origin: *');
	    $res = $this->db->query("SELECT * FROM popup_image")->row();
	    echo json_encode($res);
	}
	
	function acceptCookies(){
	     $cookie= array(
           'name'   => 'lauwba_popup',
           'value'  => 'is_activated',                            
           'expire' => '259200'

       );

       $this->input->set_cookie($cookie);
       echo "cookie berhasil";
	}
	
	function form_surat_penawaran(){
        $this->load->view('headfoot/doctype');
	    $this->load->view('page_surat_penawaran');
	}
	
	
	 public function surat_penawaran($resi) {
	     $usingPdf = $this->input->get('pdf') ?? 0;
	    $url = site_url("webservices/get_detail_training?resi=$resi");
	     //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);
        
        $data['ttd'] = base_url('/assets/img/ttd.png');
        $data['rekening'] = base_url('/assets/img/rekening.png');
        $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
        INNER JOIN`jenis` 
        ON pendaftar.training = jenis.id_jenis 
        INNER JOIN kelas 
        ON jenis.id_jenis=kelas.id_jenis 
        WHERE pendaftar.id='$resi'")->row();
        $template = "";
        $template .= $this->opening($data);
            // $template .= $this->main($data);
        echo $template;
    }
    
    private function opening($data){
        return $this->load->view('surat-penawaran/template_surat_penawaran', $data, TRUE);
            
    }
    
    private function main($data){
        return $this->load->view('surat-penawaran/template_surat_penawaran_main', $data, TRUE);
    }
    
    private function getDiskon($voucher){
        $res = $this->db->query("SELECT * FROM tb_voucher WHERE kode_voucher IN ('$voucher')")->row();
        $berlaku = $res->berlaku;
        $now = date('Y-m-d');
        if($now <= $berlaku){
            $message = "Voucher Valid";
            $potongan = $res->nominal;
        }else if($now > $berlaku){
            $message = "Voucher Kadaluarsa";
            $potongan = 0;
        }
        return $potongan;
    }
    
    function diskon(){
        header('Access-Control-Allow-Origin: *');
        $voucher = $this->input->post_get('voucher');
        $res = $this->db->query("SELECT * FROM tb_voucher WHERE kode_voucher IN ('$voucher')")->row();
        $berlaku = $res->berlaku;
        $now = date('Y-m-d');
        if($now <= $berlaku){
            $message = "Voucher Valid";
            $potongan = $res->nominal;
        }else if($now > $berlaku){
            $message = "Voucher Kadaluarsa";
            $potongan = 0;
        }
        echo json_encode(['potongan' => $potongan, 'message' => $message]);
    }
    
    function buktiBayar($idBayar){
        $this->load->view('page_bukti_bayar');
    }
    
    function jadwal_embedded(){
        $this->load->view('headfoot/doctypedetail', $title);
        $data['embedded'] = true;
        $this->load->view('headfoot/header');
        $this->load->view('module_jadwal', $data);
        // $this->load->view('headfoot/footer');
    }
    
    function getTrainingAndPrice($idKategori = null){
        $where = "";
        if(!empty($idKategori)){
            $where .= " WHERE kategori1.id_kategori IN ('$idKategori') AND jenis.id_jenis NOT IN ('34', '35', '25', '26', '27')";
        }
        $harga = $this->db->query("SELECT kelas.*, jenis.judul, jenis.id_jenis as jenis_id, jenis.id_kategori, jenis.routes 
        FROM kelas 
        INNER JOIN jenis on kelas.id_jenis=jenis.id_jenis 
        INNER JOIN kategori1 on jenis.id_kategori=kategori1.id_kategori 
        $where 
        GROUP BY kelas.id_kelas")->result();
        
        foreach($harga as $hrg){ 
            echo "<option value='$hrg->jenis_id' 
            data-biaya-reg='".$this->etc->rps($hrg->biaya)."'
            data-biaya-reg-coret='".$this->etc->rps($hrg->biaya_coret)."'
            data-biaya-reg-luar-kota='".$this->etc->rps($hrg->biaya_luar_kota)."'
            data-biaya-reg-online-coret='".$this->etc->rps($hrg->biaya_reg_online_coret)."'
            data-biaya-reg-online='".$this->etc->rps($hrg->biaya_reg_online)."'
            data-biaya-private-offline='".$this->etc->rps($hrg->biaya_private)."'
            data-biaya-private-offline-coret='".$this->etc->rps($hrg->biaya_private_coret)."'
            data-biaya-private-online-coret='".$this->etc->rps($hrg->biaya_private_online_coret)."'
            data-biaya-private-online='".$this->etc->rps($hrg->biaya_private_online)."'
            data-biaya-inkubator-coret='".$this->etc->rps($hrg->biaya_incubator_coret)."'
            data-biaya-inkubator='".$this->etc->rps($hrg->biaya_incubator)."'
            data-biaya-inhouse-coret='".$this->etc->rps($hrg->biaya_inhouse_coret)."'
            data-biaya-inhouse='".$hrg->biaya_in_house_per_person."'
            data-biaya-private-offline-luar-kota-coret='".$this->etc->rps($hrg->biaya_private_off_luar_kota_coret)."'
            data-biaya-private-offline-luar-kota='".$this->etc->rps($hrg->biaya_private_off_luar_kota)."'>$hrg->judul</option>"; 
        }
        
        /*// data-biaya-reg='$harga->biaya'
            // data-biaya-reg-coret='$harga->biaya_coret'
            // data-biaya-reg-luar-kota='$harga->biaya_luar_kota'
            // data-biaya-reg-online=''
            // data-biaya-reg-online-coret=''
            // data-biaya-private-offline=''
            // data-biaya-private-offline-coret=''
            // data-biaya-private-online-coret=''
            // data-biaya-private-online=''
            // data-biaya-private-inhouse=''
            // data-biaya-private-inhouse-coret=''
            // data-biaya-private-inkubator=''
            // data-biaya-private-inkubator-coret=''
            // data-biaya-private-inkubator-coret=''*/
    }

}
