<?php $this->load->view('headfoot/header') ?>

<!--ENDO OF HEAD-->
<?php if (sizeof($detail) > 0) { ?>
    <div class="container mt-4">
        <div class="text-light pt-2">
            <div class="row">
                <div class="col-md-12 " style="margin-top: 140px;">
                    <div class="newTitle1 d-none d-md-block">
                        <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Detail Training</span></h2>
                    </div>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>&nbsp &nbsp Detail Training</span></h2>
                    </div>
                </div>
                <!--Akhir dari Untuk Mobile-->
            </div>
        </div>
    </div>
    <p>
    <div class="container">
        <!--DETAIL START HERE-->
        <div class="row">
            <div class="col-md-12">
                <article class="row single-post no-gutters">
                    <div class="col-md-12">
                        <h2 class="h4 text-justify"><?php echo $detail->judul ?></h2>
                        <div class="image-wrapper float-left pr-3">
                            <img class="img-fluid lazyload" src="./foto_berita/<?php echo $detail->gambar ?>" height="300" width="300">
                        </div>
                        <div class="single-post-content-wrapper p-3 text-justify">
                            <?php echo $detail->isi_jenis ?>
                        </div>
                        <script>
                            //get silabus
                            $.get("<?php echo site_url('411/index.php/Webservices/getsilabusbyid/' . $detail->id_jenis) ?>", null, function(data) {
                                $(".silabus").html(data);
                            });
                            //   ("<?php echo site_url('411/index.php/jenis/getsilabusbyid/' . $detail->id_jenis) ?>");
                        </script>
                    </div>
                </article>
            </div>
            <div class="col-md-4 d-none">
                <?php
                $kelas1 = $this->db->query("SELECT * FROM kelas join jenis on kelas.id_jenis=jenis.id_jenis WHERE jenis.routes='$segment'")->row();
                ?>
                <aside class="col-md-12">

                    <!--UNTUK WIDGET-->
                    <div class="col-md-12">
                        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                        <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <div class="row h5 pl-5 ">
                                <div class="col-md-3 col-3">
                                    <img src="img/icon-paymentpng.png" width="50" class="bg-title mt-2">
                                </div>
                                <div class="col-md-9 col-9">
                                    <h5 class="mt-3">
                                        Kontribusi
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--AKHIR UNTUK WIDGET-->
                    
                    <h5>
                        <img src="img/rocket1.png" width="50">Kelas Reguler <br>
                        <small>Mengikuti Jadwal yang Tersedia dan dilaksanakan secara Offline/online (Lihat Jadwal <a href="https://www.lauwba.com/infront/jadwal/"><b>Klik Disini).</b></a></small>
                    </h5>
                    </i>
                    <table cellpadding="4" class="table">
                        <tbody>
                            <tr>
                                <td class="jarak">Biaya&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr style="background-color: #1800BB; " />

                    <h5>
                        <img src="img/rocket1.png" width="50">Kelas Private<br>
                        <small>Bisa Request Jadwal & Materi Sesuai Kebutuhannya
                    </h5>
                    <table cellpadding="4" class="table">
                        <tbody>
                            <tr>
                                <td class="jarak">Private Online</td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_private_online_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya_private_online); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="jarak" width="50px">Private Offline&nbsp;&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_private_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya_private); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul style="-webkit-padding-start: 35px; font-size:16px">
                        <!--<small>-->
                        <li><b>PRIVATE kelas Online :</b> Training From Home | Belajar Jarak Jauh Dengan Dibimbing Langsung Oleh Trainer Kami Live Session via Video Call (ZOOM/Google Meet) serta Remote Control Dengan Jumlah Peserta Terbatas 1 Peserta/Kls. Durasi Kursus -+ 1 Bulan & Bisa Request Jadwal Sesuai Kebutuhannya (Hampir sama dgn kelas offline/tatap muka langsung)</li>
                        <br>
                        <li><b>PRIVATE Kelas Offline : </b>sistem face to face terbatas 1 peserta/kelas untuk pelaksanaan di kantor kami di Yogyakarta & Tangerang</li>
                        <br>
                        <li>Durasi Kursus : -+ 1 Bulan (sampai materi selesai & peserta sudah paham/bisa)</li>
                        <br>
                        <li>Bagi yang <b><i> ingin request materi khusus</i></b>, biayanya menyesuaikan tingkat kesulitan materi yang ingin di request, info lebih lengkapnya klik chat via WA</li>
                        <br>
                        <li>Setelah mengikuti kelas PRIVATE Online maupun Offline, GRATIS mengulang di kls Reguler yang diadakan di seluruh Indonesia, Info Lebih Lengkapnya klik <a class="badge badge-warning" href="<?php echo site_url('private-class-web-android-25.html') ?>">Selengkapnya</a>
                            <!--</small>-->
                    </ul>
                    <hr style="background-color: #1800BB; " />
                    <h5>
                        <img src="img/rocket1.png" width="50">Kelas Reguler <br>
                        <small>Mengikuti Jadwal yang Tersedia (Lihat Jadwal & Tempat Pelaksanaan <a href="https://www.lauwba.com/infront/jadwal/"><b>Klik Disini).</b></a></small>
                    </h5>
                    </i>
                    <table cellpadding="4" class="table">
                        <tbody>
                            <tr>
                                <td class="jarak"><span class="font-weight-bold"><i>Yogyakarta</i></span></td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="jarak"><span class="font-weight-bold"><i>Pelaksanaan <br>Luar Yogyakarta</i></span></td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya_luar_kota); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr style="background-color: #1800BB; " />
                    <h5>
                        <img src="img/rocket1.png" width="50">Kelas Incubator
                        <br><small>Kelas khusus persiapan memasuki Dunia Kerja dgn durasi pelaksanaan Selama 2 sampai 6 bulan (Khusus untuk Pelaksanaan di Kantor kami di Yogyakarta) </small>
                    </h5>
                    <table cellpadding="4" class="table">
                        <tbody>
                            <tr>
                                <td class="jarak">Biaya (/Bulan)&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_incubator_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya_incubator); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <b>Catt :</b> <i>Untuk Rincian biaya & fasilitasnya klik <a class="badge badge-warning" href="<?php echo site_url('incubator-class-android-26.html') ?>">Selengkapnya</a></i>
                    <hr style="background-color: #1800BB; " />
                    <h5><img src="img/rocket1.png" width="50">Kelas In House Training XXX
                        <br><small>Pelatihan SDM/karyawan yang pelaksanaannya berdasarkan permintaan oleh instansi. Pelaksanaan bisa request <b>Online atau Offline</b> </small>
                    </h5>
                    <table cellpadding="4" class="table">
                        <tbody>
                            <tr>
                                <td class="jarak">Biaya&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <del class="text-danger font-weight-bold">Rp. <?php echo $this->etc->rps($detail->biaya_inhouse_coret); ?></del><br>
                                    Rp. <?php echo $this->etc->rps($detail->biaya_inhouse); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul style="-webkit-padding-start: 35px; font-size:16px">
                        <li>Biaya Training menyesuikan banyaknya jumlah peserta <a class="badge badge-warning" href="<?php echo site_url('in-house-training-27.html') ?>">(Klik Disini)</a></li>
                        <li>Jadwal dan Tempat pelaksanaan berdasarkan permintaan instansi</li>
                        <li> <i>Bagi yang ingin request materi/silabus, lebih lengkapnya hub kami via WA</i></li>
                        <li>Request Surat Penawaran Dari Kami via WA/SMS ke nomor <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Permisi%20Bu,%20Apakah%20Bisa%20Dibuatkan%20Surat Penawaran%20di%20Untuk%20Training...%20Dari%20Instansi..." class="text-dark ">
                                <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206 (KLIK Chat WA)</a>
                        </li>
                    </ul>
                    <hr style="background-color: #1800BB; " />
                    <div class="widget">
                        <!--<div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">-->
                        <!--   <div class="col-md-3  col-sm-12 text-center">-->
                        <!--      <img src="img/icon-catatan1.png" width="50">-->
                        <!--   </div>-->
                        <!--   <div class="col-md-9  col-sm-12 text-center text-md-left">-->
                        <!--      <h5 class="mt-2">-->
                        <!--         Catatan-->
                        <!--      </h5>-->
                        <!--   </div>-->
                        <!--</div>-->


                        <div class="col-md-12">
                            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <div class="row h5 pl-5 ">
                                    <div class="col-md-3 col-3">
                                        <img src="img/icon-catatan1.png" width="50" class="bg-title mt-2">
                                    </div>
                                    <div class="col-md-9 col-9">
                                        <h5 class="mt-3">
                                            Fasilitas
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--AKHIR UNTUK WIDGET-->
                        <br>
                        <ol style="-webkit-padding-start: 35px; font-size:16px">

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
                                Aplikasi dan Modul dalam bentuk BUKU (android, web & flutter)
                            </li>
                            <li style="list-style-type: decimal;">
                                Lunch (Makan siang) Khusus untuk peserta Full Day (Kls Offline Reguler & Private)
                            </li>
                            <li style="list-style-type: decimal;">
                                Dapat berkonsultasi setelah kursus selesai melalui Grup Whatsapp
                            </li>
                            <li style="list-style-type: decimal;">
                                Peserta terbatas 1 org/kelas (KELAS ONLINE & PRIVATE CLASS)
                            </li>
                            <li style="list-style-type: decimal;">
                                Peserta terbatas 5 org/kelas untuk KELAS REGULER
                            </li>
                            <li style="list-style-type: decimal;">
                                Voucher Diskon training senilai Rp. 250.000 Berlaku Untuk Pengambilan Kelas Lainnya
                            </li>
                            <li style="list-style-type: decimal;">
                                Bagi yang sudah mengikuti <b>Training/Kursus Online</b>, GRATIS mengikuti kelas offline/reguler yang kami adakan di 16 kota.
                            </li>
                        </ol>
                        <!--<div class="widget">-->
                        <!--   <div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">-->
                        <!--      <div class="col-md-3 col-sm-12 text-center">-->
                        <!--         <img src="img/admin-icon.png" width="50" class="mt-2">-->
                        <!--      </div>-->
                        <!--      <div class="col-md-9  col-sm-12 text-center text-md-left">-->
                        <!--         <h4 >-->
                        <!--            Private Class <br><small style="font-size: 17px">Training/Kursus Online & Offline dan Inhouse Training  </small>-->
                        <!--         </h4>-->
                        <!--      </div>-->
                        <!--   </div>-->
                        <!--UNTUK WIDGET-->
                        <!--UNTUK WIDGET-->
                        <div class="col-md-12">
                            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <div class="row h5 pl-5 ">
                                    <div class="col-md-3 col-3">
                                        <img src="img/icon-catatan1.png" width="50" class="bg-title mt-2">
                                    </div>
                                    <div class="col-md-9 col-9">
                                        <h5 class="mt-3">
                                            Catatan
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--AKHIR UNTUK WIDGET-->
                        <br>
                        <ol style="-webkit-padding-start: 25px; font-size:16px">
                            <li style="list-style-type: decimal;">
                                <p>Satu-satunya tempat training/kursus yang memiliki <b>Metode Pembelajaran <i>Terlengkap</b></i>  yang bisa disesuaikan dengan kebutuhan Anda</p>
                                Biaya kursus dapat berubah sewaktu-waktu, gunakan kesempatan emas biaya promo.
                            </li>
                            <li style="list-style-type: decimal;">
                                Bagi yang sudah mengikuti Training/Kursus Online, GRATIS mengikuti kelas offline/reguler yang kami adakan di 16 kota(Pelaksanaan kembali diadakan setelah kondisi sudah memungkinkan dari COVID19).
                            </li>
                            <li style="list-style-type: decimal;">
                                DP 50% harus dibayarkan maksimal 48 jam setelah melakukan registrasi.
                            </li>
                            <li style="list-style-type: decimal;">
                                Pembayaran bisa melalui transfer ke rekening <b>BNI 411 212 2220 a.n. PT. Lauwba Techno Indonesia </b>atau ke rekening <b>BSI(Bank Syariah Indonesia) 419 1276 930 a.n. Hardiansah</b>
                            </li>
                            <li style="list-style-type: decimal;">
                                Harap melakukan konfirmasi transfer via WA/SMS ke nomor <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konfirmasi%20Pembayaran,%20Berikut%20di%20Terlampir%20Bukti%20Pembayarannya" class="text-dark ">
                                    <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206 (KLIK Chat WA)</a>
                            </li>
                            <li style="list-style-type: decimal;">
                                Sisa biaya kursus dapat dibayarkan pada saat kursus berlangsung
                            </li>
                            <li style="list-style-type: decimal;">
                                <b><i>Disclaimer:</b>tidak dapat dilakukan pembatalan training dan jasa lainnya, hanya bisa reschedule jadwal. Uang yang sudah dibayarkan tidak dapat dikembalikan. Terimakasih</i>
                            </li>
                        </ol>
                        <!--UNTUK WIDGET-->

                        <div class="col-md-12">
                            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <div class="row h5 pl-5 ">
                                    <div class="col-md-3 col-3">
                                        <img src="img/admin-icon.png" width="50" class="bg-title mt-2">
                                    </div>
                                    <div class="col-md-9 col-9">
                                        <h5 class="mt-3">
                                            Request Class
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--AKHIR UNTUK WIDGET-->
                        <p>Training yang waktu pelaksanaan, durasi, harga, silabus, tempat dan jumlah pesertanya dapat disesuaikan dengan permintaan Anda. </p>
                        <p><b><i>Jika memiliki penawaran/permintaan Khusus</b></i>, Bisa Langsung menghubungi kami via WA... </p>
                        <p> <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Pak/Bu,%20Kami%20Mau%20Request%20training/kursus%20Private (Offline/Online)%20Atau%20Inhouse%20training%20Lauwba..." class="text-dark ">
                                <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206</a>
                            (Klik Disini)
                        </p>
                    </div>
                    <!-- End widget -->
                    <!--<div class="widget">-->
                    <!--   <div class="row" style="background-color: rgb(24, 0, 187); color: #FFF; padding: 10px 0px 10px 8px;">-->
                    <!--      <div class="col-md-3 col-sm-12 text-center">-->
                    <!--         <img src="img/admin-icon.png" width="50">-->
                    <!--      </div>-->
                    <!--      <div class="col-md-9  col-sm-12 text-center text-md-left">-->
                    <!--         <h4 class="mt-2">Konsultasi Langsung</h4>-->
                    <!--      </div>-->
                    <!--   </div>-->
                    <!--UNTUK WIDGET-->
                    <div class="col-md-12">
                        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                        <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <div class="row h5 pl-5 ">
                                <div class="col-md-3 col-3">
                                    <img src="img/admin-icon.png" width="50" class="bg-title mt-2">
                                </div>
                                <div class="col-md-9 col-9">
                                    <h5 class="mt-3">
                                        CARA DAFTAR
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--AKHIR UNTUK WIDGET-->
                    <p><b>Berikut ini tutorial cara daftar training di Lauwba.com <a href="https://youtu.be/SUPm-NARLm4"> KLIK DISINI</a></b> </p>
                </aside>
            </div>
            <!-- End widget -->
            <div class="col-md-12">
            <h4>Tag : </h4>
            <?php
            $limit = sizeof($tag_kelas);
            $rows = 1;
            foreach ($tag_kelas as $t) {
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
        </div>
        </div>
        <!-- End widget -->
    </div>
    <!-- End widget -->
    <!--</div>-->
    <!--</div>-->
    <!-- End box-sidebar -->
    <!--</div>-->
     

    
    <!--FASILITAS DAN CATT-->
    <?php $this->load->view('module_fasilitas_catt')?>
    <!--END OF FASILITASI DAN CATT-->
    

    <!--PERBANDINGNGAN KELAS-->
    <!--File ada di folder application/view/module_perbadingan_kelas-->
    <br>
    <?php $this->load->view('page_class_comparison', ['id' => $detail->id_jenis]); 
    ?>
    <!--END OF PERBANDINGAN KELAS-->


    <!--trainer-->
    <div class="container-fluid">

        <div class="col-md-12 " style="margin-top: 160px">
            <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>INSTRUCTOR</span></h2>
            </div>
        </div>
        <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>&nbsp &nbsp INSTRUCTOR</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->



        <div class="row">
            <?php $trainer1 = $this->db->query("SELECT * FROM kelas join jenis on kelas.id_jenis=jenis.id_jenis join tutor on kelas.id_tutor=tutor.id_tutor WHERE jenis.routes='$segment'")->row(); ?>
            <?php $trainer2 = $this->db->query("SELECT * FROM kelas join jenis on kelas.id_jenis=jenis.id_jenis join tutor on kelas.id_tutor1=tutor.id_tutor WHERE jenis.routes='$segment'")->row(); ?>
            <div class="col-md-6 text-center mt-3">
                <div class="avatar d-flex justify-content-center">
                    <div class=" rounded-circle" style="width: 120px; height: 120px; background: url('<?php echo $trainer1->gambar ?>'); background-position: center; background-size: cover"></div>
                </div>
                <div class="comment_right clearfix">
                    <div class="comment_info">
                        <p  href="javascript:void(0)">
                            <span class="font-weight-bold"><?php echo $trainer1->nama ?></span><br>
                            <?php echo $trainer1->descriptions ?>
                        </p>
                    </div>
                    <a href="https://lauwba.com/karyawan/index.php/cv-karyawan?nama=<?= $trainer1->nama?>" class="btn btn-sm btn-success" target="_blank">Lihat CV</a>
                </div>
            </div>
            <div class="col-md-12 d-block d-md-none">
                <hr>
            </div>
            <div class="col-md-6 text-center mt-3">
                <div class="avatar d-flex justify-content-center">
                    <div class="rounded-circle" style="width: 120px; height: 120px; background: url('<?php echo $trainer2->gambar ?>'); background-position: center; background-size: cover"></div>
                </div>
                <div class="comment_right clearfix">
                    <div class="comment_info">
                       <p  href="javascript:void(0)">
                            <span class="font-weight-bold"><?php echo $trainer2->nama ?></span><br>
                            <?php echo $trainer2->descriptions ?>
                        </p>
                    </div>
                    <a href="https://lauwba.com/karyawan/index.php/cv-karyawan?nama=<?= $trainer2->nama?>" class="btn btn-sm btn-success" target="_blank">Lihat CV</a>
                </div>
            </div>
            <!-- End Comments -->
        </div>
       
    </div>
    <hr>
    </div>

    <!--PROMO-->
    <!--File ada di folder application/view/module_promo-->
    <?php $this->load->view('module_promo'); ?>
    <!--END OF PROMO-->

    <!--VIDEO-->
    <!--File ada di folder application/view/module_portofolio_it_training-->
    <?php $this->load->view('module_video'); ?>
    <!--END OF VIDEO-->

    

    <!--TESTIMONI-->
    <!--File ada di folder application/view/module_testimoni-->
    <?php $this->load->view('module_testimoni'); ?>
    <!--END OF TESTIMONI-->
    
<?php
} else {
    echo '<div class="container">
           <div class="row">
               <div class="col-md-12">';
    $this->load->view('404-');
    echo '</div>
           </div">
               </div>';
}
?>
<!--JADWAL-->
<!--File ada di folder application/view/module_jadwal-->
<?php $this->load->view('module_jadwal'); ?>
<!--END OF JADWAL-->
<!--LOKASI PELAKSANAAN-->
<!--File ada di folder application/view/module_alamat-->
<?php 
// $this->load->view('module_alamat'); 
?>
<!--END OF LOKASI PELAKSANAAN-->
<!--<div class="mb-3 px-5">-->
<!--    <div class="col-md-12 blues">-->
<!--        <div class="blues p-2">-->
<!--            <div class="col-md-8 justift-content-center  text-center ">-->
<!--                <p class="text-uppercase text-white font-weight-bold pt-2">KUOTA TERBATAS, SILAHKAN DAFTAR SEKARANG</p>-->
<!--            </div>-->
<!--            <div class="col-md-4 text-center">-->
                <!--<input onclick="window.open('https://api.whatsapp.com/send?phone=6282221777206&amp;text=_*DAFTAR%20TRAINING/KURSUS%20Lauwba.com%20:*_%20%0D%0A%20===========%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%0D%0A_*Nama%20:*_%20...%0D%0A%20_*Asal%20Instansi/kampus%20:*_%20...%0D%0A%20_*Kelas%20Yang%20di%20pilih%20%20:*_%20...%0D%0A%20%20%0D%0A%20Catt%20:%20_Bagi%20yg%20bukan%20utusan%20instansi%20atau%20blm%20kuliah%20cukup%20mengisi%20:%20*Pribadi*_')" type="button" value="DAFTAR VIA WA" name="daftar-via-wa" class="btn btn-light text-primary font-weight-bold"/>-->
