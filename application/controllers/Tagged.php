<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tagged
 *
 * @author Sigit Suryono
 */
class Tagged extends CI_Controller {

    //put your code here
    function index($tag) {
        $tagged = str_replace("%20", " ", $tag);
        $data['detail'] = (object) array("judul" => "Tag : $tagged", "isi_jenis" => "Tag : $tagged");
        $this->load->view('headfoot/doctypedetail', $data);
        $data['news'] = $this->crud->select_other("news", "INNER JOIN tag ON tag.id_kolom=news.id_news  WHERE tag.tag_seo = '$tagged' GROUP BY tag.id_kolom")->result();
        $data['products'] = $this->crud->select_other("produk", "INNER JOIN tag ON tag.id_kolom=produk.id_produk  WHERE tag.tag_seo = '$tagged' GROUP BY tag.id_kolom")->result();
        $data['jenis'] = $this->crud->select_other("jenis", "INNER JOIN tag ON tag.id_kolom=jenis.id_jenis INNER JOIN kelas ON kelas.id_jenis=jenis.id_jenis  WHERE tag.tag_seo = '$tagged' GROUP BY tag.id_kolom")->result();
        $this->load->view("tagged", $data);
    }

}
