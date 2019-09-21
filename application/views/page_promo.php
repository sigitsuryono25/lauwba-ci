<?php $this->load->view('headfoot/header') ?>
<div class="container-fluid  promo-container">
<div class="container mt-4">
  <div class="text-light pt-2">
    <div class="row">
      <div class="col-md-12 " style="margin-top: 140px;">
        <div class="newTitle1 d-none d-md-block">
          <h2 class="h4 ml-5 pl-5" id="titleborder"><span>PROMO LAUWBA TECHNO</span></h2>
        </div>
      </div>
      <!--Ini Untuk Mobile-->
      <div class="col-md-12 d-md-none d-block">
        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
        <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
          <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbspPROMO LAUWBA TECHNO</span></h2>
        </div>
      </div>
      <!--Akhir dari Untuk Mobile-->
    </div>
  </div>
</div>
<div class="container mt-4">
  <div class="row">
    <?php foreach($promo as $i=>$value){?>
    <div class="col-md-4">
        
        <!--HAPUS CLASS shadow UNTUK MENGHILANGKAN-->
        <!--GANTI shadow KE shadow-sm UNTUK SHADOW YANG LEBIH KECIL/TIPIS-->
      <div class="card mb-4 border-0 bg-transparent shadow" style="border-radius: 15px 15px 15px 15px">
        <?php if(!empty($value->cover)){?>
            <img class="card-img-top" style="border-radius: 15px 15px 0px 0px" src="<?= $value->cover?>">
        <?php }else{?>
            <img class="card-img-top" style="border-radius: 15px 15px 0px 0px" src="https://lauwba.com/assets/img/default-cover.jpg?<?= md5(time())?>">
        <?php }?>
        <div class="card-body border-0 rounded bg-white">
          <!--<h5 class="card-title text-danger">Judul Promo</h5>-->
          <div class="table-responsive">
            <?php if(strlen($value->nama_voucher) <= 28){?>
            <a class="h5  text-primary  d-block" href="<?= site_url("detail-promo/$value->_id--$value->slug")?>" style="text-decoration: none">
              <?= $value->nama_voucher?><br><br><br>
            </a>
            <?php }else if(strlen($value->nama_voucher) <= 56 && strlen($value->nama_voucher) > 28){?>
            <a class="h5  text-primary  d-block" href="<?= site_url("detail-promo/$value->_id--$value->slug")?>" style="text-decoration: none">
              <?= $value->nama_voucher?><br><br>
            </a>
            <?php }else{?>
            <a class="h5  text-primary  d-block" href="<?= site_url("detail-promo/$value->_id--$value->slug")?>" style="text-decoration: none">
              <?= $value->nama_voucher?>
            </a>
            <?php }?>
          </div>
          <div class="row p-2 mx-2" style="border: dashed 1px #c0c0c0; border-bottom: 0px">
            <div class="col-md-1 col-1">
              <i class="fa fa-calendar text-primary"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Berlaku Sampai</span><br>
              <?php $now = date("Y-m-d")?>
              <span class="font-weight-bold <?= ($value->berlaku < $now) ? "text-danger" : "text-success"?>">
                <?= ($value->berlaku < $now) ? "<del class='small'>".$this->etc->indonesiaDate($value->berlaku, null, null, true)."(Kadaluarsa)</del>" : $this->etc->indonesiaDate($value->berlaku, null, null, true)?>
              </span>
            </div>
          </div>
          <div class="row p-2 mx-2" style="border: dashed 1px #c0c0c0;">
            <div class="col-md-1 col-1">
              <i class="fa fa-ticket text-primary"></i>
            </div>
            <div class="col-md-6 col-7">
              <span>Kode Promo</span><br>
              <div class="table-responsive d-block  overflow-auto">
                <span class="text-danger font-weight-bold small text-uppercase">
                  <?= $value->kode_voucher?>
                </span>
              </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="d-block d-md-flex justify-content-center align-items-center">
                  <a class="btn btn-sm btn-outline-warning my-1 text-center d-block" role="button"
                    onclick="salinKode('<?= strtoupper($value->kode_voucher)?>', '<?= $i?>')">
                      <span class="small font-weight-bold">Salin Kode</span>
                      </a>
                </div>
                <div id="salin-kupon-<?= $i?>" class="text-center"></div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-primary text-center border-0 " style="border-radius: 0px 0px 15px 15px">
          <a href="<?= site_url("detail-promo/$value->_id--$value->slug")?>" class="d-block btn text-uppercase text-white
            font-weight-bold btn">LIHAT DETAIL</a>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
</div>
</div>
<script>
  function salinKode(kode, elemt){
      copyTextToClipboard(kode, elemt);
  }
  function copyTextToClipboard(text, elemt) {
    var textArea = document.createElement("textarea");

    //
    // *** This styling is an extra step which is likely not required. ***
    //
    // Why is it here? To ensure:
    // 1. the element is able to have focus and selection.
    // 2. if the element was to flash render it has minimal visual impact.
    // 3. less flakyness with selection and copying which **might** occur if
    //    the textarea element is not visible.
    //
    // The likelihood is the element won't even render, not even a
    // flash, so some of these are just precautions. However in
    // Internet Explorer the element is visible whilst the popup
    // box asking the user for permission for the web page to
    // copy to the clipboard.
    //

    // Place in the top-left corner of screen regardless of scroll position.
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;

    // Ensure it has a small width and height. Setting to 1px / 1em
    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = '2em';
    textArea.style.height = '2em';

    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;

    // Clean up any borders.
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';

    // Avoid flash of the white box if rendered for any reason.
    textArea.style.background = 'transparent';


    textArea.value = text;

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'successful' : 'unsuccessful';
      var elm = `<small>berhasil disalin</small>`;
      $("#salin-kupon-" + elemt).append(elm);
      $("#salin-kupon-" + elemt).fadeOut(2000, function(){
          $("#salin-kupon-" + elemt).html('');
          $("#salin-kupon-" + elemt).css('display', 'block');
      });
    } catch (err) {
      console.log('Oops, unable to copy');
    }
  }
  $(document).ready(function(){
      $('.promo-container').css("background-color", "#e6e6e62b");
  })
</script>
<!--LOKASI PELAKSANAAN-->
<!--File ada di folder application/view/module_alamat-->
<?php $this->load->view('module_alamat'); ?>
<!--END OF LOKASI PELAKSANAAN-->

<!--TESTIMONI-->
<!--File ada di folder application/view/module_testimoni-->
<?php $this->load->view('module_testimoni'); ?>
<!--END OF TESTIMONI-->

<!--CLIENT-->
<!--File ada di folder application/view/module_client-->
<?php $this->load->view('module_client'); ?>
<!--END OF CLIENT-->

<?php
$this->load->view('headfoot/footer') ?>