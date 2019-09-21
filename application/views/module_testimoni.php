<?php $testimoni = $this->crud->select('testimoni')->result();?>
<?php $multiplier = 5?>
<div class="container carousel-container mt-5">
    <div class="row">
        <div class="col-md-12">
                        <div class="newTitle1 d-none d-md-block">
                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Customer Stories</span></h2>
            </div>
        </div>
                <!--Ini Untuk Mobile-->
        <div class="col-md-12 d-md-none d-block">
            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>Customer Stories</span></h2>
            </div>
        </div>
        <!--Akhir dari Untuk Mobile-->
        <div class="col-md-12">
            <div id="testimoni" class="carousel slide" data-ride="carousel" data-interval="4000">
                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <?php if ($i == 0) { ?>
                            <li data-target="#testimoni" data-slide-to="<?php echo $i ?>" class="active"></li>
                        <?php } else { ?>
                            <li data-target="#testimoni" data-slide-to="<?php echo $i ?>"></li>
                            <?php
                        }
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <?php if ($i == 0) { ?>
                            <div class="carousel-item active "style="padding-left: 5%;padding-right: 5%;">
                                <div class="row mb-3">
                                    <?php 
                                    $limit = $i*$multiplier;
                                    $testimoni = $this->db->query("SELECT * FROM `testimoni` ORDER BY tanggal DESC LIMIT $limit, $multiplier")->result();
                                    foreach($testimoni as $t){
                                    ?>
                                    <div class="col-md-12 mb-3 p-0 d-none d-md-block">
                                        <div class="row">
                                            <div class="col-md-2 p-0">
                                                 <div style="width: 120px;height: 120px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block rounded-circle"></div>
                                            </div>
                                         

                                            <div class="col-md-10  p-0">
                                                <div >
                                                      
                                            <h5 class="teal"><b><?php echo $t->nama_pemberi?></b></h5>
                                             <img alt="lauwba-rating" src="https://lauwba.com/img/rating-lauwba.jpg">
                                            <div>
                                                 <i><?php echo $t->testimoni?></i>
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                                          <div style="width: 120px;height: 120px;  
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 d-block rounded-circle"></div>
                                        <div >
                                            <h5 class="teal"><b><?php echo $t->nama_pemberi?></b></h5>
                                             <img alt="lauwba-rating" src="https://lauwba.com/img/rating-lauwba.jpg">
                                            <div>
                                                <i><?php echo $t->testimoni?></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        <?php } else if ($i == 1) { ?>
                            <div class="carousel-item" style="padding-left: 5%;padding-right: 5%;">
                                <div class="row mb-3">
                                    <?php 
                                    $limit = $i*$multiplier;
                                    $testimoni = $this->db->query("SELECT * FROM `testimoni` ORDER BY tanggal DESC LIMIT $limit, $multiplier")->result();
                                    foreach($testimoni as $t){
                                    ?>
                                    <div class="col-md-12 mb-3 p-0 d-none d-md-block">
                                        <div style="width: 120px;height: 120px; 
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block rounded-circle"></div>
                                        <div >
                                            <h5 class="teal"><b><?php echo $t->nama_pemberi?></b></h5>
                                             <img alt="lauwba-rating" src="https://lauwba.com/img/rating-lauwba.jpg">
                                            <div>
                                                <i><?php echo $t->testimoni?></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                                          <div style="width: 120px;height: 120px;  
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 d-block rounded-circle"></div>
                                         <div >
                                            <h5 class="teal"><b><?php echo $t->nama_pemberi?></b></h5>
                                             <img alt="lauwba-rating" src="https://lauwba.com/img/rating-lauwba.jpg">
                                            <div>
                                                 <i><?php echo $t->testimoni?></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                    <?php } else if ($i == 2) { ?>
                        <div class="carousel-item" style="padding-left: 5%;padding-right: 5%;">
                            <div class="row mb-3">
                                <?php 
                                    $limit = $i*$multiplier;
                                    $testimoni = $this->db->query("SELECT * FROM `testimoni` ORDER BY tanggal DESC LIMIT $limit, $multiplier")->result();
                                    foreach($testimoni as $t){
                                    ?>
                                    <div class="col-md-12 mb-3 p-0 d-none d-md-block">
                                         <div style="width: 120px;height: 120px;  
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 pull-left d-block rounded-circle"></div>
                                         <div >
                                            <h5 class="teal"><b><?php echo $t->nama_pemberi?></b></h5>
                                             <img alt="lauwba-rating" src="https://lauwba.com/img/rating-lauwba.jpg">
                                            <div>
                                                 <i><?php echo $t->testimoni?></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p-0 d-block d-md-none">
                                          <div style="width: 120px;height: 120px;  
                                             background: url(<?php echo base_url("testimoni/".$t->foto)?>);
                                             background-position: unset;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                             " class="mr-4 d-block rounded-circle"></div>
                                       <div >
                                            <h5 class="teal"><b><?php echo $t->nama_pemberi?></b></h5>
                                             <img alt="lauwba-rating" src="https://lauwba.com/img/rating-lauwba.jpg">
                                            <div>
                                                 <i><?php echo $t->testimoni?></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <a class="news carousel-control-prev" href="#testimoni" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="news carousel-control-next" href="#testimoni" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
        <a class="btn btn-sm btn-success my-3 mx-4" href="<?php echo site_url('infront/testimoni')?>">Selengkapnya</a>
    </div>
</div>
<script>
    $('.carousel-container').hover(function(){
       $("#testimoni").carousel('pause');
    },function(){
       $("#testimoni").carousel('cycle');
    });
    
</script>