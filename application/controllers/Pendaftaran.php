<?php

class Pendaftaran extends CI_Controller{

    function index(){
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
        $this->load->view('page_register', $data);
    }    
    
    function pendaftaranProcess(){
        header('Access-Control-Allow-Origin: *');
        $jsonData = file_get_contents("php://input");
        $json = json_decode($jsonData);
        $nextid = $this->db->query("SELECT MAX(id)+1 as nextid FROM `pendaftar`ORDER BY id LIMIT 1")->row()->nextid;
        $random = $this->etc->randomunik();
        $data = [
            'id' => $nextid,
            'nama_lengkap' => $json->nama_lengkap,
            'email' => $json->email,
            'random' => $random,
            'nomor_telepon' => $json->nomor_hp,
            'instansi' => $json->nama_instansi,
            'jabatan' => $json->jabatan,
            'harga' => $this->calculatePrice($json, $random),
            'tahu_darimana' => $json->tahu_darimana,
            'motivasi' => $json->motivasi,
            'keterangan' => $json->keterangan_tambahan,
            'voucher' => $json->kode_promo,
            'from' => $json->from,
            'referral_code' => $json->kode_ref,
        ];
        $pilihanKelas = $json->pilihan_kelas;
        
        if($pilihanKelas == "reg"){
            $this->processReguler($json,$data);
        }
        else if($pilihanKelas == "private-offline"){
            $this->processPrivate($json,$data);
        }
        else if($pilihanKelas == "private-online"){
            $this->processPrivate($json,$data);
        }
        else if($pilihanKelas == "inkubator"){
            $this->processInkubator($json,$data);
        }
        else if($pilihanKelas == "in-house"){ 
            $this->processCooporate($json,$data);
        }
    }
    
    function updatePendaftaranProcess(){
        header('Access-Control-Allow-Origin: *');
        $jsonData = file_get_contents("php://input");
        $json = json_decode($jsonData);
        $random = $json->random;
        $data = [
            'nama_lengkap' => $json->nama_lengkap,
            'email' => $json->email,
            'random' => $random,
            'nomor_telepon' => $json->telepon,
            'instansi' => $json->instansi,
            'jabatan' => $json->jabatan,
            'harga' => $this->calculatePrice($json, $random),
            'tahu_darimana' => $json->tahu_darimana,
            'motivasi' => $json->motivasi,
            'keterangan' => $json->keterangan,
            'from' => $json->from,
        ];
        $pilihanKelas = $json->pilihan_kelas;
        
        if($pilihanKelas == "reg"){
            $this->processReguler($json,$data, true);
        }
        else if($pilihanKelas == "private-offline"){
            $this->processPrivate($json,$data, true);
        }
        else if($pilihanKelas == "private-online"){
            $this->processPrivate($json,$data, true);
        }
        else if($pilihanKelas == "inkubator"){
            $this->processInkubator($json,$data, true);
        }
        else if($pilihanKelas == "in-house"){ 
            $this->processCooporate($json,$data, true);
        }
    }
    
