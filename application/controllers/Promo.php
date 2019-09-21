<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class Promo extends CI_Controller{
    
    function index(){
        $data['detail'] = (object) array("judul" => "Promo Lauwba Techno Indonesia", "isi_jenis"=> "Promo Tersedia di Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $detail['promo'] = $this->db->query("SELECT * FROM tb_voucher WHERE tampil_di_promo IN ('Y') ORDER BY berlaku DESC")->result();
        $this->load->view('page_promo', $detail);
    }
    
    function detail_promo($id, $slugTitle){
        $data['detail'] = (object) array("judul" => "Promo Lauwba Techno Indonesia", "isi_jenis"=> "Promo Tersedia di Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $detail['isi'] = $this->db->query("SELECT * FROM tb_voucher WHERE _id IN ('$id') AND tampil_di_promo IN ('Y')")->row();
        $this->load->view('page_detail_promo', $detail);
    }
    
    function promoAktif(){
        $promo = $this->db->query('SELECT * FROM tb_voucher WHERE deleted = "0" AND tampil_di_promo IN ("Y") AND berlaku >= DATE_FORMAT(NOW(), "%Y-%m-%d");')->result();
        if(!empty($promo)){
            foreach($promo as $prm){
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                <div><h5>$prm->nama_voucher</h5>
                <span>Dapatkan potongan harga sebesar Rp. ". $this->etc->rps($prm->nominal)."
                </div>
                <a class='btn btn-sm btn-warning' onclick='setPromo(`$prm->kode_voucher`, $prm->nominal)' data-dismiss='modal'><i class='fa fa-ticket'></i>&nbsp;$prm->kode_voucher</a>
                </li>";
            }
        }else{
            echo '<li class="list-group-item text-center">Tidak ada promo aktif</li>';
        }
    }
}