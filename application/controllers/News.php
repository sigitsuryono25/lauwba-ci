<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News
 *
 * @author Sigit Suryono
 */
class News extends CI_Controller {

    function news_list() {

        $data['news'] = $this->crud->select_other('news', "ORDER BY post_on DESC LIMIT 20")->result();
        $data['detail'] = (object) array("judul" => "Lauwba News", "isi_jenis" => "Artikel/Berita Lauwba Terkini");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('news-list', $data);
    }

    //put your code here
    function news_reader($param) {
//        SELECT * FROM `news` INNER JOIN kategori1 WHERE news.id_kategori=kategori1.id_kategori ORDER BY post_on DESC LIMIT 6
        $data['news'] = $this->news->daftarBerita();
        $data['testimoni'] = $this->crud->select('testimoni')->result();
        $data['kelas'] = $this->crud->select_join('kelas', 'jenis', 'id_jenis', "WHERE kelas.id_jenis NOT IN('1') ORDER BY kelas.biaya ASC")->result();
        $data['lain'] = $this->crud->select_where('jenis', "jenis.id_jenis IN('25','26','27') AND  jenis.id_jenis NOT IN('1') ")->result();
        $data['gallery'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album order by id_gallery desc limit 9")->result();
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by id_gallery desc limit 9")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by id_gallery desc limit 9")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by id_gallery desc limit 9")->result();
        $data['produk'] = $this->crud->select_other('produk', 'ORDER BY date_added DESC LIMIT 10')->result();
        $data['album'] = $this->crud->select('album')->result();
        $data['jadwal'] = $this->crud->select_other("kelas", 'join jenis on kelas.id_jenis=jenis.id_jenis ORDER BY kelas.jadwal DESC')->result();

        $data['news_detail'] = $this->crud->select_join('news', 'kategori1', 'id_kategori', "WHERE news.judul_seo='$param'")->row();
        $data['detail'] = (object) array("judul" => $data['news_detail']->jdl_news, "isi_jenis" => $data['news_detail']->ket_news);
        $this->load->view('headfoot/doctypedetail', $data);

        $this->load->view('news-reader', $data);
    }

}
