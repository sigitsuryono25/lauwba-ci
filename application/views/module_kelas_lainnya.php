<?php 
$lain = $this->crud->select_where('jenis', "jenis.id_jenis IN('25','26','27') AND  jenis.id_jenis NOT IN('1') ")->result();
?>
<div class="container">
    <div class="row px-4">
        <div class="col-md-12">
            <div class="newTitle1">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Pilihan Kelas Lainnya</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <?php foreach ($lain as $l) { ?>
                <div class="row mb-3 px-3">
                    <div class="py-2 col-md-12 light-shadow">
                        <div class="row" onclick="window.open(`<?php echo site_url($l->routes) ?>`)" style="cursor: pointer">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <img class="lazyload img-fluid" src="<?php echo base_url()?>foto_berita/<?php echo $l->gambar ?>" height="150" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1 text-primary d-none d-md-block">
                                    <h5>
                                        <b class="text-uppercase"><?php echo $l->judul ?></b>
                                        <br>
                                        <!--<small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($l->hrg_coret) ?></del></small>-->
                                        <!--<small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>-->
                                    </h5>
                                </div>
                                <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                    <h5>
                                        <b><?php echo $l->judul ?></b>
                                        <br>
                                        <!--<small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($l->hrg_coret) ?></del></small>-->
                                        <!--<small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>-->
                                    </h5>
                                </div>
                                <p class="my-1 text-justify">
                                    <?php
                                    $string = strip_tags($l->isi_jenis);
                                    if (strlen($string) > 200) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 200);
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