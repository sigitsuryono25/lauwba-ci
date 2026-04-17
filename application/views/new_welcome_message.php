<?php $this->load->view('headfoot/header') ?>
<!--END OF HEAD-->

<<<<<<< HEAD
<!--SLIDER-->
<!--File ada di folder application/view/module_slider-->
<?php $this->load->view('module_slider');?>
<!--END OF SLIDER-->
=======
        <div class="row">
            <div class="col-md-12 blues">
                <div class="row blues p-2">
                    <div class="col-md-8 justift-content-center  text-center ">
                        <p class="text-uppercase text-white font-weight-bold pt-2">PROMO!! MASIH DISKON HINGGA 50%. DAFTAR SEKARANG</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <input onclick="window.open('https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konsultasi%20tentang%20training/kursus%20di%20Lauwba...')" type="button" value="DAFTAR VIA WA" name="daftar-via-wa" class="btn btn-light text-primary font-weight-bold"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4 pt-4 pb-4 ">
        <div class="row mt-3 mb-3 d-flex justify-content-center ">
            <div class="col-md-3 m-1 box mt-4">
                <div class="card text-center"  style="border: 1px solid white"> <img class="card-img-top" src="http://www.lauwba.com/layanan/jasa-pembuatan-website-makassar-lauwba-techno.jpg" alt="Card image cap">
                    <div class="card-body">
                        <p class="text-uppercase teal font-weight-bold text-center">software development</p>
                        <p class="card-text text-center">Jasa Pembuatan Website, Aplikasi Android, iOS dan aplikasi custom by request. Saat ini sudah ada ratusan client kami, baik dari Perusahaan,
                            Instansi Pemerintahan, Kampus, Sekolah, Yayasan dll</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 m-1 box  mt-4">
                <div class="card text-left" style="border: 1px solid white"> 
                    <img class="card-img-top" src="http://www.lauwba.com/layanan/training-web-android-lauwba-techno.jpg" alt="Card image cap">
                    <div class="card-body">
                        <p class="text-uppercase teal font-weight-bold text-center">it training & course</p>
                        <p class="card-text text-center">
                            Terdapat Kelas Reguler, Private, Inhouse dan Incubator. Kami telah meluluskan ribuan peserta Training dari berbagai kalangan baik dari utusan instansi pemerintahan, kampus dan perusahaan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 m-1 box  mt-4 ">
                <div class="card text-left"  style="border: 1px solid white"> <img class="card-img-top" src="http://www.lauwba.com/layanan/jasa-periklanan-google-dan-facebook-makassar.jpg" alt="Card image cap">
                    <div class="card-body">
                        <p class="text-uppercase teal font-weight-bold text-center">digital marketing</p>
                        <p class="card-text text-center">
                            Jasa SEO, Google Adwords/ads & Facebook Ads. Telah terbukti meningkatkan penjualan Dealer Resmi Mobil Suzuki Makassar, CV. Tugu Jogja, Fullbright Institute & Beberapa perusahaan lainnya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row px-2 my-3 ">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>PRODUK SOFTWARE</span></h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row d-flex justify-content-center">
                    <?php
                    define("URL_IMAGE", 'http://localhost/CodeIgniter/admin_lauwba/assets/images/produk/');
                    foreach ($produk as $p) {
                        ?>
                        <div class="col-md-2 m-2 light-shadow" style="cursor: pointer">
                            <div class="card text-left"> <img class="card-img-top" src="<?php echo URL_IMAGE . $p->gambar; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <p class="font-weight-bold teal text-center"><?php echo $p->nama_produk ?></p>
                                    <p class="card-text">
                                    </p>
                                </div>
                                <div class="card-footer bg-primary text-center">
                                    <a class="text-light">
                                        Rp. <?php echo $this->etc->rps($p->harga) ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-2">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>BIMBTEK CLASS</span></h2>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <h4 class="text-uppercase">bimbingan teknis 2019/2020</h4>
            <p class="lead">Kelas Bimbingan Teknis Khusus Untuk Instansi Pemerintahan & Swasta di Bidang IT 2019/2020</p>
            <p>Bagi Instansi yang membutuhkan surat penawaran BIMTEK dari kami langsung 
                <a class="font-weight-bold" target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Hallo%20Admin,%20apakah%20bisa%20dikirimkan%20%20surat%20penawaran%20untuk%20BIMTEK?">KLIK DISINI</a></p>
>>>>>>> 9caa20c15c70040dacffd45d99145e72d46c2d56

<!--LAYANAN-->
<!--File ada di folder application/view/module_layanan-->
<?php $this->load->view('module_layanan');?>
<!--END OF LAYANAN-->

<!--KEGIATAAN TERBARU-->
<!--File ada di folder application/view/module_kegiatan_terbaru-->
<?php $this->load->view('module_kegiatan_terbaru');?>
<!--END OF KEGIATAAN TERBARU-->

<<<<<<< HEAD
=======
                                //if the string doesn't contain any space then it will cut without word basis.
                                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '... <a class="badge badge-warning" href="' . site_url($b->routes) . '">Selengkapnya</a>';
                            }
                            echo $string;
                            ?></p>
                    </div>
                </div>
                <hr>
                <div class="col-md-4 mb-2 d-block d-md-none" onclick="window.open(`<?php echo site_url($b->routes) ?>`)" style="cursor: pointer">
                    <div class="card text-left"> <img class="card-img-top" src="http://www.lauwba.com/foto_berita/<?php echo $b->gambar ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="text-uppercase teal font-weight-bold text-left">digital marketing</p>
                            <p class="card-text">
                                <?php
                                $string = strip_tags($b->isi_jenis);
                                if (strlen($string) > 400) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 400);
                                    $endPoint = strrpos($stringCut, ' ');

                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    $string .= '... <a class="badge badge-warning" href="' . site_url($b->routes) . '">Selengkapnya</a>';
                                }
                                echo $string;
                                ?>    
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4 ">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>IT Training &amp; Course</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <?php foreach ($kelas as $k) { ?>
                <div class="row mb-3 px-3">
                    <div class="py-2 col-md-12 light-shadow">            
                        <div class="row" onclick="window.open(`<?php echo site_url($k->routes) ?>`)" style="cursor: pointer">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $k->gambar ?>" height="150" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($k->isi_jenis);
                                    if (strlen($string) > 300) {
>>>>>>> 9caa20c15c70040dacffd45d99145e72d46c2d56

<!--IT TRAINING AND COURSES-->
<!--File ada di folder application/view/module_it_training_courses-->
<?php $this->load->view('module_it_training_courses');?>
<!--END OF IT TRAINING AND COURSES-->

<<<<<<< HEAD
=======
                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a class="badge badge-warning" href="' . site_url($k->routes) . '">Selengkapnya</a>';
                                    }
                                    echo $string;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Jadwal Kursus dan Training Kelas Regular</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th rowspan="2">Training</th>
                            <th>Kota</th>
                            <th>Jadwal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jadwal as $j) { ?>
                            <tr>
                                <td><?php echo $j->judul ?></td>
                                <td><?php echo $j->kota ?><br><?php echo $j->kota1 ?></td>
                                <td><?php echo $j->jadwal ?><br><?php echo $j->jadwal1 ?></td>
                                <td><?php echo $j->keterangan ?><br><?php echo $j->keterangan1 ?></td>
                            </tr>
                        <?php } ?>
                        <?php
                        $kota = array("Yogyakarta", "Bekasi", "Bandung", "Depok", "Makassar", "Jakarta", "Palembang");
                        for ($i = 0; $i < 6; $i++) {
                            ?>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Pilihan Kelas Lainnya</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <?php foreach ($lain as $l) { ?>
                <div class="row mb-3 px-3">
                    <div class="py-2 col-md-12 light-shadow">
                        <div class="row" onclick="window.open(`<?php echo site_url($l->routes) ?>`)" style="cursor: pointer">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $l->gambar ?>" height="150" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b><?php echo $l->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $l->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($l->isi_jenis);
                                    if (strlen($string) > 300) {
>>>>>>> 9caa20c15c70040dacffd45d99145e72d46c2d56

<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni');?>
<!--END OF TESTIMONI-->

<!--JADWAL-->
<!--File ada di folder application/view/module_jadwal-->
<?php $this->load->view('module_jadwal');?>
<!--END OF JADWAL-->

<!--PROMO-->
<!--File ada di folder application/view/module_promo-->
<?php $this->load->view('module_promo');?>
<!--END OF PROMO--> 


<!--LOKASI PELAKSANAAN-->
<!--File ada di folder application/view/module_alamat-->
<?php $this->load->view('module_alamat');?>
<!--END OF LOKASI PELAKSANAAN-->

<!--PILIHAN KELAS LAINNYA-->
<!--File ada di folder application/view/module_kelas_lainnya-->
<?php $this->load->view('module_kelas_lainnya');?>
<!--END OF PILIHAN KELAS LAINNYA-->


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

<?php $this->load->view('headfoot/footer') ?>