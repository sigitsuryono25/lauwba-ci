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
                        <img class="img-thumbnail" data-src="./foto_berita/<?php echo $b->gambar ?>"> </div>
                    <div class="d-flex flex-column justify-content-center pl-3 col-lg-9 order-1 order-lg-2">
                        <p class="lead font-weight-bold"><?php echo $b->judul ?></p>
                        <p class="text-justify"><?php
                            $string = strip_tags($b->isi_jenis);
                            if (strlen($string) > 200) {

                                // truncate string
                                $stringCut = substr($string, 0, 200);
                                $endPoint = strrpos($stringCut, ' ');

                                //if the string doesn't contain any space then it will cut without word basis.
                                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '... <a class="badge badge-warning">Selengkapnya</a>';
                            }
                            echo $string;
                            ?></p>
                    </div>
                </div>
                <hr>
                <div class="col-md-4 mb-2 d-block d-md-none" onclick="window.open(`<?php echo site_url($b->routes) ?>`)" style="cursor: pointer">
                    <div class="card text-left"> <img class="card-img-top" data-src="./foto_berita/<?php echo $b->gambar ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="text-uppercase teal font-weight-bold text-left">digital marketing</p>
                            <p class="card-text">
                                <?php
                                $string = strip_tags($b->isi_jenis);
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
                </div>
            <?php } ?>
        </div>
    </div>
</div>