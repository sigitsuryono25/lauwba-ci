<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Etc
 *
 * @author windows8.1
 */
class Etc extends CI_Model {

    //put your code here
    function tarif($tipe) {
        $query = $this->db->query("select tarif from tarif where tipe='$tipe'");
        $data = $query->rows();
        return $data->tarif;
    }

    function charge_mishop() {
        $query = $this->db->query("select tarif from tarif where tipe='charge'");
        $data = $query->rows();
        return $data->tarif;
    }
    
    function add_date($tgl){
        $date = date_create($tgl);
        date_add($date, date_interval_create_from_date_string('3 days'));
        return date_format($date, 'd-m-Y');
    }
    
    
    function randomunik(){
        return rand(100,999);
    }

    public function rp($angka) {
        $rupiah = number_format($angka, 0, ',', '.');
        return 'Rp. ' . $rupiah;
    }

    public function rps($angka) {
        $rupiah = number_format($angka, 0, ',', '.');
        return $rupiah;
    }
    
    public function compressedimage($url){
        $image = file_get_contents($url);
        if ($image !== false){
            $img =  base64_encode($image);
        }
        //if ($img) {
        $percent = 0.7;
        // Content type
        $data = base64_decode($img);
        $im = imagecreatefromstring($data);
        $width = imagesx($im);
        $height = imagesy($im);
        // $newwidth = $width * $percent;
        $newwidth = 140;
        // $newheight = $height * $percent;
        $newheight = 86;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        // Resize
        imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        // Output
        ob_start (); 
          imagepng($thumb);
          $image_data = ob_get_contents (); 
        ob_end_clean (); 
        
        $image_data_base64 = base64_encode ($image_data);
        // echo $image_data_base64;
        return 'data:image/png;base64,'. $image_data_base64;
        //}
    }

   

    function tgl($tgl) {
        $hari = substr($tgl, 8, 2);
        $tahun = substr($tgl, 0, 4);
        $nama_bulan = $this->bulan($tgl);
        $tgl_oke = $hari . ' ' . $nama_bulan . ' ' . $tahun;
        return $tgl_oke;
    }
    
    function bulanOnly($bulan)
	{
		switch ($bulan) {
			case 1:
				$bulan = "Januari";
				break;
			case 2:
				$bulan = "Februari";
				break;
			case 3:
				$bulan = "Maret";
				break;
			case 4:
				$bulan = "April";
				break;
			case 5:
				$bulan = "Mei";
				break;
			case 6:
				$bulan = "Juni";
				break;
			case 7:
				$bulan = "Juli";
				break;
			case 8:
				$bulan = "Agustus";
				break;
			case 9:
				$bulan = "September";
				break;
			case 10:
				$bulan = "Oktober";
				break;
			case 11:
				$bulan = "November";
				break;
			case 12:
				$bulan = "Desember";
				break;
		}
		return $bulan;
	}
	
	public function dateFormat($date, $format = "d/m/Y")
	{
		return date_format(date_create($date), $format);
	}
	
	public function dateAdd($dates, $add, $format = "d/m/Y")
	{
		$date = date_create($dates);
		date_add($date, date_interval_create_from_date_string($add));
		return date_format($date, $format);
	}


    function prov() {
        $query = $this->db->query("Select * from provinces");
        return $query->result();
    }

    function kab($id) {
        $query = $this->db->query("Select * from regencies where province_id='$id'");
        return $query->result();
    }

    public function terbilang($angka) {

        $angka = (float) $angka;
        $bilangan = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');

        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int) ($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            return sprintf('Seratus %s', $this->terbilang($angka - 100));
        } else if ($angka < 1000) {
            $hasil_bagi = (int) ($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            $hasil_bagi = (int) ($angka / 1000);
            $hasil_mod = $angka % 1000;
            return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } else if ($angka < 1000000000) {
            $hasil_bagi = (int) ($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            $hasil_bagi = (int) ($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) {
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }
    
     public function indonesiaDate($tgl, $jam = null, $delimiter = " ", $isCut = false)
    {
        $hari = substr($tgl, 8, 2);
        // if($hari < 10){
        // 	$hari = "0".$hari;
        // }
        $tahun = substr($tgl, 0, 4);
        $nama_bulan = $this->bulan($tgl, $isCut);
        $tgl_oke = $hari . ' ' . $nama_bulan . ' ' . $tahun . "$delimiter " . $jam;
        return $tgl_oke;
    }
    
    function bulan($tgl, $isCut = false)
    {
        $bulan = substr($tgl, 5, 2);
        switch ($bulan) {
            case 1:
                $bulan = ($isCut) ? "Jan" : "Januari";
                break;
            case 2:
                $bulan = ($isCut) ? "Feb" : "Februari";
                break;
            case 3:
                $bulan = ($isCut) ? "Mar" : "Maret";
                break;
            case 4:
                $bulan = ($isCut) ? "Apr" : "April";
                break;
            case 5:
                $bulan = ($isCut) ? "Mei" : "Mei";
                break;
            case 6:
                $bulan = ($isCut) ? "Jun" : "Juni";
                break;
            case 7:
                $bulan = ($isCut) ? "Jul" : "Juli";
                break;
            case 8:
                $bulan = ($isCut) ? "Agus" : "Agustus";
                break;
            case 9:
                $bulan = ($isCut) ? "Sep" : "September";
                break;
            case 10:
                $bulan = ($isCut) ? "Okt" : "Oktober";
                break;
            case 11:
                $bulan = ($isCut) ? "Nov" : "November";
                break;
            case 12:
                $bulan = ($isCut) ? "Des" : "Desember";
                break;
        }
        return $bulan;
    }
    
    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
    
     function date_diff($date) {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $date1 = new DateTime($date);
        $date2 = new DateTime($now);

        $diff = $date2->diff($date1);

        $hours = $diff->h;
        $day = $diff->days;
        if ($day >= 365) {
            return round($day / 365) . ' Tahun lalu';
        } else if ($day > 0 && $day <=31) {
            return $day . ' Hari lalu';
        }else if ($day > 31 && $day <365) {
            return round($day / 31) . ' Bulan lalu';
        } else if ($hours <= 24) {
            return $hours . ' jam Lalu';
        }
    }
    
    function getWeekday($date) {
        $w = date('w', strtotime($date));
        $days = array('Minggu', 'Senin', 'Selasa', 'Rabu','Kamis','Jumat', 'Sabtu');
        return $days[$w];
    }

}
