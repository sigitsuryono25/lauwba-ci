<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $data['news'] = $this->news->daftarBerita();
        $data['slider'] = $this->crud->select_other('slider', 'order by id_slider desc')->result();
        $data['bimtek'] = $this->crud->select_where('jenis', "id_kategori='1'")->result();
        $data['testimoni'] = $this->crud->select('testimoni')->result();
//        select_join($table1, $table2, $id)
        $data['kelas'] = $this->crud->select_join('kelas', 'jenis', 'id_jenis', "WHERE kelas.id_jenis NOT IN('1') ORDER BY kelas.biaya ASC")->result();
        $data['lain'] = $this->crud->select_where('jenis', "jenis.id_jenis IN('25','26','27') AND  jenis.id_jenis NOT IN('1') ")->result();
        $data['gallery'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album order by id_gallery desc limit 9")->result();
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by id_gallery desc limit 9")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by id_gallery desc limit 9")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by id_gallery desc limit 9")->result();
        $data['produk'] = $this->crud->select_other('produk', 'ORDER BY date_added DESC LIMIT 10')->result();
        $data['album'] = $this->crud->select('album')->result();
        $this->load->view('new_welcome_message', $data);
    }

    function team() {
        $data['team'] = $this->crud->select_other('tutor', 'order by id_tutor desc')->result();

        $this->load->view('teams', $data);
    }

    function contact() {
        $data['team'] = $this->crud->select_other('tutor', 'order by id_tutor desc')->result();
        $data['static'] = $this->crud->select_where('halamanstatis', "id_halaman='28'")->row();

        $this->load->view('contacts', $data);
    }

    function portofolio() {
        $data['gallery'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album order by id_gallery desc")->result();
        $data['in_house'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by id_gallery desc")->result();
        $data['private'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by id_gallery desc")->result();
        $data['regular'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by id_gallery desc")->result();
        $data['android'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='17' order by id_gallery desc")->result();
        $data['desktop'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='26' order by id_gallery desc")->result();
        $data['website'] = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='18' order by id_gallery desc")->result();
        $this->load->view('portofolio', $data);
    }

    function static_page($param) {
        $data['static'] = $this->crud->select_where('halamanstatis', "id_halaman='$param'")->row();

        $this->load->view('static-pages', $data);
    }

    function soft_dev($param = null) {
        $first = explode(".", $param);
        $data['static'] = $this->crud->select_other('halamanstatis', "WHERE judul_seo='$first[0]'")->row();
        $this->load->view('static-pages', $data);
    }

    function kursus($param = null) {
       
        $first = explode(".", $param);

        $data['kelas'] = $this->crud->select_other('jenis', "join kategori1 ON jenis.id_kategori=kategori1.id_kategori"
                        . " JOIN kelas ON jenis.id_jenis=kelas.id_jenis "
                        . " WHERE kategori1.kategori_seo='$first[0]' AND id_subkategori NOT IN ('1') ORDER BY kelas.biaya ASC")->result();
        $this->load->view('software-dev', $data);
    }

}
