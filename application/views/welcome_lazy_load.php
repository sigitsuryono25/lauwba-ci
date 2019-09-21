<?php require_once('./assets/static/function.resize.php') ?>
<style>
    .newTitle1{
        background: url(<?php echo base_url('assets/img/layer-lauwba.png')?>);
        background-size: contain;
        background-repeat: no-repeat;
        color: white;
        margin-bottom: 5px;
        padding-bottom: 5px;
        padding-top: 5px;
        padding-left: 5px;
        padding-right: 5px;
        max-width: 100%;
        text-align: left;
        position: relative;
        top: -10px;
    }
</style>
<?php $this->load->view('headfoot/header') ?>
<!--END OF HEAD-->
<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;margin-top: 125px;">
    <!--<div class="col-md-12">-->
    <div class="carousel slide" data-ride="carousel" id="carousel">
        <div class="carousel-inner" >
            <?php
            $no = 1;
            foreach ($slider as $s) {
                if ($no == 1) {
                    echo '<div class="carousel-item active" style="background: url(http://jquery.eisbehr.de/lazy/images/loading.gif) no-repeat cover">';
                } else {
                    echo '<div class="carousel-item" style="background: url(http://jquery.eisbehr.de/lazy/images/loading.gif) no-repeat cover">';
                }
                ?>
                <img style="width: 100%;" 
                     class="lazyload img-fluid" data-src="sliderimages/<?php echo $s->gbr_slider ?>">
            </div>
            <?php
            $no++;
        }
        ?>
    </div> 
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"> 
        <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> 
    </a> 
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next"> 
        <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span> 
    </a>
    <!--</div>-->
</div>

