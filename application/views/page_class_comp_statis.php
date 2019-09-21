<!--<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Perbedaan Kelas di Lauwba Techno Indonesia</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='' rel='stylesheet'>
     <style>
        body {
            /* background: #B1EA86; */
            /*padding: 25px 0;*/
            overflow: hidden;
        }

        li span {
            line-height: 1px !important;
        }

        a {
            text-decoration: none;
        }

        .pricingTable {
            text-align: center;
            background: #fff;
            margin: 0 -15px;
            box-shadow: 0 0 10px #ababab;
            padding-bottom: 40px;
            border-radius: 10px;
            color: #cad0de;
            transform: scale(1);
            transition: all .5s ease 0s
        }

        .pricingTable:hover {
            transform: scale(1.05);
            z-index: 1
        }

        .pricingTable .pricingTable-header {
            padding: 40px 0;
            background: #f5f6f9;
            border-radius: 10px 10px 50% 50%;
            transition: all .5s ease 0s font-weight: bold;
        }

        .pricingTable .pricingTable-header {
            background: #ff9624
        }

        .pricingTable .pricingTable-header i {
            font-size: 50px;
            color: #858c9a;
            margin-bottom: 10px;
            transition: all .5s ease 0s
        }

        .pricingTable .price-value {
            font-size: 20px;
            color: #ff9624;
            transition: all .5s ease 0s font-weight: bold;
        }

        .pricingTable .price-value-coret {
            font-size: 24px;
            color: #ff9624;
            transition: all .5s ease 0s font-weight: bold;
        }

        .pricingTable .month {
            display: block;
            font-size: 14px;
            color: #000
        }

        .pricingTable .month,
        .pricingTable .price-value,
        .pricingTable .pricingTable-header i {
            color: #fff
        }

        .pricingTable .heading {
            font-size: 24px;
            color: #ff9624;
            margin-bottom: 20px;
            text-transform: uppercase
        }

        .pricingTable .pricing-content ul {
            list-style: none;
            padding: 0;
            margin-bottom: 30px
        }

        .pricingTable .pricing-content ul li {
            line-height: 30px;
            color: rgb(77, 77, 77)
        }

        .pricingTable .pricingTable-signup a {
            display: inline-block;
            font-size: 15px;
            color: #fff;
            padding: 10px 35px;
            border-radius: 20px;
            background: #ffa442;
            text-transform: uppercase;
            transition: all .3s ease 0s
        }

        .pricingTable .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #ffa442
        }

        .pricingTable.blue .heading,
        .pricingTable.blue .price-value {
            color: #2196F3
        }

        .pricingTable.blue .pricingTable-signup a,
        .pricingTable.blue .pricingTable-header {
            background: #2196F3
        }

        .pricingTable.blue .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #2196F3
        }

        .pricingTable.red .heading,
        .pricingTable.red .price-value {
            color: #ff4b4b
        }

        .pricingTable.red .pricingTable-signup a,
        .pricingTable.red .pricingTable-header {
            background: #ff4b4b
        }

        .pricingTable.red .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #ff4b4b
        }


        /* INDIGO */
        .pricingTable.indigo .heading,
        .pricingTable.indigo .price-value {
            color: #1A237E
        }

        .pricingTable.indigo .pricingTable-signup a,
        .pricingTable.indigo .pricingTable-header {
            background: #1A237E;
        }

        .pricingTable.indigo .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #1A237E
        }

        /* PINK */
        .pricingTable.pink .heading,
        .pricingTable.pink .price-value {
            color: #F50057
        }

        .pricingTable.pink .pricingTable-signup a,
        .pricingTable.pink .pricingTable-header {
            background: #F50057;
        }

        .pricingTable.pink .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #F50057
        }

        /* TEAL */
        .pricingTable.teal .heading,
        .pricingTable.teal .price-value {
            color: #0399be
        }

        .pricingTable.teal .pricingTable-signup a,
        .pricingTable.teal .pricingTable-header {
            background: #0399be;
        }

        .pricingTable.teal .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #0399be
        }



        .pricingTable.green .heading,
        .pricingTable.green .price-value {
            color: #40c952
        }

        .pricingTable.green .pricingTable-signup a,
        .pricingTable.green .pricingTable-header {
            background: #40c952
        }

        .pricingTable.green .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #40c952
        }

        .pricingTable.blue .price-value,
        .pricingTable.green .price-value,
        .pricingTable.teal .price-value,
        .pricingTable.indigo .price-value,
        .pricingTable.pink .price-value,
        .pricingTable.red .price-value {
            color: #fff
        }

        @media screen and (max-width:990px) {
            .pricingTable {
                margin: 0 0 20px
            }
        }

        .box {
            width: 200px;
            height: 300px;
            position: relative;
            border: 1px solid #BBB;
            background: #EEE;
        }

        .ribbon {
            position: absolute;
            right: -5px;
            top: -5px;
            z-index: 1;
            overflow: hidden;
            width: 75px;
            height: 75px;
            text-align: right;
        }

        .ribbon span {
            font-size: 10px;
            font-weight: bold;
            color: #FFF;
            text-transform: uppercase;
            text-align: center;
            line-height: 20px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            width: 100px;
            display: block;
            background: #79A70A;
            background: linear-gradient(#F70505 0%, #8F0808 100%);
            box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
            position: absolute;
            top: 19px;
            right: -21px;
        }

        .ribbon span::before {
            content: "";
            position: absolute;
            left: 0px;
            top: 100%;
            z-index: -1;
            border-left: 3px solid #8F0808;
            border-right: 3px solid transparent;
            border-bottom: 3px solid transparent;
            border-top: 3px solid #8F0808;
        }

        .ribbon span::after {
            content: "";
            position: absolute;
            right: 0px;
            top: 100%;
            z-index: -1;
            border-left: 3px solid transparent;
            border-right: 3px solid #8F0808;
            border-bottom: 3px solid transparent;
            border-top: 3px solid #8F0808;
        }
    </style>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
</head>

<body class='snippet-body p-3'>-->
    <div class="demo">
        <div class="container-fluid">
            <div class="row">
                <!--<div class="col-md-3 col-sm-6 mt-4">-->
                <!--    <div class="pricingTable">-->
                <!--        <div class="pricingTable-header">-->
                <!--            <img alt="img desc" src="/assets/img/icn/reguler-online-lauwba.png"></img>-->
                <!--            <div class="price-value font-weight-bold">KELAS REGULER ONLINE</div>-->
                <!--        </div>-->
                <!--        <div class="pricing-content mt-3">-->
                <!--            <ul>-->
                <!--                <li style="line-height: 20px;"><b>Pelaksanaan : </b><br>Via Zoom/Google Meet</li>-->
                <!--                <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>4 Hari Full Day</li>-->
                <!--                <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="javascript:void(0)" onclick="parent.parentJadwal('reguler-online')">Klik Disini</a>-->
                <!--                </li>-->
                <!--                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>2-5 Peserta/Kls-->
                <!--                </li>-->
                <!--                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Mengikuti Silabus-->
                <!--                    Kami</li>-->
                                    
                <!--                    <br>-->
                <!--                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>-->

                                    
                <!--                                                    <font color="blue"><b>GARANSI :<br></b> GRATIS Mengulang Sampai Bisa! </del></font><br>-->
                <!--            </ul>-->
                <!--        </div>-->
                <!--        <div class="pricingTable-signup">-->
                <!--            <a href="javascript:void(0)" onclick="parent.parentRegister()">Daftar Sekarang</a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
   
   
   
            

                <div class="col-md-4 col-sm-6 mt-4">
                    <div class="pricingTable teal">
                        <div class="pricingTable-header">
                              <i class="fa fa-diamond"></i>
                            <div class="price-value font-weight-bold"> CORPORATE TRAINING </div>
                        </div>
                        <div class="pricing-content mt-3">
                            <ul>
                                    <li style="line-height: 20px;"> Training Khusus Corporate/Instansi <br>Untuk
                                        Pengembangan skill SDM Perkantoran</li>
                                    <p>
                                        <li style="line-height: 20px;"><b>Pelaksanaan : </b><br>Online/Offline</li>
                                        <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>4 Hari Full Day(By Request)
                                        </li>
                                        <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="javascript:void(0)">By
                                                Request</a></li>
                                        <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>By
                                            Request</li>
                                        <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Sesuai
                                            Silabus/By Request<br><a href="https://lauwba.com/in-house-training-27.html"> Selengkapnya KLIK DISINI</a></li>
                                                                                
                                                                                
                            <!--                                                     <br>-->
                            <!--                     <img alt="img desc" src="/assets/img/icn/hotel-lauwba.png"><br>-->
                            <!--<font color="blue"><b>GRATIS <br></b>Penginapan selama  pelatihan(Yogyakarta)</del></font><br>-->

                                                                                
                                                                                
                                                                                <br>
                                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>
                                <font color="blue"><b>GARANSI :<br></b> GRATIS Mengulang Sampai Bisa</del></font><br>
                                </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="javascript:void(0)" onclick="parent.parentRegister()">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>

   
   
   
                <div class="col-md-4 col-sm-6 mt-4" style="transform: scale(1.05); z-index: 2;">
                    <div class="pricingTable pink">
                    <div class="ribbon d-md-block d-none"><span>REKOMENDED</span></div>
                    <div class="ribbon d-md-none d-block" style="right: 8px"><span>REKOMENDED</span></div>
                        <div class="pricingTable-header">
                            <img alt="img desc" src="/assets/img/icn/bootcamp4-lauwba.png"></img>
                            <div class="price-value font-weight-bold"> BOOTCAMP<br>(Inkubator) </div>

                      </div>
                    
                        <div class="pricing-content mt-3">
                                <ul>
                                    <li style="line-height: 20px;">Kelas khusus untuk  <br> persiapan <br>memasuki <b>Dunia
                                            Kerja </b></li><br>
                                    <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Bisa Request Online atau Offline <br>di kantor kami
                                        (Yogyakarta)</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>2 - 6 Bulan </li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="javascript:void(0)">Kelas Baru
                                            Buka Setiap Hari <br>Senin & Kamis</a></li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>1-2
                                        Peserta/Kls</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Silabus Basic
                                     + Lanjut + Project <br><a onclick="parent.openUrl('https://lauwba.com/incubator-class-android-26.html')" href="javascript:void(0)"> Selengkapnya KLIK DISINI</a></li>
                            <!--                 <img alt="img desc" src="/assets/img/icn/hotel-lauwba.png"><br>-->
                            <!--<font color="blue"><b>GRATIS <br></b>Penginapan selama  pelatihan</del></font><br>-->


                                                                              <br>
                                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>
                                <font color="blue"><b>GARANSI :<br></b> GRATIS Mengulang Sampai Bisa</del></font><br>
                                </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="javascript:void(0)" onclick="parent.parentRegister()">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-4 col-sm-6 mt-4" style="transform: scale(1.05); z-index: 1;">
                    <div class="pricingTable green">
                    <div class="ribbon d-md-block d-none"><span>BEST SELLER</span></div>
                    <div class="ribbon d-md-none d-block" style="right: 8px"><span>BEST SELLER</span></div>
                        <div class="pricingTable-header bg-success">
                            <img alt="img desc" src="/assets/img/icn/private-class-online2.png"></img>
                            <div class="price-value text-white font-weight-bold"> KELAS PRIVATE &nbsp; ONLINE</div>
                        </div>
                        <div class="pricing-content mt-3">
                                <ul>
                                    <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Via Zoom/Google Meet</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Durasi</b><br> Selama -1 Bulan/sampai
                                        materi selesai</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jadwal : </b><br><a href="javascript:void(0)">By
                                            Request</a></li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>1 Peserta/Kls
                                    </li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Mengikuti
                                        Silabus Kami</li>
                                                                              <br>
                                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>
                                <font color="blue"><b>GARANSI :<br></b> GRATIS Mengulang Sampai Bisa</del></font><br>
                                </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="javascript:void(0)" class=" bg-success" onclick="parent.parentRegister()">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mt-4">
                    <div class="pricingTable indigo">
                        <div class="pricingTable-header ">
                               <img alt="img desc" src="/assets/img/icn/presentation1.png"></img>
                            <div class="price-value font-weight-bold"> REGULER CLASS</div>
                        </div>
                        <div class="pricing-content mt-3">
                                <ul>
                                    <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Offline di kantor kami</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>4 Hari Full Day</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="javascript:void(0)" onclick="parent.parentJadwal('reguler-offline')">Klik Disini</a></li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>2-5
                                        Peserta/Kls</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Mengikuti
                                        Silabus Kami</li>
                                        <br>
                                                 <img alt="img desc" src="/assets/img/icn/hotel-lauwba.png"><br>
                            <font color="blue"><b>GRATIS <br></b>Penginapan selama  pelatihan(Yogyakarta)</del></font><br>


                                                                              <br>
                                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>
                                <font color="blue"><b>GARANSI :<br></b> GRATIS Mengulang Sampai Bisa</del></font><br>
                                </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="javascript:void(0)" onclick="parent.parentRegister()">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-6 mt-4">
                    <div class="pricingTable red">
                        <div class="pricingTable-header">
                         <img alt="img desc" src="/assets/img/icn/private-class.png"></img>
                            <div class="price-value font-weight-bold"> KELAS PRIVATE OFFLINE</div>
                        </div>
                        <div class="pricing-content mt-3">
                                <ul>
                                    <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Offline di kantor kami
                                        Yogyakarta<br> & bisa request diluar kota</li>
    <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>10 Hari (Half Day)<br>sampai
                                materi selesai & sudah paham</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="javascript:void(0)">By
                                            Request</a></li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>1 Peserta/Kls
                                    </li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus : </b><br>Mengikuti
                                        Silabus Kami</li>
                                        
                                         <br>
                                                 <img alt="img desc" src="/assets/img/icn/hotel-lauwba.png"><br>
                            <font color="blue"><b>GRATIS <br></b>Penginapan selama  pelatihan(Yogyakarta)</del></font><br>

                                        
                                                                              <br>
                                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>
                                <font color="blue"><b>GARANSI :<br></b> GRATIS Mengulang Sampai Bisa</del></font><br>
                                </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="javascript:void(0)" onclick="parent.parentRegister()">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-6 mt-4">
                    <div class="pricingTable blue">
                        <div class="pricingTable-header">
                            <i class="fa fa-cube"></i>
                            <div class="price-value font-weight-bold"> KELAS PRIVATE PROJECT</div>
                        </div>
                        <div class="pricing-content mt-3">
                                <ul>
                                    <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Offline/Online</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>Fleksibel</li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jadwal:</b><br><a href="javascript:void(0)">By
                                            Request</a></li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>Fleksibel
                                    </li>
                                    <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>By Request
                                
                                    </li> <br>
                                      <br>
                                                                                 <img alt="img desc" src="/img/garansi.jpg"><br>

                                    
                                                                    <font color="blue"><b>GARANSI :<br></b> Dibimbing sampai projectnya jadi</del></font><br>
                                </ul>
                        <div class="pricingTable-signup">
                            <a href="javascript:void(0)" onclick="parent.hubWa()">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                </div>

                <!--<div class="col-md-3 col-sm-6 mt-4">-->
                <!--    <div class="pricingTable green">-->
                <!--        <div class="pricingTable-header">-->
                <!--            <i class="fa fa-cube"></i>-->
                <!--            <div class="price-value"> WEBINAR/WORKSHOP</div>-->
                <!--        </div>-->
                <!--        <div class="pricing-content mt-3">-->
                <!--                <ul>-->
                <!--                    <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Offline/Online</li>-->
                <!--                    <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>Fleksibel</li>-->
                <!--                    <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="javascript:void(0)">By-->
                <!--                            Request</a></li>-->
                <!--                    <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>Fleksibel</li>-->
                <!--                    <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus : </b><br>By Request-->
                <!--                    </li>-->
                <!--                </ul>-->
                <!--        </div>-->
                <!--        <div class="pricingTable-signup">-->
                <!--            <a href="javascript:void(0)" onclick="parent.hubWa()">Hubungi Kami</a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->


            </div>
        </div>
    </div>
<!--    <script type='text/javascript'></script>-->
<!--</body>-->

<!--</html>-->