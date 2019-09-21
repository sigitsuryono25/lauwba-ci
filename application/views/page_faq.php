<?php $this->load->view('headfoot/header') ?>
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12 " style="margin-top: 140px;">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Frequently Asked Question</span></h2>
                </div>
            </div>
            <!--Ini Untuk Mobile-->
            <div class="col-md-12 d-md-none d-block">
                <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbsp;Frequently Asked Question</span></h2>
                </div>
            </div>
            <!--Akhir dari Untuk Mobile-->
        </div>
    </div>
</div>
<div class="container mb-4">
    <p>Berikut ini adalah beberapa pertanyaan yang paling sering ditanyakan di Lauwba Techno Indonesia</p>
    <?php foreach ($faq as $i => $v) { ?>
        <div id="q-<?= $i?>" role="tablist" aria-multiselectable="true">
            <div class="card border-0">
                <div class="card-header bg-white" style="cursor: pointer" role="tab" id="q-header-<?= $i?>" data-toggle="collapse" data-parent="#q-<?= $i?>" href="#answered-<?= $i?>" aria-expanded="true" aria-controls="answered-<?= $i?>">
                    <div class="d-flex text-primary justify-content-between align-items-center">
                        <h5 class="mb-0 "><?php echo $i + 1 . ". ". $v->pertanyaan?></h5>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
                <div id="answered-<?= $i?>" class="collapse" role="tabpanel" aria-labelledby="q-header-<?= $i?>">
                    <div class="card-body">
                        <?= $v->jawaban?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php $this->load->view('headfoot/footer') ?>