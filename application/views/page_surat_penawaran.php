<meta name="google-site-verification" content="3Da4gClCauXNcyKq1r5YDnYLSQUidKmnUDrpRv5ILTc" />
<?php $this->load->view('headfoot/header') ?>
<!--<div class="container mt-4">-->
<!--    <div class="text-light pt-2">-->
<!--        <div class="row" style="margin-top: 120px">-->
<!--            <div class="col-md-12">-->
<!--            <div class="newTitle1 d-none d-md-block">-->
<!--                <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Surat Penawaran</span></h2>-->
<!--            </div>-->
<!--        </div>-->
        
<!--        <div class="col-md-12 d-md-none d-block">-->
<!--            <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title"/>-->
<!--            <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">-->
<!--                <h2 class="h6 ml-5 pl-4 " id="titleborder"><span> &nbsp Surat Penawaran</span></h2>-->
<!--            </div>-->
<!--        </div>-->
      
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<br>&nbsp;
<br>&nbsp;
<br>&nbsp;
<br>&nbsp;
<br>&nbsp; <center><H2>FORM SURAT PENAWARAN</H2></center>
<div class="container mt-4" style="height: 100vh">
    <form class="formNomorPendaftaran">
        <div class="form-group">
            <label>Nomor Pendaftaran/Tagihan</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Nomor Pendaftaran/Tagihan" name="nomor-pendaftaran"/>
                <div class="input-group-append">
                    <input type="submit" class="btn btn-success btn-sm" value="Cari" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <a data-toggle="modal" data-target="#exampleModal" href="javascript:void(0)">Dimana saya bisa mendapatkan Nomor Pendaftaran/Tagihan?</a>
        </div>
        <div class="form-group">
            <h6 class="text-danger"><b>Berkas-berkas pendukung lainnya jika dibutuhkan:</b></h6>
            <ul style="list-style: none;">
                <li class="text-decoration-none"><a href="https://lauwba.com/assets/berkas-pendukung/company-profile-pt-lauwba-techno-indonesia.pdf" download="" class="text-primary font-weight-bold">Company Profile</a></li>
                <li class="text-decoration-none"><a href="https://lauwba.com/assets/berkas-pendukung/npwp-pt-lauwba-techno-indonesia.png" download="" class="text-primary font-weight-bold">NPWP</a></li>
                <li class="text-decoration-none"><a href="https://lauwba.com/assets/berkas-pendukung/form-registrasi.xlsx" download="" class="text-primary font-weight-bold">Form Registrasi</a></li>
            
            </ul>
        </div>
    </form>
    <div class="response-penawaran">
        
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nomor Pendaftaran/Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
            <img src="<?= base_url('assets/berkas-pendukung/nomor-tagihan.png')?>" class="img-fluid" alt="nomor-pendaftaran" />    
        </div>
        <p class="text-center">Nomor tagihan berada disebelah kanan tanda pagar</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(".formNomorPendaftaran").on("submit", function(e){
        e.preventDefault();
        window.open("<?= site_url("surat-penawaran/")?>" + $('[name="nomor-pendaftaran"]').val());
    })
</script>

<?php $this->load->view('headfoot/footer') ?>