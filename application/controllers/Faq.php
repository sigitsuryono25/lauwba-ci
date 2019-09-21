<?php


class Faq extends CI_Controller{
    
    function index(){
        $data['detail'] = (object) array("judul" => "Frequently Asked Question", "isi_jenis"=> "Pertanyaan yang sering ditanyakan di Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $detail['faq'] = $this->db->query("SELECT * FROM tb_faq")->result();
        $this->load->view('page_faq', $detail);
    }
    
}