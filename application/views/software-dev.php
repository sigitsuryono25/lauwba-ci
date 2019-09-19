<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="row px-4 ">
        <div class="col-md-12">
            <div id="gallery">
                <h2 class="title1" id="titleborder"><span>IT Training &amp; Course</span></h2>
            </div>
        </div>
        <div class="col-md-12">
            <?php foreach ($kelas as $k) { ?>
                <div class="row mb-3 px-3">
                    <div class="py-2 col-md-12 light-shadow">
                        <div class="row">
                            <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $k->gambar ?>" height="150" width="150">
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
                                    if (strlen($string) > 300) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 300);
                                        $endPoint = strrpos($stringCut, ' ');

                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a class="badge badge-warning" href="' . site_url($k->routes) . '">Selengkapnya</a>';
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
<?php
$this->load->view('headfoot/footer')?>