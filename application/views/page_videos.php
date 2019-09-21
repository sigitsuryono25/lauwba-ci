<?php 
$parts = $this->uri->segment(3);
echo $parts;
if(!empty($parts)){
    $title = " ". $this->db->query("SELECT * FROM kategori_video WHERE slug IN ('$parts')")->row()->nama_kategori;
    $video = $this->db->query("SELECT * FROM video INNER JOIN kategori_video ON video.kategori=kategori_video.id_kategori WHERE slug IN ('$parts')")->result();
    // $title = " ".$video[0]->nama_kategori;
    // print_r($video);
}else{
    $video = $this->crud->select('video')->result();
    $title = "";
}
?>
<?php $this->load->view('headfoot/header') ?>
<div class="container">
    <div class="pt-2 mb-4">
        <div class="row">
            <div class="col-md-12 pt-4" style="margin-top: 120px;">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Video<?= $title?></span></h2>
                </div>
            </div>
            <!--Ini Untuk Mobile-->
            <div class="col-md-12 d-md-none d-block">
                <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px"
                    class="bg-title" />
                <div class="newTitle1Mobile"
                    style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Video</span></h2>
                </div>
            </div>
            <!--Akhir dari Untuk Mobile-->
            <div class="row py-2">
                <?php foreach($video as $key=>$v){
                if($key <=5){
                ?>
                    
                    <div class="col-md-4 my-2 youtube" data-embed="<?=  $v->link?>" data-title="<?= $v->jdl_video?>">
                        <img src="https://img.youtube.com/vi/<?=  $v->link?>/hqdefault.jpg" style="height: 200px" class="w-100" alt="<?=  $v->jdl_video?>" />
                        <div class="play-overlay">
                            <img src="/img/youtube-player.png" >
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
    <!--<div class="container text-center mt-4">-->
    <!--<h1 class="font-weight-bold">Kontak</h1>-->
    <!--    <a class="text-dark" target="_blank" href="<?php //echo base_url() ?>"><span class="fa fa-globe "></span> <?php //echo base_url() ?></a><br/>-->
    <!--    <a class="text-dark" target="_blank" href="http://www.facebook.com/LauwbaTechno"><span class="fa fa-facebook-square "></span> Lauwba Techno Indonesia</a><br/>-->
    <!--    <a class="text-dark" target="_blank" href="https://twitter.com/@lauwbatechno"><span class="fa fa-twitter-square "></span> @lauwbatechno</a>-->
    <!--</div>-->
    <script>
        document.title= "Video<?= $title?> Lauwba Techno Indonesia";
    </script>
    <?php
$this->load->view('headfoot/footer')?>