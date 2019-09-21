<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set("Asia/Jakarta");

class Academywebservice extends CI_Controller{
    
    function __construct(){
            parent::__construct();
        // if($this->input->cookie('lauwba') != '055dad045fc8f70d79169d27444c345b7398e36f925693d40c3452f180fa235f'){
        //     header('HTTP/1.1 403 Forbidden');
        //     exit();
        // };
    }
    
    
    function getPriceByWordpressId($id){
        $price = $this->db->query("SELECT * FROM kelas where wordpress_id = '$id'")->row();
        die(json_encode($price));
    }
    
}