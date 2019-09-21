<?php
define("URL_IMAGE", 'http://localhost/CodeIgniter/admin_lauwba/assets/images/produk/');
$this->load->view('headfoot/header')
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img class="card-img-top" src="<?php echo URL_IMAGE . $products->gambar; ?>" alt="Card image cap">
        </div> 
        <div class="col-md-12">
            <h3><?php echo $products->nama_produk ?></h3>
            <h4 class="badge badge-success lead"> Rp. <?php echo $this->etc->rps($products->harga) ?></h4>
        </div> 
        <div class="col-md-12">
            <p class="text-justify"><?php echo $products->deskripsi ?></p>
        </div> 
    </div>
</div>
<div class="container ">
    <div class="row px-2 my-3 ">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>PRODUK LAINNYA</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <?php
                foreach ($produk as $p) {
                    ?>
                    <div class="col-md-2 m-2 light-shadow" style="cursor: pointer">
                        <div class="card text-left"> <img class="card-img-top" src="<?php echo URL_IMAGE . $p->gambar; ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="font-weight-bold teal text-center"><?php echo $p->nama_produk ?></p>
                                <p class="card-text">
                                </p>
                            </div>
                            <div class="card-footer bg-primary text-center">
                                <a class="text-light">
                                    Rp. <?php echo $this->etc->rps($p->harga) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('headfoot/footer')?>