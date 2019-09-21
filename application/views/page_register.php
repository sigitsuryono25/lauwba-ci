<?php $this->load->view('headfoot/header') ?>
<br>
<br>
<br>
<br>
<br>
<br>
<h2 class="text-center my-5">FORM PENDAFTARAN</h2>
            
<div class="container">
    <div class="row">
        <div class="col-md-5 d-block justify-content-center">
           <iframe width="100%" height="220" src="https://www.youtube.com/embed/SUPm-NARLm4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           <b>Keterangan : </b><br>
            <li>Bagi yang masih agak bingung cara daftarnya, bisa nonton video diatas </li>
           <li>Bagi yang membutuhkan <b><i>Surat Penawaran</b></i> secara otomatis akan dikirimkan oleh sistem via email setelah mengisi Form Registrasi/pendaftaran </li> 
           <li>Silahkan memilih  <b><i>Corporate Training </b></i>  jika pesertanya lebih dari 1 orang agar bisa mendapatkan harga yang lebih murah serta bisa request tempat serta jadwal pelaksanaannya</li>
           <li>Penjelasan masing-masing jenis <b>Kelas</b> akan muncul setelah Anda Klik/pilih</b>
           <li>Setelah mengisi form Pendaftaran, secara otomatis invoice serta nomor rekening akan muncul dan terkirim via email Anda </li>
        </div>
        <div class="col-md-7" id="info_dasar">
            <br>
                <input type="hidden" name="from" value="<?= (!empty($this->input->get('from'))) ? $this->input->get('from') : 'Lauwba Techno Indonesia'?>" />
                <div class="form-group">
                    <label for="nama-lengkap">Nama Lengkap<span class="text-danger">*</span></label>
                    <input type="text" name="nama-lengkap" id="nama_lengkap" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Anda<span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="" required>
                    <small>Diperlukan untuk mengirimkan invoice ke email anda</small>
                </div>
                <div class="form-group">
                    <label for="nomor-hape">Nomor Hape (WhatsApp)<span class="text-danger">*</span></label>
                    <input type="tel" name="nomor-hape" id="nomor_hp" class="form-control" placeholder="contoh 6282221777206" required>
                    <small class="text-danger">Dengan 62 dan tanpa angka 0 didepan</small>
                </div>
                <div class="form-group">
                    <label for="nama-instansi">Nama Perusahaan/Instansi<span class="text-primary"> (Pilihan. Bisa di isi atau dikosongkan)</span></label>
                    <input type="text" name="nama-instansi" id="nama-instansi" class="form-control" placeholder="">
                    <small class="text-danger">Bila ingin mendaftar In House Training maka silahkan isi kolom ini</small>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan<span class="text-primary"> (Pilihan. Bisa di isi atau dikosongkan)</span></label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="">
                    <small class="text-danger">Bila ingin mendaftar In House Training maka silahkan isi kolom ini</small>
                </div>
                
                <fieldset class="pilihan-kelas border p-4" id="pilihan_kelas_container">
                    <legend>Pilihan Kelas</legend>
                    <div class="radio-kelas text-center">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="inlineCheckbox1" value="reguler" name="pilihan-kelas" data-kategori="reg">
                          <label class="form-check-label" for="inlineCheckbox1"><b>Reguler Class</b></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="inlineCheckbox2"  name="pilihan-kelas" value="private">
                          <label class="form-check-label" for="inlineCheckbox2"><b>Private Class</b></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="inlineCheckbox3"  name="pilihan-kelas" value="inkubator" data-kategori="inkubator">
                          <label class="form-check-label" for="inlineCheckbox3"><b>Bootcamp(Incubator 2-6 Bulan)</b></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="inlineCheckbox4"  name="pilihan-kelas" value="coorporate" data-kategori="in-house">
                          <label class="form-check-label" for="inlineCheckbox4"><b>Corporate Training</b></label>
                        </div>
                    </div>
                    <ul class="nav nav-pills justify-content-center d-none">
                      <li class="nav-item bg-light">
                        <a class="nav-link active kelas border" data-kategori="reg" data-toggle="pill" href="#reguler">Reguler</a>
                      </li>
                      <li class="nav-item bg-light">
                        <a class="nav-link kelas border" data-toggle="pill" href="#private">Private</a>
                      </li>
                      <li class="nav-item bg-light">
                        <a class="nav-link border" data-kategori="inkubator" data-toggle="pill" href="#inkubator">Inkubator</a>
                      </li>
                      <li class="nav-item bg-light">
                        <a class="nav-link border" data-kategori="in-house" data-toggle="pill" href="#coorporate">Coorporate</a>
                      </li>
                    </ul>
                    <br>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        
                        <!--Reguler Tab-->
                        <div class="tab-pane container fade" id="reguler">
                            <div class="form-group text-center">
                                <small><b>Kelas Reguler</b> Pelaksanaan <b><i><u>secara offline tatap muka langsung</u></i></b></small></hr><p>
                            </div>
                            <div class="form-group">
                                <label>Kota Pelaksanaan<span class="text-danger">*</span></label>
                                <select name="reguler-kota" class="form-control" id="kota_pelaksanaan_reguler">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php foreach($kota as $kt){?>
                                        <option value="<?= $kt->daerah?>"><?= $kt->daerah?></option>
                                    <?php }?>
                                </select>
                                <small class="invalid-action-kota text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Kategori Training<span class="text-danger">*</span></label>
                                <select name="kategori" class="form-control">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php foreach($kategori as $kg){?>
                                        <option value="<?= $kg->id_kategori ?>"><?= $kg->nama_kategori?></option>
                                    <?php }?>
                                </select>
                                <small class="invalid-action-kategori text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Pilihan Training<span class="text-danger">*</span></label>
                                <select name="pilihan-training" class="form-control" id="pilihan_training_reguler">
                                    <option value="">-- Pilih Satu --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jadwal">Jadwal Tersedia<span class="text-danger">*</span></label>
                                <select name="jadwal" class="form-control reguler-input" required id="pilihan_jadwal_reguler">
                                    <option value="">-- Pilih Satu --</option>
                                </select>
                            </div>
                        </div>
                        
                        <!--Private Tab-->
                        <div class="tab-pane container fade" id="private">
                            <div class="form-group">
                                 <small><b>Kelas Private: </b> Kelas dengan penanganan khusus, bisa request jadwal sesuai kebutuhannya<b><i>terbatas satu peserta/kls serta tersedia kls tatap muka secara Offlina & Online</u></i></b></small> <p></hr>
                                <label>Jenis Pelaksanaan<span class="text-danger">*</span></label>
                                <select class="form-control" name="jenis-pelaksanaan" id="pelaksanaan_private">
                                    <option value="">-- Pilih Satu --</option>
                                    <option value="private-online">Online</option>
                                    <option value="private-offline">Offline</option>
                                </select>
                                <small class="invalid-action-jenis-pelaksanaan text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai<span class="text-danger">*</span></label>
                                <input type="date" name="private-start-date" class="form-control" id="tanggal_mulai_private">
                            </div>
                            <div class="private-off-additional-info d-none">
                                <div class="form-group private-off-kota">
                                    <label>Kota Pelaksanaan<span class="text-danger">*</span></label>
                                    <select class="form-control" name="private-off-kota" id="kota_private">
                                        <option value="">-- Pilih Satu --</option>
                                        <option value="yogyakarta">Yogyakarta</option>
                                        <option value="luar-yogya">Luar Yogyakarta</option>
                                    </select>
                                </div>
                                <div class="form-group alamat-off-private d-none">
                                    <label>Alamat<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat-private-off" id="alamat_private"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kategori Training<span class="text-danger">*</span></label>
                                <select name="kategori-training-private" class="form-control">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php foreach($kategori as $kg){?>
                                        <option value="<?= $kg->id_kategori ?>"><?= $kg->nama_kategori?></option>
                                    <?php }?>
                                </select>
                                <small class="invalid-action-kategori text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Pilihan Training<span class="text-danger">*</span></label>
                                <select name="pilihan-training-private" class="form-control" id="pilihan_training_private">
                                    <option value="">-- Pilih Satu --</option>
                                </select>
                            </div>
                        </div>
                        
                        <!--Inkubator Tab-->
                        <div class="tab-pane container fade" id="inkubator">
                            <div class="form-group text-center">
                                <small><b>Kelas Inkubator (Bootcamp)</b> Kelas khusus untuk persiapan
