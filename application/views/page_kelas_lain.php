<?php $this->load->view('headfoot/header') ?>
<!--ENDO OF HEAD-->
<?php if(sizeof($detail) > 0){?>

    <div class="container mt-4">
        <div class="text-light pt-2">
            <div class="row">
                <div class="col-md-12 " style="margin-top: 160px">
                    <div class="newTitle1 d-none d-md-block">
                        <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Detail Training</span></h2>
                    </div>
                </div>
        <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>&nbsp &nbsp Detail Training</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
            </div>
        </div>
    </div>
<div class="container">
    <!--DETAIL START HERE-->
    <div class="row">
        <div class="col-md-12">
            <article class="row single-post no-gutters">
                <div class="col-md-12">
                    <h1 class="h4 text-justify"><?php echo $detail->judul ?></h1>
                    <div class="image-wrapper float-left pr-3">
                        <img class="img-fluid" src="./foto_berita/<?php echo $detail->gambar ?>" height="150" width="150">
                    </div>
                    <div class="single-post-content-wrapper p-3 text-justify">
                        <?php echo $detail->isi_jenis ?>
                    </div>
                </div>
            </article>
        </div>
       <div class="col-md-4 d-none">
            <?php
            $kelas1 = $this->db->query("SELECT * FROM kelas join jenis on kelas.id_jenis=jenis.id_jenis WHERE jenis.routes='$segment'")->row();
            ?>
            <aside class="col-md-12">
                <div class=" box_style_1">
                   
                     
                       <div class="widget">
                           <div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">
                                <div class="col-md-3  col-sm-12 text-center">
                                    <img src="img/icon-paymentpng.png" width="50">
                                </div>
                                <div class="col-md-9  col-sm-12 text-center text-md-left">
                                    <h4 class="mt-2">
                                        CATATAN</h4>
                                </div>
                            </div>

                        <ol style="-webkit-padding-start: 25px;">
                            <li style="list-style-type: decimal;">
                                Biaya kursus dapat berubah sewaktu-waktu, gunakan kesempatan emas biaya promo.
                            </li>
                            <li style="list-style-type: decimal;">
                                Bagi yang sudah mengikuti Training/Kursus Online, GRATIS mengikuti kelas offline/reguler yang kami adakan di 16 kota(Pelaksanaan kembali diadakan setelah kondisi sudah memungkinkan dari COVID19).
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                DP 50% harus dibayarkan maksimal 48 jam setelah melakukan registrasi.
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Pembayaran bisa melalui transfer ke rekening BNI 41121 22220 a.n. <b>PT. Lauwba Techno Indonesia </b>atau ke rekening BNI Syariah 0419 1276 93 a.n. Hardiansah
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Harap melakukan konfirmasi  transfer via WA/SMS ke nomor <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konfirmasi%20Pembayaran,%20Berikut%20di%20Terlampir%20Bukti%20Pembayarannya" class="text-dark ">
                                    <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206 (KLIK Chat WA)</a> 
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Sisa biaya kursus dapat dibayarkan pada saat kursus berlangsung
                            </li>
                           
                        </ol>
                    <div class="widget">
                        <div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">
                                <div class="col-md-3  col-sm-12 text-center">
                                    <img src="img/icon-catatan1.png" width="50">
                                </div>
                                <div class="col-md-9  col-sm-12 text-center text-md-left">
                                    <h4 class="mt-2">
                                        Fasilitas</h4>
                                </div>
                            </div>

                        <ol style="-webkit-padding-start: 25px;">
                            <li style="list-style-type: decimal;">
                                Sertifikat RESMI (Member Google Parnert)
                            </li>
                              <li style="list-style-type: decimal;"> 			 
                                <b>GRATIS Mengulang sampai BISA! </b>
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Ruangan Full AC &amp; Full Akses Internet
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Aplikasi dan Modul dalam bentuk BUKU 
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Lunch (Makan siang) Khusus untuk peserta Full Day (Kls Offline Reguler & Private)
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Dapat berkonsultasi setelah kursus selesai melalui Grup Whatsapp
                            </li>
                            <li style="list-style-type: decimal;"> 			 
                                Peserta terbatas 1 org/kelas (KELAS ONLINE PRIVATE)
                            </li>
                            <li style="list-style-type: decimal;">
                                Voucher Discon training senilai Rp. 250.000 Berlaku Untuk Pengambilan Kelas Lainnya
                            </li>
                             <li style="list-style-type: decimal;">
                                Bagi yang sudah mengikuti <b>Training/Kursus Online</b>, GRATIS mengikuti kelas offline/reguler yang kami adakan di 16 kota(Pelaksanaan kembali diadakan setelah kondisi sudah memungkinkan dari covid19).
                            </li>
                          
                        </ol>
                        <div class="widget">
                            <div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">
                                <div class="col-md-3 col-sm-12 text-center">
                                    <img src="img/admin-icon.png" width="50" class="mt-2">
                                </div>
                                <div class="col-md-9  col-sm-12 text-center text-md-left">
                                    <h4 >
                                        Private Class <br><small style="font-size: 17px">Training/Kursus Online & Offline dan Inhouse Training  </small></h4>
                                </div>
                            </div>
                            
                                 
                            <p>Training yang waktu pelaksanaan, durasi, harga, silabus, tempat dan jumlah pesertanya dapat disesuaikan dengan permintaan Anda. </p>
                            <p>Jika memiliki penawaran Khusus, Bisa Langsung menghubungi kami... </p>
                            <p > <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Pak/Bu,%20Kami%20Mau%20Request%20training/kursus%20Private (Offline/Online)%20Atau%20Inhouse%20training%20Lauwba..." class="text-dark ">
                                    <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206</a> 
                                (Klik Disini)
                            </p>
                        </div><!-- End widget -->
                        <div class="widget">
                            <div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">
                                <div class="col-md-3 col-sm-12 text-center">
                                    <img src="img/admin-icon.png" width="50">
                                </div>
                                <div class="col-md-9  col-sm-12 text-center text-md-left">
                                    <h4 class="mt-2">Konsultasi Langsung</h4>
                                </div>
                            </div>
                            <p>Jika ada yang mau ditanyakan, silakan Hubungi kami  </p>
                            KONSULTASI 1X24 JAM WA/telp <br><i>Fast Respon</i>  <p > <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konsultasi%20tentang%20training/kursus%20di%20Lauwba..." class="text-dark ">
                                    <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206</a> 
                                (Klik Disini)
                            </p>
                        </div><!-- End widget -->
                    </div><!-- End widget -->
                     </div><!-- End widget -->
                </div><!-- End box-sidebar -->
            </aside>
        </div>
    </div>
    
    
        <div class="col-md-12">
            <h4>Tag : </h4>
            <?php
            $limit = sizeof($tag);
            $rows = 1;
            foreach ($tag as $t) {
                if ($rows == $limit) {
                    ?>
                    <a href="<?php echo site_url('tagged/' . $t->tag_seo) ?>" class="btn badge badge-info text-white"><?php echo $t->tag; ?></a>
                <?php } else { ?>
                    <a href="<?php echo site_url('tagged/' . $t->tag_seo) ?>" class="btn badge badge-info text-white"><?php echo $t->tag; ?></a>&nbsp;
                    <?php
                }
                $rows++;
            }
            ?>
            
            
             <!--Ini Untuk Mobile-->
     <div class="row">
    <div class="container" style="margin-top: 180px;">
    <div class="newTitle1 d-none d-md-block">
        <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Pilihan Metode Pembelajaran</span></h2>
    </div>
    <!--Ini Untuk Mobile-->
     <div class="row">
    <div class="col-md-12 d-md-none d-block">
        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
        <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
            <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbsp;&nbsp;&nbsp;&nbsp;Pilihan Metode Pembelajarans</span></h2>
        </div>
    </div>
    <p>Satu-satunya tempat training/kursus yang memiliki <b>Metode Pembelajaran <i>Terlengkap</b></i>  yang bisa disesuaikan dengan kebutuhan Anda</p>

    <!--Akhir dari Untuk Mobile-->
    <!--<iframe src="<?= site_url('infront/perbedaan-kelas-statis')?>" id="kelas-compare" marginheight="0" frameborder="0" class="w-100" onload="autoResize()"></iframe>-->
    <?php $this->load->view('page_class_comp_statis');?>
</div>

</div>
    
        </div>
    </div>
    

    <!--TESTIMONI-->
        <!--File ada di folder application/view/module_testimoni-->
        <?php $this->load->view('module_testimoni');?>
        <!--END OF TESTIMONI-->
        <!--footer-->
</div>
<?php }else{
    echo '<div class="container">
        <div class="row">
            <div class="col-md-12">';
    $this->load->view('404-');
     echo '</div>
        </div">
            </div>';
}?>


