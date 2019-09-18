<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="card- bg-primary text-light pt-2 mb-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-uppercase text-center">Lauwba News</h2>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php foreach ($news as $k) { ?>
        <div class="row" onclick="window.open(`<?php echo site_url('reader/' . $k->judul_seo) ?>`)" style="cursor: pointer">
            <div class="py-2 col-md-12 light-shadow">
                <div class="row">
                    <div class="text-center col-md-2 d-block align-self-center justify-content-center">
                        <img class="img-fluid" src="http://www.lauwba.com/foto_berita/<?php echo $k->foto_news ?>" height="150" width="150">
                    </div>
                    <div class="col-md-10">
                        <div class="mb-1 text-primary d-none d-md-block">
                            <h5>
                                <b><?php echo $k->jdl_news ?></b>
                                <br>
                                <small class="badge badge-success text-center"><?php echo date_format(date_create($k->post_on), "d-m-Y H:i:s") ?></small>
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
                                $string .= '... <a class="badge badge-warning" href="' . site_url($k->judul_seo) . '">Selengkapnya</a>';
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
<?php
$this->load->view('headfoot/footer')?>