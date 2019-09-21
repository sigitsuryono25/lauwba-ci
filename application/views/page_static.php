<?php $this->load->view('headfoot/header') ?>
<div class="container mt-4">
    <div class="text-light pt-2 mb-4">
        <div class="row px-4">
            <div class="col-md-12 pt-4" style="margin-top: 100px;">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span><?php echo $static->judul ?></span></h2>
                </div>
            </div>
        <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://lauwba.com/assets/img/layer-lauwba12.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span> &nbsp <?php echo $static->judul ?></span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->            
       
        </div>
    </div>
</div>
<div class="container">
    <?php echo $static->isi_halaman ?>
</div>
<?php if(strpos(current_url(), 'clients') !== false){?>


<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni');?>
<!--END OF TESTIMONI-->
<?php }
if(strpos(current_url(), 'profile') !== false || strpos(current_url(), 'sof-dev') !== false){?>
    <!--VIDEO-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_video');?>
<!--END OF VIDEO-->


<!--PORTOFLIO IT TRAINING-->
<!--File ada di folder application/view/module_portofolio_it_training-->
<?php $this->load->view('module_portofolio_it_training');?>
<!--END OF PORTOFLIO IT TRAINING-->

    <!--LOKASI PELAKSANAAN-->
    <!--File ada di folder application/view/module_alamat-->
    <?php $this->load->view('module_portofolio_project');?>
    
    <!--END OF LOKASI PELAKSANAAN-->

    <!--TESTIMONI-->
    <!--File ada di folder application/view/module_testimoni-->
    <?php $this->load->view('module_testimoni');?>
    <!--END OF TESTIMONI-->
    

    
    <!--CLIENT-->
    <!--File ada di folder application/view/module_client-->
    <?php $this->load->view('module_client');?>
    <!--END OF CLIENT-->
<?php }?>
<?php $this->load->view('headfoot/footer') ?>