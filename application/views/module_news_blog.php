<?php
$news = $this->news->daftarBerita();
?>
<div class="container">
    <div class="row px-4 mt-4">
       
            
            
            
             <div class="col-md-12">
            <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>News &amp; Blog</span></h2>
            </div>
        </div>
        
        <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>News &amp; Blog</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
            
            
            
        <div class="col-md-12">
            <div class="row">
                <?php
                foreach ($news as $n) {
                    ?>
                    <div class="col-md-6" onclick="window.open('<?php echo site_url('reader/' . $n->judul_seo) ?>')" title="<?php echo $n->jdl_news ?>" style="cursor: pointer">
                        <div class="row px-3">
                            <div class="p-0 col-lg-4 order-2 order-lg-1">
                                <img class="lazyload img-fluid d-block my-2" src="<?php echo base_url()?>news/<?php echo $n->foto_news ?>" alt="gambar berita">
                            </div>
                            <div class="p-3 col-lg-7 order-1 order-lg-2 ">
                                <p class="font-weight-bold"><?php echo $n->jdl_news ?><br>
                                    <small class="teal"><?php echo $n->nama_kategori ?></small>&nbsp;
                                    <small><i class="fa fa-clock-o"></i> <?php echo $this->etc->date_diff($n->post_on) ?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>