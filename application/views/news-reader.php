<?php $this->load->view('headfoot/header') ?>
<!--ENDO OF HEAD-->
<div class="container">
    <!--DETAIL START HERE-->
    <div class="row">
        <div class="col-md-12">
            <article class="row single-post mt-5 no-gutters">
                <div class="col-md-12">
                    <h3 class="lead display-4"><?php echo $detail->jdl_news ?></h3>
                    <small><?php echo date_format(date_create($detail->post_on), 'd-m-Y H:i:s') ?></small><br />
                    <div class="image-wrapper float-left pr-3">
                        <img class="img-fluid" src="http://www.lauwba.com/img/<?php echo $detail->foto_news ?>">
                    </div>
                    <div class="single-post-content-wrapper p-3 text-justify">
                        <?php echo $detail->ket_news ?>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <hr>
</div>

<!--footer-->
<div class="container">
    <div class="row px-4 mt-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>News &amp; Blog</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <?php foreach ($news as $n) { ?>
                    <div class="col-md-6" onclick="window.open()" title="<?php echo $n->jdl_news ?>" style="cursor: pointer">
                        <div class="row px-3">
                            <div class="p-0 col-lg-4 order-2 order-lg-1">
                                <img class="img-fluid d-block my-2" src="http://www.lauwba.com/img/<?php echo $n->foto_news ?>" alt="gambar berita">
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
<div class="container">
    <div class="row px-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Jadwal Kursus dan Training Kelas Regular</span></h2>
            </div>
        </div>
        <div class="col-md-12">
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
                <div class="row">
                    <div class="py-2 col-md-12 light-shadow">
                        <div class="row">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $k->gambar ?>" height="150" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($k->isi_jenis);
                                    if (strlen($string) > 300) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 300);
                                        $endPoint = strrpos($stringCut, ' ');

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
                <h2 class="title1" id="titleborder"><span>Pilihan Kelas Lainnya</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <?php foreach ($lain as $l) { ?>
                <div class="row">
                    <div class="py-2 col-md-12 light-shadow">
                        <div class="row">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $l->gambar ?>" height="150" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b><?php echo $l->judul ?></b>
                                        <br>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $l->judul ?></b>
                                        <br>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($l->isi_jenis);
                                    if (strlen($string) > 300) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 300);
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
                <h2 class="title1" id="titleborder"><span>Testimoni</span></h2>
            </div>
        </div>
        <div class="row px-3">
            <?php foreach ($testimoni as $t) { ?>
                <div class="col-md-3">
                    <div class="card text-center"> 
                        <img class="img-thumbnail img-fluid" src="http://lkp-unikom.com/admin411/assets/uploads/testimoni/<?php echo $t->foto ?>" alt="testimoni images">
                        <div class="card-body">
                            <p class="text-uppercase teal font-weight-bold text-left">software development</p>
                            <p class="card-text text-left">Jasa Pembuatan Website, Aplikasi Android, iOS dan aplikasi custom by request. Saat ini sudah ada ratusan client kami, baik dari Perusahaan,
                                Instansi Pemerintahan, Kampus, Sekolah, Yayasan dll</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4 mt-4">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Projects Portofolio</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills text-center d-flex justify-content-center">
                        <li class="nav-item"> <a href="" class="nav-link active show" data-toggle="pill" data-target="#all">ALL<br></a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#in-house">IN HOUSE TRAINING</a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#private">PRIVATE CLASS<br></a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#regular">REGULAR CLASS<br></a></li>
                    </ul>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade active show" id="all" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($gallery as $value) { ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="img-thumbnail" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                        <div class="tab-pane fade" id="in-house" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($in_house as $value) { ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px;padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="img-thumbnail" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($private as $value) { ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="img-thumbnail" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($regular as $value) { ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="http://www.lauwba.com/img_galeri/<?php echo $value->gbr_gallery ?>" class="img-thumbnail" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
            </div>
        </div>
    </div>
</div>
<!--<div class="container">
    <div class="row mt-4">
        <div class="container-fluid"></div>
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Lokasi</span></h2>
            </div>
        </div>
        <div class="col-md-12"><iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31623.24957438492!2d110.3843626181536!3d-7.799755351345503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5765d4d95351%3A0x5175f045ca1816c!2sLauwba+Techo+Indonesia+Wilayah+Yogykarta!5e0!3m2!1sid!2sid!4v1509164706236" scrolling="no" frameborder="0"></iframe></div>
    </div>
</div>-->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>Lokasi</span></h2>
            </div>
            <img class="img-fluid d-block" src="https://lauwba.com/img/CLIENT-kursus-Pembuatan-website-android-makassar-jogja-lauwba.jpg">
        </div>
    </div>
</div> 
<?php
$this->load->view('headfoot/footer')?>