<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="text-light pt-2 mb-4">
        <div class="row">
            <div class="col-md-12 pt-4" style="margin-top: 120px;">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Kontak</span></h2>
                </div>
            </div>
         <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Kontak</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
         <div class="p-4 col-md-3">
               
                <p> <a href="tel:02744281507" >
                        <i class="fa d-inline mr-3 text-muted fa-phone"></i>0274-4435 9440</a> </p>
                <p> <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konsultasi%20tentang%20training/kursus%20di%20Lauwba...">
                        <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>Telp/WA : 08 222 1 777 206</a> </p>
                <p> <a href="#" >
                        <i class="fa d-inline mr-3 text-muted fa-envelope-o"></i>info@lauwba.com</a> </p>

            </div>
            <div class="p-4 col-md-3">
               
                <p> <a target="_blank" href="http://www.facebook.com/LauwbaTechno" >
                        <i class="fa d-inline mr-3 text-muted fa-facebook-square"></i>Lauwba Techno Indonesia</a> </p>
                <p> <a target="_blank" href="https://twitter.com/@lauwbatechno">
                        <i class="fa d-inline mr-3 text-muted fa-twitter-square"></i>@lauwbatechno</a> </p>
                <p> <a target="_blank" href="https://www.instagram.com/lauwba_techno/" >
                        <i class="fa d-inline mr-3 text-muted fa-instagram"></i>@lauwba_techno</a> </p>
        
        </div>
    </div>
</div>


<!--LOKASI PELAKSANAAN-->
<!--File ada di folder application/view/module_alamat-->
<?php $this->load->view('module_alamat');?>
<!--END OF LOKASI PELAKSANAAN-->




            <div class="col-md-12 pt-4" style="margin-top: 120px;">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Kantor Pusat</span></h2>
                </div>
            </div>
         <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://lauwba.com/assets/img/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Kantor Pusat</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12"><iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31623.24957438492!2d110.3843626181536!3d-7.799755351345503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5765d4d95351%3A0x5175f045ca1816c!2sLauwba+Techo+Indonesia+Wilayah+Yogykarta!5e0!3m2!1sid!2sid!4v1509164706236" scrolling="no" frameborder="0"></iframe></div>
    </div>
</div>
<!--VIDEO-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_video');?>
<!--END OF VIDEO-->


<!--<div class="container text-center mt-4">-->
    <!--<h1 class="font-weight-bold">Kontak</h1>-->
<!--    <a class="text-dark" target="_blank" href="<?php //echo base_url() ?>"><span class="fa fa-globe "></span> <?php //echo base_url() ?></a><br/>-->
<!--    <a class="text-dark" target="_blank" href="http://www.facebook.com/LauwbaTechno"><span class="fa fa-facebook-square "></span> Lauwba Techno Indonesia</a><br/>-->
<!--    <a class="text-dark" target="_blank" href="https://twitter.com/@lauwbatechno"><span class="fa fa-twitter-square "></span> @lauwbatechno</a>-->
<!--</div>-->
<?php
$this->load->view('headfoot/footer')?>