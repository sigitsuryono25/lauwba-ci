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
                <div class="row mb-3 px-3" onclick="location.href = '<?php echo site_url($k->routes) ?>'" style="cursor: pointer">
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
    <div class="container">
        <div class="row px-4">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>Jadwal Kursus dan Training Kelas Regular</span></h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th rowspan="2">Training</th>
                                <th>Kota</th>
                                <th>Jadwal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $j) { ?>
                                <tr>
                                    <td ><?php echo $j->judul ?></td>
                                    <td><?php echo $j->kota ?><br><?php echo $j->kota1 ?></td>
                                    <td><?php echo $j->jadwal ?><br><?php echo $j->jadwal1 ?></td>
                                    <td><?php echo $j->keterangan ?><br><?php echo $j->keterangan1 ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row px-4">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>Pilihan Kelas Lainnya</span></h2>
                </div>
            </div>
            <div class="col-md-12">
                <?php foreach ($lain as $l) { ?>
                    <div class="row mb-3 px-3">
                        <div class="py-2 col-md-12 light-shadow">
                            <div class="row" onclick="window.open(`<?php echo site_url($l->routes) ?>`)" style="cursor: pointer">
                                <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                                    <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $l->gambar ?>" height="150" width="150">
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-1 text-primary d-none d-md-block">
                                        <h5>
                                            <b><?php echo $l->judul ?></b>
                                            <br>
                                            <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                            <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                        </h5>
                                    </div>
                                    <div class="d-block d-md-none mb-1 mt-1 text-primary text-center">
                                        <h5>
                                            <b><?php echo $l->judul ?></b>
                                            <br>
                                            <small class="text-danger font-weight-bold"><del>Rp. <?php echo $this->etc->rps($k->biaya_coret) ?></del></small>
                                            <small class="badge badge-success text-center">Rp. <?php echo $this->etc->rps($l->hrg) ?></small>
                                        </h5>
                                    </div>
                                    <p class="my-1 text-justify">
                                        <?php
                                        $string = strip_tags($l->isi_jenis);
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
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row px-2">
            <div class="col-md-12">
                <div id="gallery">
                    <h2 class="title1" id="titleborder"><span>BIMBTEK CLASS</span></h2>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <h4 class="text-uppercase">bimbingan teknis 2019/2020</h4>
                <p class="lead">Kelas Bimbingan Teknis Khusus Untuk Instansi Pemerintahan & Swasta di Bidang IT 2019/2020</p>
                <p>Bagi Instansi yang membutuhkan surat penawaran BIMTEK dari kami langsung 
                    <a class="font-weight-bold" target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Hallo%20Admin,%20apakah%20bisa%20dikirimkan%20%20surat%20penawaran%20untuk%20BIMTEK?">KLIK DISINI</a></p>

                <hr>
            </div>
            <div class="col-md-12 mx-2">
                <?php foreach ($bimtek as $b) { ?>
                    <div class="row mb-2  d-none d-md-flex" onclick="window.open(`<?php echo site_url($b->routes) ?>`)" style="cursor: pointer">
                        <div class="p-0 col-lg-3 order-2 order-lg-1"> 
                            <img class="img-thumbnail" src="http://www.lauwba.com/foto_berita/<?php echo $b->gambar ?>"> </div>
                        <div class="d-flex flex-column justify-content-center pl-3 col-lg-9 order-1 order-lg-2">
                            <p class="lead font-weight-bold"><?php echo $b->judul ?></p>
                            <p class="text-justify"><?php
                                $string = strip_tags($b->isi_jenis);
                                if (strlen($string) > 400) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 400);
                                    $endPoint = strrpos($stringCut, ' ');

                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    $string .= '... <a class="badge badge-warning" href="' . site_url($b->routes) . '">Selengkapnya</a>';
                                }
                                echo $string;
                                ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-4 mb-2 d-block d-md-none" onclick="window.open(`<?php echo site_url($b->routes) ?>`)" style="cursor: pointer">
                        <div class="card text-left"> <img class="card-img-top" src="http://www.lauwba.com/foto_berita/<?php echo $b->gambar ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="text-uppercase teal font-weight-bold text-left">digital marketing</p>
                                <p class="card-text">
                                    <?php
                                    $string = strip_tags($b->isi_jenis);
                                    if (strlen($string) > 400) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 400);
                                        $endPoint = strrpos($stringCut, ' ');

                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a class="badge badge-warning" href="' . site_url($b->routes) . '">Selengkapnya</a>';
                                    }
                                    echo $string;
                                    ?>    
                                </p>
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