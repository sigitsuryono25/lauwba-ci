<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="text-light pt-2 mb-4">

        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span><?php echo $static->judul ?></span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php echo $static->isi_halaman ?>
</div>
<?php $this->load->view('headfoot/footer') ?>