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
        $data['gallery'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album order by id_gallery desc limit 9")->result();
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by id_gallery desc limit 9")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by id_gallery desc limit 9")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by id_gallery desc limit 9")->result();
        $data['produk'] = $this->crud->select_other('produk', 'ORDER BY date_added DESC LIMIT 10')->result();
        $data['album'] = $this->crud->select('album')->result();

        $segment = $this->uri->segment(1);
        $data['segment'] = $segment;
        $data['detail'] = $this->crud->select_where('jenis', "jenis.routes='$segment'")->row();

        $routes = array('bimbingan-teknis-pengelolaan-fotografi-dan-videografi-bagi-pemerintah-daerah-35.html', 'bimbingan-teknis-membangun-sistem-informasi-dan-administrasi-desa-berbasis-android--website-34.html',
            'in-house-training-27', 'incubator-class-android-26.html', 'private-class-web-android-25.html');

        if (in_array($segment, $routes)) {
            $this->load->view('detail_kelas_1', $data);
        } else {
            $this->load->view('detail_kelas', $data);
        }
    }

}
