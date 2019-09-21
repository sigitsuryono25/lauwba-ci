<?php
$testimoni = $this->db->query("SELECT * FROM testimoni ORDER BY tanggal DESC LIMIT 7")->result();
?>
<div class="wrapper-page">
    <?php $this->load->view('header-pdf') ?>
    <h4 class="text-center">Kata Customer Kami</h4>
    <div class="row px-4">
        <?php foreach ($testimoni as $key => $t) { ?>
            <div class="col-12 mb-3 px-4 d-none d-md-block">
                <div class="row ">
                    <div class="col-md-2 p-0">
                        <div style="width: 120px;height: 120px; 
                             background: url(<?php echo base_url("testimoni/" . $t->foto) ?>);
                             background-position: unset;
                             background-size: cover;
                             background-repeat: no-repeat;
                             " class="mr-4 pull-left d-block rounded-circle"></div>
                    </div>
                    <div class="col-md-10  p-0">
                        <div>
                            <h5 class="teal"><b> <?php echo $t->nama_pemberi ?></b></h5>
                             <img src="https://lauwba.com/img/rating-lauwba.jpg" class="img-fluid lazyload">
                            <div>
                                <i><?php echo $t->testimoni ?></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row ">-->
                <!--    <div class="col-md-2 p-0">-->
                <!--      <img style="width: 120px;height: 100px;" src="<?php echo base_url("testimoni/" . $t->foto) ?>" class="mr-4 d-block"/>-->
                <!--    </div>-->
                <!--    <div class="col-md-10  p-0">-->
                <!--        <div >-->
                <!--            <h5 class="teal"><b><?php echo $t->nama_pemberi ?></b></h5>-->
                <!--            <div>-->
                <!--                <i><?php echo $t->testimoni ?></i>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                <img style="width: 120px;height: 100px;" src="<?php echo base_url("testimoni/" . $t->foto) ?>" class="mr-4 d-block"/>
                <div >
                    <h5 class="teal"><b><?php echo $t->nama_pemberi ?></b></h5>
                    <div>
                        <i><?php echo $t->testimoni ?></i>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
                <?php $this->load->view('footer-pdf') ?>
</div>