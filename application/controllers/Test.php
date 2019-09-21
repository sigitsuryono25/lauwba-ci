<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class Test extends CI_Controller{
    
    public function surat_penawaran($resi) {
        $usingPdf = $this->input->get('pdf') ?? 0;
	    $url = site_url("webservices/get_detail_training?resi=$resi");
	     //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);
        
        $data['ttd'] = base_url('/assets/img/ttd.png');
        $data['rekening'] = base_url('/assets/img/rekening.png');
         $data['detail'] = $this->db->query("SELECT * FROM pendaftar 
        INNER JOIN`jenis` 
        ON pendaftar.training = jenis.id_jenis 
        INNER JOIN kelas 
        ON jenis.id_jenis=kelas.id_jenis 
        WHERE pendaftar.id='$resi'")->row();
       
        // konfigurasi dompdf
        if($usingPdf == 0){
            $template = "";
            $template .= $this->opening($data);
            // $template .= $this->main($data);
            echo $template;
        }else{
            
            $options = new Options();
            $options->setChroot(__DIR__);
            $options->set('isRemoteEnabled', true);
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            
            $dompdf = new Dompdf($options);
            $html = $this->load->view('surat-penawaran/new-surat-penawaran', $data, TRUE);
            $dompdf->setBasePath(__DIR__);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $dompdf->render();
            
            $canvas = $dompdf->getCanvas();
            $font = $dompdf->getFontMetrics()->get_font("Arial", "normal");
            
            $text = "Halaman {PAGE_NUM}/{PAGE_COUNT}";
            $size = 10;
            
            // hitung lebar text
            $textWidth = $dompdf->getFontMetrics()->get_text_width($text, $font, $size);
            
            // posisi X di tengah
            $x = (($canvas->get_width() - $textWidth) / 2) + 60;
            
            // posisi Y (bawah)
            $y = $canvas->get_height() - 70; // 60px dari bawah
            
            $canvas->page_text($x, $y, $text, $font, $size, [0, 0, 0]);
            
            // stream PDF
            $dompdf->stream("sertifikat_xxx.pdf", [
                "Attachment" => false
            ]);
        }

    }
    
    private function opening($data){
        return $this->load->view('surat-penawaran/template_surat_penawaran', $data, TRUE);
            
    }
    
    private function main($data){
        return $this->load->view('surat-penawaran/template_surat_penawaran_main', $data, TRUE);
    }
    
    
}