<!--footer-->

<!--JADWAL-->
<!--File ada di folder application/view/module_jadwal-->
<?php 
// $this->load->view('module_jadwal');
?>
<!--END OF JADWAL-->

<div class="container">
    <div class="row px-5 mb-3">
        <div class="col-md-12 blues">
            <div class="row blues p-2">
                <div class="col-md-8 justift-content-center  text-center ">
                    <p class="text-uppercase text-white font-weight-bold pt-2">KUOTA TERBATAS, SILAHKAN DAFTAR SEKARANG</p>
                </div>
                <div class="col-md-4 text-center">
                    <input onclick="window.open('https://api.whatsapp.com/send?phone=6282221777206&amp;text=_*DAFTAR%20TRAINING/KURSUS%20Lauwba.com%20:*_%20%0D%0A%20===========%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%0D%0A_*Nama%20:*_%20...%0D%0A%20_*Asal%20Instansi/kampus%20:*_%20...%0D%0A%20_*Kelas%20Yang%20di%20pilih%20%20:*_%20...%0D%0A%20%20%0D%0A%20Catt%20:%20_Bagi%20yg%20bukan%20utusan%20instansi%20atau%20blm%20kuliah%20cukup%20mengisi%20:%20*Pribadi*_')" type="button" value="DAFTAR VIA WA" name="daftar-via-wa" class="btn btn-light text-primary font-weight-bold"/>
                </div>
            </div>
        </div>
    </div>
