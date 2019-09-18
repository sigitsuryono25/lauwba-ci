<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="card- bg-primary text-light pt-2 mb-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-uppercase text-center"> <?php echo $static->judul ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php echo $static->isi_halaman ?>
</div>
<?php $this->load->view('headfoot/footer') ?>