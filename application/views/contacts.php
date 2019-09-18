<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="card- bg-primary text-light pt-2 mb-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-uppercase text-center">Kontak</h2>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
        <?php echo $static->isi_halaman?>    
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12"><iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31623.24957438492!2d110.3843626181536!3d-7.799755351345503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5765d4d95351%3A0x5175f045ca1816c!2sLauwba+Techo+Indonesia+Wilayah+Yogykarta!5e0!3m2!1sid!2sid!4v1509164706236" scrolling="no" frameborder="0"></iframe></div>
    </div>
</div>
<div class="container text-center mt-4">
    <!--<h1 class="font-weight-bold">Kontak</h1>-->
    <a class="text-dark" target="_blank" href="<?php echo base_url() ?>"><span class="fa fa-globe "></span> <?php echo base_url() ?></a><br/>
    <a class="text-dark" target="_blank" href="http://www.facebook.com/LauwbaTechno"><span class="fa fa-facebook-square "></span> Lauwba Techno Indonesia</a><br/>
    <a class="text-dark" target="_blank" href="https://twitter.com/@lauwbatechno"><span class="fa fa-twitter-square "></span> @lauwbatechno</a>
</div>
<?php
$this->load->view('headfoot/footer')?>