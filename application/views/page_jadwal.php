<?php $this->load->view('headfoot/header') ?>
<?php
$jdwl = $jadwal['sekarang'];
$jdwlBulanDepan = $jadwal['bulan_depan'];
$judulSsekarang = $jadwal['judul_sekarang'];
$judulBulanDepan = $jadwal['judul_bulan_depan'];
?>

<div class="container" style="margin-top: 180px;">

    
    <div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12 mt-4">
            <div class="reg">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal CORPORATE TRAINING</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal CORPORATE  TRAINING</span></h2>
                    </div>
                </div>

                <!--Akhir dari Untuk Mobile-->

                <div class="col-md-12">

                    <center class="text-dark">
                        <b><i> TRAINING For Corporate/Instansi</i> </b> <br>
                        <b><i> Untuk  INHOUSE TRAINING/DIKLAT/BIMTEK/PUBLIC TRAINING </b> by request atau sesuai kebutuhan Instansi/Korporasi</i><br>
                        <b><i> DURASI kelasnya yaitu selama 2 sampai 4 hari dari jam 08.30 - 16.00 (kondisional sesuai request instansi)</i></b><br>
                           <b><i>PELAKSANAAN </b> bisa Offline atau Online sesuai request dari awal</i>
                    </center>
                </div>

            </div>
        </div>
    </div>
    
    

