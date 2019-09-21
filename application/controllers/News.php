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
    
    function daftar_berita() {

        $data['kategori'] = $this->crud->select_other("kategori", "ORDER BY id_kategori ASC")->result();
        // $data['news'] = $this->crud->select_other('news', "INNER JOIN kategori WHERE news.id_kategori=kategori.id_kategori ORDER BY post_on DESC LIMIT 60")->result();
        $data['detail'] = (object) array("judul" => "Lauwba News", "isi_jenis" => "Artikel/Berita Lauwba Terkini");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_news_list', $data);
    }
    
    function pagination($nextIndex = 0, $showed=4, $idKat){
        $data['news'] = $this->db->query("SELECT * FROM news INNER JOIN kategori ON news.id_kategori=kategori.id_kategori WHERE news.id_kategori IN ('$idKat')
        ORDER BY post_on DESC LIMIT $nextIndex, $showed")->result();
        $this->load->view('pagination-response', $data);
    }
    
    
    function news_by_category($kate){
        $page = empty($this->input->get('page')) ? 0 : $this->input->get('page');
        $getLimit = $this->db->query("SELECT * FROM kategori WHERE kategori_seo IN ('$kate')")->row();
        $data['kategori'] = $getLimit->nama_kategori;
        $idKategori = $getLimit->id_kategori;
        $multiplier = 20;
        $limit = $page*$multiplier;
        $data['news'] = $this->db->query("SELECT * FROM `news` WHERE id_kategori IN ('$idKategori') ORDER BY post_on DESC LIMIT $limit, $multiplier")->result();
        $data['detail'] = (object) array("judul" => "Lauwba News: ".$getLimit->nama_kategori, "isi_jenis" => "Artikel/Berita Lauwba Terkini");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('page_berita_by_category', $data);
        
    }

    //put your code here
    function news_reader($param) {
//        SELECT * FROM `news` INNER JOIN kategori1 WHERE news.id_kategori=kategori1.id_kategori ORDER BY post_on DESC LIMIT 6
        $data['news'] = $this->news->daftarBerita();
        $data['testimoni'] = $this->crud->select('testimoni')->result();
        $data['kelas'] = $this->crud->select_join('kelas', 'jenis', 'id_jenis', "WHERE kelas.id_jenis NOT IN('1') ORDER BY kelas.biaya ASC")->result();
        $data['lain'] = $this->crud->select_where('jenis', "jenis.id_jenis IN('25','26','27') AND  jenis.id_jenis NOT IN('1') ")->result();
         $data['all_it'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('20', '21', '22') order by id_gallery desc  LIMIT 0,9")->result();
        $data['all_proj'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('17', '18', '26') order by id_gallery desc  LIMIT 0,9")->result();
        
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by id_gallery desc LIMIT 0,9")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by id_gallery desc LIMIT 0,9")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by id_gallery desc LIMIT 0,9")->result();
        
        $data['android'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='17' order by id_gallery desc LIMIT 0,9")->result();
        $data['desktop'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('26', '18') order by id_gallery desc LIMIT 0,9")->result();
        $data['produk'] = $this->crud->select_other('produk', 'ORDER BY date_added DESC LIMIT 10')->result();
        $data['album'] = $this->crud->select('album')->result();
//        $data['jadwal'] = $this->crud->select_other("kelas", 'join jenis on kelas.id_jenis=jenis.id_jenis ORDER BY kelas.jadwal DESC')->result();
        // $data['jadwal'] = $this->crud->select_other('jadwal', 'INNER JOIN jenis ON jadwal.id_jenis=jenis.id_jenis INNER JOIN kelas on jenis.id_jenis=kelas.id_jenis GROUP BY jadwal.kota_pelaksanaan  ORDER BY tanggal ASC')->result();
        $data['jadwal'] = $this->crud->select_other('jadwal', "LEFT JOIN jenis ON jadwal.id_jenis=jenis.id_jenis LEFT JOIN kelas on jenis.id_jenis=kelas.id_jenis  WHERE jadwal.active IN ('Y') GROUP BY jadwal.kota_pelaksanaan  ORDER BY tanggal ASC")->result();

        $data['news_detail'] = $this->crud->select_join('news', 'kategori', 'id_kategori', "WHERE news.judul_seo LIKE '$param'")->row();
        $idNews = $data['news_detail']->id_news;
        $data['tag'] = $this->crud->select_other("tag", "WHERE id_kolom='$idNews'")->result();
        $data['detail'] = (object) array("judul" => $data['news_detail']->jdl_news, "isi_jenis" => $data['news_detail']->ket_news);
        $this->load->view('headfoot/doctypedetail', $data);

        $this->load->view('page_news_reader', $data);
    }

}