</div>
<!--IT TRAINING AND COURSES-->
<!--File ada di folder application/view/module_it_training_courses-->
<?php 
// $this->load->view('module_it_training_courses');
?>
<!--END OF IT TRAINING AND COURSES-->

<!--PILIHAN KELAS LAINNYA-->
<!--File ada di folder application/view/module_kelas_lainnya-->
<?php 
// $this->load->view('module_kelas_lainnya');
?>
<!--END OF PILIHAN KELAS LAINNYA-->

<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php
// $this->load->view('module_testimoni');
?>
<!--END OF TESTIMONI-->

<!--PORTOFLIO IT TRAINING-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_portofolio_it_training');?>
<!--END OF PORTOFLIO IT TRAINING-->
<!--PORTOFLIO PROJECT-->

<!--File ada di folder application/view/module_portofolio_project-->
<?php $this->load->view('module_portofolio_project');?>
<!--END OF PORTOFLIO PROJECT-->

<!--NEWS AND BLOG-->
<!--File ada di folder application/view/module_news_blog-->
<?php $this->load->view('module_news_blog');?>
<!--END OF NEWS AND BLOG-->

<!--LOKASI-->
<!--File ada di folder application/view/module_lokasi-->
<?php $this->load->view('module_lokasi');?>
<!--END OF LOKASI-->


<!--CLIENT-->
<!--File ada di folder application/view/module_client-->
<?php $this->load->view('module_client');?>
<!--END OF CLIENT-->
<?php
$this->load->view('headfoot/footer')?>