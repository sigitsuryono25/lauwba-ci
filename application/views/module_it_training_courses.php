<?php 
    $kelas = $this->crud->select_join('kelas', 'jenis', 'id_jenis', "WHERE kelas.id_jenis NOT IN('1') ORDER BY jenis.seq ASC")->result();
?>
<div class="container">
    <div class="row px-4 ">
        <div class="col-md-12">
                     <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>IT Training &amp; Courses</span></h2>
            </div>
        </div>
        
                <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>&nbsp &nbsp IT Training &amp; Courses</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
        
        <div class="col-md-12">
            <?php foreach ($kelas as $k) { ?>
                <div class="row mb-3 px-3">
                    <div class="py-2 col-md-12 light-shadow">            
                        <div class="row" onclick="window.open(`<?php echo site_url($k->routes) ?>`)" style="cursor: pointer">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <?php $src = json_decode($k->image_srcset, true);?>
                                <?php if(!empty($src)){?>
                                <picture>
                                    <source 
                                        type="image/webp"
                                        srcset="
                                          <?= base_url("/foto_berita/".$src['480']) ?> 480w,
                                          <?= base_url("/foto_berita/".$src['720']) ?> 720w,
                                          <?= base_url("/foto_berita/".$src['1080']) ?> 1080w,
                                          <?= base_url("/foto_berita/".$src['1440']) ?> 1440w
                                        "
                                        sizes="100vw"
                                    >
                                    <img src="<?php echo base_url()?>foto_berita/<?php echo $k->gambar?>?v=<?= date('ymdhis')?>" alt="<?= $k->judul ?>" height="84" width="140">
                                </picture>
                                <?php }else{?>
                                <img class="lazyload img-fluid" alt="<?php echo $k->judul ?>" src="<?php echo base_url()?>foto_berita/<?php echo $k->gambar?>?v=<?= date('ymdhis')?>" height="84" width="140">
                                <?php }?>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya) ?></small>
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $k->judul ?></b>
                                        <br>
                                        <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                        <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($k->biaya) ?></small>
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($k->isi_jenis);
                                    if (strlen($string) > 150) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 150);
                                        $endPoint = strrpos($stringCut, ' ');

                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
                                    }
                                    echo $string;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>