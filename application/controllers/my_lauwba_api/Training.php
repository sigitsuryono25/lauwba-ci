<?php
include_once(dirname(__FILE__) . "/Baseapi.php");

class Mytraining extends Baseapi{
    
    
    function index(){
        $this->checkAuthToken();
        
        $training = $this->db->query("SELECR jenis.judul 
        FROM pendaftar 
        INNER JOIN kelas ON pendaftar.training=kelas.id_kelas 
        INNER JOIN jenis ON kelas.id_jenis=jenis.id_jenis WHERE email = '".$this->email."'")->result();
        if(!empty($training)){
            $this->success("training found", "training", $training);
        }else{
            $this->notFound();
        }
    }
}