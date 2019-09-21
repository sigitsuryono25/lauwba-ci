<?php $this->load->view('headfoot/header') ?>
<?php if($project == false){?>
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12 " style="margin-top: 160px">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Portoflio IT Training</span></h2>
                </div>
            </div>
         <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span> &nbsp Portoflio IT Training</span></h2>
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
                                        <div class="px-2 mb-3 col-md-3 col-12 col-sm-12 btn-menu">
                                            <div class="wrapper-block w-100">
                                                  <!--<div class="wrapper-block ">-->
                                                <div class="highslide-gallery">
                                                    <div class="hover text-center p-1" style="top: 75%">
                                                        <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                                                    </div>
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
                                                    <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                                                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
<?php }else{?>
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12 " style="margin-top: 160px">
                <div class="newTitle1">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span><?php echo $title?></span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row px-4 mt-4">
        <?php foreach ($project as $value) { ?>
            <div class="px-2 mb-3 col-md-4 col-12 col-sm-12 btn-menu">
                <!--<div class="wrapper-block ">-->
                    <div class="wrapper-block ">
                    <div class="highslide-gallery">
                        <div class="hover text-center p-1">
                            <p style="color: #FFF; font-size: 15px; padding-bottom: 2px" class="text-uppercase"><?php echo $value->jdl_gallery ?></p>
                        </div>
                        <a href="../../img_galeri/<?php echo $value->gbr_gallery ?>" class="highslide text-center" onclick="return hs.expand(this)">
                            <img  class="lazyload img-thumbnail" src="../../img_galeri/<?php echo $value->gbr_gallery ?>" alt="<?php echo $value->gbr_gallery ?>" title="Klik Untuk Memperbesar" 
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
<?php }?>

<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni');?>
<!--END OF TESTIMONI-->
<?php $this->load->view('headfoot/footer') ?>