<!--REGULAR ONLINE-->
<div class="container mt-4" id="reguler-online">
    <div class="row mb-3">
        <div class="col-md-12 mt-4">
            <div class="reg">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal Kelas REGULER Yogyakarta</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal Kelas REGULER Yogyakarta</span></h2>
                    </div>
                </div>

                <!--Akhir dari Untuk Mobile-->

                <div class="col-md-12">

                    <center class="text-dark">
                        <b><i> Untuk Kelas REGULER Yogyakarta </b> Mengikuti Jadwal yang Tersedia (Lihat Jadwal dibawah ini)</i><br>
                        <b><i> DURASI Kursus Selama 4 Hari dari Jam 08.30 - 15.30</i></b>
                    </center>
                </div>

            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-md-6 col-12">
            <h4 class="text-center"><u><?= $judulSsekarang ?></u></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Jadwal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jdwl as $j) {
                            if(strtolower($j->kota_pelaksanaan) == "yogyakarta"){
                        ?>
                            <tr>
                                <td class="align-middle"><?= $j->tanggal ?></td>
                                <td class="align-middle"><?php
                                                            if (strtolower($j->keterangan) == "full booked") {
                                                                echo "<span class='badge badge-danger text-capitalize'>$j->keterangan</span>";
                                                            } else if (strtolower($j->keterangan) == "2 seats available") {
                                                                echo "<span class='badge badge-warning text-capitalize'>$j->keterangan</span>";
                                                            } else {
                                                                echo "<span class='badge badge-success text-capitalize'>$j->keterangan</span>";
                                                            } ?>
                                </td>
                            </tr>
                        <?php } 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <h4 class="text-center"><u><?= $judulBulanDepan ?></u></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Jadwal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jdwlBulanDepan as $j) { 
                        if(strtolower($j->kota_pelaksanaan) == "yogyakarta"){
                        ?>
                            <tr>
                                <td class="align-middle"><?= $j->tanggal ?></td>
                                <td class="align-middle"><?php
                                                            if (strtolower($j->keterangan) == "full booked") {
                                                                echo "<span class='badge badge-danger text-capitalize'>$j->keterangan</span>";
                                                            } else if (strtolower($j->keterangan) == "2 seats available") {
                                                                echo "<span class='badge badge-warning text-capitalize'>$j->keterangan</span>";
                                                            } else {
                                                                echo "<span class='badge badge-success text-capitalize'>$j->keterangan</span>";
                                                            } ?>
                                </td>
                            </tr>
                        <?php }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--END OF REGULAR ONLINE-->



<div class="container mt-4">
    <div class="text-light pt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span> Jadwal PRIVATE CLASS</span></h2>
                </div>
            </div>
            <!--Ini Untuk Mobile-->
            <div class="col-md-12 d-md-none d-block">
                <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbsp &nbsp &nbsp Jadwal Kelas PRIVATE</span></h2>
                </div>
            </div>
            <!--Akhir dari Untuk Mobile-->
            <div class="col-md-12">
                <center class="text-dark">
                    <h4>Kelas Private ONLINE & OFFLINE</h4> <br>
                    <b>Durasi Kursus :</b> Selama <b><i> 1 Bulan</b> (sampai materi selesai & peserta sudah paham/bisa)</i><br>
                    <b>Waktu Pelaksanaan : </b><i> Bisa Request Jadwal Sesuai Kebutuhannya yaitu <b> 1 sampai 4 kali </b> pertemuan dalam sepekan</i><br>
                        <b>Pilihan Hari & Durasi : </b><i> Senin-Ahad, Bisa request 3 jam/pertemuan atau full day 5 jam/pertemuan</i>
                </center>
            </div>

</div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12 mt-4">
            <div class="reg">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal INCUBATOR CLASS(Bootcamp)</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal Kelas INCUBATOR(Bootcamp)</span></h2>
                    </div>
                </div>

                <!--Akhir dari Untuk Mobile-->

                <div class="col-md-12">

                    <center class="text-dark">
                        <b><i> Untuk Kelas BARU INCUBATOR(Bootcamp) </b>  dibuka setiap hari </i><br>
                        <b><i> DURASI kelasnya yaitu sesuai pilihan pada saat registrasi antara 2 sampai 6 bulan</b> (3 sampai 4x pertemuan dalam sepekan Full day : 08.30/09.00 -12.00  Materi & 13.00 - 15:00 Latihan Praktek Study Kasus)</i>
                    </center>
                </div>

            </div>
        </div>
    </div>
</div>
    


<div class="container mt-4" id="reguler-offline">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="reg">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal Kelas REGULER (12 Kota) </span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal Kelas REGULER(12 Kota)</span></h2>
                    </div>
                </div>

                <!--Akhir dari Untuk Mobile-->

                <div class="col-md-12">

                    <center class="text-dark">

                        <b><i> Untuk Kelas REGULER OFFLINE DI SELURUH INDONESIA</b> Mengikuti Jadwal yang Tersedia (Lihat Jadwal & Tempat Pelaksanaan dibawah ini)</i><br>
                        <b><i> DURASI Kursus Selama 4 Hari dari Jam 08.30 - 15.30</i></b>
                    </center>
                </div>

            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-md-6 col-12">
            <h4 class="text-center"><u><?= $judulSsekarang ?></u></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Kota</th>
                            <th>Jadwal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jdwl as $j) { ?>
                            <tr>
                                <td class="align-middle"><?= $j->kota_pelaksanaan ?></td>
                                <td class="align-middle"><?= $j->tanggal ?></td>
                                <td class="align-middle"><?php
                                                            if (strtolower($j->keterangan) == "full booked") {
                                                                echo "<span class='badge badge-danger text-capitalize'>$j->keterangan</span>";
                                                            } else if (strtolower($j->keterangan) == "2 seats available") {
                                                                echo "<span class='badge badge-warning text-capitalize'>$j->keterangan</span>";
                                                            } else {
                                                                echo "<span class='badge badge-success text-capitalize'>$j->keterangan</span>";
                                                            } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <h4 class="text-center"><u><?= $judulBulanDepan ?></u></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Kota</th>
                            <th>Jadwal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jdwlBulanDepan as $j) { ?>
                            <tr>
                                <td class="align-middle"><?= $j->kota_pelaksanaan ?></td>
                                <td class="align-middle"><?= $j->tanggal ?></td>
                                <td class="align-middle"><?php
                                                            if (strtolower($j->keterangan) == "full booked") {
                                                                echo "<span class='badge badge-danger text-capitalize'>$j->keterangan</span>";
                                                            } else if (strtolower($j->keterangan) == "2 seats available") {
                                                                echo "<span class='badge badge-warning text-capitalize'>$j->keterangan</span>";
                                                            } else {
                                                                echo "<span class='badge badge-success text-capitalize'>$j->keterangan</span>";
                                                            } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 </div>
<p>
<!--ISI TABLE YANG LAMA-->

<?php

//foreach ($jdwl as $j) {
//  $pelaksanaan = $this->crud->select_other("jadwal", "WHERE kota_pelaksanaan LIKE '%$j->kota_pelaksanaan%' AND active IN ('Y')")->result();
//$span = sizeof($pelaksanaan);
?>
<!-- <tr>
                            <td rowspan="<?php //echo $span 
                                            ?>" class="align-middle"><?php //echo $j->kota_pelaksanaan 
                                                                        ?></td> -->
<?php
//$row = 1;
//foreach ($pelaksanaan as $r) {
//if ($row == 1) {
?>
<!-- <td><?php //echo $r->tanggal 
            ?></td>
                                    <td><?php //echo $r->keterangan 
                                        ?></td> -->
<?php //} else { 
?>
<!-- <td><?php //echo $r->tanggal 
            ?></td>
                                    <td><?php //echo $r->keterangan 
                                        ?></td> -->
<?php //}
?>
</tr>
<?php
// $row++;
// }
// }
?>





<div class="container" style="margin-top: 180px;">
    <div class="newTitle1 d-none d-md-block">
        <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Pilihan Metode Pembelajaran</span></h2>
    </div>
    <!--Ini Untuk Mobile-->
     <div class="row">
    <div class="col-md-12 d-md-none d-block">
        <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" />
        <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
            <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>&nbsp;&nbsp;&nbsp;&nbsp;Pilihan Metode Pembelajarans</span></h2>
        </div>
    </div>
    <p>Satu-satunya tempat training/kursus yang memiliki <b>Metode Pembelajaran <i>Terlengkap</b></i>  yang bisa disesuaikan dengan kebutuhan Anda</p>

    <!--Akhir dari Untuk Mobile-->
    <!--<iframe src="<?= site_url('infront/perbedaan-kelas-statis')?>" id="kelas-compare" marginheight="0" frameborder="0" class="w-100" onload="autoResize()"></iframe>-->
    <?php $this->load->view('page_class_comp_statis');?>
</div>




<!--END OF ISI TABLE YANG LAMA-->
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