<!--                <input onclick="window.open(`<?php echo site_url('infront/daftar') ?>`)" type="button" value="DAFTAR" name="daftar-via-wa" class="btn btn-light text-primary font-weight-bold" />-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
</div>

<?php $this->load->view('module_promo2'); ?>
<!--PORTOFLIO IT TRAINING-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_portofolio_it_training'); ?>
<!--END OF PORTOFLIO IT TRAINING-->

<!--REKOMENDASI KELAS LAINNYA-->
<!--File ada di folder application/view/module_rekomend_kelas_lain-->
<?php 
$this->load->view('module_rekomend_kelas_lain', ['idKategori' => $detail->id_kategori]);
?>
<!--END OF REKOMENDASI KELAS LAINNYA-->

<!--PILIHAN KELAS LAINNYA-->
<!--File ada di folder application/view/module_kelas_lainnya-->
<?php 
//$this->load->view('module_kelas_lainnya');
?>
<!--END OF PILIHAN KELAS LAINNYA-->
<!--PORTOFLIO PROJECT-->
<!--File ada di folder application/view/module_portofolio_project-->
<?php $this->load->view('module_portofolio_project'); ?>
<!--END OF PORTOFLIO PROJECT-->
<!--NEWS AND BLOG-->
<!--File ada di folder application/view/module_news_blog-->
<?php 
//$this->load->view('module_news_blog'); ?>
<!--END OF NEWS AND BLOG-->
<!--LOKASI-->
<!--File ada di folder application/view/module_lokasi-->
<?php 
// $this->load->view('module_lokasi'); 
?>
<!--END OF LOKASI-->
<!--CLIENT-->
<!--File ada di folder application/view/module_client-->
<?php $this->load->view('module_client'); ?>
<!--END OF CLIENT-->
<?php
$this->load->view('headfoot/footer') ?>