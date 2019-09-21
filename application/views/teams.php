<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>Our team</span></h2>
                </div>
            </div>
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
                    <img class="img-fluid d-block rounded-circle mx-auto" style="height:125px;width:125px;" src="http://lkp-unikom.com/admin411/assets/uploads/trainer/<?php echo str_replace(" ", "_", $t->gambar) ?>" alt="">
                    <h4 class="mt-2 text-dark"> <b><?php echo $t->nama ?></b> </h4>
                    <p class="mb-0 text-dark"><?php echo strip_tags($t->tentang) ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
$this->load->view('headfoot/footer')?>