<?php 
$all_it = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('20', '21', '22') order by seq asc  LIMIT 0,6")->result();
$in_house = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='21' order by seq asc LIMIT 0,6")->result();
$private = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='20' order by seq asc LIMIT 0,6")->result();
$regular = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='22' order by seq desc LIMIT 0,6")->result();
?>

<!--EMBEDED SOCMED-->
<!--File ada di folder application/view/module_socmed-->
<?php $this->load->view('module_socmed');?>
<!--END OF SOCMED-->


<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Portofolio IT Training</span></h2>
                </div>
            </div>
                                                <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="layer-lauwba"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Portofolio IT Training</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
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
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($in_house as $value) {
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px;padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($private as $value) {
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($regular as $value) {
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                <div class="col-md-12 text-right mb-4">
                    <a class="btn btn-success text-white" href="<?php echo site_url('infront/portofolio/#!portofolio')?>">Selengkapnya ></a>
                </div>
            </div>
        </div>
    </div>
</div>