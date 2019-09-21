<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here"/>
        <title>Surat Penawaran</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.lauwba.com/assets/highslide/highslide.css" type="text/css">
    </head>
    <style>
        .wrapper-page {
            page-break-after: always;
            background-image: url('<?= base_url("assets/img/bg.png?v=". date('ymdhis')) ?>');
            background-position: center;
            background-repeat: no-repeat;
        }

        .wrapper-page:last-child {
            page-break-after: always;
        }
        body{
            max-width: 960px;
            margin: 0 auto;
        }
        th, td {
            padding: 10px;
        }
       #overlay {
          position: fixed;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: rgba(0,0,0,0.5);
          z-index: 2;
          cursor: pointer;
        }
        
        #text{
          position: absolute;
          top: 50%;
          left: 50%;
          font-size: 50px;
          color: white;
          transform: translate(-50%,-50%);
          -ms-transform: translate(-50%,-50%);
        }
        @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
    </style>
    <body>
        <!--Mobile Version-->
        <div class="container-fluid p-2 d-flex d-md-none justify-content-end no-print">
            <div class="btn-group table-responsive">
                <button class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
                <a class="btn btn-outline-success btn-sm " onclick="window.print()"><i class="fa fa-download"></i> Download</a>
                <a class="btn btn-outline-success btn-sm" href="<?= base_url()?>/assets/berkas-pendukung/company-profile-pt-lauwba-techno-indonesia.pdf"><i class="fa fa-download"></i> Company Profile</a>
                <a class="btn btn-outline-success btn-sm " href="<?= base_url()?>/assets/berkas-pendukung/npwp-pt-lauwba-techno-indonesia.png"><i class="fa fa-download"></i> NPWP</a>
                <??>
                <a class="btn btn-outline-success btn-sm "  href="<?= base_url()?>/assets/berkas-pendukung/form-registrasi.xlsx" download><i class="fa fa-download"></i> Form Registrasi</a>
            </div>
        </div>
        <!--Desktop Version-->
        <div class="container-fluid p-2 d-md-flex d-none fixed-top justify-content-end no-print">
            <div class="btn-group">
                <button class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
                <button class="btn btn-outline-success btn-sm "  onclick="window.print()"><i class="fa fa-download"></i> Download</button>
                <a class="btn btn-outline-success btn-sm" href="<?= base_url()?>assets/berkas-pendukung/company-profile-pt-lauwba-techno-indonesia.pdf" download><i class="fa fa-download"></i> Company Profile</a>
                <a class="btn btn-outline-success btn-sm " href="<?= base_url()?>assets/berkas-pendukung/npwp-pt-lauwba-techno-indonesia.png" download><i class="fa fa-download"></i> NPWP</a>
                <a class="btn btn-outline-success btn-sm "  href="<?= base_url()?>assets/berkas-pendukung/form-registrasi.xlsx" download><i class="fa fa-download"></i> Form Registrasi</a>
                <!--<a class="btn btn-outline-success btn-sm "  href="#" onclick="exportHTML()"><i class="fa fa-download"></i> Download Doc</a>-->
            </div>
        </div>
        <div style="margin: 10px" id="html-source">
            <div class="d-md-none d-block"></div>
            <div class="wrapper-page">
                <?php $this->load->view('header-pdf') ?>
                <div class="body">
                    <h5 style="text-align: center"><u>SURAT PENAWARAN</u><br>
                        <small class="text-center">No: <?= date_format(date_create($detail->daftar_pada), "d")?>/<?= date_format(date_create($detail->daftar_pada), "m")?>/411/LTI/<?= date_format(date_create($detail->daftar_pada), "Y")?></small></h5>

                    <table border='0'>
                        <tr>
                            <td>Lampiran</td>
                            <td>:</td>
                            <td>3 (Tiga) Berkas</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>Surat Penawaran <?= $detail->judul ?></td>
                        </tr>
                    </table>
                    <p style="text-align: justify">
                        <b>Kepada Yth,</b><br><br>
                        <span class="text-capitalize"><b>
                                <?php
                                if (!empty($detail->jabatan) && !empty($detail->instansi)) {
                                    echo "Bagian " . $detail->jabatan . " " . $detail->instansi;
                                } else {
                                    echo $detail->nama_lengkap;
                                }
                                ?>
                            </b></span><br><br>
                        <span>Di</span><br><br>
                        <span>Tempat</span><br><br>
                        <span>Dengan Hormat, </span><br><br>
                        Sebelumnya kami mengucapkan terima kasih kepada Bapak/Ibu telah menyediakan waktu untuk membaca Surat Penawaran kami. 
                        Dengan perkembangan teknologi  serta arus informasi yang semakin mudah diakses, 
                         maka dibutuhkan sebuah pengembangan skill dibidang IT. 
                        Adapun  rincian materi <?= $detail->judul ?> serta biayanya sebagaimana terlampir.
                        Demikian undangan kami. Atas perhatian dari Bapak/Ibu kami ucapkan Terima Kasih.
                    </p>
                    <p style="text-align: right; margin-top: 100px">
                        <span>Hormat Kami,</span><br><br>
                        <img src="<?= $ttd ?>" alt="" style="width: 30%"><br>
                        <span class="border-bottom border-dark"><b>Hardiansah, M.Kom.</b></span><br>
                        <span style="margin-top: 20px">Direktur PT. Lauwba Techno Indonesia</span>
                    </p>
                </div>
                
                <?php $this->load->view('footer-pdf') ?>
            </div>
            <div class="wrapper-page">
                <?php $this->load->view('header-pdf') ?>
                <div class="body">
                    <h5 class="text-center">LAMPIRAN</h5>
                    <ol>
                        <li><b>PROFIL SINGKAT KAMI</b></li>
                        <p class="text-justify">
                            PT. Lauwba Techo Indonesia merupakan perusahaan yang bergerak pada bidang teknologi informasi khususnya software development dan IT Training dengan 
                            tenaga ahli S2 dan S1 dalam bidang programming, desain dan analisis yang berpengalaman paling sedikit 1 tahun dan telah menangani 
                            ratusan client kami yang tersebar diseluruh Indonesia serta ASIA baik untuk pembuatan Aplikasi dan sistem informasi  untuk 
                            pemerintahan, swasta, akademik maupun sekolah serta sudah ribuan alumni peserta training kami yang tersebar di seluruh Indonesia, Eropa dan Asia.
                        </p>

                        <li><b>TARGET PESERTA & SILABUS</b></li>
                        <p class="text-justify">
                            <b>Target Peserta :</b><br><br>
                            Program ini dapat diikuti oleh siapapun yang berasal dari kalangan umum, karena dibimbing dari NOL dengan system pembelajaran 90% praktek dan 10% teori dengan GARANSI  sampai Bisa sebagaimana silabus yang telah kami susun.
                        </p>

                        <li><b>SILABUS</b></li>
                        <p class="text-justify">Pelaksanaan pada tanggal 
                        
                        <?php if(!empty($detail->in_house_tanggal_mulai) && !empty($detail->in_house_tanggal_selesai)){?>
                            <?= $this->etc->tgl($detail->in_house_tanggal_mulai) ?> hingga <?= $this->etc->tgl($detail->in_house_tanggal_selesai) ?> dengan system pembelajaran full praktek serta dilengkapi dengan perangkat lengkap.</p>
                        <?php }?>
                         <?php if(!empty($detail->private_tanggal_mulai)){?>
                            <?= $this->etc->tgl($detail->private_tanggal_mulai) ?> dengan system pembelajaran full praktek serta dilengkapi dengan perangkat lengkap.</p>
                        <?php }?>
                            
                        <?php 
                        $data['silabus'] = $this->db->query("SELECT silabus FROM jenis WHERE id_jenis IN ('".$detail->id_jenis."')")->row()->silabus;
                        $this->load->view('pdf-silabus', $data) ?>
                        
                        
                        
                        <div style="page-break-before: always"><?php $this->load->view('header-pdf') ?></div>
                        <li ><b>JADWAL DAN TEMPAT</b></li>
                        <h5>Jadwal:</h5>
                        <?php if(!empty($detail->in_house_tanggal_mulai) && !empty($detail->in_house_tanggal_selesai)){?>
                            <p>Pelaksanaan pada tanggal <?= $this->etc->tgl($detail->in_house_tanggal_mulai) ?> hingga <?= $this->etc->tgl($detail->in_house_tanggal_selesai) ?></p>
                        <?php }?>
                         <?php if(!empty($detail->private_tanggal_mulai)){?>
                            <p>Pelaksanaan pada tanggal <?= $this->etc->tgl($detail->private_tanggal_mulai) ?></p>
                        <?php }?>
                        <h5>Tempat:</h5>
                         
                        
                        <!-- GET ALAMAT -->
                        <?php 
                        $pilkel = $detail->pilihan_kelas;
                        if($pilkel == "private-offline"){
                            echo '<p class="text-justify"><b>PRIVATE OFFLINE CLASSS : </b>';
                            $kota = $detail->private_kota_pelaksanaan;
                            $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                            if(!empty($alamat)){
                                echo "Pelaksanaan di ". $alamat->alamat;
                            }else{
                                echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                            }
                        }else if($pilkel == "reg"){
                            echo '<p class="text-justify"><b>REGULER CLASS : </b>';
                            $kota = $detail->kota;
                            $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                            if(!empty($alamat)){
                                echo "Pelaksanaan di ". $alamat->alamat;
                            }else{
                                echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                            }
                        }else if($pilkel == "in-house"){
                             echo '<p class="text-justify"><b>IN HOUSE CLASSS : </b>';
                            $kota = $detail->in_house_kota_pelaksanaan;
                            if(strtolower($kota) == "online" || strtolower($kota) == 'daring'){
                                echo "Pelaksanaan dilakukan secara $kota sesuai dengan pilihan yang sudah ditentukan sebelumnya";
                            }
                            // if(strtolower($kota) == "yogyakarta" || strtolower($kota) == 'jogja' || strtolower($kota) == 'yogya'){
                            //   echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                            //   Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                            // }
                            else{
                                // $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                                // if(!empty($alamat)){
                                    echo "Pelaksanaan di kota ". $kota;
                                // }else{
                                //     echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                //     Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                                // }
                            }
                        }else{
                            echo '<p class="text-justify"><b>PELAKSANAAN : </b>';
                            echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                        }
                        
                        ?>
                        </p>
                        <!--<p class="text-justify"><b>IN HOUSE TRAINING  : Pelaksanaan di kantor Bapak/Ibu</b> cukup menambah biaya atau menyiapkan  akomodasi(penginapan) untuk trainer kami-->
                        <!--</p>-->

                        <li><b>FASILITAS  & BIAYA</b></li>
                        <h5>Fasilitas</h5>
                        <p>
                            - Sertifikat<br>
                            - GRATIS Mengulang Sampai Bisa Dikantor Kami (Yogyakarta)<br>
                            - Modul Dalam Bentuk Buku<br>
                            - Software untuk tools develop<br>
                            - Perangkat alat teknisi selama training<br>
                            - Grup konsultansi via WA setelah training selesai<br>
                        </p>
                        <h5>Biaya Paket Training dan Course</h5>
                        <!--<p>-->
                        <!--    - <b>Paket A (Minimal 15 Peserta)</b>  : Rp.1.700.000/Peserta<br>-->
                        <!--    - <b>Paket B (Minimal 10 Peserta)</b>  : Rp.2.100.000/Peserta<br>-->
                        <!--    - <b>Paket C (Minimal 5 Peserta)</b>  : Rp.3.200.000/Peserta<br>-->
                        <!--    - <b>Paket D (Minimal 3 Peserta)</b>  : Rp.3.900.000/Peserta<br>-->
                        <!--    - <b>Paket E (Minimal 1 Peserta)</b>  : Rp.4.900.000/Peserta<br>-->
                        <!--</p>-->
                        <div class="biaya">
                            <?php 
       $additionalInfo = "";
       $hrg = "";
       $multiplier = "";
       $psrtaString = "";
       if($detail->pilihan_kelas == 'reg'){
           $coret = $detail->biaya_coret;
           $hrg = $detail->harga;
           $jdwl = (!empty($this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row())) ? $this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row()->tanggal : "";
           $additionalInfo .= "<i>(Kelas Reguler Offline: Jadwal $jdwl)</i>";
       }else if($detail->pilihan_kelas == 'private-offline'){
           $coret = $detail->biaya_private_coret;
           $additionalInfo .= "<i>(Kelas ".strtolower(str_replace("-", " ", $detail->pilihan_kelas)).")</i>";
           $hrg = $detail->harga;
       }else if($detail->pilihan_kelas == 'in-house'){
           $coret = $detail->biaya_inhouse_coret;
           $psrta = $detail->in_house_jumlah_peserta;
           $psrtaString = "(Peserta: $psrta Orang)";
           $pelaksanaan = date_format(date_create($detail->in_house_tanggal_mulai), "d-m-Y");
           $additionalInfo .= "<i> (Kelas ".strtolower(str_replace("-", " ", $detail->pilihan_kelas)).": Pelaksanaan $pelaksanaan)</i>";
           $hrg = ($detail->harga/$psrta);
           $multiplier = " x ". $psrta;
           
       }else if($detail->pilihan_kelas == 'private-online'){
           $coret = $detail->biaya_private_online_coret;
           $additionalInfo .= "<i> (Kelas ".strtolower(str_replace("-", " ", $detail->pilihan_kelas)).")</i>";
           $hrg = $detail->harga;
       }else if($detail->pilihan_kelas == 'reg-online'){
           $coret = $detail->biaya_reg_online_coret;
           $jdwl = (!empty($this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row())) ? $this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row()->tanggal : "";
           $additionalInfo .= "<i> (Kelas Reguler Online: Jadwal $jdwl)</i>";
           $hrg = $detail->harga;
       }else if($detail->pilihan_kelas == "inkubator"){
           $coret = $detail->biaya_incubator_coret;
           $additionalInfo .= "<i>(".$detail->pilihan_kelas.": Durasi ".$detail->durasi. " bulan)</i>";
           $hrg = ($detail->harga/$detail->durasi);
           $multiplier = " x ". $detail->durasi;
       }
       ?>
        <?php $voucher = $detail->voucher;?>
        <table style="width: 100%;" class="table">
           <tr>
                <td><?php echo $detail->judul?><br><small><?= $psrtaString?></small><br><small class="text-capitalize"><?= $additionalInfo?></small></td>
                <td class="text-right"><span class="text-danger"><del>Rp. <?php echo $this->etc->rps($coret)?></del></span>&nbsp;&nbsp;Rp. <?= $this->etc->rps($hrg) . $multiplier?>
                <?php if(!empty($voucher)){?>
                <br> 
                (Voucher <span class="text-uppercase"><?= $voucher?></span>) 
                <?php }?>
                </td>
            </tr>
             <?php $subtotal = $detail->harga-$detail->random?>
            <tr class="border_bottom">
                <td>Kode Unik</td>
                <td  style="text-align: right;">Rp. <?php echo $detail->random ?></td>
            </tr>
            <tr class="border_bottom">
                <td class="text-right">Subotal</td>
                <td  style="text-align: right;">Rp. <?php echo $this->etc->rps($subtotal)?></td>
            </tr>
            <tr class="border_bottom">
                <td class="text-right">Total</td>
                <td  style="text-align: right;"><b>Rp. <?php echo $this->etc->rps($subtotal)?></b></td>
            </tr>
        </table>
                            <?php 
                            //   if($detail->pilihan_kelas == 'reg'){
                            //       $coret = $detail->biaya_coret;
                            //   }else if($detail->pilihan_kelas == 'private-offline'){
                            //       $coret = $detail->biaya_private_coret;
                            //   }else if($detail->pilihan_kelas == 'in-house'){
                            //       $coret = $detail->biaya_inhouse_coret;
                            //   }else if($detail->pilihan_kelas == 'private-online'){
                            //       $coret = $detail->biaya_private_online_coret;
                            //   }else if($detail->pilihan_kelas == 'reg-online'){
                            //       $coret = $detail->biaya_reg_online_coret;
                            //   }
                               ?>
                                <?php $voucher = $detail->voucher;?>
                                <!--<table class="table font-weight-bold table-sm">-->
                                <!--    <tr>-->
                                <!--        <td><?php echo $detail->judul?></td>-->
                                <!--        <td class="text-right"><span class="text-danger"><del>Rp. <?php echo $this->etc->rps($coret)?></del></span>&nbsp;&nbsp;Rp. <?php echo $this->etc->rps($detail->harga)?>-->
                                <!--        <?php if(!empty($voucher)){?>-->
                                <!--        <br> -->
                                <!--        (Voucher <span class="text-uppercase"><?= $voucher?></span>) -->
                                <!--        <?php }?>-->
                                <!--        </td>-->
                                <!--    </tr>-->
                                <!--    <?php $subtotal = $detail->harga-$detail->random?>-->
                                <!--    <tr>-->
                                <!--        <td>Kode Unik</td>-->
                                <!--        <td class="text-right">Rp. <?php echo $detail->random ?></td>-->
                                <!--    </tr>-->
                                <!--    <tr>-->
                                <!--        <td class="text-right">Subotal</td>-->
                                <!--        <td class="text-right">Rp. <?php echo $this->etc->rps($subtotal)?></td>-->
                                <!--    </tr>-->
                                <!--    <tr>-->
                                <!--        <td class="text-right">Total</td>-->
                                <!--        <td class="text-right">Rp. <?php echo $this->etc->rps($subtotal)?></td>-->
                                <!--    </tr>-->
                                <!--</table>-->
                        </div>
                            <b>Catatan :</b><br><i>Untuk In House Training dengan Pelaksanaan ditempat Bpk/Ibu, Cukup menambah biaya akomodasi<br>(transport dan penginapan) untuk instruktur kami.</i><br><br>
                        <h5>Pembayaran Bisa Melalui Rekening dibawah ini :</h5>
                        <?php 
                        $getPathRekening = base_url('411/assets/images/rekening/');
                        $rekening = $this->db->select("*, concat('$getPathRekening', filename) as fullpath")->from('rekening')->where(['is_active' => '1'])->get()->result();
                        ?>
                        <div class="row d-flex justify-content-center">
                            <div class="col-4">
                            <?php foreach($rekening as $rr){?>
                                <img src="<?= $rr->fullpath?>" alt="<?= $rr->filename?>" onclick="copyRekening('<?= $rr->nomor_rekening?>')"
                                    class="img img-fluid w-75"/>
                            <?php }?>
                            <img src="https://www.lauwba.com/assets/img/footer-rekening.png" class="img img-fluid w-75 mb-2">
                            </div><small class="font-weight-bold">
                        </small></div>
                        <center>
                            <br>
                        </center>
                    </ol>
                </div>
                
                <?php $this->load->view('footer-pdf') ?>
            </div>
            <?php $this->load->view('pdf-team') ?>
            <br>
            <br>
            <br>
            <?php $this->load->view('pdf-poster') ?>
            <?php $this->load->view('pdf-portofolio') ?>
            <?php $this->load->view('pdf-portofolio-1') ?>
            <?php $this->load->view('pdf-portofolio-2') ?>
            <?php //$this->load->view('pdf-portofolio-3') ?>
            <?php //$this->load->view('pdf-portofolio-4') ?>
            <?php $this->load->view('pdf-testi') ?>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
            function exportHTML(){
               var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
                    "xmlns:w='urn:schemas-microsoft-com:office:word' "+
                    "xmlns='http://www.w3.org/TR/REC-html40'>"+
                    "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
               var footer = "</body></html>";
               var sourceHTML = header+document.getElementById("html-source").innerHTML+footer;
               
               var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
               var fileDownload = document.createElement("a");
               document.body.appendChild(fileDownload);
               fileDownload.href = source;
               fileDownload.download = 'document.doc';
               fileDownload.click();
               document.body.removeChild(fileDownload);
            }
            function copyRekening(textToCopy){
        	    navigator.clipboard.writeText(textToCopy).then(
                    function() {
                      /* clipboard successfully set */
                      window.alert('Nomor rekening berhasil di salin');
                    }, 
                    function() {
                      /* clipboard write failed */
                      window.alert('Nomor rekening gagal di salin')
                    }
                )
        	}
        </script>
    </body>
</html>

<?php ?>