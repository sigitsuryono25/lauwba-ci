<?php

$dt = date("Y-m-d");
$year = $this->etc->dateFormat($dt, "Y");
$bulanNumber = $this->etc->dateFormat($dt, "n");
$now = $this->etc->bulanOnly($this->etc->dateFormat($dt, "n"));
$fromLkp = $this->input->get('from-lkp');


$nextDd = $this->etc->dateAdd($dt, "1 months", "Y-m-d");
$nextMonthNumber = $this->etc->dateFormat($nextDd, "n");
$nextMonth = $this->etc->bulanOnly($this->etc->dateFormat($nextDd, "m"));
$nextYear = $this->etc->dateFormat($nextDd, "Y");

$judulSsekarang = "$now $year";
$judulBulanDepan = "$nextMonth $nextYear";

$jadwal = $this->db->query("SELECT * FROM jadwal WHERE bulan IN ('$bulanNumber') AND tahun IN ('$year') AND active IN ('Y')")->result();
$jadwalBulanDepan = $this->db->query("SELECT * FROM jadwal WHERE bulan IN ('$nextMonthNumber') AND tahun IN ('$nextYear') AND active IN ('Y')")->result();
?>
<div class="container-fluid overflow-auto my-4" style="overflow-y: auto">
    <div class="container mt-4">
        <div class="text-light pt-2">
            <div class="row">
                <?php if(!empty($fromLkp)){?>
                <div class="col-md-12">
                    <div class="newTitle1 d-none d-md-block">
                        <h2 class="text-center text-uppercase font-weight-bold text-primary" id="titleborder"><span>Jadwal PRIVATE CLASS</span></h2>
                    </div>
                </div>
        
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block">
                        <h5 class="text-center text-uppercase text-primary font-weight-bold " id="titleborder"><span>Jadwal PRIVATE CLASS</span></h5>
                  
                </div>
                
                <div class="col-md-12">
                    <hr>
                </div>
                <?php }else{?>
                <div class="col-md-12">
                    <div class="newTitle1 d-none d-md-block">
                        <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal PRIVATE CLASS</span></h2>
                    </div>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal PRIVATE CLASS</span></h2>
                    </div>
                </div>
                <?php }?>
                <!--Akhir dari Untuk Mobile-->
                <div class="col-md-12">
                    <center class="text-dark">
                        <h4>Kelas Private ONLINE & OFFLINE</h4> <br>
                        <b>Durasi Kursus :</b> Selama <b><i> -+ 1 Bulan</b> (sampai materi selesai & peserta sudah paham/bisa)</i><br>
                        <b>Waktu Pelaksanaan : </b><i> Bisa Request Jadwal Sesuai Kebutuhannya yaitu <i><b> 1 sampai 4 kali </i></b> pertemuan dalam sepekan</i><br>
                        <p>
                            <b>Pilihan Hari & Durasi : </b><i> Senin-Ahad, Bisa request 3 jam/pertemuan atau full day 5 jam/pertemuan</i>
                    </center>


                </div>
            </div>
        </div>
    </div>
    
    
    <!--REGULAR ONLINE-->
    <div class="container mt-4">
        <div class="row mb-3">
            <?php if(!empty($fromLkp)){?>
                <div class="col-md-12">
                    <div class="newTitle1 d-none d-md-block">
                        <h2 class="text-center text-uppercase font-weight-bold text-primary" id="titleborder"><span>Jadwal REGULER  CLASS YOGYAKARTA</span></h2>
                    </div>
                </div>
        
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block">
                        <h5 class="text-center text-uppercase text-primary font-weight-bold " id="titleborder"><span>Jadwal REGULER CLASS YOGYAKARTA</span></h5>
                    
                </div>
                
                <div class="col-md-12">
                    <hr>
                </div>
                <?php }else{?>
            <div class="col-md-12">
                <div class="newTitle1 d-none d-md-block">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal Kelas Reguler  Yogyakarta</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h5 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal Kelas Reguler  Yogyakarta</span></h5>
                    </div>
                </div>
            <?php } ?>
                <!--Akhir dari Untuk Mobile-->
                <div class="col-md-12">
                     <center class="text-dark">
                        <b><i> Untuk Kelas REGULER </b> Mengikuti Jadwal yang Tersedia (Lihat Jadwal dibawah ini)</i><br>
                        <b><i> DURASI Kursus Selama 4 Hari dari Jam 08.30 - 15.30</i></b>
                    </center>
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
                            <?php foreach ($jadwal as $j) {
                             if(strtolower($j->kota_pelaksanaan) == "yogyakarta"){
                            ?>
                                <tr>
                                    <td class="align-middle"><?= $j->tanggal ?></td>
                                    <td class="align-middle"><?php
                                                                if (strtolower($j->keterangan) == "full booked") {
                                                                    echo "<span class='badge badge-danger text-capitalize'>$j->keterangan</span>";
                                                                } else if (strtolower($j->keterangan) == "2 seats available") {
                                                                    echo "<span class='badge badge-warning  text-capitalize'>$j->keterangan</span>";
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
                            <?php foreach ($jadwalBulanDepan as $j) {
                            if(strtolower($j->kota_pelaksanaan) == "yogyakarta"){?>
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
    <div class="row mb-3">
        <div class="col-md-12 mt-4">
            <div class="reg">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal Kelas Bootcamp/INCUBATOR</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal Kelas Bootcamp/INCUBATOR</span></h2>
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
    
    
    <div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12 mt-4">
            <div class="reg">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal CORPORATE TRAINING</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal CORPORATE TRAINING</span></h2>
                    </div>
                </div>

                <!--Akhir dari Untuk Mobile-->

                <div class="col-md-12">

                    <center class="text-dark">
                        <b><i> TRAINING For Corporate/Instansi</i> </b> <br>
                        <b><i> Untuk  INHOUSE TRAINING/DIKLAT/BIMTEK/PUBLIC TRAINING </b> by request atau sesuai kebutuhan Instansi/Korporasi</i><br>
                        <b><i> DURASI kelasnya yaitu selama 4 hari dari jam 08.30 - 16.00 (kondisional sesuai request instansi)</i></b><br>
                           <b><i>PELAKSANAAN </b> bisa Offline atau Online sesuai request dari awal</i>
                    </center>
                </div>

            </div>
        </div>
    </div>
    

    <div class="container mt-4">
        <div class="row">
            <?php if(!empty($fromLkp)){?>
                <div class="col-md-12">
                    <div class="newTitle1 d-none d-md-block">
                        <h2 class="text-center text-uppercase font-weight-bold text-primary" id="titleborder"><span>Jadwal REGULER CLASS</span></h2>
                    </div>
                </div>
        
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block">
                    <h5 class="text-center text-uppercase text-primary font-weight-bold" id="titleborder"><span>Jadwal REGULER CLASS</span></h5>
            
                </div>
                
                <div class="col-md-12">
                    <hr>
                </div>
                <?php }else{?>
            <div class="col-md-12">
                <div class="newTitle1 d-none d-md-block   mt-4">
                    <h2 class="h4 ml-5 pl-5" id="titleborder"><span>Jadwal REGULER CLASS</span></h2>
                </div>
                <!--Ini Untuk Mobile-->
                <div class="col-md-12 d-md-none d-block mt-4">
                    <img src="https://server4111.com/banner-lauwba/layer-lauwba.png" width="100%" height="40px" class="bg-title" alt="lauwba layer"/>
                    <div class="newTitle1Mobile" style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h2 class="h6 ml-5 pl-4 " id="titleborder"><span>Jadwal REGULER CLASS</span></h2>
                    </div>
                </div>

                <!--Akhir dari Untuk Mobile-->
                <?php }?>
                <div class="col-md-12">
                    <center class="text-dark">
                        <b><i> Untuk Kelas REGULER </b> Mengikuti Jadwal yang Tersedia (Lihat Jadwal & Tempat Pelaksanaan dibawah ini)</i><br>
                        <b><i> DURASI Kursus Selama 4 Hari dari Jam 08.30 - 15.30 </i></b>
                    </center>
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
                            <?php foreach ($jadwal as $j) { ?>
                                <tr>
                                    <td class="align-middle"><?= $j->kota_pelaksanaan ?></td>
                                    <td class="align-middle"><?= $j->tanggal ?></td>
                                    <td class="align-middle"><?php
                                                                if (strtolower($j->keterangan) == "full booked") {
                                                                    echo "<span class='badge badge-danger text-capitalize'>$j->keterangan</span>";
                                                                } else if (strtolower($j->keterangan) == "2 seats available") {
                                                                    echo "<span class='badge badge-warning  text-capitalize'>$j->keterangan</span>";
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
                            <?php foreach ($jadwalBulanDepan as $j) { ?>
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
<script>
var isEmbed = "<?= $embedded?>";
    $(document).ready(function(){
        if(isEmbed){
            $("#topbar").addClass("d-none"); 
        }
    });
</script>