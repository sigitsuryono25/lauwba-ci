<?php 
    if(sizeof($news) > 0){
    foreach ($news as $k) { ?>
        <div class="row text-left" onclick="window.open(`<?php echo site_url('reader/' . $k->judul_seo) ?>`)" style="cursor: pointer">
            <div class="py-2 col-md-12 light-shadow">
                <div class="row">
                    <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                        <img class="img-fluid" src="../../../../news/<?php echo $k->foto_news ?>" >
                    </div>
                    <div class="col-md-10">
                        <div class="mb-1 text-primary">
                            <h5>
                                <b><?php echo $k->jdl_news ?></b>
                                <br>
                                <!--<small class="badge badge-success text-center"><?php echo date_format(date_create($k->post_on), "d-m-Y H:i:s") ?></small>-->
                                <small class="badge badge-success text-center"><?php echo $k->nama_kategori ?></small>
                            </h5>
                        </div>
                        <p class="my-1 text-justify">
                            <?php
                            $string = strip_tags($k->ket_news);
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
    <?php }
    }else {
        echo 0;
    }?>