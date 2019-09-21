<?php
$this->load->view('headfoot/header')
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <img class="card-img-top" src="../../produk/<?php echo $products->gambar; ?>" alt="Card image cap" style="width : 30%">
        </div> 
        <div class="col-md-12">
            <h3><?php echo $products->nama_produk ?></h3>
            <h4 class="badge badge-success lead"> Rp. <?php echo $this->etc->rps($products->harga) ?></h4>
        </div> 
        <div class="col-md-12">
            <p class="text-justify"><?php echo $products->deskripsi ?></p>
        </div> 
        <div class="col-md-12">
            <h4>Tag : </h4>
            <?php
            $limit = sizeof($tag);
            $rows = 1;
            foreach ($tag as $t) {
                if ($rows == $limit) {
                    ?>
                    <a href="<?php echo site_url('tagged/' . $t->tag_seo) ?>" class="btn badge badge-info text-white"><?php echo $t->tag; ?></a>
                <?php } else { ?>
                    <a href="<?php echo site_url('tagged/' . $t->tag_seo) ?>" class="btn badge badge-info text-white"><?php echo $t->tag; ?></a>&nbsp;
                    <?php
                }
                $rows++;
            }
            ?>
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
                    <div class="col-md-3 mt-2 light-shadow" style="cursor: pointer" onclick="window.location.assign(`<?php echo site_url('product/details/' . $p->judul_seo) ?>`)">
                        <div class="card text-left"> <img class="card-img-top" src="../../produk/<?php echo $p->gambar; ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="teal text-center"><small class="font-weight-bold "><?php echo $p->nama_produk ?></small></p>
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