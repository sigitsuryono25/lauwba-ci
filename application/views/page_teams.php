<?php $this->load->view('headfoot/header') ?>
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12 pt-4" style="margin-top: 100px;">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Our Team</span></h2>
                </div>
            </div>
         <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Our team</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
        </div>
    </div>
</div>
<div class="py-3 px-4 mb-4 text-center text-white" >
    <div class="container">
        <div class="row mb-4">
            <div class="mx-auto col-md-12 text-dark pt-1">
                <h6>Kami mengedepankan pelayanan dan kualitas dalam memberikan solusi atas kebutuhan IT anda.</h6>
            </div>
        </div>
        <br>
        <div class="row px-3">
            <?php foreach ($team as $t) { ?>
                <div class="col-lg-6 col-md-6 pb-4 pt-2">
                    <div class="d-flex justify-content-center">
                        <div style="width: 200px;
                                   height: 200px;
                                   background: url('<?php echo $t->gambar ?>'); 
                                   background-position:center;
                                   background-size: cover;
                                   -moz-border-radius: 125px; 
                                   -webkit-border-radius: 125px; 
                                   border-radius: 125px;">
                            
                        </div>
                    </div>
                    <!--<img class="img-fluid d-block rounded-circle mx-auto" style="height:125px;width:125px;" src="../../foto_banner/<?php echo $t->gambar ?>" alt="">-->
                    <h4 class="mt-2 text-dark"> <b><?php echo $t->nama ?></b> </h4>
                    <p class="mb-0 text-dark"><?php echo strip_tags($t->tentang) ?></p>
                    <?php if(!empty($t->education)){?>
                        <a href="https://lauwba.com/karyawan/index.php/cv-karyawan?nama=<?= $t->nama?>" class="btn btn-sm btn-success" target="_blank">Lihat CV</a>
                    <?php }else{?>
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning">CV Terprivasi</a>
                    <?php }?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
$this->load->view('headfoot/footer')?>