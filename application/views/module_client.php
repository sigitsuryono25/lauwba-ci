<?php
$other = $this->load->database('accounting', TRUE);
$logos = $other->where('deleted', 0)->order_by('sequence', 'asc')->get('tb_logo')->result();
?>
<style>
.zoom-wrap { overflow: hidden; }
.zoom-img {
    transition: transform .3s ease;
}
.zoom-img:hover {
    transform: scale(1.3);
}

.col-5th { width: 20%; flex: 0 0 20%; max-width: 20%; }
</style>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Client</span></h2>
            </div>
            <div class="col-md-12 d-md-none d-block">
                <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
                <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Client</span></h2>
                </div>
            </div>
            <div class="row mt-3">
                <?php foreach ($logos as $l): ?>
                <div class="col-5th col-md-2 mb-3 d-flex align-items-center justify-content-center zoom-wrap">
                    <img src="/logo/<?= $l->file ?>" alt="<?= $l->logo_name ?>" class="img-fluid zoom-img" style="max-height: 80px;">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    
</div> 