    private function processReguler($json,$data, $isUpdate = false){
        $data['kota'] = $json->kota_pelaksanaan_reguler;
        $data['training'] = $json->pilihan_training_reguler;
        $data['pilihan_kelas'] = $json->pilihan_kelas;
        $data['jadwal'] = $json->pilihan_jadwal_reguler;
        $where = ['id' => $json->id];
        if($isUpdate){
            $res = $this->crud->updateArray("pendaftar", $data, $where);
            $data['id'] = $json->id;
        }else{
            $res = $this->crud->insert("pendaftar", $data);
        }
        if($res > 0){
            if(!empty($json->email)){
                $this->do_send_mail($json->email, $data['id'], "Payment Invoice", $json->from);
            }else{
                echo json_encode(array("message" => "Pendaftaran Berhasil.", 'nextid'=> $data['id'], "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
    }
    
    private function processPrivate($json,$data, $isUpdate = false){
        $data['pilihan_kelas'] = $json->pilihan_kelas;
        $data['private_tanggal_mulai'] = $json->tanggal_mulai_private;
        $data['training'] = $json->pilihan_training_private;
        $data['private_kota_pelaksanaan'] = $json->private_kota_pelaksanaan;
        $data['alamat_private_offline'] = $json->alamat_private_offline;
        $where = ['id' => $json->id];
        
        if($isUpdate){
            $res = $this->crud->updateArray("pendaftar", $data, $where);
            $data['id'] = $json->id;
        }else{
            $res = $this->crud->insert("pendaftar", $data);
        }
        
        if($res > 0){
            if(!empty($json->email)){
                $this->do_send_mail($json->email, $data['id'], "Payment Invoice", $json->from);
            }else{
                echo json_encode(array("message" => "Pendaftaran Berhasil.", 'nextid'=> $data['id'], "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
    }
    
    
    
    private function processInkubator($json,$data, $isUpdate = false){
        $data['durasi'] = $json->durasi_inkubator;
        $data['inkubator_tanggal_mulai'] = $json->tanggal_mulai_inkubator;
        $data['pilihan_kelas'] = $json->pilihan_kelas;
        $data['training'] = $json->pilihan_training_inkubator;
        $where = ['id' => $json->id];
        
        if($isUpdate){
            $res = $this->crud->updateArray("pendaftar", $data, $where);
            $data['id'] = $json->id;
        }else{
            $res = $this->crud->insert("pendaftar", $data);
        }
        
        if($res > 0){
            if(!empty($json->email)){
                $this->do_send_mail($json->email, $data['id'], "Payment Invoice", $json->from);
            }else{
                echo json_encode(array("message" => "Pendaftaran Berhasil.", 'nextid'=> $data['id'], "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
    }
    
    private function processCooporate($json,$data, $isUpdate = false){
        $data['in_house_kota_pelaksanaan'] = $json->alamat_coorporate;
        $data['pilihan_kelas'] = $json->pilihan_kelas;
        $data['in_house_tanggal_mulai'] = $json->tanggal_mulai_coorporate;
        $data['in_house_tanggal_selesai'] = $json->tanggal_selesai_coorporate;
        $data['training'] = $json->pilihan_training_coorporate;
        $data['in_house_jumlah_peserta'] = $json->jumlah_peserta_coorporate;
        $where = ['id' => $json->id];
        
        if($isUpdate){
            $res = $this->crud->updateArray("pendaftar", $data, $where);
            $data['id'] = $json->id;
        }else{
            $res = $this->crud->insert("pendaftar", $data);
        }
        
        if($res > 0){
            if(!empty($json->email)){
                $this->do_send_mail($json->email, $data['id'], "Payment Invoice", $json->from);
            }else{
                echo json_encode(array("message" => "Pendaftaran Berhasil.", 'nextid'=> $data['id'], "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
    }
    
    private function do_send_mail($username, $nomorPendaftaran, $subject = "Payment Invoice", $from)
	{
		$config = array(
            'protocol'   => 'smtp',
            'smtp_host'  => 'smtp.gmail.com',
            'smtp_port'  => 587,
            'smtp_user'  => 'payment.lauwba@gmail.com',
            'smtp_pass'  => 'huazifhrbgmhhrkw', // App Password
            'smtp_crypto'=> 'tls',
            'mailtype'   => 'html',
            'charset'    => 'utf-8',
            'wordwrap'   => TRUE,
            'newline'    => "\r\n",
            'crlf'       => "\r\n"
        );
		
		$data['detail'] = $this->db->query("SELECT * FROM pendaftar 
        WHERE pendaftar.id='$nomorPendaftaran'")->row();
        // print_r($data);
        // die;
        if($data['detail']->from == "LKP UNIKOM"){
             $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
        INNER JOIN jenis
        ON pendaftar.training = jenis.id_jenis 
        INNER JOIN kelas 
        ON jenis.id_jenis=kelas.id_jenis 
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
        $this->createUserAccount($nomorPendaftaran);
		$this->load->library('email', $config);
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
		}
	}
	
	
    private function createUserAccount($nomorPendaftaran){
        $data = $this->db->query("SELECT * FROM pendaftar WHERE pendaftar.id='$nomorPendaftaran'")->row();
        $isExist = $this->db->query("SELECT * FROM akun_user WHERE email = '".$data->email."'")->row();
        if(empty($isExist)){
           $data = [
               'email'=> $data->email,
               'nama'=> $data->nama_lengkap,
               'nomor_telepon'=> $data->nomor_telepon,
               'tahu_dari_mana'=> $data->tahu_darimana,
               'jabatan'=> $data->jabatan,
               'instansi'=> $data->instansi,
               'affiliate_code'=> $this->generateRandomString(),
               'password' => md5(sha1("12345abcde"))
            ]; 
            
            $this->db->insert("akun_user", $data);
        }
    }
    
    private function generateRandomString($length = 5) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	
	function sendNotification($message){
        
        $fields = array(
                        'app_id' => '8bad0d73-ade4-484e-9e8c-7a75f277be3e',
                        'included_segments' => array('All'),
                        'url'=> 'https://lauwba.com/staging/lauwba-accounting/#/pendaftar-kursus',
                        'contents' => array("en" => $message),
                        'headings' => array("en"=>"Ada Pendaftar Baru!"),
                        );
    
        $fields = json_encode($fields);
    
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
    }

    private function calculatePrice($json, $random) {
        $pilihanKelas = (isset($json->pilihan_kelas)) ? $json->pilihan_kelas : "";
        $trainingId = 0;
        
        if ($pilihanKelas == "reg") {
            $trainingId = (isset($json->pilihan_training_reguler)) ? $json->pilihan_training_reguler : 0;
        } else if ($pilihanKelas == "private-offline" || $pilihanKelas == "private-online") {
            $trainingId = (isset($json->pilihan_training_private)) ? $json->pilihan_training_private : 0;
        } else if ($pilihanKelas == "inkubator") {
            $trainingId = (isset($json->pilihan_training_inkubator)) ? $json->pilihan_training_inkubator : 0;
        } else if ($pilihanKelas == "in-house") {
            $trainingId = (isset($json->pilihan_training_coorporate)) ? $json->pilihan_training_coorporate : 0;
        }
        
        if (empty($trainingId)) return 0;
        
        $kelas = $this->db->query("SELECT * FROM kelas WHERE id_jenis = ?", [$trainingId])->row();
        if (empty($kelas)) return 0;
        
        $price = 0;
        if ($pilihanKelas == "reg") {
            if (isset($json->kota_pelaksanaan_reguler) && strtolower($json->kota_pelaksanaan_reguler) == "yogyakarta") {
                $price = $kelas->biaya;
            } else {
                $price = $kelas->biaya_luar_kota;
            }
        } else if ($pilihanKelas == "private-online") {
            $price = $kelas->biaya_private_online;
        } else if ($pilihanKelas == "private-offline") {
            if (isset($json->kota_private) && strtolower($json->kota_private) == "yogyakarta") {
                $price = $kelas->biaya_private;
            } else {
                $price = $kelas->biaya_private_off_luar_kota_coret;
            }
        } else if ($pilihanKelas == "inkubator") {
            $price = $kelas->biaya_incubator * $json->durasi_inkubator;
        } else if ($pilihanKelas == "in-house") {
            $biayaInhouseJson = json_decode($kelas->biaya_in_house_per_person);
            $jumlahPeserta = (isset($json->jumlah_peserta_coorporate)) ? $json->jumlah_peserta_coorporate : 1;
            if (empty($jumlahPeserta)) $jumlahPeserta = 1;
            
            $biayaPerPerson = $biayaInhouseJson->biaya_1_2;
            if ($jumlahPeserta >= 1 && $jumlahPeserta <= 2) {
                $biayaPerPerson = $biayaInhouseJson->biaya_1_2;
            } else if ($jumlahPeserta >= 3 && $jumlahPeserta <= 5) {
                $biayaPerPerson = $biayaInhouseJson->biaya_3_5;
            } else if ($jumlahPeserta > 5 && $jumlahPeserta <= 50) {
                $biayaPerPerson = $biayaInhouseJson->biaya_lebih_6;
            }
            $price = $biayaPerPerson * $jumlahPeserta;
        }
        
        // Subtract voucher if exists
        if (!empty($json->kode_promo)) {
            $price -= $this->getVoucherDiscount($json->kode_promo);
        }
        
        // Final price - random code as requested: "harga training - random code"
        return $price - $random;
    }

    private function getVoucherDiscount($voucher) {
        $res = $this->db->query("SELECT * FROM tb_voucher WHERE kode_voucher IN ('$voucher')")->row();
        if (empty($res)) return 0;
        
        $berlaku = $res->berlaku;
        $now = date('Y-m-d');
        if($now <= $berlaku){
            return $res->nominal;
        }
        return 0;
    }
}