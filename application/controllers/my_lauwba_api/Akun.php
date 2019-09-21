<?php
include_once(dirname(__FILE__) . "/Baseapi.php");

class Akun extends Baseapi{
    
    function index(){
        $this->checkAuthToken();
        $detail = $this->db->query("SELECT email, nama, nomor_telepon, affiliate_code, ukuran_kaos, rekening,bank,atas_nama_rekening,
        instansi, jabatan, alamat, tahu_dari_mana, saldo FROM akun_user WHERE email = '".$this->email."'")->row();
        if(!empty($detail)){
            $detail->saldo = str_replace('.', ',', $this->etc->rps($detail->saldo));
            $this->success('data found', 'user', $detail);
        }else{
            $this->notFound();
        }
    }
    
    function updateAkun(){
        $this->checkAuthToken();
        $part = $this->input->get('part');
        $stream_clean = $this->getInputFromUser();
        $request = json_decode($stream_clean, true);
        $where = ['email' => $this->email];
        if($part == 'info-dasar'){
            $upd = $this->crud->updateArray('akun_user', $request, $where);
        }
        
        if($part == 'password'){
            $data = ['password' => md5(sha1($request['password']))];
            $upd = $this->crud->updateArray('akun_user', $data , $where);
        }
        
        if($part == 'rekening'){
             $upd = $this->crud->updateArray('akun_user', $request, $where);
        }
        try{
            if($upd){
                $this->success();
            }else{
                $this->notModified();
            }
        }catch(Exception $e){
            $this->internalError();
        }
    }
    
    function getAffiliationReward(){
        $this->checkAuthToken();
        $reward = $this->db->query("SELECT * FROM settings WHERE id='3'")->row();
        if(!empty($reward)){
            $reward->nilai = str_replace('.', ',', $this->etc->rps($reward->nilai));
            $this->success('data ditemukan', 'reward', $reward);
        }else{
            $this->notFound();
        }
    }
    
    function getUserUsedMyAffiliate(){
        $this->checkAuthToken();
        $data = [];
        $info = $this->db->query("SELECT id,nama_lengkap,daftar_pada,harga,random, jenis.judul FROM pendaftar INNER JOIN jenis ON pendaftar.training=jenis.id_jenis WHERE referral_code='".$this->affiliateCode."'")->result();
        if(!empty($info)){
            foreach($info as $i){
                $tmp = [];
                $tmp = $i;
                $historyBayar = $this->db->query("SELECT jumlah_bayar, transaksi_pada FROM history_trans WHERE id_daftar = '".$i->id."'")->result();
                if(empty($historyBayar) && ($i->expired_invoices < date('Y-m-d'))){
                    $tmp->sertifikat = null;
                    $tmp->status = "Belum bayar";
                }else if(empty($historyBayar) && ($i->expired_invoices > date('Y-m-d'))){
                    $tmp->sertifikat = null;
                    $tmp->status = 'Expired';
                }else{
                    $kontribusi = str_replace(".", "", $i->harga-$i->random);
                    $total = 0;
                    foreach($historyBayar as $hh){
                        $total += $hh->jumlah_bayar;
                    }
                    if($total > 0 && $total < $kontribusi){
                        $tmp->remaining_payment = $this->etc->rps($kontribusi - $total);
                        $tmp->status = 'Belum Lunas';
                    }else{
                        $tmp->status = 'Lunas';
                    }
                }
                $tmp->daftar_pada = date("d/m/Y H:i:s", strtotime($i->daftar_pada));
                
                $isAlreadyPengajuanPencairan = $this->db->query("SELECT * FROM history_affiliate WHERE id_pendaftaran = '".$i->id."'")->row();
                if(!empty($isAlreadyPengajuanPencairan)){
                    if($isAlreadyPengajuanPencairan->status == "PENDING"){
                        $tmp->status_pengajuan_progress = "<span class='text-warning font-weight-bold'>PENDING</span>";
                    }else if($isAlreadyPengajuanPencairan->status == "DONE"){
                        $tmp->status_pengajuan_progress = "<span class='text-success font-weight-bold'>DONE</span>";
                
                    }else if($isAlreadyPengajuanPencairan->status == "PROCESS"){
                        $tmp->status_pengajuan_progress = "<span class='text-primary font-weight-bold'>PROCESS</span>";
                    }else if($isAlreadyPengajuanPencairan->status == "REJECT"){
                        $tmp->status_pengajuan_progress = "<span class='text-danger font-weight-bold'>REJECT</span>";
                    }
                    $tmp->status_pengajuan_progress_raw = $isAlreadyPengajuanPencairan->status;
                    $tmp->bukti_bayar = $isAlreadyPengajuanPencairan->bukti_bayar;
                    $tmp->status_pengajuan = true;
                    $tmp->note = $isAlreadyPengajuanPencairan->note;
                }else{
                    $tmp->status_pengajuan = false;
                    $tmp->status_pengajuan_progress = "-";
                }
                
                array_push($data, $tmp);
            }
            $this->success('data ditemukan', 'referral', $data);
        }else{
            $this->success('data tidak ditemukan', 'referral', []);
        }
    }
    
    function getPengajuanPencairan(){
        $this->checkAuthToken();
        $rr = $this->db->query("SELECT * FROM history_affiliate WHERE affiliate_code = '".$this->affiliateCode."'")->result();
        $data =[];
        if(!empty($rr)){
            foreach($rr as $result){
                $result->created_at = date('d/m/Y H:i:s', strtotime($result->created_at));
                $result->update_at = date('d/m/Y H:i:s', strtotime($result->update_at));
                if($result->status == "PENDING"){
                    $result->status = "<span class='text-warning font-weight-bold'>PENDING</span>";
                }else if($result->status == "DONE"){
                    $result->status = "<span class='text-success font-weight-bold'>DONE</span>";
                }else if($result->status == "PROCESS"){
                    $result->status = "<span class='text-primary font-weight-bold'>PROCESS</span>";
                }else if($result->status == "REJECT"){
                    $result->status = "<span class='text-danger font-weight-bold'>REJECT</span>";
                }
               array_push($data, $result);
            }
            $this->success('data found', 'history', $data);
        }else{
            $this->success('data not found', 'history', []);
        }
    }
    
    function pengajuanPencairanSaldo(){
        $this->checkAuthToken();
        $idPendaftaran = $this->input->get('id-pendaftaran');
        
        $check =  $this->db->query("SELECT * FROM pendaftar WHERE id = '$idPendaftaran'")->row();
        if($check->referral_code != $this->affiliateCode){
            $this->notModified('Nomor pendaftaran ini tidak menggunakan kode afiliasi kamu');
        }
        
        $data = [
          'id_pendaftaran' => $idPendaftaran,
          'affiliate_code' => $this->affiliateCode
        ];
        
        $ins = $this->db->insert('history_affiliate', $data);
        if($ins){
            $this->success('Pengajuan berhasil dibuat');
        }else{
            $this->notModified("Pengajuan gagal dibuat");
        }
    }
    
}