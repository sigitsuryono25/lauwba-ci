<?php $this->load->view('headfoot/header') ?>
<div class="container px-3" style="margin-top: 160px;">
<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12 ">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Lauwba News: <?php echo $kategori?></span></h2>
                </div>
            </div>
        <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Lauwba News: <?php echo $kategori?></span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
        </div>
    </div>
</div>
    <div class="mt-2">
        <div class="row">
            <?php foreach($news as $itemNews){?>
            <div class="col-md-12 my-3" onclick="window.open(`<?php echo site_url('reader/' . $itemNews->judul_seo) ?>`)" style="cursor: pointer">
                <div class="pull-left mr-3" style="width:140px; height: 140px; 
                background: url('<?php echo base_url("news/".$itemNews->foto_news)?>?v=<?= date('ymdhis')?>'); 
                background-size: cover; 
                background-repeat: no-repeat; 
                background-position: initial">
                    &nbsp;
                </div>
                <div class="meta-data my-1">
                    <h5 class="text-primary"><b><?php echo $itemNews->jdl_news?></b>
                    
                    </h5>
                    <p class="my-1 text-justify">
                        <?php
                        $string = strip_tags($itemNews->ket_news);
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
            <?php }?>
        </div>
    </div>
</div>
<?php $this->load->view('headfoot/footer') ?>