<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Lokasi Pelaksanaan</span></h2>
            </div>
        </div>
                                <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span> &nbsp Lokasi Pelaksanaan</span></h2>
            </div>
        </div>
        <?php 
        $alamat = $this->db->query("SELECT * FROM alamat")->result();
        foreach($alamat as $a){
        ?>
        <div class="col-md-3">
            <p class="text-center">
            <h3><?= $a->daerah?></h3>
            <!--- Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281<br>-->
            <!--- Jl. Kusumanegara No 224 Kota Yogyakarta, D.I.Yogyakarta-->
            <?= $a->alamat?>
            </p>
        </div>
        <?php }?>
    </div>
</div>
