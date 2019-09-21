<meta name="google-site-verification" content="3Da4gClCauXNcyKq1r5YDnYLSQUidKmnUDrpRv5ILTc" />

<?php $this->load->view('headfoot/header') ?>
<!--ENDO OF HEAD-->
<?php //print_r($news_detail); ?>
<br>
<br>
<br>
<div class="container mt-5" >
    <!--DETAIL START HERE-->
    <div class="row">
        <?php
        if (sizeof($news_detail) > 0) {
            if ($news_detail->id_kategori == 4) {
                echo '<div class="col-md-12 ">';
            } else {
                echo '<div class="col-md-12 ">';
            }
            ?>
                <h2 class="font-weight-bold text-center mt-4"><?php echo $news_detail->jdl_news ?></h2>
                <div class="image-wrapper text-center">
                    <img class="img-fluid w-75" src="../news/<?php echo $news_detail->foto_news ?>?v=<?= date('ymdhis')?>">
                </div>
                <div class="single-post-content-wrapper p-3 text-justify">
                    <?php echo $news_detail->ket_news ?>
                </div>
            </div>
        <!--ini kalo beritanya info training -->
        
        <!--akhir dari ini kalo beritanya info training -->
        <div class="col-md-12">
            <h4>Tag : </h4>
            <?php
            $limit = sizeof($tag);
            $rows = 1;
            foreach ($tag as $t) {
                if ($rows == $limit) {
                    ?>
                    <a href="<?php echo site_url('tagged/' . $t->tag_seo) ?>" class="btn badge badge-info text-white"><?php echo $t->tag; ?></a>
                <?php } else { ?>
                    <a href="<?php echo site_url('tagged/' . $t->tag_seo) ?>" class="btn badge badge-info text-white"><?php echo $t->tag; ?></a>&nbsp;
                    <?php
                }
                $rows++;
            }
            ?>
            <br>
            <small>in : <?php echo $news_detail->nama_kategori ?></small>
        </div>
        <?php if ($news_detail->id_kategori == 4) { ?>
            <?php $detail = $this->db->query("SELECT * FROM kelas INNER JOIN jenis ON kelas.id_jenis=jenis.id_jenis WHERE kelas.id_kelas IN ('$news_detail->id_kelas')")->row() ?>
            <!--FASILITAS DAN CATT-->
    <?php $this->load->view('module_fasilitas_catt')?>
    <!--END OF FASILITASI DAN CATT-->
    

    <!--PERBANDINGNGAN KELAS-->
    <!--File ada di folder application/view/module_perbadingan_kelas-->
    <br><br><br>
    <?php $this->load->view('page_class_comparison', ['id' => $detail->id_jenis]); 
    ?>
    <!--END OF PERBANDINGAN KELAS-->
        <?php } ?>
          

        <?php
    } else {
        echo ' <div class="col-md-12">';
        $this->load->view('404-');
        echo '</div>';
    }
    ?>
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
                    <div class="col-md-6" onclick="window.location.assign(`<?php echo site_url('reader/' . $n->judul_seo) ?>`)" title="<?php echo $n->jdl_news ?>" style="cursor: pointer">
                        <div class="row px-3">
                            <div class="p-0 col-lg-4 order-2 order-lg-1">
                                <img class="img-fluid d-block my-2" src="../news/<?php echo $n->foto_news ?>?v=<?= date('ymdhis')?>" alt="gambar berita">
                            </div>
                            <div class="p-3 col-lg-7 order-1 order-lg-2 ">
                                <p class="font-weight-bold"><?php echo $n->jdl_news ?><br>
                                    <small class="badge badge-success"><?php echo $n->nama_kategori ?></small>&nbsp;
                                    <!--<small><i class="fa fa-clock-o"></i> <?php echo $this->etc->date_diff($n->post_on) ?></small>-->
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!--PORTOFLIO IT TRAINING-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_portofolio_it_training'); ?>
<!--END OF PORTOFLIO IT TRAINING-->

<!--PORTOFLIO PROJECT-->
<!--File ada di folder application/view/module_portofolio_project-->
<?php $this->load->view('module_portofolio_project'); ?>
<!--END OF PORTOFLIO PROJECT-->



<!--NEWS AND BLOG-->
<!--File ada di folder application/view/module_news_blog-->
<?php $this->load->view('module_news_blog'); ?>
<!--END OF NEWS AND BLOG-->

<!--JADWAL-->
<!--File ada di folder application/view/module_jadwal-->
<?php $this->load->view('module_jadwal'); ?>
<!--END OF JADWAL-->

<!--LOKASI PELAKSANAAN-->
<!--File ada di folder application/view/module_alamat-->
<?php $this->load->view('module_alamat'); ?>
<!--END OF LOKASI PELAKSANAAN-->

<!--IT TRAINING AND COURSES-->
<!--File ada di folder application/view/module_it_training_courses-->
<?php $this->load->view('module_it_training_courses'); ?>
<!--END OF IT TRAINING AND COURSES-->

<!--PILIHAN KELAS LAINNYA-->
<!--File ada di folder application/view/module_kelas_lainnya-->
<?php $this->load->view('module_kelas_lainnya'); ?>
<!--END OF PILIHAN KELAS LAINNYA-->

<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni'); ?>
<!--END OF TESTIMONI-->

<!--LOKASI-->
<!--File ada di folder application/view/module_lokasi-->
<?php $this->load->view('module_lokasi'); ?>
<!--END OF LOKASI-->
<?php
$this->load->view('headfoot/footer')?>