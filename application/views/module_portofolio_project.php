<?php 
$all_proj = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('17', '18', '26') order by seq asc  LIMIT 0,6")->result();
$android = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album='17' order by seq asc LIMIT 0,6")->result();
$desktop = $this->crud->select_other('gallery', "join album on album.id_album=gallery.id_album where gallery.id_album in ('26', '18') order by seq asc LIMIT 0,6")->result();
?>
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Portoflio Project</span></h2>
                </div>
            </div>
                                    <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Portoflio Project</span></h2>
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
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                      <img style="height: 100% width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($android as $value) {
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                       <img style="height: 100% width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" title="Klik Untuk Memperbesar" 
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
                                    <?php foreach ($desktop as $value) {
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                       <img style="height: 100% width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" alt="<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" title="Klik Untuk Memperbesar" 
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
                    <a class="btn btn-success text-white" href="<?php echo site_url('infront/portofolio/#!portofolio')?>">Selengkapnya ></a>
                </div>
            </div>
        </div>
    </div>
</div>