memasuki Dunia Kerja atau yang ingin mendalami dari Nol sampai Tuntas. Pendaftaran <b class="text-danger"><i><u>setiap hari</u></i></b> </small></hr>
                            </div>
                            <div class="form-group">
                                <label>Durasi Pelaksanaan (bulan)<span class="text-danger">*</span></label>
                                <select class="form-control" name="durasi-pelaksanaan-inkubator" id="durasi_inkubator">
                                    <?php for($i=2; $i <=6; $i++){?>
                                        <option value="<?= $i?>"><?= $i?> bulan</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group" id="tanggal-pelaksanaan-inkubator">
                                <label>Tanggal Pelaksanaan<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal-start-inkubator" id="tanggal_mulai_inkubator">
                                <small class="invalid-action-durasi-inkubator text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Kategori Training<span class="text-danger">*</span></label>
                                <select name="kategori-training-inkubator" class="form-control">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php foreach($kategori as $kg){?>
                                        <option value="<?= $kg->id_kategori ?>"><?= $kg->nama_kategori?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pilihan Training<span class="text-danger">*</span></label>
                                <select name="pilihan-training-inkubator" class="form-control" id="pilihan_training_inkubator">
                                    <option value="">-- Pilih Satu --</option>
                                </select>
                            </div>
                        </div>
                        
                        <!--Coorporate Tab-->
                        <div class="tab-pane container fade" id="coorporate">
                            <div class="form-group">
                                 <small><b>Corporate Training : </b>Pelatihan Khusus Corporate/Instansi
Untuk Pengembangan   <b class="text-danger"><i><u>skill SDM Perkantoran</u></i></b> </small> <p> <hr>
                                <label>Kota Pelaksanaan (Bisa request Offline/Online)<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="alamat-coorporate" id="alamat_coorporate"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal mulai<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tanggal-start-coorporate" id="tanggal_mulai_coorporate"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal selesai<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tanggal-end-coorporate" id="tanggal_selesai_coorporate"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <small class="invalid-action-tanggal-coorporate text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kategori Training<span class="text-danger">*</span></label>
                                <select name="kategori-training-coorporate" class="form-control">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php foreach($kategori as $kg){?>
                                        <option value="<?= $kg->id_kategori ?>"><?= $kg->nama_kategori?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pilihan Training<span class="text-danger">*</span></label>
                                <select name="pilihan-training-coorporate" class="form-control" id="pilihan_training_coorporate">
                                    <option value="">-- Pilih Satu --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah peserta<span class="text-danger">*</span></label>
                                <select class="form-control" name="jumlah-peserta-coorporate" id="jumlah_peserta_coorporate">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php for($p = 1; $p <= 50; $p++){?>
                                        <option value="<?= $p?>"><?= $p?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group mt-3 bg-warning p-4">
                    <label class="font-weight-bold">Makin Hemat Pakai Promo</label>
                    <div class="input-group bg-warning">
                        <div class="input-group-prepend">
                            <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal-promo">Lihat Promo</a>
                        </div>
                        <input type="text" class="form-control" name='promo' readonly>
                         <div class="input-group-append bg-warning">
                            <a class="btn btn-success" href="javascript:void(0)">Gunakan</a>
                        </div>
                    </div>
                </div>
                
                <div class="form-group harga d-none">
                    <label for="harga">Kontribusi<span class="text-danger">*</span></label>
                    <br>
                    <h4 class="biaya-text h3"></h4>
                    <input type="text" readonly class="form-control-plaintext" name="harga" required>
                </div>
                
                <fieldset class="px-4 mt-4 border">
                    <legend>Info Lain</legend>
                    <div class="form-group">
                        <label for="tahu-darimana">Mengetahui Lauwba Techno Indonesia dari mana<span class="text-danger">*</span> </label>
                        <textarea name="tahu-darimana" id="tahu_darimana" cols="30" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="motivasi">Motivasi Mengikuti Training</label>
                        <textarea name="motivasi" id="motivasi" cols="30" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Tambahan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" class="form-control"></textarea>
                    </div>
                </fieldset>
                
                <fieldset class="px-4 mt-4 border d-none" id="ringkasanBiaya">
                    <legend>Ringkasan Biaya</legend>
                    <table class="table table-sm table-borderles">
                        <tr class="border-0">
                            <td class="border-0 small">Training Terpilih</td>
                            <th class="text-right border-0 small" id="kelas-terpilih">-</th>
                        </tr>
                        <tr>
                            <td class="border-0 small">Harga Normal</td>
                            <th class="text-right border-0 small font-weight-bold" id="harga-normal"><del>Rp. 0</del></th>
                        </tr>
                        <tr class="d-none">
                            <td class="border-0 small" id="kode-voucher">Potongan Harga</td>
                            <th class="text-right border-0 small" id="potongan-harga">Rp. 0</th>
                        </tr>
                        <tr>
                            <td class="border-0 small" id="kode-voucher">Diskon Tambahan</td>
                            <th class="text-right border-0 small font-weight-bold small" id="potongan-diskon">Rp. 0</th>
                        </tr>
                        <tr>
                            <td class="border-0 small">Harga Sekarang</td>
                            <th class="text-right border-0 small" id="harga-sekarang">Rp. 0</th>
                        </tr>
                        <tr>
                            <td class="border-0 small">Total Tagihan</td>
                            <td class="text-right border-0 small" id="total-tagihan">Rp. 0</th>
                        </tr>
                    </table>
                </fieldset>
                
                <div class="form-group text-center mt-4">
                    <input type="submit" value="Simpan" onclick="return submitForm()" class="btn btn-lg btn-primary" name="simpan">
                </div>
            <!--<p class="text-danger">Untuk Kelas <span class="font-weight-bold">Private, Inhouse dan Inkubator</span> silahkan mendaftar via WA. Klik <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=_*DAFTAR%20TRAINING/KURSUS%20Lauwba.com%20:*_%20%0D%0A%20===========%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%0D%0A_*Nama%20:*_%20...%0D%0A%20_*Asal%20Instansi/kampus%20:*_%20...%0D%0A%20_*Kelas%20Yang%20di%20pilih%20%20:*_%20...%0D%0A%20%20%0D%0A%20Catt%20:%20_Bagi%20yg%20bukan%20utusan%20instansi%20atau%20blm%20kuliah%20cukup%20mengisi%20:%20*Pribadi*_">-->
            <!--    disini-->
            <!--</a></p>-->
        </div>
    </div>
</div>
<!--<a class="btn btn-primary" data-target="#modal-transfer" data-toggle="modal"> click aku</a>-->
<div class="modal fade" id="modal-transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informasi Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
          <p>Terima Kasih telah melakukan pendaftaran</p>
          <p>Silahkan melakukan pembayaran sebesar <span class='nominal font-weight-bold'></span> melalui nomor rekening dibawah ini</p>
          <div class="text-center">
              
          <img class="img-fluid w-50 text-center" src="https://www.lauwba.com/411/assets/images/rek-lauwba.png" />
          </div><br>
          <p class="font-weight-bold">Legalitas Perusahaan</p>
          <p >SKT.KEMENKUMHAM RI <br>NO AHU-0022789.AH.01.01</p>
          <p >Nomor NPWP : 91.302.590.4-541.000</p>
          <p >PT. Lauwba Techno Indonesia </p><br>
          
          <p class="font-weight-bold text-danger"><i>Ctt: Harap simpan informasi pembayaran ini</i></p>
          
          <a class="btn btn-primary" href="<?php echo site_url('invoices/'. $row->nextid)?>" target="_blank">Lihat Invoice</a>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      <!--</div>-->
    </div>
  </div>
</div>

<div class="modal fade" id="modal-promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Promo Aktif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group" id="promo-aktif">
            
        </ul>
      </div>
    </div>
  </div>
</div>
<!--General Handler-->
<script>
    var selectedTraining = "";
    var finalPrice = 0;
    var pilkel = "";
    var potonganDiskon = 0;
    var privateDateStart = "";
    var privateOfflineLuarKota = "";
    var kotaSelected = "";
    var pilkelBefore = "";
    var radioPilihanKelas = "";
    var originalRingkasanBiaya = document.getElementById('ringkasanBiaya').innerHTML;
    var alertShow = false;
    var isValidForm = true;
    
    $('[name="pilihan-kelas"]').click(function(e){
        var ktgr = $(this).data('kategori');
        var currentValueId = $(this).val();
        pilkelBefore = radioPilihanKelas;
        radioPilihanKelas = currentValueId;
        pilkel = ktgr;
        if(finalPrice > 0){
            var conf = confirm('Ingin ganti kelas? Semua data yang telah dimasukkan akan hilang. Lanjutkan?');
            if(conf == true){
                $("#ringkasanBiaya").html(originalRingkasanBiaya).addClass("d-none");
                setupResetForm(pilkel);
                $(`.tab-pane`).removeClass("active").addClass("fade");
                $(`#${currentValueId}`).addClass("active").removeClass("fade");
                $("[name='promo']").val('');
                alertShow = false;
                isValidForm = true;
            }else{
                e.preventDefault();
            }  
        }else{
            $(`.tab-pane`).removeClass("active").addClass("fade");
            $(`#${currentValueId}`).addClass("active").removeClass("fade");
        }
        
        console.log(ktgr);
    })
    
    $('.nav-pills a').on('shown.bs.tab', function (e) {
        var kelas = $(this).data('kategori');
        if(typeof kelas != 'undefined'){
            pilkel = kelas;
        }
        var current_tab = e.target;
        var previous_tab = e.relatedTarget;
    });
    $("#modal-promo").on('show.bs.modal', function(){
        $("#promo-aktif").html("Loading...")
        $.get('<?= site_url("infront/get-promo-aktif")?>', function(res){
            $("#promo-aktif").html(res);
        }, 'text');
    });
    
    $("#modal-promo").on('hidden.bs.modal', function(){
        if($("[name='promo']").val() != ""){
            setupKontribusi();
        }
    });
    
    function setPromo(promoCode, potongan){
        if(pilkel == "reg"){
            if($('[name="pilihan-training"]').val() == ""){
                alert("Pilih Training Terlebih dulu");
                $("#modal-promo").modal('hide');
                return;
            }
        }
        
        if(pilkel == "private-online" || pilkel == "private-offline"){
            if($('[name="pilihan-training-private"]').val() == ""){ 
                alert("Pilih Training Terlebih dulu");
                $("#modal-promo").modal('hide');
                return;
            }
        }
        potonganDiskon = potongan
        $("[name='promo']").val(promoCode);
        $("#modal-promo").modal('hide');
    }
    
    function setupKontribusi(){
        if(pilkel == "reg"){
            setupKontribusiReg()
        }else if(pilkel == "private-online"){
            setupKotribusiPrivateOnline();
        }else if(pilkel == "private-offline"){
            setupKotribusiPrivateOffline();
        }else if(pilkel == "inkubator"){
            setupKontribusiInkubator();
        }else if(pilkel == "in-house"){
            setupKontribusiInhouse();
        }
    }
    
    function resetVar(){
        selectedTraining = "";
        finalPrice = 0;
        pilkel = "";
        potonganDiskon = 0;
        privateDateStart = "";
        privateOfflineLuarKota = "";
        kotaSelected = "";
    }
    
    function setupResetForm(pil){
        if(pilkelBefore == "reguler"){
            $('[name="reguler-kota"]').val('');
            $('[name="kategori"]').val("");
            $('[name="pilihan-training"]').html("").html("<option value=''>-- Pilih Satu --</option>");
            $('[name="jadwal"]').html('').html("<option value=''>-- Pilih Satu --</option>");
        }else if(pilkelBefore == "private"){
            $('[name="jenis-pelaksanaan"]').val('');
            $('[name="private-start-date"]').val('');
            $('[name="private-off-kota"]').val('');
            $('[name="alamat-private-off"]').val('');
            $('[name="kategori-training-private"]').val('')
            $('[name="pilihan-training-private"]').html("").html("<option value=''>-- Pilih Satu --</option>");
        }else if(pilkelBefore == "inkubator"){
            $('[name="durasi-pelaksanaan-inkubator"]').val('2');
            $('[name="tanggal-start-inkubator"]').val('');
            $('[name="kategori-training-inkubator"]').val('');
            $('[name="pilihan-training-inkubator"]').html("").html("<option value=''>-- Pilih Satu --</option>");
        }else if(pilkelBefore == "coorporate"){
            $('[name="alamat-coorporate"]').val('');
            $('[name="tanggal-start-coorporate"]').val('');
            $('[name="tanggal-end-coorporate"]').val('');
            $('[name="kategori-training-coorporate"]').val('');
            $('[name="pilihan-training-coorporate"]').html("").html("<option value=''>-- Pilih Satu --</option>");
            $('[name="jumlah-peserta-coorporate"]').val('');
        }
        resetVar();
    }
</script>

<!--Reguler Handler-->
<script>
    $('[name="kategori"]').change(function(){
        if($('[name="reguler-kota"]').val() == ""){
            $(".invalid-action-kota").html("Pilih Kota Pelaksanaan terlebih dulu");
            $('[name="kategori"]').val("");
            return;
        }
        if($(this).val() == ""){
            $('[name="pilihan-training"]').html("").html("<option value=''>-- Pilih Satu --</option>");
            $('[name="jadwal"]').html('').html("<option value=''>-- Pilih Satu --</option>");
        }else{
            $('[name="pilihan-training"]').html('').html("<option value=''>sedang memuat Training...</option>");
            $.get("<?= site_url('infront/get-kelas/') ?>" + $(this).val(), function(res){
                $('[name="pilihan-training"]').html("");
                $('[name="pilihan-training"]').html("<option value=''>-- Pilih Satu --</option>").append(res);
                $('[name="jadwal"]').html('').html("<option value=''>-- Pilih Satu --</option>");
                $("#ringkasanBiaya").addClass("d-none");
            }, 'text');
        }
    });
    $('[name="pilihan-training"]').change(function(){
        if($(this).val() == ""){
             $('[name="jadwal"]').html('').html("<option value=''>-- Pilih Satu --</option>");
        }else{
            kotaSelected = $('[name="reguler-kota"]').find(':selected').text(); 
            $("#kelas-terpilih").html($('[name="pilihan-training"]').find(':selected').text());
            $('[name="jadwal"]').html('').html("<option value=''>sedang memuat jadwal...</option>");
            $.get("<?php echo site_url('welcome/jadwal/')?>" + kotaSelected, function(res){
                $('[name="jadwal"]').html(res); 
                $("#ringkasanBiaya").addClass("d-none");
            });
        }
    });
    $('[name="jadwal"]').change(function(){
        setupKontribusi();
    });
    
    $('[name="reguler-kota"]').change(function(){
        if($(this).val() != ""){
            kotaSelected = $(this).val();
            $(".invalid-action-kota").html("");
            setupKontribusi();
        }
    });
    
    function setupKontribusiReg(){
        var selectedElementTraining = $('[name="pilihan-training"]').find(':selected');
        var biayaReg = selectedElementTraining.data('biaya-reg');
        var biayaRegCoret = selectedElementTraining.data('biaya-reg-coret');
        var biayaLuarKota = selectedElementTraining.data('biaya-reg-luar-kota');
        if(kotaSelected.toLowerCase() == "yogyakarta"){
            var potonganHarga = parseInt(biayaRegCoret.replaceAll(".", "")) - parseInt(biayaReg.replaceAll(".", ""));
            $("#harga-normal").html("Rp. <del>" + biayaRegCoret + "</del>");
            $("#harga-sekarang").html("Rp. " + biayaReg);
            $("#potongan-harga").html("<del><b>Rp. " + numberFormat(potonganHarga) + "</b></del>");
            var hargaSementara = parseInt(biayaReg.replaceAll(".", ""));
            if(potonganDiskon > 0){
                $("#potongan-diskon").html(`(${$("[name='promo']").val()}) Rp. ${numberFormat(potonganDiskon)}`)
                hargaSementara = hargaSementara - parseInt(potonganDiskon); 
            }
            finalPrice = hargaSementara;
            $("#ringkasanBiaya").removeClass("d-none");
            $("#total-tagihan").html(`Rp. ${numberFormat(finalPrice)}`)
            $('[name="harga"]').val(finalPrice);
        }else{
            var potonganHarga = parseInt(biayaRegCoret.replaceAll(".", "")) - parseInt(biayaLuarKota.replaceAll(".", ""));
            $("#harga-normal").html("Rp. <del>" + biayaRegCoret + "</del>");
            $("#harga-sekarang").html("Rp. " + biayaLuarKota);
            $("#potongan-harga").html("<del><b>Rp. " + numberFormat(potonganHarga) + "</b></del>");
            var hargaSementara = parseInt(biayaLuarKota.replaceAll(".", ""));
            if(potonganDiskon > 0){
                $("#potongan-diskon").html(`(${$("[name='promo']").val()}) Rp. ${numberFormat(potonganDiskon)}`)
                hargaSementara = hargaSementara - parseInt(potonganDiskon); 
            }
            finalPrice = hargaSementara;
            $("#ringkasanBiaya").removeClass("d-none");
            $("#total-tagihan").html(`<b>Rp. ${numberFormat(finalPrice)}</b>`)
            $('[name="harga"]').val(finalPrice);
        }
    }
</script>

<!--Private Handler-->
<script>
    $('[name="jenis-pelaksanaan"]').change(function(){
       pilkel = $(this).val();
       $('[name="kategori-training-private"]').val("");
       $('[name="pilihan-training-private"]').html("<option value=''>-- Pilih Satu --</option>");
       $('[name="pilihan-training-private"]').val("");
       if(pilkel == 'private-offline'){
            $(".private-off-additional-info").removeClass('d-none');
       }else{
           $(".private-off-additional-info").addClass('d-none');
       }
    });
    
    $('[name="kategori-training-private"]').change(function(){
        if($('[name="jenis-pelaksanaan"]').val() == ""){
            $(".invalid-action-jenis-pelaksanaan").html('Pilih jenis pelaksanaan terlebih dulu');
            $(this).val("");
            return;
        }
        $('[name="pilihan-training-private]').html('').html("<option value=''>sedang memuat Training...</option>");
        $.get("<?= site_url('infront/get-kelas/') ?>" + $(this).val(), function(res){
            $('[name="pilihan-training-private]').html("");
            $('[name="pilihan-training-private"]').html("<option value=''>-- Pilih Satu --</option>").append(res);
        }, 'text')
    });
    
    $('[name="pilihan-training-private"]').change(function(){
        $("#kelas-terpilih").html($('[name="pilihan-training-private"]').find(':selected').text());
        setupKontribusi();
    });
    
    $('[name="private-off-kota"]').change(function(){
        privateOfflineLuarKota = $(this).val();
        if($(this).val().toLowerCase() !== "yogyakarta"){
           $(".alamat-off-private").removeClass("d-none");
        } else{
           $(".alamat-off-private").addClass("d-none");
        }
    });
    
    function setupKotribusiPrivateOnline(){
        var selectedElementTraining = $('[name="pilihan-training-private"]').find(':selected');
        var biayaPrivateOnline = selectedElementTraining.data('biaya-private-online');
        var biayaPrivateOnlineCoret = selectedElementTraining.data('biaya-private-online-coret');
        
        var potonganHarga = parseInt(biayaPrivateOnlineCoret.replaceAll(".", "")) - parseInt(biayaPrivateOnline.replaceAll(".", ""));
            $("#harga-normal").html("Rp. <del>" + biayaPrivateOnlineCoret + "</del>");
            $("#harga-sekarang").html("Rp. " + biayaPrivateOnline);
            $("#potongan-harga").html("<del><b>Rp. " + numberFormat(potonganHarga) + "</b></del>");
            var hargaSementara = parseInt(biayaPrivateOnline.replaceAll(".", ""));
            if(potonganDiskon > 0){
                $("#potongan-diskon").html(`(${$("[name='promo']").val()}) Rp. ${numberFormat(potonganDiskon)}`)
                hargaSementara = hargaSementara - parseInt(potonganDiskon); 
            }
            finalPrice = hargaSementara;
            $("#ringkasanBiaya").removeClass("d-none");
            $("#total-tagihan").html(`<b>Rp. ${numberFormat(finalPrice)}</b>`)
            $('[name="harga"]').val(finalPrice);
    }
    
    function setupKotribusiPrivateOffline(){
        var selectedElementTraining = $('[name="pilihan-training-private"]').find(':selected');
        var biayaPrivateOffline = (privateOfflineLuarKota.toLowerCase() == "yogyakarta") ? selectedElementTraining.data('biaya-private-offline') : selectedElementTraining.data('biaya-private-offline-luar-kota-coret');
        var biayaPrivateOfflineCoret = (privateOfflineLuarKota.toLowerCase() == "yogyakarta") ? selectedElementTraining.data('biaya-private-offline-coret') :selectedElementTraining.data('biaya-private-offline-luar-kota');
        
        var potonganHarga = parseInt(biayaPrivateOfflineCoret.replaceAll(".", "")) - parseInt(biayaPrivateOffline.replaceAll(".", ""));
            $("#harga-normal").html("Rp. <del>" + biayaPrivateOfflineCoret + "</del>");
            $("#harga-sekarang").html("Rp. " + biayaPrivateOffline);
            $("#potongan-harga").html("<del><b>Rp. " + numberFormat(potonganHarga) + "</b></del>");
            var hargaSementara = parseInt(biayaPrivateOffline.replaceAll(".", ""));
            if(potonganDiskon > 0){
                $("#potongan-diskon").html(`(${$("[name='promo']").val()}) Rp. ${numberFormat(potonganDiskon)}`)
                hargaSementara = hargaSementara - parseInt(potonganDiskon); 
            }
            finalPrice = hargaSementara;
            $("#ringkasanBiaya").removeClass("d-none");
            $("#total-tagihan").html(`<b>Rp. ${numberFormat(finalPrice)}</b>`)
            $('[name="harga"]').val(finalPrice);
    }
</script>

<!--Inkubator Handler-->
<script>
    $('[name="kategori-training-inkubator"]').change(function(){ 
        if($('[name="tanggal-start-inkubator"]').val() == ""){
            $(".invalid-action-durasi-inkubator").html('Pilih Tanggal pelaksanaan dulu');
            $(this).val("");
            return;
        }
        $('[name="pilihan-training-inkubator"]').html('').html("<option value=''>sedang memuat Training...</option>");
        $.get("<?= site_url('infront/get-kelas/') ?>" + $(this).val(), function(res){
            $('[name="pilihan-training-inkubator]').html("");
            $('[name="pilihan-training-inkubator"]').html("<option value=''>-- Pilih Satu --</option>").append(res);
        }, 'text')
    });
    
    $('[name="pilihan-training-inkubator"]').change(function(){
        console.log($("#kelas-terpilih").html($('[name="pilihan-training-inkubator"]').find(':selected').text()));
        setupKontribusi();
    });
    
    function setupKontribusiInkubator(){
        var selectedElementTraining = $('[name="pilihan-training-inkubator"]').find(':selected');
        var durasi = $('[name="durasi-pelaksanaan-inkubator"]').val();
        var biayaInkubator = selectedElementTraining.data('biaya-inkubator');
        var biayaInkubatorCoret = selectedElementTraining.data('biaya-inkubator-coret');
        
        var potonganHarga = parseInt(biayaInkubatorCoret.replaceAll(".", "")) - parseInt(biayaInkubator.replaceAll(".", ""));
        $("#harga-normal").html("Rp. <del>" + biayaInkubatorCoret + "</del>");
        $("#harga-sekarang").html("Rp. " + biayaInkubator + "<br><b><i><u>Kontribusi Bulanan</u></i></b>");
        $("#potongan-harga").html("<del><b>Rp. " + numberFormat(potonganHarga) + "</b></del>");
        var hargaSementara = parseInt(biayaInkubator.replaceAll(".", "")) * parseInt(durasi);
        if(potonganDiskon > 0){
            $("#potongan-diskon").html(`(${$("[name='promo']").val()}) Rp. ${numberFormat(potonganDiskon)}`)
            hargaSementara = hargaSementara - parseInt(potonganDiskon); 
        }
        finalPrice = hargaSementara;
        $("#ringkasanBiaya").removeClass("d-none");
        var catatanInkubator = `<br>(Rp. ${biayaInkubator} x ${durasi} bulan)`;
        $("#total-tagihan").html(`Rp. ${numberFormat(finalPrice)}${catatanInkubator}`);
        $('[name="harga"]').val(finalPrice);
    }
</script>

<!--Cooporate Handler-->
<script>
    $('[name="kategori-training-coorporate"]').change(function(){ 
        if($('[name="tanggal-start-coorporate"]').val() == "" || $('[name="tanggal-end-coorporate"]').val() == ""){
            $(".invalid-action-tanggal-coorporate").html('Pilih Tanggal mulai dan selesai pelaksanaan dulu');
            $(this).val("");
            return;
        }
        $('[name="pilihan-training-coorporate"]').html('').html("<option value=''>sedang memuat Training...</option>");
        $.get("<?= site_url('infront/get-kelas/') ?>" + $(this).val(), function(res){
            $('[name="pilihan-training-coorporate]').html("");
            $('[name="pilihan-training-coorporate"]').html("<option value=''>-- Pilih Satu --</option>").append(res);
        }, 'text')
    });
    
    $('[name="pilihan-training-coorporate"]').change(function(){
        $("#kelas-terpilih").html($('[name="pilihan-training-coorporate"]').find(':selected').text());
    });
    $('[name="jumlah-peserta-coorporate"]').change(function(){
        setupKontribusi();
    })
    
    function setupKontribusiInhouse(){
        var selectedElementTraining = $('[name="pilihan-training-coorporate"]').find(':selected');
        var biayaInhouseCoret = selectedElementTraining.data('biaya-inhouse-coret');
        var biayaInhouseJson = selectedElementTraining.data('biaya-inhouse');
        var getJumlahPeserta = $('[name="jumlah-peserta-coorporate"]').find(":selected").val();
        var biayaInhouse = biayaInhouseJson.biaya_1_2;
        if(getJumlahPeserta >= 1 && getJumlahPeserta <= 2){
            biayaInhouse = biayaInhouseJson.biaya_1_2;
        }else if(getJumlahPeserta >= 3 && getJumlahPeserta <= 5){
            biayaInhouse = biayaInhouseJson.biaya_3_5;
        }else if(getJumlahPeserta > 5 && getJumlahPeserta <= 50){
            biayaInhouse = biayaInhouseJson.biaya_lebih_6;
        }
        var biayaCoretCoorporate = parseInt(biayaInhouseCoret.replaceAll(".", "")) * parseInt(getJumlahPeserta);
        var hargaSementara = parseInt(biayaInhouse) * parseInt(getJumlahPeserta);
        
        var potonganHarga = parseInt(biayaCoretCoorporate) - parseInt(hargaSementara);
        $("#harga-normal").html("Rp. <del>" + numberFormat(biayaCoretCoorporate) + "</del>");
        $("#harga-sekarang").html("Rp. " + numberFormat(hargaSementara) + `<br>(${getJumlahPeserta} peserta x Rp. ${numberFormat(biayaInhouse)})`);
        $("#potongan-harga").html("<del><b>Rp. " + numberFormat(potonganHarga) + "</b></del>");
        if(potonganDiskon > 0){
            $("#potongan-diskon").html(`(${$("[name='promo']").val()}) Rp. ${numberFormat(potonganDiskon)}`)
            hargaSementara = hargaSementara - parseInt(potonganDiskon); 
        }
        finalPrice = hargaSementara;
        $("#ringkasanBiaya").removeClass("d-none");
        $("#total-tagihan").html(`Rp. ${numberFormat(finalPrice)}`);
        $('[name="harga"]').val(finalPrice);
    }
</script>

<!--Insert Handler-->
<script>
    function submitForm(){
        isValidForm = true;
        alertShow = false;
        var infoDasar = {
            'from' : $('[name="from"]').val(),
            'nama_lengkap' : $('[name="nama-lengkap"]').val(),
            'email': $('[name="email"]').val(),
            'nomor_hp': $('[name="nomor-hape"]').val(),
            'nama_instansi' : $('[name="nama-instansi"]').val(),
            'jabatan': $('[name="jabatan"]').val(),
            'kode_ref': '<?= $this->input->get("affiliate")?>',
            'tahu_darimana' : $('[name="tahu-darimana"]').val(),
            'motivasi': $('[name="motivasi"]').val(),
            'keterangan_tambahan': $('[name="keterangan"]').val(),
            'kode_promo': $('[name="promo"]').val(),
            'harga': $("#total-tagihan").text().replace("Rp", "").replaceAll(".", "").replaceAll(" ", "")
        }
        var regulerClass = {
            'kota_pelaksanaan_reguler': $('[name="reguler-kota"]').val(),
            'pilihan_training_reguler': $('[name="pilihan-training"]').val(),
            'pilihan_kelas': pilkel,
            'pilihan_jadwal_reguler': $('[name="jadwal"]').val()
        };
        var privateClass = {
            'pilihan_kelas': pilkel,
            'pelaksanaan_private': $('[name="jenis-pelaksanaan"]').val(),
            'tanggal_mulai_private': $('[name="private-start-date"]').val(),
            'pilihan_training_private': $('[name="pilihan-training-private"]').val(),
            'kota_private': $('[name="private-off-kota"]').val(),
            'alamat_private': $('[name="alamat-private-off"]').val()
        };
        var inkubatorClass = {
            'durasi_inkubator': $('[name="durasi-pelaksanaan-inkubator"]').val(),
            'tanggal_mulai_inkubator': $('[name="tanggal-start-inkubator"]').val(),
            'pilihan_kelas': pilkel,
            'pilihan_training_inkubator': $('[name="pilihan-training-inkubator"]').val()
        };
        var coorporateClass = {
            'alamat_coorporate' : $('[name="alamat-coorporate"]').val(),
            'pilihan_kelas': pilkel,
            'tanggal_mulai_coorporate': $('[name="tanggal-start-coorporate"]').val(),
            'tanggal_selesai_coorporate': $('[name="tanggal-end-coorporate"]').val(),
            'pilihan_training_coorporate': $('[name="pilihan-training-coorporate"]').val(),
            'jumlah_peserta_coorporate': $('[name="jumlah-peserta-coorporate"]').val()
        };
        
        var finalData = {};
        
        
        //validation info Dasar
        for(var key in infoDasar){
            $(`#${key}`).removeClass("is-invalid");
            if(infoDasar[key] =='' && key !=  'kode_ref' && key != 'nama_instansi' && key != 'from' && key != 'jabatan' && key != 'motivasi' && key != 'keterangan_tambahan' && key != 'kode_promo'){
                if(!alertShow){
                    alert("Semua kolom berbintang harus diisi")
                    alertShow = true
                }
                console.log(key);
                $(`#${key}`).addClass("is-invalid");
                $('html, body').animate({scrollTop:$('#info_dasar').position().top}, 'slow');
                isValidForm = false
            }
            if(!isValidForm) { return; }
            else{
                
            }
        }
        
        if(pilkel == ""){
            if(!alertShow){
                alert("Pilih kelas terlebih dahulu");
                alertShow = true;
            }
            $('html, body').animate({scrollTop:$('#pilihan_kelas_container').position().top}, 'slow');
            isValidForm = false;
            return;
        }
        
        if(pilkel == "reg"){
            for(var key in regulerClass){
                $(`#${key}`).removeClass("is-invalid");
                if(regulerClass[key] == ''){
                    if(!alertShow){
                        alert("Semua kolom berbintang harus diisi")
                        alertShow = true
                    }
                    console.log(key);
                    $(`#${key}`).addClass("is-invalid");
                    $('html, body').animate({scrollTop:$('#reguler').position().top}, 'slow');
                    isValidForm = false
                }
            }
            if(!isValidForm) { return; }
            else{
                finalData = Object.assign(infoDasar, regulerClass)
                console.log(finalData);
            }
        }
        
        if(pilkel == "private-offline"){
            for (const key in privateClass) {
                $(`#${key}`).removeClass("is-invalid");
                if(privateClass['kota_private'].toLowerCase() == "yogyakarta"){
                    if(privateClass[key] =='' && key != 'alamat_private'){
                        if(!alertShow){
                            alert("Semua kolom berbintang harus diisi");
                            alertShow = true;
                        }
                        console.log(key);
                        $(`#${key}`).addClass("is-invalid");
                        $('html, body').animate({scrollTop:$('#private').position().top}, 'slow');
                        isValidForm = false
                    }
                }else{
                   if(privateClass[key] ==''){
                        if(!alertShow){
                            alert("Semua kolom berbintang harus diisi");
                            alertShow = true;
                        }
                        console.log(key);
                        $(`#${key}`).addClass("is-invalid");
                        $('html, body').animate({scrollTop:$('#private').position().top}, 'slow');
                        isValidForm = false
                    } 
                }
                
            }
            
            
            if(!isValidForm) { 
                return; 
            }else{
                finalData = Object.assign(infoDasar, privateClass)
                console.log(finalData);
            }
        }
        
        if(pilkel == "private-online"){
            for (const key in privateClass) {
                $(`#${key}`).removeClass("is-invalid");
                if(privateClass[key] =='' && key != 'alamat_private' && key != 'kota_private'){
                    if(!alertShow){
                        alert("Semua kolom berbintang harus diisi");
                        alertShow = true;
                    }
                    console.log(key);
                    $(`#${key}`).addClass("is-invalid");
                    $('html, body').animate({scrollTop:$('#private').position().top}, 'slow');
                    isValidForm = false
                } 
            }
            
            
            if(!isValidForm) { 
                return; 
            }else{
                
                finalData = Object.assign(infoDasar, privateClass)
                console.log(finalData);
            }
        }
        
        if(pilkel == "inkubator"){
            for(var key in inkubatorClass){
                $(`#${key}`).removeClass("is-invalid");
                if(inkubatorClass[key] == ''){
                    if(!alertShow){
                        alert("Semua kolom berbintang harus diisi")
                        alertShow = true
                    }
                    console.log(key);
                    $(`#${key}`).addClass("is-invalid");
                    $('html, body').animate({scrollTop:$('#inkubator').position().top}, 'slow');
                    isValidForm = false
                }
            }
            if(!isValidForm) { return; }
            else{
                finalData = Object.assign(infoDasar, inkubatorClass)
                console.log(finalData);
            }
        }
        
        if(pilkel == "in-house"){
            for(var key in coorporateClass){
                $(`#${key}`).removeClass("is-invalid");
                if(coorporateClass[key] == ''){
                    if(!alertShow){
                        alert("Semua kolom berbintang harus diisi")
                        alertShow = true
                    }
                    console.log(key);
                    $(`#${key}`).addClass("is-invalid");
                    $('html, body').animate({scrollTop:$('#coorporate').position().top}, 'slow');
                    isValidForm = false
                }
            }
            if(!isValidForm) { 
                return; 
            }else{
                finalData = Object.assign(infoDasar, coorporateClass)
                console.log(finalData);
            }
        }
        
        // console.log(JSON.stringify(finalData));
        $('#loading-modal').modal('show');
        $.post('<?= site_url('pendaftaran/pendaftaranProcess')?>', JSON.stringify(finalData), function(res){
            $('#loading-modal').modal('hide');
            pendaftaranDialog(res.message, res.nextid);
        }, 'json');
    }
</script>


<!-- Modal -->
<div class="modal fade" id="loading-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered border-0">
      <div class="modal-content bg-transparent border-0">
        
        <!-- Modal body -->
        <div class="modal-body text-center">
          <div class="d-flex justify-content-center mb-3">
         	 <img src="https://lauwba.com/assets/img/lauwba.gif" width="100" height="100" class="img-fluid"/>
          </div>
          <h3><span class="badge badge-success">Silahkan tunggu<br><br>Sedang Mengirimkan Invoice</span></h3>
        </div>
                
      </div>
    </div>
</div>
<script>
    function numberFormat(val) {
      // remove sign if negative
      var sign = 1;
      if (val < 0) {
        sign = -1;
        val = -val;
      }
      // trim the number decimal point if it exists
      let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
      let len = num.toString().length;
      let result = '';
      let count = 1;
    
      for (let i = len - 1; i >= 0; i--) {
        result = num.toString()[i] + result;
        if (count % 3 === 0 && count !== 0 && i !== 0) {
          result = '.' + result;
        }
        count++;
      }
    
      // add number after decimal point
      if (val.toString().includes(',')) {
        result = result + ',' + val.toString().split(',')[1];
      }
      // return result with - sign if negative
      return sign < 0 ? '-' + result : result;
    }
</script>
<script>
    var isEmbedHeader = "<?php if(isset($_GET['used_header'])){ echo 1;}else{ echo 0;} ?>";
    var isEmbedFooter = "<?php if(isset($_GET['used_footer'])){ echo 1;}else{ echo 0;} ?>";
    $(document).ready(function(){
        if(isEmbedHeader == "1"){
            $("#topbar").addClass("d-none"); 
        }
        if(isEmbedFooter == "1"){
            $(".footer_graph").addClass("d-none"); 
            $(".footer1").addClass("d-none"); 
            $("#back-to-top").addClass("d-none"); 
        }
    });
    function pendaftaranDialog(message, nextid){
        // Swal.fire({
        //   title: "Pendaftaran Berhasil.",
        //   text:message,
        //   icon: "success",
        //   showDenyButton: true,
        //   showCancelButton: true,
        //   confirmButtonText: "Lihat invoice",
        //   denyButtonText: `Surat penawaran`,
        //   cancelButtonText: `Login member`,
        //   confirmButtonColor: "#3085d6",
        //   cancelButtonColor: "#d33",
        //   allowOutsideClick: false,
        //   allowEscapeKey: false,
        //   denyButtonColor: "#28a745",
        // }).then((result) => {
        //   if (result.isConfirmed) {
        //     window.open("<?= site_url('/invoices')?>/" + nextid);
        //   } else if (result.isDenied) {
        //     window.open("<?= site_url('/surat-penawaran') ?>/" + nextid)
        //   } else if(result.isDismissed){
        //     window.open('https://my.lauwba.com/');
        //   }
        // });
        Swal.fire({
          title: "Pendaftaran Berhasil.",
          html: `
            <p>${message}</p>
            <div class="d-flex justify-content-center mt-5">
              <button id="btn-invoice" class="btn btn-primary">
                Lihat Invoice
              </button>
              <button id="btn-penawaran" class="btn btn-success mx-2">
                Surat Penawaran
              </button>
              <button id="btn-login" class="btn btn-danger">
                Login Member
              </button>
            </div>
          `,
          icon: "success",
          showConfirmButton: false, 
          showDenyButton: false, 
          showCancelButton: false,
          allowOutsideClick: true,
          allowEscapeKey: true,
          didOpen: () => {
            document.getElementById('btn-invoice').addEventListener('click', () => {
              window.open("<?= site_url('/invoices')?>/" + nextid);
            });

            document.getElementById('btn-penawaran').addEventListener('click', () => {
              window.open("<?= site_url('/surat-penawaran')?>/" + nextid);
            });

            document.getElementById('btn-login').addEventListener('click', () => {
              window.open("https://my.lauwba.com/");
            });
          }
        }).then((result) => {
          if (result.isDismissed) {
            location.reload(); // 🚀 reload page
          }
        });
    }
</script>
<?php $this->load->view('headfoot/footer')?>