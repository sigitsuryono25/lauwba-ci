<?php $this->load->view('headfoot/header') ?>
<div style="margin-top: 180px"></div>
<div class="container mt-5 mb-4">
    <div class="row mt-5">
        <div class="col-md-8">
            <h5><?= $isi->nama_voucher?></h5>
            <div class="text-center">
                <?php if(!empty($isi->cover)){?>
                    <img class="img-fluid" src="<?= $isi->cover?>" ><br>
                <?php }else{?>
                    <img class="img-fluid" src="https://lauwba.com/assets/img/default-cover.jpg?<?= md5(time())?>"><br>
                <?php }?>
            </div>
            <span class="text-uppercase border-bottom border-danger h6 small font-weight-bold">Deskripsi</span><br>
            <p><?php echo $isi->deskripsi ?></p>
            <br>
            <div class="border rounded p-2">
                <ul class="nav mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" style="border-bottom: 3px solid #0B1CB0 !important;">
                    <a class="nav-link active font-weight-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Syarat dan Ketentuan</a>
                  </li>
                </ul>
                <hr>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <?php echo $isi->syarat ?>
                  </div>
                </div>
            </div>
            <br>
            <br>
            <a href="<?= site_url('infront/promo')?>" class="btn btn-sm btn-outline-primary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> 
                Kembali ke daftar promo
            </a>
        </div>
        <div class="col-md-4">
            <div class="card border-0 rounded-0">
                <div class="card-header border-0 " style="border-radius: 10px 10px 0px 0px">
                    <h5>Info Promo</h5>
                </div>
                <div class="card-body border-0">
                    <div class="row p-2 mx-2" style="border: dashed 1px #c0c0c0; border-bottom: 0px">
                        <div class="col-md-1 col-1">
                            <i class="fa fa-calendar text-primary"></i>
                        </div>
                        <div class="col-md-10 col-10">
                            <span>Berlaku Sampai</span><br>
                            <span><?= $this->etc->indonesiaDate($isi->berlaku, null, null, true)?></span>
                        </div>
                    </div>
                    <div class="row p-2 mx-2" style="border: dashed 1px #c0c0c0;">
                        <div class="col-md-1 col-1">
                            <i class="fa fa-ticket text-primary"></i>
                        </div>
                        <div class="col-md-6 col-6">
                            <span>Kode Promo</span><br>
                            <div class=" d-block  overflow-auto">
                                <span class="text-danger font-weight-bold small text-uppercase"><?= $isi->kode_voucher?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2 mx-2" style="border: dashed 1px #c0c0c0; border-top: 0px">
                        <div class="col-md-1 col-1">
                            <i class="fa fa-percent text-primary" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-10 col-10">
                            <span>Potongan</span><br>
                            <span>Rp. <?= $this->etc->rps($isi->nominal)?></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer-sm bg-primary text-center" style="border-radius: 0px 0px 10px 10px">
                    <a href="<?= site_url('infront/daftar?voucher='.strtoupper($isi->kode_voucher))?>" class="d-block btn btn-primary text-white font-weight-bold">DAFTAR SEKARANG</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('headfoot/footer') ?>