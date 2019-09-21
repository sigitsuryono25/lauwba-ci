<?php


class Peserta extends CI_Controller{
    
    function index(){
        redirect(site_url('/'));
    }
    
    function cetakHistoryKelas(){
        $content = $this->input->get('q');
        $data['content'] = $content;
        $this->load->view('page-history-kelas', $data);
    }
    
    function showHistoryKelas(){
        $idPeserta = $this->input->get('q');
        $get = $this->makeGetRequest("https://lauwba.com/411/index.php/Peserta/detailProgressByPeserta?id_peserta=$idPeserta");
        $detailPeserta = $this->makeGetRequest("https://lauwba.com/webservices/pendaftarDetail/$idPeserta");
        $jsonPeserta = json_decode($detailPeserta);
        $json =  json_decode($get);
        $data['history'] = $json->data_ajar;
        $data['peserta'] = $jsonPeserta;
        // echo "<pre>";
        // print_r($data['peserta']->kelas);
        // die;
        $this->load->view('new-page-history-kelas', $data);
    }

    private function makeGetRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Enable SSL verification
        
        $response = curl_exec($ch);
        
        if(curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        return $response;
    }
}