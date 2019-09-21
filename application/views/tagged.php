<?php $this->load->view('headfoot/header') ?>
<div class="container" style="margin-top: 150px">
    <h4>Kelas</h4>
    <?php
    $sizeJenis = sizeof($jenis);
    if ($sizeJenis == 0) {
        ?>
        <h4 class="text-center">Tidak ada Hasil ditampilkan</h4>
        <?php
    } else {
        foreach ($jenis as $j) {
            ?>
            <div class="row mb-3 px-3">
                <div class="py-2 col-md-12 light-shadow">            
                    <div class="row" onclick="window.open(`<?php echo site_url($j->routes) ?>`)" style="cursor: pointer">
                        <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                            <img class="img-fluid" src="../foto_berita/<?php echo $j->gambar ?>" height="150" width="150">
                        </div>
                        <div class="col-md-10">
                            <div class="mb-1 text-primary d-none d-md-block">
                                <h5>
                                    <b><?php echo $j->judul ?></b>
                                    <br>
                                    <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($j->biaya_coret) ?></del></small>
                                    <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($j->biaya) ?></small>
                                </h5>
                            </div>
                            <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                <h5>
                                    <b><?php echo $j->judul ?></b>
                                    <br>
                                    <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($j->biaya_coret) ?></del></small>
                                    <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($j->biaya) ?></small>
                                </h5>
                            </div>
                            <p class="my-1 text-justify">
                                <?php
                                $string = strip_tags($j->isi_jenis);
                                if (strlen($string) > 300) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 300);
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
            <?php
        }
    }
    ?>
</div>
<div class="container">
    <h4>News</h4>
    <?php
    $sizeNews = sizeof($news);
    if ($sizeNews == 0) {
        ?>
        <h4 class="text-center">Tidak ada Hasil ditampilkan</h4>
        <?php
    } else {
        foreach ($news as $k) {
            ?>
            <div class="row" onclick="window.open(`<?php echo site_url('reader/' . $k->judul_seo) ?>`)" style="cursor: pointer">
                <div class="py-2 col-md-12 light-shadow">
                    <div class="row">
                        <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                            <img class="img-fluid" src="../news/<?php echo $k->foto_news ?>" height="150" width="150">
                        </div>
                        <div class="col-md-10">
                            <div class="mb-1 text-primary d-none d-md-block">
                                <h5>
                                    <b><?php echo $k->jdl_news ?></b>
                                </h5>
                            </div>
                            <p class="my-1 text-justify">
                                <?php
                                $string = strip_tags($k->ket_news);
                                if (strlen($string) > 300) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 300);
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
            <?php
        }
    }
    ?>
</div>
<div class="container d-none">
    <h4>Produk</h4>

    <?php
    $size = sizeof($products);
    if ($size == 0) {
        ?>
        <h4 class="text-center">Tidak ada Hasil ditampilkan</h4>
        <?php
    } else {
        foreach ($products as $p) {
            ?>
            <div class="row" onclick="window.open(`<?php echo site_url('product/details/' . $p->judul_seo) ?>`)" style="cursor: pointer">
                <div class="py-2 col-md-12 light-shadow">
                    <div class="row">
                        <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                            <img class="img-fluid" src="../produk/<?php echo $p->gambar ?>" height="150" width="150">
                        </div>
                        <div class="col-md-10">
                            <div class="mb-1 text-primary d-none d-md-block">
                                <h5>
                                    <b><?php echo $p->nama_produk ?></b>
                                    <br>
                                    <small class="badge badge-success text-center">Rp.<?php echo $this->etc->rps($p->harga) ?></small>
                                </h5>
                            </div>
                            <p class="my-1 text-justify">
                                <?php
                                $string = strip_tags($p->deskripsi);
                                if (strlen($string) > 300) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 300);
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
            <?php
        }
    }
    ?>
</div>
<?php $this->load->view('headfoot/footer') ?>