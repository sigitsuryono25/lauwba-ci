<?php $video = $this->crud->select('video')->result();?>
<div class="container carousel-container mt-5">
    <div class="row px-4">
        <div class="col-md-12">
                        <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Video</span></h2>
            </div>
        </div>
                <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Video</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
        <div class="col-md-12">
            <div class="row">
                <?php foreach($video as $key=>$v){
                if($key <=5){
                ?>
                    <div class="col-md-4 youtube" data-embed="<?=  $v->link?>" data-title="<?= $v->jdl_video?>">
                        <img src="../../video/thumbnails/<?= $v->thumbnail?>" style="height: 200px" class="w-100" alt="<?=  $v->jdl_video?>" />
                        <div class="play-overlay">
                            <img src="/img/youtube-player.png" alt="youtub player place holder">
                        </div>
                        <label class="mt-2"><?= $v->jdl_video?></label>
                    </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
        <a class="btn btn-sm btn-success my-3 mx-4" href="#">Selengkapnya</a>
    </div>
</div>
<script>
    $('.carousel-container').hover(function(){
       $("#testimoni").carousel('pause');
    },function(){
       $("#testimoni").carousel('cycle');
    });
</script>