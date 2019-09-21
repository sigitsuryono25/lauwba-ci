<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        
    }
    body{
        padding: 25px;
    }
    p{
        line-height: 1.8em;
    }
    th, td {
        padding: 15px;
        text-align: center;
    }
    a{
        text-decoration: none;
    }
</style>
<body>
    <div style="margin: 10px">
        <div class="d-md-none d-block"></div>
        <div class="wrapper-page">
           <div class="header" style="text-align: center">
                <img src="<?= base_url('/assets/img/header.png') ?>" width="350">
                <p style="text-align: center; margin-top: -2px">
                    <b>Office :</b> Gedung PT. Lauwba Techno Indonesia, Karangploso, Piyungan, Bantul, Daerah Istimewa Yogyakarta 55792
                </p>
                <hr>
            </div>
            <div class="body">
                <h5 style="text-align: center"><u>SURAT PENAWARAN</u><br>
                    <small class="text-center">No:
                        <?= date_format(date_create($detail->daftar_pada), "d")?>/
                        <?= date_format(date_create($detail->daftar_pada), "m")?>/411/LTI/
                        <?= date_format(date_create($detail->daftar_pada), "Y")?>
                    </small>
                </h5>

                <table border='0'>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>3 (Tiga) Berkas</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td>Surat Penawaran
                            <?= $detail->judul ?>
                        </td>
                    </tr>
                </table>
                <p style="text-align: justify">
                    <b>Kepada Yth,</b><br><br>
                    <span class="text-capitalize"><b>
                            <?php
                            if (!empty($detail->jabatan) && !empty($detail->instansi)) {
                                echo "Bagian " . $detail->jabatan . " " . $detail->instansi;
                            } else {
                                echo $detail->nama_lengkap;
                            }
                            ?>
                        </b></span><br><br>
                    <span>Di</span><br><br>
                    <span>Tempat</span><br><br>
                    <span>Dengan Hormat, </span><br><br>
                    Sebelumnya kami mengucapkan terima kasih kepada Bapak/Ibu telah menyediakan waktu untuk membaca
                    Surat Penawaran kami.
                    Dengan perkembangan teknologi serta arus informasi yang semakin mudah diakses,
                    serta dengan keadaan Pandemi Covid19 saat ini yang mengharuskan kebanyakan aktivitas kita dirumah
                    serta lebih dekat dengan
                    Teknologi, maka dibutuhkan sebuah pengembangan skill dibidang IT.
                    Adapun rincian materi
                    <?= $detail->judul ?> serta biayanya sebagaimana terlampir.
                    Demikian undangan kami. Atas perhatian dari Bapak/Ibu kami ucapkan Terima Kasih.
                </p>
                <p style="text-align: right; margin-top: 100px">
                    <span>Hormat Kami,</span><br>
                    <span class="border-bottom border-dark"><b>Hardiansah, M.Kom.</b></span><br>
                    <span style="margin-top: 20px">Direktur PT. Lauwba Techno Indonesia</span>
                </p>
                <hr>
                <center>
                <h3>Silahkan download Lampiran dibawah ini</h3>
                    <table  width='65%'>
                        <tr>
                            <td>
                                <a href="<?= site_url('surat-penawaran/'.$detail->id)?>" class="text-primary font-weight-bold"><i class="fa fa-download"></i> Surat Penawaran</a>
                            </td>
                            <td>
                                <a href="<?= base_url('assets/berkas-pendukung/company-profile-pt-lauwba-techno-indonesia.pdf')?>" download class="text-primary font-weight-bold"><i class="fa fa-download"></i> Company Profile</a>
                            </td>
                            <td>
                                <a href="<?= base_url('assets/berkas-pendukung/npwp-pt-lauwba-techno-indonesia.png')?>" download class="text-primary font-weight-bold"> <i class="fa fa-download"></i> NPWP</a>
                            </td>
                            <td>
                                <a href="<?= base_url('assets/berkas-pendukung/form-registrasi.xlsx')?>" download class="text-primary font-weight-bold"><i class="fa fa-download"></i> Form Registrasi</a><br><i> (Khusus Peserta yang lebih dari 1 Orang atau peserta In House Training)</i>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
</body>

</html>