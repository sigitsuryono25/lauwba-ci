<?php
include_once(dirname(__FILE__) . "/Baseapi.php");

class Mytraining extends Baseapi{
    
    
    function index(){
        $this->checkAuthToken();
        $status = $this->input->get('status');
        $training = $this->db->query("SELECT id, (harga-random) as harga, jenis.judul, daftar_pada, pilihan_kelas, jadwal, private_tanggal_mulai, in_house_tanggal_mulai, in_house_tanggal_selesai,
        inkubator_tanggal_mulai, expired_invoices
        FROM pendaftar 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE email = '". $this->email."'")->result();
        if(!empty($training)){
            $data = [];
            foreach($training as $tr){
                $tmp = [];
                $tmp = $tr;
                if($tr->pilihan_kelas == 'reg'){
                    $this->handleReguler($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'private-offline'){
                    $this->handlePrivateOffline($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'private-online'){
                    $this->handlePrivateOnline($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'inkubator'){
                    $this->handleInkubator($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'in-house'){
                    $this->handleInhouse($tr, $tmp);
                }
                $tmp->harga = $this->etc->rps($tmp->harga);
                $this->handlePembayaran($tr, $tmp);
                if($tmp->status == 'Expired' || $tmp->status == 'Belum dibayar'){
                    $tmp->sertifikat = null;
                    $tmp->status_kelas = '-';
                } else {
                    $this->handleStatusKelas($tr, $tmp);
                }
                $tmp->expired_invoices = date('d/m/Y', strtotime($tr->expired_invoices));
                unset($tmp->private_tanggal_mulai);
                unset($tmp->inkubator_tanggal_mulai);
                unset($tmp->in_house_tanggal_mulai);
                unset($tmp->in_house_tanggal_selesai);
                unset($tmp->random);
                
                if($status == 'selesai'){
                    if($tmp->status_kelas == 'Selesai'){
                        array_push($data, $tmp);
                    }
                }else if($status == 'ongoing'){
                    $tmp->sertifikat = null;
                    if($tmp->status_kelas == 'On-going'){
                        $tmp->sertifikat = null;
                        array_push($data, $tmp);
                    }
                }else{
                    array_push($data, $tmp);
                }
            }
            $this->success("training found", "training", $data);
        }else{
            $this->notFound();
        }
    }
    
    
    private function handleReguler($tr, $tmp){
        $jadwal = $this->db->query("SELECT tanggal from jadwal WHERE id = '".$tr->jadwal."'")->row();
        $tmp->jadwal = $jadwal->tanggal;
        return $tmp;
    }
    private function handlePrivateOffline($tr, $tmp){
        if($tr->private_tanggal_mulai != '00/00/0000'){
            return $tmp->jadwal = date('d/m/Y', strtotime($tr->private_tanggal_mulai));
        }else{
            return $tmp->jadwal = "-";
        }
    }
    
    private function handlePrivateOnline($tr, $tmp){
        return $tmp->jadwal = date('d/m/Y', strtotime($tr->private_tanggal_mulai));
    }
    
    private function handleInkubator($tr, $tmp){
        if($tr->inkubator_tanggal_mulai != "0000-00-00"){
            return $tmp->jadwal =date('d/m/Y', strtotime( $tr->inkubator_tanggal_mulai));
        }else{
            return $tmp->jadwal = '-';
        }
    }
    
    private function handleInhouse($tr, $tmp){
        return $tmp->jadwal = date('d/m/Y', strtotime($tr->in_house_tanggal_mulai)) ." s.d ". date('d/m/Y', strtotime($tr->in_house_tanggal_selesai));
    }
    
    private function handleStatusKelas($tr, $tmp){
        $getStatus = $this->db->query("SELECT * FROM lauwbaco_presensi_kar.tb_progress WHERE id_peserta = '$tr->id' ORDER BY id_progress DESC LIMIT 1")->row();
        if(empty($getStatus)){
            $tmp->sertifikat = null;
            $tmp->status_kelas = 'Belum dimulai';
            return $tmp;
        }else{
            $progress = $getStatus->progressval;
            if($progress == 100){
                $sertifikat = $this->cekSertifikat($tr->id);
                if($sertifikat != false){
                    $tmp->sertifikat = $sertifikat;
                }else{
                    $tmp->sertifikat = null;
                }
                $tmp->status_kelas = 'Selesai';
                return $tmp;
            }else{
                $tmp->sertifikat = null;
                $tmp->status_kelas = 'On-going';
                return $tmp;
            }
        }
    }
    
    private function handlePembayaran($tr, $tmp){
        $historyBayar = $this->db->query("SELECT jumlah_bayar, transaksi_pada FROM history_trans WHERE id_daftar = '".$tr->id."'")->result();
        if(empty($historyBayar) && ($tr->expired_invoices < date('Y-m-d'))){
            $tmp->sertifikat = null;
            $tmp->status = "Expired";
            return $tmp;
        }else if(empty($historyBayar) && ($tr->expired_invoices > date('Y-m-d'))){
            return $tmp->status = 'Belum dibayar';
        }else{
            $kontribusi = str_replace(".", "", $tr->harga);
            $total = 0;
            foreach($historyBayar as $hh){
                $total += $hh->jumlah_bayar;
            }
            if($total > 0 && $total < $kontribusi){
                $tmp->remaining_payment = $this->etc->rps($kontribusi - $total);
                $tmp->status = 'Belum Lunas';
                return $tmp;
            }else{
                return $tmp->status = 'Lunas';
            }
        }
    }
    
    function historyBelajar($idPendaftaran){
        $this->checkAuthToken();
        
        $history = $this->db->query("SELECT tb_progress.*, tb_user.nama FROM lauwbaco_presensi_kar.tb_progress
        INNER JOIN lauwbaco_presensi_kar.tb_user ON lauwbaco_presensi_kar.tb_progress.username=lauwbaco_presensi_kar.tb_user.username 
        WHERE id_peserta='$idPendaftaran' order by id_progress DESC")->result();
        $detailTraining = $this->db->query("SELECT pendaftar.*, tutor.nama, jenis.judul FROM pendaftar INNER JOIN jenis ON pendaftar.training=jenis.id_jenis INNER JOIN tutor ON pendaftar.selected_trainer=tutor.id_tutor WHERE id = '$idPendaftaran'")->row();
        $data['training'] = $detailTraining->judul;
        $data['last_trainer'] = $detailTraining->nama;
        $data['kelas'] = $detailTraining->pilihan_kelas;
        $data['nama_peserta'] = $detailTraining->nama_lengkap;
        $data['detail'] = [];
        if(!empty($history)){
            $data['last_progress'] = $history[0]->progressval;
            $data['pertemuan_terakhir'] = $history[0]->added_on;
            $data['detail'] = $history;
            $this->success("history found", "history", $data);
        }else{
            $this->success("history not found", "history", $data);
        }
    }
    
    function getMyCertificate(){
        $this->checkAuthToken();
        
        $training = $this->db->query("SELECT nama_lengkap, pendaftar.id, jenis.judul, daftar_pada 
        FROM pendaftar 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE email = '".$this->email."'")->result();
        if(!empty($training)){
            $data = [];
            foreach($training as $tr){
                $tmp = [];
                $sertifikat = $this->db->query("SELECT * FROM lauwbaco_sertifikat.tb_sertifikat WHERE id_peserta = '".$tr->id."'")->row();
                $tmp['training'] = $tr->judul;
                $tmp['nama_lengkap'] = $tr->nama_lengkap;
                $tmp['tanggal_daftar'] = $tr->daftar_pada;
                $tmp['detail_certificate'] = $sertifikat;
                $tmp['info'] = (!empty($sertifikat)) ? "Sudah diterbitkan" : "Kelas belum selesai atau Sertifikat belum diterbitkan";
                array_push($data, $tmp);
            }
            $this->success("kelas found", "kelasku", $data);
        }else{
            $this->notFound();
        }
    }
    
    function getHistoryBayar($idTraining = null){
        $this->checkAuthToken();
        
        $where = "";
        if(!empty($idTraining)){
            $where .="AND pendaftar.id = '$idTraining'";
        }
        $total = 0;
        $training = $this->db->query("SELECT pendaftar.id, nama_lengkap, jenis.judul, daftar_pada, (harga-random) as harga
        FROM pendaftar 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE email = '". $this->email."' $where")->result();
        if(!empty($training)){
            $data = [];
            foreach($training as $tr){
                $historyBayar = $this->db->query("SELECT FORMAT(jumlah_bayar, 0) as jumlah_bayar, DATE_FORMAT(transaksi_pada, '%d %M %Y') as transaksi_pada FROM history_trans WHERE id_daftar = '".$tr->id."'")->result_array();
                foreach($historyBayar as $hst){
                    $total += str_replace(',', '', $hst['jumlah_bayar']);
                }
                $tmp = [];
                $tmp = $tr;
                $tmp->daftar_pada = date('d/m/Y H:i:s', strtotime($tmp->daftar_pada));
                $tmp->payment_history = $historyBayar;
                $tmp->email = $this->email;
                $tmp->total = str_replace('.', ',', $this->etc->rps($total));
                $tmp->harga = str_replace('.', ',', $this->etc->rps($tmp->harga));
                array_push($data, $tmp);
            }
            $this->success("kelas and history found", "kelasku", $data);
        }else{
            $this->notFound();
        }
    }
    
    function dashboardInfo(){
        $this->checkAuthToken();
        $training = $this->db->query("SELECT id, (harga-random) as harga, jenis.judul, daftar_pada, pilihan_kelas, jadwal, private_tanggal_mulai, in_house_tanggal_mulai, in_house_tanggal_selesai,
        inkubator_tanggal_mulai, expired_invoices
        FROM pendaftar 
        INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE email = '". $this->email."' ORDER BY daftar_pada DESC")->result();
        if(!empty($training)){
            $data = [];
            foreach($training as $tr){
                $tmp = [];
                $tmp = $tr;
                if($tr->pilihan_kelas == 'reg'){
                    $this->handleReguler($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'private-offline'){
                    $this->handlePrivateOffline($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'private-online'){
                    $this->handlePrivateOnline($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'inkubator'){
                    $this->handleInkubator($tr, $tmp);
                }
                if($tr->pilihan_kelas == 'in-house'){
                    $this->handleInhouse($tr, $tmp);
                }
                $tmp->harga = $this->etc->rps($tmp->harga);
                $this->handlePembayaran($tr, $tmp);
                if($tmp->status == 'Expired' || $tmp->status == 'Belum dibayar'){
                    $tmp->status_kelas = '-';
                } else {
                    $this->handleStatusKelas($tr, $tmp);
                }
                $tmp->expired_invoices = date('d/m/Y', strtotime($tr->expired_invoices));
                $tmp->daftar_pada = date('d/m/Y H:i:s', strtotime($tr->daftar_pada));
                unset($tmp->private_tanggal_mulai);
                unset($tmp->inkubator_tanggal_mulai);
                unset($tmp->in_house_tanggal_mulai);
                unset($tmp->in_house_tanggal_selesai);
                unset($tmp->random);
                
                array_push($data, $tmp);
            }
            
            
            $dashboard['training_info']['jumlah_training'] = 0;
            $dashboard['training_info']['kelas_selesai'] = 0;
            $dashboard['training_info']['belum_lunas'] = 0;
            $dashboard['training_info']['belum_dibayar'] = 0;
            $dashboard['ringkasan_training']['berjalan'] = [];
            $dashboard['ringkasan_training']['belum_lunas'] = [];
            $dashboard['ringkasan_training']['belum_dibayar'] = [];
            $dashboard['ringkasan_training']['expired'] = [];
            $dashboard['ringkasan_training']['semua'] = [];
            $dashboard['progress'] = [];
            $countJumlah = 0;
            $countJumlahSelesai = 0;
            $countJumlahBelumLunas = 0;
            $countJumlahBelumLDibayar = 0;
            foreach($data as $trainingInfo){
                array_push($dashboard['ringkasan_training']['semua'], $trainingInfo);
                if($trainingInfo->status != "Expired"){
                    $dashboard['training_info']['jumlah_training'] = ++$countJumlah;
                } 
                
                if($trainingInfo->status == "Expired"){
                    array_push($dashboard['ringkasan_training']['expired'], $trainingInfo);   
                }
                
                if($trainingInfo->status_kelas == 'Selesai'){
                    $dashboard['training_info']['kelas_selesai'] = ++$countJumlahSelesai;
                }
                
                if($trainingInfo->status == "Belum Lunas"){
                    $dashboard['training_info']['belum_lunas'] = ++$countJumlahBelumLunas;
                    array_push($dashboard['ringkasan_training']['belum_lunas'], $trainingInfo);        
                }
                
                if($trainingInfo->status == 'Belum dibayar'){
                    $dashboard['training_info']['belum_dibayar'] = ++$countJumlahBelumLDibayar;
                    array_push($dashboard['ringkasan_training']['belum_dibayar'], $trainingInfo);
                }
                
                if($trainingInfo->status_kelas == 'On-going'){
                    array_push($dashboard['ringkasan_training']['berjalan'], $trainingInfo);
                }
                
                
                $progress = $this->db->query("SELECT tb_progress.*, tb_user.nama FROM lauwbaco_presensi_kar.tb_progress INNER JOIN lauwbaco_presensi_kar.tb_user ON lauwbaco_presensi_kar.tb_progress.username=lauwbaco_presensi_kar.tb_user.username
                WHERE id_peserta = '$trainingInfo->id' ORDER BY id_progress DESC LIMIT 3")->result();
                if(!empty($progress)){
                    foreach($progress as $pr){
                        $tt = [];
                        $tt = $pr;
                        $tt->judul = $trainingInfo->judul;
                        array_push($dashboard['progress'], $tt);
                    }
                }
            }
            
            $this->success("training found", "training", $dashboard);
        }else{
            $this->notFound();
        }
    }
    
    private function cekSertifikat($idPeserta){
        $cont = file_get_contents("https://certificate.lauwba.com/get-sertifikat?id-peserta=$idPeserta");
        $json = json_decode($cont);
        if(!empty($json)){
            $code = $json->code;
            if($code == 500){
                return false;
            }else{
                $json->data->url = "https://certificate.lauwba.com/pdfViewer/index.html#https://certificate.lauwba.com/sert/". $json->data->file_name;
                return $json;
            }
        }else{
            return false;
        }
    }
}