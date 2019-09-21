<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set("Asia/Jakarta");


class Project extends CI_Controller{
    
    function formPendaftaran(){
        $data['detail'] = (object) array("judul" => "Form Pendaftaran Project Lauwba Techno Indonesia", "isi_jenis" => "Form Pendaftaran Project Lauwba Techno Indonesia");
        $this->load->view('headfoot/doctypedetail', $data);
        $this->load->view('headfoot/header');
        $this->load->view('pendaftaran-project');
        $this->load->view('headfoot/footer');
    }
    
    function pendaftaran(){
        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);
        
        $ins = $this->crud->insert('pendaftar_project', $data);
        if($ins > 0){
            echo json_encode(['message' => 'data berhasil ditambahkan', 'code' => 200]);
        }else{
            echo json_encode(['message' => 'data gagal ditambahkan', 'code' => 500]);
        }
    }
    
    function data(){
        $page = (!empty($this->input->get('page'))) ? $this->input->get('page') : 0;
        $offset = 25;
        $start = $page*$offset;
        $project = $this->db->query("SELECT * FROM pendaftar_project ORDER BY terdaftar_pada DESC LIMIT $start, $offset")->result();
        if(!empty($project)){
            $data = [];
            foreach($project as $p){
                $tmp = [];
                $tmp['uuid'] = $p->uuid;
                $tmp['nama'] = $p->nama;
                $tmp['terdaftar_pada'] = date_format(date_create($p->terdaftar_pada), "d/m/Y");
                $tmp['judul_aplikasi'] = $p->judul_aplikasi;
                $tmp['nomor_telepon'] = $p->nomor_telepon;
                $tmp['list_fitur'] = $p->list_fitur;
                $tmp['harga'] = $this->etc->rp($p->harga);
                $tmp['biaya_kelas'] = $this->etc->rp($p->biaya_kelas);
                $tmp['total'] = $this->etc->rp($p->biaya_kelas + $p->harga);
                
                array_push($data, $tmp);
            }
            echo json_encode(['message' => 'data ditemukan', 'code' => 200, 'data' => $data]);
        }else{
            echo json_encode(['message' => 'tidak ada data', 'code' => 404]);
        }
    }
    
    function hapus_data(){
        $uuid = $this->input->get('uuid');
        $where = ['uuid' => $uuid];
        $del = $this->crud->deleteArray('pendaftar_project', $where);
         if($del > 0){
            echo json_encode(['message' => 'data berhasil dihapus', 'code' => 200]);
        }else{
            echo json_encode(['message' => 'data gagal ditambahkan', 'code' => 500]);
        }
    }
}