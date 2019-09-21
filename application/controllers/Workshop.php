<?php


class Workshop extends CI_Controller{
    
    function index(){
        $data['detail'] = (object) array("judul" => "Workshop", "isi_jenis"=> "IT Training dan Developer Team Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_workshop', $data);    
    }
}