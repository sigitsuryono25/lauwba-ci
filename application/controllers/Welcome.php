<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
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
        $data['album'] = $this->crud->select('album')->result();
        $this->load->view('welcome_message', $data);
    }

}
