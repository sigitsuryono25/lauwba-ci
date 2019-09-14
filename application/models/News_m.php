<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News_m
 *
 * @author sigit
 */
class News_m extends CI_Model {

    //put your code here

    public function insert($data) {
        $this->db->insert("news", $data);
        return $this->db->affected_rows();
    }

    public function getkategori() {
        return $this->db->query("SELECT * FROM kategori1 ORDER BY id_kategori ")->result();
    }

    public function daftarBerita() {
        return $this->db->query("SELECT * FROM `news` INNER JOIN kategori1 WHERE news.id_kategori=kategori1.id_kategori ORDER BY post_on DESC LIMIT 6")->result();
    }

    public function getBeritaById($id) {
        return $this->db->query("SELECT * FROM `news` INNER JOIN kategori1 ON news.id_kategori=kategori1.id_kategori WHERE id_news='$id'")->row();
    }

    public function delete_berita($cond) {
        $this->db->delete('news', $cond);
        return $this->db->affected_rows();
    }

}