<div class="container pb-4 ">
    <div class="row mt-3 mb-3 d-flex justify-content-center ">
        <div class="col-md-3 m-1 box mt-4">
            <div class="card text-center"  style="border: 1px solid white"> <img class="lazyload card-img-top" data-src="../layanan/jasa-pembuatan-website-makassar-lauwba-techno.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="text-uppercase teal font-weight-bold text-center">software development</p>
                    <p class="card-text text-center">Jasa Pembuatan Website, Aplikasi Android, iOS dan aplikasi custom by request. Saat ini sudah ada ratusan client kami, baik dari Perusahaan,
                        Instansi Pemerintahan, Kampus, Sekolah, Yayasan dll</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 m-1 box  mt-4">
            <div class="card text-left" style="border: 1px solid white"> 
                <img class="lazyload card-img-top" data-src="../layanan/training-web-android-lauwba-techno.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="text-uppercase teal font-weight-bold text-center">it training & course</p>
                    <p class="card-text text-center">
                        Terdapat Kelas Reguler, Private, Inhouse dan Incubator. Kami telah meluluskan ribuan peserta Training dari berbagai kalangan baik dari utusan instansi pemerintahan, kampus dan perusahaan.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 m-1 box  mt-4 ">
            <div class="card text-left"  style="border: 1px solid white"> <img class="lazyload card-img-top" data-src="../layanan/jasa-periklanan-google-dan-facebook-makassar.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="text-uppercase teal font-weight-bold text-center">digital marketing</p>
                    <p class="card-text text-center">
                        Jasa SEO, Google Adwords/ads & Facebook Ads. Telah terbukti meningkatkan penjualan Dealer Resmi Mobil Suzuki Makassar, CV. Tugu Jogja, Fullbright Institute & Beberapa perusahaan lainnya</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row  px-4">
        <div class="col-md-12">
            <div class="newTitle1">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Kegiatan Terbaru</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div id="newsIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">
                    <?php
                    $i = 0;
                    foreach ($news_car as $c) {
                        ?>
                        <?php if ($i == 0) { ?>
                            <li data-target="#newsIndicators" data-slide-to="<?php echo $i ?>" class="active"></li>
                        <?php } else { ?>
                            <li data-target="#newsIndicators" data-slide-to="<?php echo $i ?>"></li>
                            <?php
                        }
                        $i++;
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($news_car as $c) {
                        ?>
                        <?php if ($i == 0) { ?>
                            <div class="carousel-item active " style="
                                 padding-left: 5%;
                                 padding-right: 5%;
                                 ">
                                 <?php } else { ?>
                                <div class="carousel-item" style="
                                     padding-left: 5%;
                                     padding-right: 5%;
                                     ">
                                     <?php }
                                     ?>
                                <div class="row mb-3 px-5">
                                    <div class="py-2 col-md-12 light-shadow text-center">            
                                        <div class="row" onclick="window.open(`<?php echo site_url('reader/' . $c->judul_seo) ?>`)" style="cursor: pointer">
                                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                                <img class="lazyload img-fluid" data-src="../news/<?php echo $c->foto_news ?>">
                                            </div>
                                            <div class="col-md-10">
                                                <div class="mb-1 text-primary">
                                                    <h5>
                                                        <b><?php echo $c->jdl_news ?></b>
                                                    </h5>
                                                </div>
                                                <p class="my-1 text-justify">
                                                    <?php
                                                    $string = strip_tags($c->ket_news);
                                                    if (strlen($string) > 150) {

                                                        // truncate string
                                                        $stringCut = substr($string, 0, 150);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.
                                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                        $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
                                                    }
                                                    echo $string;
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>

                </div>
                <a class="news carousel-control-prev" href="#newsIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="news carousel-control-next" href="#newsIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
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

            <hr>
        </div>
        <div class="col-md-12 mx-2">
<?php foreach ($bimtek as $b) { ?>
                                                                            <div class="row mb-2  d-none d-md-flex" onclick="window.open(`<?php echo site_url($b->routes) ?>`)" style="cursor: pointer">
                                                                                <div class="p-0 col-lg-3 order-2 order-lg-1"> 
                                                                                    <img class="img-thumbnail" data-src="./foto_berita/<?php echo $b->gambar ?>"> </div>
                                                                                <div class="d-flex flex-column justify-content-center pl-3 col-lg-9 order-1 order-lg-2">
                                                                                    <p class="lead font-weight-bold"><?php echo $b->judul ?></p>
                                                                                    <p class="text-justify"><?php
    $string = strip_tags($b->isi_jenis);
    if (strlen($string) > 200) {

        // truncate string
        $stringCut = substr($string, 0, 200);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
    }
    echo $string;
    ?></p>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-4 mb-2 d-block d-md-none" onclick="window.open(`<?php echo site_url($b->routes) ?>`)" style="cursor: pointer">
                                                                                <div class="card text-left"> <img class="card-img-top" data-src="./foto_berita/<?php echo $b->gambar ?>" alt="Card image cap">
                                                                                    <div class="card-body">
                                                                                        <p class="text-uppercase teal font-weight-bold text-left">digital marketing</p>
                                                                                        <p class="card-text">
    <?php
    $string = strip_tags($b->isi_jenis);
    if (strlen($string) > 200) {

        // truncate string
        $stringCut = substr($string, 0, 200);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
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
</div> -->
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
                                <!--<img class="img-fluid" data-src="<?php echo $this->etc->compressedimage('../../foto_berita/' . $k->gambar) ?>" height="84" width="140">-->
                                <img class="lazyload img-fluid" data-src="../../foto_berita/<?php echo $k->gambar ?>" height="84" width="140">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_private_online_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya_private_online) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_private_online_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya_private_online) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($k->isi_jenis);
                                    if (strlen($string) > 150) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 150);
                                        $endPoint = strrpos($stringCut, ' ');

                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
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
                <table class="table table-bordered">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Kota</th>
                            <th>Jadwal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($jadwal as $j) {
                            $pelaksanaan = $this->crud->select_other("jadwal", "WHERE kota_pelaksanaan LIKE '%$j->kota_pelaksanaan%' AND active IN ('Y')")->result();
                            $span = sizeof($pelaksanaan);
                            ?>
                            <tr >
                                <td rowspan="<?php echo $span ?>" class="align-middle"><?php echo $j->kota_pelaksanaan ?></td>
                                <?php
                                $row = 1;
                                foreach ($pelaksanaan as $r) {
                                    if ($row == 1) {
                                        ?>
                                        <td><?php echo $r->tanggal ?></td>
                                        <td><?php echo $r->keterangan ?></td>
                                    <?php } else { ?>
                                        <td><?php echo $r->tanggal ?></td>
                                        <td><?php echo $r->keterangan ?></td>
                                    <?php }
                                    ?>
                                </tr>
                                <?php
                                $row++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 blues">
                <div class="row blues p-2" style="
                     background-repeat: no-repeat;
                     background-image: url(../assets/img/house-wire-model-fade-white-1500x1085.png);
                     background-attachment: scroll;
                     background-position: center right;
                     ">
                    <div class="col-md-8 justify-content-center  text-center ">
                        <p class="text-uppercase text-white font-weight-bold pt-3">PROMO! <small>MASIH DISKON HINGGA 50%</small></p>
                    </div>
                    <div class="col-md-4 text-center pt-2 pb-2" >
                        <input onclick="window.open('https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konsultasi%20tentang%20training/kursus%20di%20Lauwba...')" type="button" value="DAFTAR SEKARANG" name="daftar-via-wa" 
                               class="btn text-white font-weight-bold" style="color: #fff;
                               border: 3px solid #fff;border-radius: 100px;
                               background: transparent;"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p>

    <div class="row mt-4 mb-4 p-2">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Lokasi Pelaksanaan</span></h2>
            </div>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Yogyakarta</h3>
            Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Jakarta</h3>
            Komunikopi Graha Gizi Jl. Tebet Barat 1 RT.4/RW.2, Tebet Barat Jakarta Selatan 12810
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Tangerang</h3>
            Perumahan Grand Dhaya Pesona, Blok B2 No. 2, RT. 04 RW. 23, Jombang, Ciputat, Tangerang Selatan
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Makassar</h3>
            Confie Cafe & Coworking Space Jalan Penjernihan Raya, Kompleks PDAM No.7, Karampuang, Panakkukang, Makassar City, South Sulawesi 90000
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Bandung</h3>
            Ruangréka Coworking Space Bandung Jl. Raden Patah No.28, Lebakgede, Coblong, Kota Bandung, Jawa Barat
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Palembang</h3>
            Bingen Cafe 2 Ilir, Ilir Timur II, Jl. Residen Abdul Rozak No.5, Bukit Sangkal, Kalidoni, Kota Palembang, Sumatera Selatan 30163
            </p>
        </div>

        <div class="col-md-3">
            <p class="text-center">
            <h3>Batam</h3>
            Titik Mulai Coworking Space Komplek Ruko Superblock Imperium Blok B-49, Taman Baloi, Batam Kota, Taman Baloi, Batam City, Riau Islands 29444
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Pekanbaru</h3>
            Volks Facility Jalan Rajawali No.5, Kampung Melayu, Sukajadi, Kedungsari, Sukajadi, Kota Pekanbaru, Riau 28122
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Medan</h3>
            Saga Creative Hub Komp. Setia Budi Center Blok B – 9, Tj. Rejo, Medan Sunggal, Kota Medan, Sumatera Utara 20122
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Lampung</h3>
            Grow+ Coworking Space Jl. Zainal Abidin Pagar Alam No.93, Labuhan Ratu, Kedaton, Kota Bandar Lampung, Lampung 35142
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Solo</h3>
            Seruang Coworking Space Jebres, Kota Surakarta, Jawa Tengah 57126
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Semarang</h3>
            A+ Coworking Space Jl. Durian Raya No.63-73, Srondol Wetan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50263
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Malang</h3>
            Ruang Perintis Coworking Space Jl. Candi Sawentar, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Balikpapan</h3>
            DILo BalikpapanDamai, Balikpapan Kota, Kota Balikpapan, Kalimantan Timur 76114
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Bali</h3>
            Tempat Kita Coworking Space Jl. Batur Sari No.64a, Sanur Kauh, Denpasar Sel., Kota Denpasar, Bali 80227
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-center">
            <h3>Surabaya</h3>
            KORIDOR Coworking Space, Siola, Tunjungan St No.1, Genteng, Surabaya City, East Java 60275
            </p>
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
                                <img class="lazyload img-fluid" data-src="../../foto_berita/<?php echo $l->gambar ?>" height="150" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b class="text-uppercase"><?php echo $l->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($l->hrg_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $l->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($l->hrg_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($l->isi_jenis);
                                    if (strlen($string) > 200) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 200);
                                        $endPoint = strrpos($stringCut, ' ');

                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
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

<?php $multiplier = 1?>
<div class="container">
    <div class="row  px-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>New Testimoni</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div id="testimoni" class="carousel slide" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <?php if ($i == 0) { ?>
                            <li data-target="#testimoni" data-slide-to="<?php echo $i ?>" class="active"></li>
                        <?php } else { ?>
                            <li data-target="#testimoni" data-slide-to="<?php echo $i ?>"></li>
                            <?php
                        }
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <?php if ($i == 0) { ?>
                            <div class="carousel-item active "style="padding-left: 5%;padding-right: 5%;">
                                <div class="row mb-3">
                                    <?php 
                                    $limit = $i*$multiplier;
                                    $testimoni = $this->db->query("SELECT * FROM `testimoni` ORDER BY tanggal DESC LIMIT $limit, $multiplier")->result();
                                    foreach($testimoni as $t){
                                    ?>
                                    <div class="col-md-12 mb-3 p-0 d-none d-md-block">
                                        <div style="width: 150px;height: 130px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block"></div>
                                        <div >
                                            <h3><?php echo $t->nama_pemberi?></h3>
                                            <div>
                                                <?php echo $t->testimoni?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                                         <div style="width: 150px;height: 130px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block"></div>
                                        <div >
                                            <h3><?php echo $t->nama_pemberi?></h3>
                                            <div>
                                                <?php echo $t->testimoni?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        <?php } else if ($i == 1) { ?>
                            <div class="carousel-item" style="padding-left: 5%;padding-right: 5%;">
                                <div class="row mb-3">
                                    <?php 
                                    $limit = $i*$multiplier;
                                    $testimoni = $this->db->query("SELECT * FROM `testimoni` ORDER BY tanggal DESC LIMIT $limit, $multiplier")->result();
                                    foreach($testimoni as $t){
                                    ?>
                                    <div class="col-md-12 mb-3 p-0 d-none d-md-block">
                                        <div style="width: 150px;height: 130px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block"></div>
                                        <div >
                                            <h3><?php echo $t->nama_pemberi?></h3>
                                            <div>
                                                <?php echo $t->testimoni?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                                         <div style="width: 150px;height: 130px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block"></div>
                                        <div >
                                            <h3><?php echo $t->nama_pemberi?></h3>
                                            <div>
                                                <?php echo $t->testimoni?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                    <?php } else if ($i == 2) { ?>
                        <div class="carousel-item" style="padding-left: 5%;padding-right: 5%;">
                            <div class="row mb-3">
                                <?php 
                                    $limit = $i*$multiplier;
                                    $testimoni = $this->db->query("SELECT * FROM `testimoni` ORDER BY tanggal DESC LIMIT $limit, $multiplier")->result();
                                    foreach($testimoni as $t){
                                    ?>
                                    <div class="col-md-12 mb-3 p-0 d-none d-md-block">
                                        <div style="width: 150px;height: 130px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block"></div>
                                        <div >
                                            <h3><?php echo $t->nama_pemberi?></h3>
                                            <div>
                                                <?php echo $t->testimoni?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                                         <div style="width: 150px;height: 130px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block"></div>
                                        <div >
                                            <h3><?php echo $t->nama_pemberi?></h3>
                                            <div>
                                                <?php echo $t->testimoni?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <a class="news carousel-control-prev" href="#testimoni" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="news carousel-control-next" href="#testimoni" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>Portoflio IT Training</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4 mt-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills text-center d-flex justify-content-center">
                        <li class="nav-item"> <a href="" class="nav-link active show" data-toggle="pill" data-target="#all">ALL<br></a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#in-house">IN HOUSE TRAINING</a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#regular">REGULAR CLASS<br></a></li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#private">PRIVATE CLASS<br></a> </li>
                    </ul>
                    <hr>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade active show" id="all" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($all_it as $value) { ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu" >
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery" >
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <?php
                                                    $settings = array('w' => 300, 'h' => 300, 'compress' => true, 'compression' => 70);
                                                    $image_path = '../img_galeri/' . $value->gbr_gallery;
                                                    ?>
                                                    <a href="<?php echo $image_path ?>" class="highslide text-center" onclick="return hs.expand(this)" >
                                                        <img style="height: 200px; width: 100%;" 
                                                             class="lazyload img-thumbnail" 
                                                             src="<?php echo resize($image_path, $settings) ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" />

                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="in-house" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    foreach ($in_house as $value) {
                                        $seo = $value->album_seo;
                                        ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px;padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <div style="height: 200px; width: 100%; position: absolute; top: 0;
                                                             background-repeat: no-repeat;
                                                             background-attachment: scroll;
                                                             background-position: center;
                                                             background-image: url(../assets/img/loader.gif);">

                                                        </div>
                                                        <img style="height: 200px; width: 100%" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazyload img-thumbnail"  data-src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="private" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    foreach ($private as $value) {
                                        $seo = $value->album_seo;
                                        ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <div style="height: 200px; width: 100%; position: absolute; top: 0;
                                                             background-repeat: no-repeat;
                                                             background-attachment: scroll;
                                                             background-position: center;
                                                             background-image: url(../assets/img/loader.gif);">

                                                        </div>
                                                        <img style="height: 200px; width: 100%" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazyload img-thumbnail"  data-src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="regular" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    foreach ($regular as $value) {
                                        $seo = $value->album_seo;
                                        ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <div style="height: 200px; width: 100%; position: absolute; top: 0;
                                                             background-repeat: no-repeat;
                                                             background-attachment: scroll;
                                                             background-position: center;
                                                             background-image: url(../assets/img/loader.gif);">

                                                        </div>
                                                        <img style="height: 200px; width: 100%" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazyload img-thumbnail"  data-src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <a class="btn btn-success text-white" href="<?php echo site_url('infront/portofolio/#!portofolio') ?>">Selengkapnya ></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>Portoflio Project</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4 mt-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills text-center d-flex justify-content-center">
                        <li class="nav-item"> <a href="" class="nav-link active show" data-toggle="pill" data-target="#all-proj">ALL<br></a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#android">MOBILE APPS<br></a></li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#desktop">WEB & DESKTOP APPS<br></a></li>
                    </ul>
                    <hr>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade active show" id="all-proj" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($all_proj as $value) { ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100" >
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <div style="height: 200px; width: 100%; position: absolute; top: 0;
                                                             background-repeat: no-repeat;
                                                             background-attachment: scroll;
                                                             background-position: center;
                                                             background-image: url(../assets/img/loader.gif);">

                                                        </div>
                                                        <img style="height: 200px; width: 100%" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazyload img-thumbnail"  data-src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="android" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    foreach ($android as $value) {
                                        $seo = $value->album_seo;
                                        ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <div style="height: 200px; width: 100%; position: absolute; top: 0;
                                                             background-repeat: no-repeat;
                                                             background-attachment: scroll;
                                                             background-position: center;
                                                             background-image: url(../assets/img/loader.gif);">

                                                        </div>
                                                        <img style="height: 200px; width: 100%" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazyload img-thumbnail"  data-src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desktop" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    foreach ($desktop as $value) {
                                        $seo = $value->album_seo;
                                        ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <div style="height: 200px; width: 100%; position: absolute; top: 0;
                                                             background-repeat: no-repeat;
                                                             background-attachment: scroll;
                                                             background-position: center;
                                                             background-image: url(../assets/img/loader.gif);">

                                                        </div>
                                                        <img style="height: 200px; width: 100%" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazyload img-thumbnail"  data-src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <a class="btn btn-success text-white" href="<?php echo site_url('infront/portofolio/#!portofolio') ?>">Selengkapnya ></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4 mt-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>News &amp; Blog</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <?php
                foreach ($news as $n) {
                    ?>
                    <div class="col-md-6" onclick="window.open('<?php echo site_url('reader/' . $n->judul_seo) ?>')" title="<?php echo $n->jdl_news ?>" style="cursor: pointer">
                        <div class="row px-3">
                            <div class="p-0 col-lg-4 order-2 order-lg-1">
                                <img class="lazyload img-fluid d-block my-2" data-src="../news/<?php echo $n->foto_news ?>" alt="gambar berita">
                            </div>
                            <div class="p-3 col-lg-7 order-1 order-lg-2 ">
                                <p class="font-weight-bold"><?php echo $n->jdl_news ?><br>
                                    <small class="teal"><?php echo $n->nama_kategori ?></small>&nbsp;
                                    <small><i class="fa fa-clock-o"></i> <?php echo $this->etc->date_diff($n->post_on) ?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
                define("URL_IMAGE", '../produk/');
                foreach ($produk as $p) {
                    ?>
                    <div class="col-md-3 mt-2 light-shadow" style="cursor: pointer" onclick="window.open(`<?php echo site_url('product/details/' . $p->judul_seo) ?>`)">
                        <div class="card text-left"> <img class="card-img-top lazyload"  data-src="<?php echo URL_IMAGE . $p->gambar; ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="teal text-center"><small class="font-weight-bold "><?php echo $p->nama_produk ?></small></p>
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

<div class="container">
    <div class="row px-4 mt-4">
        <div class="container-fluid"></div>
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Lokasi</span></h2>
            </div>
        </div>
        <div class="col-md-12"><iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31623.24957438492!2d110.3843626181536!3d-7.799755351345503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5765d4d95351%3A0x5175f045ca1816c!2sLauwba+Techo+Indonesia+Wilayah+Yogykarta!5e0!3m2!1sid!2sid!4v1509164706236" scrolling="no" frameborder="0"></iframe></div>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Client</span></h2>
            </div>
            <img class="img-fluid d-block lazyload" data-src="../img/CLIENT-kursus-Pembuatan-website-android-makassar-jogja-lauwba.jpg">
        </div>
    </div>
</div> 
<?php $this->load->view('headfoot/footer') ?>