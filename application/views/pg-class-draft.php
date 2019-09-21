<!doctype html>
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
            padding: 30px 0;
           
        }

        li span{
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
            transition: all .5s ease 0s
            font-weight: bold;
        }

        .pricingTable:hover .pricingTable-header {
            background: #ff9624
        }

        .pricingTable .pricingTable-header i {
            font-size: 50px;
            color: #858c9a;
            margin-bottom: 10px;
            transition: all .5s ease 0s
        }

        .pricingTable .price-value {
            font-size: 23px;
            color: #ff9624;
            transition: all .5s ease 0s
            font-weight: bold;
        }
                .pricingTable .price-value-coret {
            font-size: 24px;
            color: #ff9624;
            transition: all .5s ease 0s
            font-weight: bold;
        }

        .pricingTable .month {
            display: block;
            font-size: 14px;
            color: #000
        }

        .pricingTable:hover .month,
        .pricingTable:hover .price-value,
        .pricingTable:hover .pricingTable-header i {
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
        .pricingTable.blue:hover .pricingTable-header {
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
        .pricingTable.red:hover .pricingTable-header {
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
        .pricingTable.indigo:hover .pricingTable-header {
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
        .pricingTable.pink:hover .pricingTable-header {
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
        .pricingTable.teal:hover .pricingTable-header {
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
        .pricingTable.green:hover .pricingTable-header {
            background: #40c952
        }

        .pricingTable.green .pricingTable-signup a:hover {
            box-shadow: 0 0 10px #40c952
        }

        .pricingTable.blue:hover .price-value,
        .pricingTable.green:hover .price-value,
        .pricingTable.teal:hover .price-value,
        .pricingTable.indigo:hover .price-value,
        .pricingTable.pink:hover .price-value,
        .pricingTable.red:hover .price-value {
            color: #fff
        }

        @media screen and (max-width:990px) {
            .pricingTable {
                margin: 0 0 20px
            }
        }
    </style>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
</head>

<body class='snippet-body'>
    <div class="demo">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <i class="fa fa-adjust"></i>
                            <div class="price-value">KELAS REGULER ONLINE </s></div>
                            
                        </div>
                        
                            <b><font color="red"> Rp.<s> 3.000.000 </s><br></font>
                             <font color=#ff9624 >Rp.899.000 </font></b><P>
                        <div class="pricing-content">
                            <ul>
                                <li style="line-height: 20px;"><b>Pelaksanaan Via</b><br>Zoom/Google Meet</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi</b><br>4 Hari Full Day</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal?</b><br><a href="">Klik Disini</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta</b> <br>2-5 Peserta/Kls</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus </b><br>Mengikuti Silabus Kami</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mt-4" style="transform: scale(1.05); z-index: 1;">
                    <div class="pricingTable green">
                        <div class="pricingTable-header bg-success">
                            <i class="fa fa-briefcase"></i>
                            <div class="price-value text-white"> KELAS  PRIVATE &nbsp; ONLINE</div>
                          
                        </div>
                            <b><font color="red"> Rp.<s> 4.000.000 </s><br></font>
                             <font color="green" >Rp. 1.390.000 </font></b><P>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                <li style="line-height: 20px;"><b>Pelaksanaan Via</b><br>Zoom/Google Meet</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi</b><br>-+ 1 Bulan/sampai materi selesai dan sudah paham</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal?</b><br><a href="">By Request</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta</b> <br>1 Peserta/Kls</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus </b><br>Mengikuti Silabus Kami</li>
                             </ul>
                              
                            </ul>
                        </div>
                    </div>
                </div>
                
                    <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable indigo">
                        <div class="pricingTable-header ">
                            <i class="fa fa-adjust"></i>
                            <div class="price-value"> KELAS REGULER OFFLINE  </div>
                            
                        </div>
                        <b><font color="red">Rp.<s>4.500.000</s></b><br></font>
                         <b><font color="indigo">Rp.990.000</b><p></font>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                <li style="line-height: 20px;"><b>Pelaksanaan Via</b><br>Offline di kantor kami</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi</b><br>4 Hari Full Day</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal?</b><br><a href="">Klik Disini</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta</b> <br>2-5 Peserta/Kls</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus </b><br>Mengikuti Silabus Kami</li>
                             </ul>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable red">
                        <div class="pricingTable-header">
                            <i class="fa fa-diamond"></i>

                         <div class="price-value"> KELAS PRIVATE OFFLINE</div>
                          
                        </div>
                            <b><font color="red"> Rp.<s> 5.000.000 </s><br></font>
                             <font color="red" >Rp. 2.390.000 </font></b><P>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                <li style="line-height: 20px;"><b>Pelaksanaan Via</b><br>Offline di kantor kami Jogja/Tangerang</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi</b><br>-+ 1 Bulan/sampai materi selesai dan sudah paham</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal?</b><br><a href="">By Request</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta</b> <br>1 Peserta/Kls</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus </b><br>Mengikuti Silabus Kami</li>
                             </ul>
                              
                            </ul>
                            </ul>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable pink">
                        <div class="pricingTable-header">
                            <i class="fa fa-adjust"></i>
                            <div class="price-value"> KELAS INKUBATOR </div>
                            
                        </div>
                        <b><font color="red">Rp.<s>8.500.000</s></b><br></font>
                         <b><font color="pink">Rp.4.990.000/Bln</b><p></font>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                <li style="line-height: 20px;">Kelas khusus persiapan <br>Memasuki <b>Dunia Kerja</b></li><br>
                                <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Offline di kantor kami di Yogyakarta</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>2 - 6 Bulan </li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="">Kelas Baru Buka Setiap Hari Senin & Kamis</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>1-2 Peserta/Kls</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Silabus Basic + Lanjut + Project</li>
                             </ul>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable teal">
                        <div class="pricingTable-header">
                            <i class="fa fa-adjust"></i>
                            <div class="price-value"> IN HOUSE TRAINING<br>DIKLAT/BIMTEK<br>PUBLIC TRAINING  </div>
                            
                        </div>
                        <b><font color="red">Rp.<s>8.500.000</s></b><br></font>
                         <b><font color=#0399be>Rp.4.490.000</b><p></font>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                
                                 <li style="line-height: 20px;"> Pelatihan Khusus Corporate/Instansi <br>Untuk Pengembangan skill SDM</li><p>
                                <li style="line-height: 20px;"><b>Pelaksanaan : </b><br>Online/Offline</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>4 Hari Full Day</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal :</b><br><a href="">By Request</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>By Request</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>Sesuai Silabus/By Request</li>
                             </ul>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable blue">
                        <div class="pricingTable-header">
                            <i class="fa fa-cube"></i>
                            
                            <div class="price-value"> KELAS PRIVATE PROJECT</div>
                          
                        </div>
                          
                             <font color="blue"><b>Harga :</b><br>Menyesuaikan Tingkat Kesulitan Project </font></b><P>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                <li style="line-height: 20px;"><b>Pelaksanaan :</b><br>Offline/Online</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi :</b><br>Fleksibel</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal:</b><br><a href="">By Request</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta :</b> <br>Fleksibel</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus :</b><br>By Request</li>
                             </ul>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mt-4">
                    <div class="pricingTable green">
                        <div class="pricingTable-header">
                            <i class="fa fa-cube"></i>
   <div class="price-value"> WEBINER/WORKSHOP</div>
                          
                        </div>
                          
                             <font color="green"><b>Harga :</b><br>Hub Kami</font></b><P>
                        <div class="pricing-content">
                            <ul>
                             <ul>
                                <li style="line-height: 20px;"><b>Pelaksanaan Via</b><br>Offline/Online</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Durasi</b><br>Fleksibel</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jadwal?</b><br><a href="">By Request</a></li>
                                <li style="line-height: 20px;" class="mt-3"><b>Jumlah Peserta</b> <br>Fleksibel</li>
                                <li style="line-height: 20px;" class="mt-3"><b>Materi/Silabus </b><br>By Request</li>
                             </ul>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script type='text/javascript'></script>
</body>

</html>