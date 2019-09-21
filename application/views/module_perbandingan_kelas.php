<!--EDIT HALAMAN PERBANDINGAN KELAS DI page_class_compariso.php. Load module ini pake iframe, karena beda versi bootstrap--> 

<div class="container">
    <div class="col-md-12 pt-4" style="margin-top: 120px;">
        <div class="newTitle1 d-none d-md-block">
            <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Kontribusi</span></h2>
        </div>
    </div>
    <!--Ini Untuk Mobile-->
    <div class="col-md-12 d-md-none d-block">
        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" alt="lauwba layer"
            class="bg-title" />
        <div class="newTitle1Mobile"
            style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
            <h2 class="h5 ml-5 pl-4 " id="titleborder"><span>&nbsp;&nbsp;&nbsp;Kontribusi</span></h2>
        </div>
    </div>
    <p>Biaya Training/kursus dapat berubah sewaktu-waktu, <b>gunakan kesempatan Emas Biaya PROMO</b> yang sedang berlangsung</p>
    <iframe id="kelas-compare" onLoad="autoResize();" marginheight="0" frameborder="0" src="<?= site_url('infront/perbedaan-kelas?uuid='. $id_jenis)?>" class="w-100"></iframe>
</div>