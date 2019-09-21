<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $detail->judul ?></title>
        <?php
        $isi_berita = (strip_tags($detail->isi_jenis));
        $isi = substr($isi_berita, 0, 150);
        ?>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="<?php echo base_url('assets/') ?>img/favicon.png" type="image/x-icon">
        <meta name="description" content="<?php echo $isi ?>">
        <meta name="keywords" content="Kursus Android Jogja, kursus android makassar, kursus web jogja, kursus web makassar. Training/Kursus dan Jasa pembuatan website aplikasi android di makassar,Jogja dan semarang. Kami menawarkan jasa pembuatan website company profile perusahaan, website instansi pemerintahan, website hotel, website sekolah, jasa website toko online dan pembuatan website untuk yayasan dan website pribadi, kursus android programming JOGJA, kursus WEB programming JOGJA, kursus android programming makassar, kursus WEB programming Makassar, kursus web makassar, kursus website yogyakarta jogja, kursus android makassar, kursus android yogyakarta jogja, kursus teknisi laptop makassar, kursus tekisi laptop jogja, Kursus Android Jogja, kursus android makassar, kursus web jogja, kursus web makassar">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <!--<link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.1.3.css">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">-->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/highslide/') ?>highslide.css" type="text/css">
        <script  src="<?php echo base_url('assets/highslide/') ?>highslide-with-gallery.js" type="text/javascript"></script>
    </head>