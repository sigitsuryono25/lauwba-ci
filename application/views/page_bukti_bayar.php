<?php
$nomorBayar = $this->uri->segment(3);
$bayar = $this->db->query("SELECT history_trans.*, pendaftar.nama_lengkap, pendaftar.from, lauwbaco_admin_lkp.jenis.judul as judul_lkp, lauwbaco_latest_lauwba.jenis.judul FROM history_trans 
INNER JOIN pendaftar ON history_trans.id_daftar=pendaftar.id
LEFT JOIN lauwbaco_latest_lauwba.jenis 
ON pendaftar.training=lauwbaco_latest_lauwba.jenis.id_jenis
LEFT JOIN lauwbaco_admin_lkp.jenis 
ON pendaftar.training=lauwbaco_admin_lkp.jenis.id_jenis 
WHERE history_trans.id IN ('$nomorBayar')")->row();

// die($this->db->last_query());
$jenis = $this->input->get('jenis');
$wordingBayar = "";
if($jenis == "project"){
    $wordingBayar = "Pembayaran project";
}else{
    $wordingBayar ="Pembayaran kelas ";
    $wordingBayar .= ($bayar->from == "Lauwba Techno Indonesia") ? $bayar->judul : $bayar->judul_lkp. " ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bukti Pembayaran</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  @page {
    size: A4;
    margin: 0;
  }

  body {
    background: #e0e0e0;
  }

  .a4-page {
    width: 210mm;
    min-height: 297mm;
    margin: 10px auto;
    background: #fff;
    position: relative;
    box-shadow: 0 0 5px rgba(0,0,0,0.15);
  }

  /* HEADER & FOOTER FULL WIDTH */
  .a4-header,
  .a4-footer {
    width: 100%;
    padding: 10mm 15mm;
    background: #FFF;
  }


  .a4-footer {
    position: absolute;
    bottom: 0;
  }

  /* CONTENT TETAP ADA MARGIN */
  .a4-content {
    padding: 15mm 20mm 15mm; 
    /* top = ruang buat header, bottom = ruang footer */
  }
  
  .fab-button {
      position: fixed;
      bottom: 25px;
      right: 25px;
      width: 55px;
      height: 55px;
      border-radius: 50%;
      border: none;
      background: #cc3360; /* lo bisa ganti warna brand */
      color: #fff;
      font-size: 26px;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.25);
      z-index: 999;
      transition: 0.2s ease;
    }
    
    .fab-button:hover {
      opacity: 0.85;
      transform: scale(1.08);
    }

  @media print {
    body {
      background: #fff;
    }
    .a4-page {
      margin: 0;
      box-shadow: none;
      page-break-after: always;
    }
    .fab-button {
        display: none !important;
      }
  }
</style>
</head>
<body>

<div class="a4-page">

  <!-- FULL WIDTH HEADER -->
  <div class="a4-header d-flex justify-content-between align-items-center" style="height: 160px;background-image: url('<?= base_url("assets/img/header.jpg")?>');background-size: contain;background-repeat: no-repeat;width: 100%;">
    &nbsp;
  </div>

  <!-- CONTENT WITH MARGINS -->
  <div class="a4-content">
    <h4 class="text-center text-uppercase">kwitansi</h4>
    <p class="text-center">Nomor:&nbsp;&nbsp;<u><b><?= $this->uri->segment(3)?></b>/411/LTI/<?= date('Y')?></u></p>
    <table class="table table-bordered mt-5 pt-5">
        <tbody>
            <tr>
                <td>Telah diterima dari</td>
                <td>:</td>
                <td><b><?= $bayar->nama_lengkap?></b></td>
            </tr>
            <tr>
                <td>Jumlah uang</td>
                <td>:</td>
                <td><b><u><i><?= $this->etc->terbilang($bayar->jumlah_bayar)?> Rupiah</i></u></b></td>
            </tr>
            <tr>
                <td>Untuk pembayaran</td>
                <td>:</td>
                <td><b><u><i><?= $wordingBayar?></i></u></b></td>
            </tr>
        </tbody>
    </table>  
    <br>
    <br>
    <b style="background: #9b9b9b; font-size:2rem" class="my-5">Rp. <?= $this->etc->rps($bayar->jumlah_bayar)?>,-</b>
    <div class="text-end mt-5 pt-2">
      <p>Yogyakarta, <?= $this->etc->indonesiaDate(date_format(date_create($bayar->transaksi_pada), "Y-m-d"))?></p><br>
      <img src="<?= base_url("assets/img/sign.png")?>" style="width: 50%;"/><br>
      <b><u>Hardiansah, S. Kom., M. Kom.</u></b><br><span>Direktur</span>
    </div>
  </div>

  <!-- FULL WIDTH FOOTER -->
  <div class="a4-footer text-center" style="height: 161px;background-image: url('https://lauwba.com/assets/img/footer.png');background-size: contain;background-repeat: no-repeat;width: 100%;">
    &nbsp;
  </div>

   <button class="fab-button" onclick="window.print()">
      <i class="bi bi-printer"></i>
    </button>
</div>

</body>
</html>