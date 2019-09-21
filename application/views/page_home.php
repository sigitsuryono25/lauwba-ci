<?php $this->load->view('headfoot/header') ?>
<!--END OF HEAD-->

<!--SLIDER-->
<!--File ada di folder application/view/module_slider-->
<?php $this->load->view('module_slider');?>
<!--END OF SLIDER-->

<!--LAYANAN-->
<!--File ada di folder application/view/module_layanan-->
<?php //$this->load->view('module_layanan');?>
<!--END OF LAYANAN-->
<P>
<!--KEGIATAAN TERBARU-->
<!--File ada di folder application/view/module_kegiatan_terbaru-->
<?php //$this->load->view('module_kegiatan_terbaru');?>
<!--END OF KEGIATAAN TERBARU-->



<!--IT TRAINING AND COURSES-->
<!--File ada di folder application/view/module_it_training_courses-->
<?php $this->load->view('module_it_training_courses');?> 
<!--END OF IT TRAINING AND COURSES-->


<div class="container" style="margin-top: 180px;">
    <div class="newTitle1 d-none d-md-block">
        <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Pilihan Metode Pembelajaran</span></h2>
    </div>
    <!--Ini Untuk Mobile-->
    <div class="col-md-12 d-md-none d-block">
        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
        <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
            <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbsp;&nbsp;&nbsp;&nbsp;Pilihan Metode Pembelajaran</span></h2>
        </div>
    </div>
 <p>Satu-satunya tempat training/kursus yang memiliki <b>Metode Pembelajaran <i>Terlengkap</b></i>  yang bisa disesuaikan dengan kebutuhan Anda</p>
    <!--Akhir dari Untuk Mobile-->
    <!--<iframe src="<?= site_url('infront/perbedaan-kelas-statis')?>" id="kelas-compare" frameborder="0" class="w-100" onload="autoResize()" style="overflow-y: hidden"></iframe>-->
   <?php $this->load->view('page_class_comp_statis');?>
</div>

<!--VIDEO-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_video');?>
<!--END OF VIDEO-->



<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni');?>
<!--END OF TESTIMONI-->

<!--JADWAL-->
<!--File ada di folder application/view/module_jadwal-->
<?php 
// $this->load->view('module_jadwal');
?>
<!--END OF JADWAL-->

<!--PROMO-->
<!--File ada di folder application/view/module_promo-->
<?php $this->load->view('module_promo');?>
<!--END OF PROMO--> 

<!--EMBEDED SOCMED-->
<!--File ada di folder application/view/module_socmed-->
<?php 
 //$this->load->view('module_socmed');
?>
<!--END OF SOCMED-->

<!--LOKASI PELAKSANAAN-->
<!--File ada di folder application/view/module_alamat-->
<?php 
// $this->load->view('module_alamat');
?>
<!--END OF LOKASI PELAKSANAAN-->

<!--PILIHAN KELAS LAINNYA-->
<!--File ada di folder application/view/module_kelas_lainnya-->
<?php //$this->load->view('module_kelas_lainnya');?>
<!--END OF PILIHAN KELAS LAINNYA-->



<!--PORTOFLIO IT TRAINING-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php //$this->load->view('module_portofolio_it_training');?>
<!--END OF PORTOFLIO IT TRAINING-->


<!--PORTOFLIO PROJECT-->
<!--File ada di folder application/view/module_portofolio_project-->
<?php 
// $this->load->view('module_portofolio_project');
?>
<!--END OF PORTOFLIO PROJECT-->

<!--NEWS AND BLOG-->
<!--File ada di folder application/view/module_news_blog-->
<?php// $this->load->view('module_news_blog');?>
<!--END OF NEWS AND BLOG-->

<!--LOKASI-->
<!--File ada di folder application/view/module_lokasi-->
<?php 
// $this->load->view('module_lokasi');
?>
<!--END OF LOKASI-->


<!--CLIENT-->
<!--File ada di folder application/view/module_client-->
<?php $this->load->view('module_client');?>
<!--END OF CLIENT-->

<?php $this->load->view('headfoot/footer') ?>