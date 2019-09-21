<?php $this->load->view('headfoot/header') ?>
<div class="container">
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12 " style="margin-top: 140px">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Customer Stories</span></h2>
                </div>
            </div>
         <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbsp Customer Stories</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
        </div>
    </div>
    <!--VIDEO-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_video');?>
<!--END OF VIDEO-->

</div>
    <div class="row px-4">
        <?php foreach ($testimoni as $key => $t) { ?>
            <div class="col-md-12 mb-3 px-4 d-none d-md-block">
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
                        <div >
                            <h5 class="teal"><b><?php echo $t->nama_pemberi ?></b></h5>
                             <img src="https://lauwba.com/img/rating-lauwba.jpg">
                            <div>
                                <i><?php echo $t->testimoni ?></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                <div style="width: 120px;height: 120px;  
                     background: url(<?php echo base_url("testimoni/" . $t->foto) ?>);
                     background-position: unset;
                     background-size: cover;
                     background-repeat: no-repeat;
                     " class="mr-4 d-block rounded-circle"></div>
                <div >
                    <h5 class="teal"><b><?php echo $t->nama_pemberi ?></b></h5>
                     <img src="https://lauwba.com/img/rating-lauwba.jpg">
                    <div>
                        <i><?php echo $t->testimoni ?></i>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>




    <?php $this->load->view('module_client');?>
<?php $this->load->view('headfoot/footer') ?>