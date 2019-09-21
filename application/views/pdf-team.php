<?php
$team = $this->crud->select_other('tutor', 'WHERE is_active IN ("Y") order by nomor_urut')->result();
?>
<div class="wrapper-page">
    <?php $this->load->view('header-pdf') ?>
    <h4 class="text-center">Tim Kami</h4>
        <div class="row">
            <?php foreach ($team as $t) { ?>
                <div class="col-6 text-center">
                    <div class="d-flex justify-content-center">
                        <img src="<?= $t->gambar ?>"style="width: 100px;
                                   height: 100px; 
                                   -moz-border-radius: 50px; 
                                   -webkit-border-radius: 50px; 
                                   border-radius: 50px;"/>
                            
                    </div>
                    <!--<img class="img-fluid d-block rounded-circle mx-auto" style="height:125px;width:125px;" src="../../foto_banner/<?php echo $t->gambar ?>" alt="">-->
                    <b class="d-block text-dark"><?php echo $t->nama ?></b>
                    <p class="mb-0 text-dark"><?php echo strip_tags($t->tentang) ?></p>
                </div>
            <?php } ?>
        </div>
    <?php $this->load->view('footer-pdf') ?>
</div>