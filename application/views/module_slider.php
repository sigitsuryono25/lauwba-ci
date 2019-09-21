<?php
$slider = $this->crud->select_other('slider', 'order by id_slider desc')->result();
?>
<!--<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;margin-top: 125px;">-->
    <!--<div class="col-md-12">-->
<!--    <div class="carousel slide" data-ride="carousel" id="carousel">-->
<!--        <div class="carousel-inner" >-->
            <?php
           // $no = 1;
            //foreach ($slider as $s) {
              //  if ($no == 1) {
                //    echo '<div class="carousel-item active">';
                //} else {
                 //   echo '<div class="carousel-item">';
            //    }
                ?>
                <!--<img style="height:601px" -->
                <!--     class="lazyload img-fluid d-none d-md-block w-100" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="sliderimages/<?php echo $s->gbr_slider ?>">-->
                     
                <!--<img style="width: 100%;" -->
                <!--     class="lazyload img-fluid d-block d-md-none" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="sliderimages/<?php echo $s->gbr_slider ?>">-->
            <!--</div>-->
            <?php
//            $no++;
  //      }
        ?>
<!--    </div> -->
<!--    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"> -->
<!--        <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> -->
<!--    </a> -->
<!--    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next"> -->
<!--        <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span> -->
<!--    </a>-->
    <!--</div>-->
<!--</div>-->
<?php $promo = $this->db->query("SELECT * FROM `tb_voucher` WHERE is_highlight = 'Y' ORDER BY `tb_voucher`.`_id` DESC LIMIT 1")->row();
$year = date_format(date_create($promo->berlaku), 'Y');
$bulan = date_format(date_create($promo->berlaku), 'n');
$hari = date_format(date_create($promo->berlaku), 'd');
?>
<div class="jumbotron jumbotron-fluid d-flex justify-content-center align-items-center" style=" margin-top: 115px; opacity: .8; background: RED">
  <div class="container">
     <div class="row ">
        <div class="col-md-6 col-12 text-white py-3">
            <!--<h2 style="line-height: 1.5em">PROMO!!!</h2>-->
            <!--<h2 style="line-height: 1.5em">Sambut RAMADHAN 2022</h2>-->
            
            <h2 style="line-height: 1.5em">&nbsp;</h2>
            <h2 style="line-height: 1.5em"><?= $promo->nama_voucher?></h2>
            
            <span class="mt-3">
                <!--DISKON Training hingga 70% + Potongan Tambahan Rp.300.000</br> <b>KODE PROMO : RMD300K </b>-->
                <!--dan Beragam PROMO Menarik Lain Menanti Anda. -->
                <!--| UPGRADE SKILL Anda Sekarang Juga. </br>-->
                <!--<B>DAFTAR Sekarang Sebelum Promo Berakhir!</b>-->
                <?= strip_tags($promo->deskripsi)?>
            </span><br>
            <div id="countdown" class="row justify-content-center align-items-center mt-3"></div>
            <!--<div class="clock my-3 w-100"></div>-->
            <button onclick="location.assign('<?= site_url('detail-promo/'. $promo->_id.'--'.$promo->slug)?>')" style="background: #ff9800;border-radius: 1.5rem !important;box-shadow: 3px 3px rgb(255 176 77 / 32%);"
            class="btn btn-lg rounded d-block align-items-center text-center text-white mt-3 font-weight-bold">Lihat Selengkapnya</button>
            <br>
        </div>
        <div class="col-md-6 col-12">
            <img fetchpriority="high" class="img-fluid" src="<?= base_url()?>assets/img/PROMO KURSUS ANDROID lauwba.webp?hash=<?= time()?>" alt="promo image">
        </div>
     </div>
  </div>
</div>

<script defer>
        $('#countdown').countdown({
            year: <?= $year?>,// YYYY Format
            month: <?= $bulan?>,// 1-12
            day: <?= $hari?>,// 1-31
            hour: 0,// 24 hour format 0-23
            minute: 0,// 0-59
            second: 0,
        });
    </script>