<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Penawaran</title>
    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } */

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* PAGE CONFIG */
        @page {
            size: A4;
            margin: 40mm 15mm 25mm 15mm; 
        }

        /* HEADER */
        header {
            position: fixed;
            top: -35mm;         /* tarik ke atas setinggi header */
            left: 0;
            right: 0;
            height: 35mm;   
            background-image: url('<?= base_url('/assets/img/header.jpg?v='. date('ymdhis')) ?>');
            background-repeat: no-repeat;
            background-size: 100% 100%;       /* << INI YANG FIX */
            background-position: top left;
        }
        header img {
            height: 57mm;
            object-fit: cover;
            object-position: top;
        }
        /* FOOTER */
        footer {
            position: fixed;
            bottom: -15mm;
            left: 0;
            right: 0;
            height: 15mm;
            padding-top: 3mm;
            border-top: 1px solid #aaa;
            text-align: center;
            font-size: 12px;
        }

        /* CONTENT */
        .content {
            margin-top: 0;
            margin-bottom: 12mm;
            line-height: 1.6;
            background-image: url('<?= base_url("assets/img/bg.png?v=". date('ymdhis')) ?>');
            background-position: center;
            background-repeat: no-repeat;
        }

        .content * {
            page-break-inside: auto;
        }

        p, li {
            page-break-inside: avoid;
            padding-top: 2mm;
            padding-bottom: 1mm;
        }
        
        ul, ol {
            page-break-inside: avoid;
        }
        li {
            page-break-inside: avoid;
            padding-top: 1mm;   /* dari 2mm → lebih rapet */
            padding-bottom: 0mm;
            line-height: 1.2;   /* tambah rapet */
        }
        h1, h2, h3, h4, h5, h6, {
            margin-top: 1mm;
            margin-bottom: 1mm;
            padding-top: 1mm;        /* penting */
            line-height: 1.2;
            page-break-inside: avoid;
        }
        p{
            margin-top: 1mm;
            margin-bottom: 1mm;
            padding-top: 1.5mm;        /* penting */
            line-height: 1.5;
            page-break-inside: avoid;
        }
        
        .table-border {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .table-border th,
        .table-border td {
            border: 1px solid #ccc;    /* border tipis */
            padding: 6px 8px;
        }
        
        .table-border th {
            background: #f7f7f7;       /* ala Bootstrap */
            font-weight: bold;
        }
        
        /* biar header tabel muncul di setiap halaman PDF */
        .table-border thead {
            display: table-header-group;
        }
        
        /* anti table patah di tengah halaman */
        .table-border th,
        .table-border td {
            page-break-inside: avoid;
        }
        
        .center-x {
            text-align: center;
        }
        .grid {
            width: 100%;
            border-collapse: collapse;
        }
        
        .grid .col-6 {
            width: 50%;
            vertical-align: top;
            padding: 5px;
        }
        .col-6 img {
            display: block;
            max-width: 100%;
            height: auto;
        }
        
        .grid-3 {
            width: 100%;
            border-collapse: collapse;
        }
        
        .grid-3 .col-4 {
            width: 33.33%;
            vertical-align: top;
            padding: 5px;
        }
        .grid-3 .col-4 img {
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            display: block !important;
            object-fit: cover;
        }
        .grid-3 tr {
            page-break-inside: avoid !important;
        }
        .grid-3 td {
            page-break-inside: avoid !important;
        }
        .profile-pic {
            text-align: center;      /* PDF SAFE */
        }
        
        .profile-pic img {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
            display: inline-block;   /* centerable */
        }
        
        .text-center{
            text-align: center;
        }
        .text-justify {
            text-align: justify;
        }
        .break {
            page-break-before: always;
        }
    </style>

</head>

<body>
        <header></header>
    
        <footer>
            &nbsp;
        </footer>
    
        <div class="content">
            <div class="opening">
                <div class="body">
                    <table border='0'>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td><?= date_format(date_create($detail->daftar_pada), "d")?>/<?= date_format(date_create($detail->daftar_pada), "m")?>/411/LTI/<?= date_format(date_create($detail->daftar_pada), "Y")?></td>
                        </tr>
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
                        <span>Di</span><br>
                        <span>Tempat</span><br><br>
                        <span>Dengan Hormat, </span><br>
                        Sebelumnya kami mengucapkan terima kasih kepada Bapak/Ibu telah menyediakan waktu untuk membaca Surat Penawaran kami. 
                        Dengan perkembangan teknologi  serta arus informasi yang semakin mudah diakses, 
                         maka dibutuhkan sebuah pengembangan skill dibidang IT. 
                        Adapun  rincian materi <?= $detail->judul ?> serta biayanya sebagaimana terlampir.
                        Demikian undangan kami. Atas perhatian dari Bapak/Ibu kami ucapkan Terima Kasih.
                    </p>
                    <p style="text-align: right; margin-top: 50px">
                        <span>Hormat Kami,</span><br><br>
                        <img src="<?= $ttd ?>" alt="" style="width: 30%"><br>
                        <span class="border-bottom border-dark"><b>Hardiansah, M.Kom.</b></span><br>
                        <span style="margin-top: 20px">Direktur PT. Lauwba Techno Indonesia</span>
                    </p>
                </div>
            </div>
            
            <div class="break"></div>
            <div class="main">
                <h3 class="text-center">LAMPIRAN</h3>
                <ol>
                    <!--PROFILE SINGKAT-->
                    <li><b>PROFIL SINGKAT KAMI</b></li>
                        <p class="text-justify">
                            PT. Lauwba Techo Indonesia merupakan perusahaan yang bergerak pada bidang teknologi informasi khususnya software development dan IT Training dengan 
                            tenaga ahli S2 dan S1 dalam bidang programming, desain dan analisis yang berpengalaman paling sedikit 1 tahun dan telah menangani 
                            ratusan client kami yang tersebar diseluruh Indonesia serta ASIA baik untuk pembuatan Aplikasi dan sistem informasi  untuk 
                            pemerintahan, swasta, akademik maupun sekolah serta sudah ribuan alumni peserta training kami yang tersebar di seluruh Indonesia, Eropa dan Asia.
                        </p>
    
                    <!--TARGET PESERTA-->
                    <li><b>TARGET PESERTA & SILABUS</b></li>
                        <p class="text-justify">
                            <b>Target Peserta :</b><br>
                            Program ini dapat diikuti oleh siapapun yang berasal dari kalangan umum, karena dibimbing dari NOL dengan system pembelajaran 90% praktek dan 10% teori dengan GARANSI  sampai Bisa sebagaimana silabus yang telah kami susun.
                        </p>
                        
                    <!--SILABUS-->
                    <div class="break"></div>
                    <li><b>SILABUS</b></li>
                        <p class="text-justify">Pelaksanaan pada tanggal 
                            <?php if(!empty($detail->in_house_tanggal_mulai) && !empty($detail->in_house_tanggal_selesai)){?>
                                <?= $this->etc->tgl($detail->in_house_tanggal_mulai) ?> hingga <?= $this->etc->tgl($detail->in_house_tanggal_selesai) ?> dengan system pembelajaran full praktek serta dilengkapi dengan perangkat lengkap.</p>
                            <?php }?>
                             <?php if(!empty($detail->private_tanggal_mulai)){?>
                                <?= $this->etc->tgl($detail->private_tanggal_mulai) ?> dengan system pembelajaran full praktek serta dilengkapi dengan perangkat lengkap.
                            <?php }?>
                        </p>
                        <?php $data['silabus'] = $this->db->query("SELECT silabus FROM jenis WHERE id_jenis IN ('".$detail->id_jenis."')")->row()->silabus;?>
                        <div style="padding: 10px, 0, 10px, 0">
                            <?php echo $this->load->view('pdf-silabus', $data, TRUE) ?>
                        </div>
                    
                    <!--JADWAL AND TEMPAT-->
                    <div class="break"></div>
                    <li ><b>JADWAL DAN TEMPAT</b></li>
                        <h5>Jadwal:</h5>
                        <?php if(!empty($detail->in_house_tanggal_mulai) && !empty($detail->in_house_tanggal_selesai)){?>
                            <span>Pelaksanaan pada tanggal <?= $this->etc->tgl($detail->in_house_tanggal_mulai) ?> hingga <?= $this->etc->tgl($detail->in_house_tanggal_selesai) ?></span>
                        <?php }?>
                         <?php if(!empty($detail->private_tanggal_mulai)){?>
                            <span>Pelaksanaan pada tanggal <?= $this->etc->tgl($detail->private_tanggal_mulai) ?></span>
                        <?php }?>
                        <h5>Tempat:</h5>
                        <!-- GET ALAMAT -->
                        <p class="text-justify">
                            <?php 
                            $pilkel = $detail->pilihan_kelas;
                            if($pilkel == "private-offline"){
                                echo '<b>PRIVATE OFFLINE CLASSS : </b>';
                                $kota = $detail->private_kota_pelaksanaan;
                                $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                                if(!empty($alamat)){
                                    echo "Pelaksanaan di ". $alamat->alamat;
                                }else{
                                    echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                    Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                                }
                            }else if($pilkel == "reg"){
                                echo '<b>REGULER CLASS : </b>';
                                $kota = $detail->kota;
                                $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                                if(!empty($alamat)){
                                    echo "Pelaksanaan di ". str_replace('MAPS Klik dsini', '', strip_tags($alamat->alamat));
                                }else{
                                    echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                    Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                                }
                            }else if($pilkel == "in-house"){
                                 echo '<b>IN HOUSE CLASSS : </b>';
                                $kota = $detail->in_house_kota_pelaksanaan;
                                if(strtolower($kota) == "online" || strtolower($kota) == 'daring'){
                                    echo "Pelaksanaan dilakukan secara $kota sesuai dengan pilihan yang sudah ditentukan sebelumnya";
                                }
                                else{
                                    echo "Pelaksanaan di kota ". $kota;
                                }
                            }else{
                                echo '<b>PELAKSANAAN : </b>';
                                echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                                    Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                            }
                            ?>
                        .</p>
                    
                    <!--FASILITAS-->
                    <br>
                    <li><b>FASILITAS  & BIAYA</b></li>
                        <h5>Fasilitas</h5>
                        <div class="padding: 10px, 0, 10px, 0">
                            <ul>
                                <li>Sertifikat</li>
                                <li>GRATIS Mengulang Sampai Bisa Dikantor Kami (Yogyakarta)</li>
                                <li>Baju Kaos Training</li>
                                <li>Goodybag</li>
                                <li>Modul Dalam Bentuk Buku</li>
                                <li>Software untuk tools develop</li>
                                <li>Perangkat alat teknisi selama training</li>
                                <li>Grup konsultansi via WA setelah training selesai</li>
                            </ul>
                        </div>
                        <b>Biaya</b>
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
                            <table style="width: 100%;" class="table-border">
                               <tr>
                                    <td><?php echo $detail->judul?><br><small><?= $psrtaString?></small><br><small class="text-capitalize"><?= $additionalInfo?></small></td>
                                    <td style="text-align: right;"><span class="text-danger"><del>Rp. <?php echo $this->etc->rps($coret)?></del></span>&nbsp;&nbsp;Rp. <?= $this->etc->rps($hrg) . $multiplier?>
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
                            </div>
                                <b>Catatan :</b><br><i>Untuk In House Training dengan Pelaksanaan ditempat Bpk/Ibu, Cukup menambah biaya akomodasi <b>(transport dan penginapan)</b> untuk instruktur kami.</i><br><br>
                        </div>
                        
                        <!--Pembayaran dan rekening-->
                        <div class="break"></div>
                        <div class="pembayaran">
                        <b>Pembayaran Bisa Melalui Rekening dibawah ini</b><br/><br/>
                            <?php 
                            $getPathRekening = base_url('411/assets/images/rekening/');
                            $rekening = $this->db->select("*, concat('$getPathRekening', filename) as fullpath")->from('rekening')->where(['is_active' => '1'])->get()->result();
                            ?>
                            <div class="center-x">
                                <?php foreach($rekening as $rr){?>
                                    <img src="<?= $rr->fullpath?>" alt="<?= $rr->filename?>" style="width: 50%" onclick="copyRekening('<?= $rr->nomor_rekening?>')"
                                        class="img img-fluid w-75"/>
                                <?php }?>
                                <img src="https://www.lauwba.com/assets/img/footer-rekening.png" style="width: 50%" class="img img-fluid w-75 mb-2">
                            </div>
                        </ol>
                    </div>
                </ol>
            </div>
            
            <div class="break"></div>
            <div class="team">
                <!--<h3 class="text-center">Tim Kami</h3>-->
                <?php // $team = $this->crud->select_other('tutor', 'WHERE is_active IN ("Y") order by nomor_urut')->result();
                    //   $rows = array_chunk($team, 2);
                ?>
                
                <!--<table class="grid">-->
                    <?php // foreach($rows as $row): ?>
                    <!--<tr>-->
                        <!--<td class="col-6 center-x center-position">-->
                        <!--    <div class="profile-pic">-->
                        <!--        <img src="<?php //= $row[0]->gambar ?>"style="width: 85px;-->
                        <!--                   height: 85px; -->
                        <!--                   display: block;-->
                        <!--                   -moz-border-radius: 50px; -->
                        <!--                   -webkit-border-radius: 50px; -->
                        <!--                   border-radius: 50px;"/>-->
                        <!--    </div>-->
                        <!--    <div class="center-x">-->
                        <!--        <b class="d-block text-dark"><small><?php // echo $row[0]->nama ?></small></b><br>-->
                        <!--        <small class="mb-0 text-dark"><?php // echo strip_tags($row[0]->tentang) ?></small>-->
                        <!--    </div>-->
                        <!--</td>-->
                
                        <!--<td class="col-6 center-x">-->
                            <?php // if($row[1]){?>
                                <!--<div class="profile-pic">-->
                                <!--<img src="<?php //= $row[1]->gambar ?>"style="width: 85px;-->
                                <!--           height: 85px; -->
                                <!--           display: block;-->
                                <!--           -moz-border-radius: 50px; -->
                                <!--           -webkit-border-radius: 50px; -->
                                <!--           border-radius: 50px;"/>-->
                                <!--</div>-->
                                <!--<div class="center-x">-->
                                <!--    <b class="d-block text-dark"><small><?php // echo $row[1]->nama ?></small></b><br>-->
                                <!--    <small class="mb-0 text-dark"><?php // echo strip_tags($row[1]->tentang) ?></small>-->
                                <!--</div>-->
                            <?php //}?>
                        <!--</td>-->
                    <!--</tr>-->
                    <?php// endforeach; ?>
                <!--</table>-->
            </div>
            
            <div class="break"></div>
            <div class="poster">
                <br>
                <div class='center-x'>
                    <img src="<?= base_url('/assets/img/poster-min.png') ?>" alt="" style="width:78%" class="img-fluid"/>
                </div>
            </div>
            
            <div class="break"></div>
            <div class="portofolio-1">
                <h3 class="text-center">Portfolio IT Training</h3>
                <?php 
                $ddataPorto = $this->db->query("SELECT * FROM gallery join album on album.id_album=gallery.id_album where gallery.id_album in ('20', '21', '22') order by seq asc LIMIT 12")->result();
                $rows = array_chunk($ddataPorto, 3);
                ?>
                <table class="grid-3">
                    <?php foreach($rows as $row){?>
                    <tr>
                        <td class="col-4">
                            <?php if(!isset($row[0])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail" src="https://lauwba.com/img_galeri/<?php echo $row[0]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[0]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="col-4">
                            <?php if(!isset($row[1])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail img-fluid" src="https://lauwba.com/img_galeri/<?php echo $row[1]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[1]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="col-4">
                            <?php if(!isset($row[2])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail img-fluid" src="https://lauwba.com/img_galeri/<?php echo $row[2]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[2]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            </div>
            
            <div class="break"></div>
            <div class="portofolio-2">
                <h3 class="text-center">Portfolio Mobile Apps</h3>
                <?php 
                $ddataPorto = $this->db->query("SELECT * FROM gallery join album on album.id_album=gallery.id_album where gallery.id_album='17' order by seq asc LIMIT 12")->result();
                $rows = array_chunk($ddataPorto, 3);
                ?>
                <table class="grid-3">
                    <?php foreach($rows as $row){?>
                    <tr>
                        <td class="col-4">
                            <?php if(!isset($row[0])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail" src="https://lauwba.com/img_galeri/<?php echo $row[0]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[0]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="col-4">
                            <?php if(!isset($row[1])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail img-fluid" src="https://lauwba.com/img_galeri/<?php echo $row[1]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[1]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="col-4">
                            <?php if(!isset($row[2])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail img-fluid" src="https://lauwba.com/img_galeri/<?php echo $row[2]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[2]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            </div>
            
            <div class="break"></div>
            <div class="portofolio-3">
                <h3 class="text-center">Portfolio Web & Desktop Apps</h3>
                <?php 
                $ddataPorto = $this->db->query("SELECT * FROM gallery join album on album.id_album=gallery.id_album where gallery.id_album in ('26', '18') order by seq asc LIMIT 12")->result();
                $rows = array_chunk($ddataPorto, 3);
                ?>
                <table class="grid-3">
                    <?php foreach($rows as $row){?>
                    <tr>
                        <td class="col-4">
                            <?php if(!isset($row[0])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail" src="https://lauwba.com/img_galeri/<?php echo $row[0]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[0]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div><br>
                        </td>
                        <td class="col-4">
                            <?php if(!isset($row[1])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail img-fluid" src="https://lauwba.com/img_galeri/<?php echo $row[1]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[1]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div><br?
                        </td>
                        <td class="col-4">
                            <?php if(!isset($row[2])) return; ?>
                            <div class="highslide-gallery">
                                <a>
                                    <img class="lazyload img-thumbnail img-fluid" src="https://lauwba.com/img_galeri/<?php echo $row[2]->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                                </a>
                                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                                     <?php echo $row[2]->jdl_gallery ?>
                                    </p>
                                </div>
                            </div><br>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            </div>
    </div>
</body>

</html>