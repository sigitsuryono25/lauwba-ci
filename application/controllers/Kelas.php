<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kelas
 *
 * @author Sigit Suryono
 */
class Kelas extends CI_Controller {

    //put your code here
    function detail() {
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

        $segment = $this->uri->segment(1);
        $data['segment'] = $segment;

        $routes = array('bimbingan-teknis-pengelolaan-fotografi-dan-videografi-bagi-pemerintah-daerah-35.html', 'bimbingan-teknis-membangun-sistem-informasi-dan-administrasi-desa-berbasis-android--website-34.html',
            'in-house-training-27.html', 'incubator-class-android-26.html', 'private-class-web-android-25.html');

        
        // $id_produk = $data['detail']->id_jenis;
        // $data['tag'] = $this->crud->select_other("tag", "WHERE id_kolom='$id_produk'")->result();
        
        if (in_array($segment, $routes)) {
            $data['detail'] = $this->db->query("SELECT * FROM `jenis` WHERE jenis.routes IN('$segment')")->row();
            $data['tag'] = $this->crud->select_other("tag", "WHERE id_kolom='".$data['detail']->id_jenis."'")->result();
            $this->load->view('headfoot/doctypedetail', $data);
            $this->load->view('page_kelas_lain', $data);
        } else {
            $data['detail'] = $this->db->query("SELECT * FROM `kelas` INNER JOIN jenis ON kelas.id_jenis=jenis.id_jenis WHERE jenis.routes IN('$segment')")->row();
            $idKelas = $data['detail']->id_jenis;
            $data['tag_kelas'] = $this->crud->select_other("tag", "WHERE id_kolom='$idKelas'")->result();
            $this->load->view('headfoot/doctypedetail', $data);
            $this->load->view('page_detail_kelas', $data);
        }
    }

    function perbandinganKelas(){
        $this->load->view('page_class_comparison');
    }
    
    function perbandinganKelasStatis(){
        $this->load->view('page_class_comp_statis');
    }
}
