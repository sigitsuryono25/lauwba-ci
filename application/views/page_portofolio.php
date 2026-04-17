<?php $this->load->view('headfoot/header') ?>
<<<<<<< HEAD:application/views/page_portofolio.php
<div class="container mt-4">
=======
<div class="container">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>Project Portoflio</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
>>>>>>> 9caa20c15c70040dacffd45d99145e72d46c2d56:application/views/portofolio.php
    <div class="row px-4 mt-4">
        <div class="col-md-12 pt-4" style="margin-top: 120px;">
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
                                    <?php foreach ($all_it as $key=>$value) {
                                    if($key <=26 ){
                                    ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    }
                                    }?>
                                </div>
                                
                                    <div class="text-right">
                                        <a class="btn btn-sm btn-success text-white" href="<?= site_url('portofolio/detail/it-training')?>">Selengkapnya >></a>
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="in-house" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($in_house as $key=> $value) {
                                    if($key <=26 ){
                                    ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    } ?>
                                </div>
                                
                                    <div class="text-right">
                                        <a class="btn btn-sm btn-success text-white" href="<?= site_url('portofolio/detail/it-training')?>">Selengkapnya >></a>
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="private" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($private as $key=> $value) {
                                    if($key <=26 ){
                                    ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    } ?>
                                </div>
                                
                                    <div class="text-right">
                                        <a class="btn btn-sm btn-success text-white" href="<?= site_url('portofolio/detail/it-training')?>">Selengkapnya >></a>
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="regular" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($regular as $key=>$value) {
                                    if($key <=26 ){
                                    ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    } ?>
                                    
                                </div>
                                
                                    <div class="text-right">
                                        <a class="btn btn-sm btn-success text-white" href="<?= site_url('portofolio/detail/it-training')?>">Selengkapnya >></a>
                                    </div>
                            </div>
                        </div>
                    </div>
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
                        <li class="nav-item"> <a href="" class="nav-link active show" data-toggle="pill" data-target="#all">ALL<br></a> </li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#android">MOBILE APPS<br></a></li>
                        <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#desktop">WEB & DESKTOP APPS<br></a></li>
                    </ul>
                    <hr>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade active show" id="all" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($all_proj as $key=>$value) {
                                    if($key  <= 26 ){?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block ">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 100% width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    }?>
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-sm btn-success text-white" href="<?= site_url('portofolio/detail/mobile-apps')?>">Selengkapnya Portofolio Mobile Apps >></a>
                                    <a class="btn btn-sm btn-warning text-white" href="<?= site_url('portofolio/detail/web-desktop-apps')?>">Selengkapnya Portofolio Web & Desktop Apps>></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="android" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($android as $value) {
                                    if($key  <= 26 ){
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block ">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                       <img style="height: 100% width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    }?>
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-sm btn-success text-white" href="<?= site_url('portofolio/detail/mobile-apps')?>">Selengkapnya Portofolio Mobile Apps >></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desktop" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($desktop as $value) {
                                    if($key  <= 26 ){
                                        $seo = $value->album_seo; ?>
                                        <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block ">
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                      <img style="height: 100% width: 100%" src="../../img_galeri/<?php echo $value->gbr_gallery ?>?v=<?= date('ymdhis')?>" class="img-thumbnail lazyload" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
                                                             />
                                                    </a>
                                                    <div class="highslide-caption text-uppercase">
                                                        <?php echo $value->keterangan ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    }?>
                                </div>
                                
                                <div class="text-right">
                                    <a class="btn btn-sm btn-warning text-white" href="<?= site_url('portofolio/detail/web-desktop-apps')?>">Selengkapnya Portofolio Web & Desktop Apps>></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni');?>
<!--END OF TESTIMONI-->
<?php $this->load->view('headfoot/footer') ?>