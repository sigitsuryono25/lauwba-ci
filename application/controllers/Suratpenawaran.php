<?php


class Suratpenawaran extends CI_Controller{
    
    function index(){
        // $data['detail'] = (object) array("judul" => "Form Surat Penawaran Lauwba Techno Indonesia", "isi_jenis" => "Form Surat Penawaran Lauwba Techno Indonesia");
        // $this->load->view('headfoot/doctypedetail', $data);
        // $data['kota'] = $this->db->query("SELECT * FROM alamat")->result();
        // $data['training'] = $this->db->query("SELECT * FROM jenis WHERE id_jenis NOT IN ('34', '35', '25', '26', '27')")->result();
        // $this->load->view('headfoot/doctypedetail', $data);
        // $d['used_header'] = ($this->input->post_get("used_header") == "0") ? false: true;
        // $d['used_footer'] = ($this->input->post_get("used_footer") == "0") ? false : true;
        // $this->load->view('page_form_surat_penawaran', $d);
        $dataHarga = [];
      
        $harga = $this->db->query("SELECT kelas.*, jenis.judul, jenis.id_jenis, jenis.id_kategori, jenis.routes 
        FROM kelas INNER JOIN jenis on kelas.id_jenis=jenis.id_jenis INNER JOIN kategori1 on jenis.id_kategori=kategori1.id_kategori WHERE jenis.id_jenis NOT IN ('34', '35', '25', '26', '27') GROUP BY kelas.id_kelas")->result();
        foreach($harga as $hrg){
          $dataHarga[$hrg->routes] = $hrg;
          $dataHarga[$hrg->routes]->biaya_in_house_per_person = json_decode($hrg->biaya_in_house_per_person);
        }
        $data['detail'] = (object) array("judul" => "Surat Penawaran Kursus/Training Lauwba Techno Indonesia", "isi_jenis" => "Surat Penawaran Kursus/Training Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $data['kota'] = $this->db->query("SELECT * FROM alamat")->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori1 WHERE id_kategori NOT IN ('1', '10', '5') ORDER BY kategori1.nama_kategori ASC")->result();
        $data['training'] = $this->db->query("SELECT * FROM jenis WHERE id_jenis NOT IN ('34', '35', '25', '26', '27')")->result();
        $data['used_header'] = ($this->input->post_get("used_header") == "0") ? false: true;
        $data['used_footer'] = ($this->input->post_get("used_footer") == "0") ? false : true;
        $data['harga'] = json_encode($dataHarga);
        $this->load->view('page_form_surat_penawaran', $data);
    }
    
     function suratPenawaranProcess(){
        header('Access-Control-Allow-Origin: *');
        $jsonData = file_get_contents("php://input");
        $json = json_decode($jsonData);
        $nextid = $this->db->query("SELECT MAX(id)+1 as nextid FROM `pendaftar`ORDER BY id LIMIT 1")->row()->nextid;
        $data = [
            'id' => $nextid,
            'nama_lengkap' => $json->nama_lengkap,
            'email' => $json->email,
            'random' => $this->etc->randomunik(),
            'nomor_telepon' => $json->nomor_hp,
            'instansi' => $json->nama_instansi,
            'jabatan' => $json->jabatan,
            'harga' => $json->harga,
            'tahu_darimana' => $json->tahu_darimana,
            'motivasi' => $json->motivasi,
            'keterangan' => $json->keterangan_tambahan,
            'voucher' => $json->kode_promo,
            'from' => $json->from,
            'referral_code' => $json->kode_ref,
            'is_register' => 'N'
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
        $data = [
            'nama_lengkap' => $json->nama_lengkap,
            'email' => $json->email,
            'random' => $json->random,
            'nomor_telepon' => $json->telepon,
            'instansi' => $json->instansi,
            'jabatan' => $json->jabatan,
            'harga' => $json->kontribusi,
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
                echo json_encode(array("message" => "Data berhasil disimpan.", 'nextid'=> $data['id'], "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
    }
    
    private function processPrivate($json,$data, $isUpdate = false){
        $data['pilihan_kelas'] = $json->pilihan_kelas;
        $data['private_tanggal_mulai'] = $json->jadwal;
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
                echo json_encode(array("message" => "Data berhasil disimpan.", 'nextid'=> $data['id'], "error" => 200));
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
                echo json_encode(array("message" => "Data berhasil disimpan.", 'nextid'=> $data['id'], "error" => 200));
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
                echo json_encode(array("message" => "Data berhasil disimpan.", 'nextid'=> $data['id'], "error" => 200));
            }
        }else{
            echo json_encode(array("message" => "insert data gagal", "error" => 404));
        }
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
            echo json_encode(array("message" => "Data berhasil disimpan. Invoice Telah Dikirimkan Ke Email anda. Pastikan Email anda benar.", "error" => 200, 'nextid'=>$nomorPendaftaran));
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
            
            $ins = $this->db->insert("akun_user", $data);
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
    
//     function proses_surat(){
//         header('Access-Control-Allow-Origin: *');
//         //global var
//         $selectedTraining = "";
        
//         $nama = $this->input->post_get("nama-lengkap");
//         $from = (!empty($this->input->post_get("from"))) ? $this->input->post_get("from") : "Lauwba Techno Indonesia";
//         $tel = $this->input->post_get("nomor-hape");
//         $instansi = $this->input->post_get("nama-instansi");
//         $jabatan = $this->input->post_get("jabatan");
//         $kota = $this->input->post_get("kota");
//         $training = $this->input->post_get("training");
//         $jadwal = $this->input->post_get("jadwal");
//         $harga = $this->input->post_get("harga");
//         $tahu = $this->input->post_get("tahu-darimana");
//         $motivasi = $this->input->post_get("motivasi");
//         $keterangan = $this->input->post_get("keterangan");
//         $pilihanKelas = $this->input->post_get("pilihan-kelas");
//         $email = $this->input->post_get("email");
//         $nextid = $this->input->post_get("nextid");
//         $voucher = $this->input->post_get('voucher');
//         $potongan = $this->getDiskon($voucher);
        
//         //private
//         $trainingPrivate = $this->input->post_get('training-private-offline');
//         $trainingPrivateOnline = $this->input->post_get('training-private-online');
        
//         //reg online
//         $trainingRegOnline = $this->input->post_get('training-reg-online');
        
//         //in house training
//         $kotaPelaksanaanInHouse = $this->input->post_get('kota-in-house');
//         $tanggalMulaiInHouse = $this->input->post_get('tanggal-mulai-in-house');
//         $tanggaSelesaiInHouse = $this->input->post_get('tanggal-selesai-in-house');
//         $trainingInHouse = $this->input->post_get('training-in-house');
//         $jumlahPeserta = $this->input->post_get('jumlah-peserta');
        
        
//         //inkubator
//         $durasi = $this->input->post_get("durasi-kelas-inkubator");
//         $trainInkubator = $this->input->post_get('training-inkubator');
        
//         if($pilihanKelas == "private-offline"){
//             $selectedTraining = $trainingPrivate;
//             $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-offline');
//             $kotaPrivate = $this->input->post_get('kota-private-offline');
//         }else if($pilihanKelas == "private-online"){
//             $selectedTraining = $trainingPrivateOnline;
//             $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-online');
//             $kotaPrivate = "";
//         }else if($pilihanKelas == "reg"){
//             $selectedTraining = $training;
//             $tanggalMulaiPrivate = "";
//             $kotaPrivate = "";
//         }else if($pilihanKelas == "reg-online"){
//             $selectedTraining = $trainingRegOnline;
//             $tanggalMulaiPrivate = "";
//             $kotaPrivate = "";
//         }else if($pilihanKelas == "in-house"){
//             $selectedTraining = $trainingInHouse;
//             $tanggalMulaiPrivate = "";
//             $kotaPrivate = "";
//         }else if($pilihanKelas == "inkubator"){
//              $selectedTraining = $trainInkubator;
//         }
        
//         // if(!empty($trainingPrivate)){
//         //     $selectedTraining = $trainingPrivate;
//         //     $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-offline');
//         //     $kotaPrivate = $this->input->post_get('kota-private-offline');
//         // }else if(!empty($trainingPrivateOnline)){
//         //     $selectedTraining = $trainingPrivateOnline;
//         //     $tanggalMulaiPrivate = $this->input->post_get('tanggal-mulai-private-online');
//         //     $kotaPrivate = "";
//         // }else if(!empty($trainingInHouse)){
//         //     $selectedTraining = $trainingInHouse;
//         //     $tanggalMulaiPrivate = "";
//         //     $kotaPrivate = "";
//         // }else if(!empty($trainInkubator)){
//         //     $selectedTraining = $trainInkubator;
//         // }else if(!empty($training)){
//         //     $selectedTraining = $training;
//         //     $tanggalMulaiPrivate = "";
//         //     $kotaPrivate = "";
//         // }
        
//         $nextid = $this->db->query("SELECT MAX(id)+1 as nextid FROM `pendaftar`ORDER BY id LIMIT 1")->row()->nextid;
//         $harga1 = str_replace("Rp", "", $harga);
//         $harga2 = str_replace(" ", "", $harga1);
//         $harga3 = str_replace(".", "", $harga2);
//         $telBesih1 = str_replace("(","", $tel);
//         $telBesih2 = str_replace(")","", $telBesih1);
//         $telBesih3 = str_replace("-","", $telBesih2);
//         $telBesih4 = str_replace(" ","", $telBesih3);
        
//         $data = array(
//             'id' => $nextid,
//             'nama_lengkap'=>$nama,
//             'nomor_telepon'=>$telBesih3,
//             'instansi'=>$instansi,
//             'random' => $this->etc->randomunik(),
//             'email' => $email,
//             'jabatan'=>$jabatan,
//             'kota'=>$kota,
//             'training'=>$selectedTraining,
//             'jadwal'=>$jadwal,
//             'harga'=>$harga3,
//             'tahu_darimana'=>$tahu,
//             'durasi' => $durasi,
//             'from'=>$from,
//             'motivasi'=>$motivasi,
//             'voucher' => $voucher,
//             'keterangan'=>$keterangan,
//             'private_tanggal_mulai' => $tanggalMulaiPrivate,
//             'private_kota_pelaksanaan' => $kotaPrivate,
//             'in_house_kota_pelaksanaan' => $kotaPelaksanaanInHouse,
//             'in_house_tanggal_mulai' => $tanggalMulaiInHouse,
//             'in_house_tanggal_selesai' => $tanggaSelesaiInHouse,
//             'in_house_jumlah_peserta' => $jumlahPeserta,
//             'pilihan_kelas' => $pilihanKelas,
//             'is_register' => 'N'
//             );
            
//             // print_r($data);
//         if($potongan > 0){
//         }
//         $res = $this->crud->insert("pendaftar", $data);
//         if($res > 0){
//             if(!empty($email)){
//                 $this->do_send_mail($email, $nextid, "Surat Penawaran", $from);
//             }else{
//                 echo json_encode(array("message" => "Pendaftaran Berhasil.", 'nextid'=> $nextId, "error" => 200));
//             }
//         }else{
//             echo json_encode(array("message" => "insert data gagal", "error" => 404));
//         }
//     }
    
//     private function do_send_mail($username, $nomorPendaftaran, $subject = "Surat Penawaran", $from)
// 	{
// 		// $from_email = "sigitsuryono0225@gmail.com";
// 		$config = Array(
// 			'protocol' => 'mail',
// 			'smtp_host' => 'ssl://smtp.gmail.com',
// 			'smtp_port' => '587',
// 			'smtp_user' => 'payment.lauwba@gmail.com',
// 			'smtp_pass' => 'admin>_<',
// 			'mailtype' => 'html',
// 			'wordwrap' => TRUE,
// 			'charset' => 'utf-8'
// 		);
// 		//get userdetail
// 		$url = site_url("webservices/get_detail_training?resi=$nomorPendaftaran");
// 	     //  Initiate curl
//         $ch = curl_init();
//         // Will return the response, if false it print the response
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         // Set the url
//         curl_setopt($ch, CURLOPT_URL,$url);
//         // Execute
//         $result=curl_exec($ch);
//         // Closing
//         curl_close($ch);
        
//         $data['detail'] = (object) json_decode($result);
//         $msg = $this->load->view('surat-penawaran/email-surat-penawaran', $data, TRUE);

// 		$this->load->library('email', $config);
// // 		$this->email->set_header('Content-Type', 'text/html');
// 		$this->email->set_newline("\r\n");

// 		$this->email->from("payment.lauwba@gmail.com");
// 		$this->email->to($username);
// 		$this->email->subject($subject);
// 		$this->email->message($msg);

// 		//Send mail
// 		if ($this->email->send()) {
//             echo json_encode(array("message" => "Data Berhasil Dikirimkan. Surat Penawaran Telah Dikirimkan Ke Email anda. Pastikan Email anda benar.", "error" => 200, 'nextid'=>$nomorPendaftaran));
// 		    $this->sendNotification($data['detail']->nama_lengkap);
// 		} else {
// 			echo $this->email->print_debugger();
// 			// print("Email gagal terkirim.");
// 		}
// 	}
	
// 	function sendNotification($message){
//         // $re = file_get_contents("php://input");
//         // $json = json_decode($re);
        
//         // print_r($json);
        
//         $content = array(
//                      "en" => 'English Message'
//                      );

//         $fields = array(
//                         'app_id' => '8bad0d73-ade4-484e-9e8c-7a75f277be3e',
//                         'included_segments' => array('All'),
//                         'data' => array("foo" => "bar"),
//                         'contents' => array("en" => $message),
//                         'headings' => array("en"=>"Surat Penawaran Baru"),
//                         );
    
//         $fields = json_encode($fields);
//         // print("\nJSON sent:\n");
//         // print($fields);
    
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
//                                                   'Authorization: Basic NmVhZTVhMWMtZWI5Yi00MDYzLWIwMTEtYTQ4YmY5NGEyYjBi'));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//         curl_setopt($ch, CURLOPT_HEADER, FALSE);
//         curl_setopt($ch, CURLOPT_POST, TRUE);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
//         $response = curl_exec($ch);
//         curl_close($ch);
    
//         // echo json_encode($response);
//     }
	
// 	private function getDiskon($voucher){
//         $res = $this->db->query("SELECT * FROM tb_voucher WHERE kode_voucher IN ('$voucher')")->row();
//         $berlaku = $res->berlaku;
//         $now = date('Y-m-d');
//         if($now <= $berlaku){
//             $message = "Voucher Valid";
//             $potongan = $res->nominal;
//         }else if($now > $berlaku){
//             $message = "Voucher Kadaluarsa";
//             $potongan = 0;
//         }
//         return $potongan;
//     }
    
//     function diskon(){
//         header('Access-Control-Allow-Origin: *');
//         $voucher = $this->input->post_get('voucher');
//         $res = $this->db->query("SELECT * FROM tb_voucher WHERE kode_voucher IN ('$voucher')")->row();
//         $berlaku = $res->berlaku;
//         $now = date('Y-m-d');
//         if($now <= $berlaku){
//             $message = "Voucher Valid";
//             $potongan = $res->nominal;
//         }else if($now > $berlaku){
//             $message = "Voucher Kadaluarsa";
//             $potongan = 0;
//         }
//         echo json_encode(['potongan' => $potongan, 'message' => $message]);
//     }
}