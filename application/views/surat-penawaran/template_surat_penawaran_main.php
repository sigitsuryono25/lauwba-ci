<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Test Auto Pagination</title>

  <script src="https://unpkg.com/pagedjs@0.4.2/dist/paged.polyfill.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      width: 210mm;
      margin: 0 auto;
      background: #e5e5e5; /* abu soft */
    }
    
    /* Layout Paged.js viewer */
    .pagedjs_pages {
      margin: 0 0 12px 0;
      padding: 0 0;
      background: #e5e5e5 !important; /* abu */
    }
    
    /* Setiap halaman cetak */
    .pagedjs_page {
      background: #ffffff !important; /* putih */
      box-shadow: 0 0 10px rgba(0,0,0,0.15);
      border-radius: 4px;
    }
    
    /* Opsional: kasih jarak antar halaman biar lebih cakep */
    .pagedjs_page {
      margin: 0 auto 30px auto;
    }

    /* Print Button */
    #print-btn {
      position: fixed;
      top: 12px;
      right: 12px;
      background: #007bff;
      color: #fff;
      padding: 12px 18px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      z-index: 999999 !important;
      display: none;
      /* muncul setelah render */
    }

    @media print {
      #print-btn {
        display: none !important;
      }
    }

    @media print {
      * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }

    @media screen {
      body {
        background: #ddd;
      }

      .pagedjs_page {
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
      }
    }

    @page {
      size: A4;
      margin: 30mm 15mm 35mm;
    }

    header {
      position: running(pageHeader);
      width: 100%;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      padding: 8px 0;
    }

    footer {
      position: running(pageFooter);
      width: 100%;
      font-size: 12px;
      text-align: center;
      padding: 20px 0;
      min-height: 30mm;
    }

    @page {
      @top-center {
        content: element(pageHeader);
      }

      @bottom-center {
        content: element(pageFooter);
      }
    }
    .center-x {
            text-align: center;
        }

    .content {
      font-size: 14px;
      line-height: 1.4;
      padding: 0 5px;
      margin-top: 0mm;
      padding-bottom: 40mm;
      break-before: avoid-page;
    }
    .break {
        page-break-before: always;
    }
    p {
        margin: 0;
    }
  </style>
</head>

<body>

  <button id="print-btn" onclick="window.print()">🖨 Print</button>

  <header class="print-header" style="background: url('https://lauwba.com/assets/img/header.jpg')">
    <!--<img src="" style="width:100%; height:auto;">-->
  </header>
  <footer class="print-footer">
    <img src="https://lauwba.com/assets/img/footer.png" style="width:100%; height:auto;">
  </footer>

  <div class="content">
    <div class="main">
        <h3 class="text-center">LAMPIRAN</h3>
        <ol>
            <!--PROFILE SINGKAT-->
            <li><b>PROFIL SINGKAT KAMI</b></li>
                <span style="text-align: justify">
                    PT. Lauwba Techo Indonesia merupakan perusahaan yang bergerak pada bidang teknologi informasi khususnya software development dan IT Training dengan 
                    tenaga ahli S2 dan S1 dalam bidang programming, desain dan analisis yang berpengalaman paling sedikit 1 tahun dan telah menangani 
                    ratusan client kami yang tersebar diseluruh Indonesia serta ASIA baik untuk pembuatan Aplikasi dan sistem informasi  untuk 
                    pemerintahan, swasta, akademik maupun sekolah serta sudah ribuan alumni peserta training kami yang tersebar di seluruh Indonesia, Eropa dan Asia.
                </span><br><br>

            <!--TARGET PESERTA-->
            <li><b>TARGET PESERTA & SILABUS</b></li>
                <span style="text-align: justify">
                    <b>Target Peserta :</b><br>
                    Program ini dapat diikuti oleh siapapun yang berasal dari kalangan umum, karena dibimbing dari NOL dengan system pembelajaran 90% praktek dan 10% teori dengan GARANSI  sampai Bisa sebagaimana silabus yang telah kami susun.
                </span><br><br>
                
            <!--SILABUS-->
            <li><b>SILABUS</b></li>
                <span style="text-align: justify">Pelaksanaan pada tanggal 
                    <?php if(!empty($detail->in_house_tanggal_mulai) && !empty($detail->in_house_tanggal_selesai)){?>
                        <?= $this->etc->tgl($detail->in_house_tanggal_mulai) ?> hingga <?= $this->etc->tgl($detail->in_house_tanggal_selesai) ?> dengan system pembelajaran full praktek serta dilengkapi dengan perangkat lengkap.</p>
                    <?php }?>
                     <?php if(!empty($detail->private_tanggal_mulai)){?>
                        <?= $this->etc->tgl($detail->private_tanggal_mulai) ?> dengan system pembelajaran full praktek serta dilengkapi dengan perangkat lengkap.
                    <?php }?>
                </span>
                <?php $data['silabus'] = $this->db->query("SELECT silabus FROM jenis WHERE id_jenis IN ('".$detail->id_jenis."')")->row()->silabus;?>
                <div style="padding: 10px, 0, 10px, 0">
                    <?php echo $this->load->view('pdf-silabus', $data, TRUE) ?>
                </div>
            
            <!--JADWAL AND TEMPAT-->
            <br/>
            <li ><b>JADWAL DAN TEMPAT</b></li>
                <span>Jadwal:<br>
                <?php if(!empty($detail->in_house_tanggal_mulai) && !empty($detail->in_house_tanggal_selesai)){?>
                    <b>Pelaksanaan pada tanggal <?= $this->etc->tgl($detail->in_house_tanggal_mulai) ?> hingga <?= $this->etc->tgl($detail->in_house_tanggal_selesai) ?></b>
                <?php }?>
                 <?php if(!empty($detail->private_tanggal_mulai)){?>
                    <b>Pelaksanaan pada tanggal <?= $this->etc->tgl($detail->private_tanggal_mulai) ?></b>
                <?php }?><br>
                Tempat: </span><br>
                <!-- GET ALAMAT -->
                <span style="text-align: justify">
                    <?php 
                    $pilkel = $detail->pilihan_kelas;
                    if($pilkel == "private-offline"){
                        echo '<b>PRIVATE OFFLINE CLASSS : </b>';
                        $kota = $detail->private_kota_pelaksanaan;
                        $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                        if(!empty($alamat)){
                            echo "Pelaksanaan di ". $alamat->alamat;
                        }else{
                            echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                            Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                        }
                    }else if($pilkel == "reg"){
                        echo '<b>REGULER CLASS : </b>';
                        $kota = $detail->kota;
                        $alamat = $this->db->query("SELECT * FROM alamat WHERE daerah LIKE '%$kota%'")->row();
                        if(!empty($alamat)){
                            echo "Pelaksanaan di ". str_replace('MAPS Klik dsini', '', strip_tags($alamat->alamat));
                        }else{
                            echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                            Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                        }
                    }else if($pilkel == "in-house"){
                         echo '<b>IN HOUSE CLASSS : </b>';
                        $kota = $detail->in_house_kota_pelaksanaan;
                        if(strtolower($kota) == "online" || strtolower($kota) == 'daring'){
                            echo "Pelaksanaan dilakukan secara $kota sesuai dengan pilihan yang sudah ditentukan sebelumnya";
                        }
                        else{
                            echo "Pelaksanaan di kota ". $kota;
                        }
                    }else{
                        echo '<b>PELAKSANAAN : </b>';
                        echo "Pelaksanaan di kantor kami di Gedung PT. Lauwba Techno Indonesia (Utara Universitas AMIKOM Yogyakarta) 
                            Jl. Sukun Perumahan Puri Adi Citra No B1, Condongcatur, Sleman, Yogyakarta 55281";
                    }
                    ?>
                .</span>
            
            <!--FASILITAS-->
            <br>
            <br>
            <li><b>FASILITAS  & BIAYA</b></li>
                <b>Fasilitas</b>
                <div class="padding: 10px, 0, 10px, 0">
                    <ul>
                        <li>Sertifikat</li>
                        <li>GRATIS Mengulang Sampai Bisa Dikantor Kami (Yogyakarta)</li>
                        <li>Baju Kaos Training</li>
                        <li>Goodybag</li>
                        <li>Modul Dalam Bentuk Buku</li>
                        <li>Software untuk tools develop</li>
                        <li>Perangkat alat teknisi selama training</li>
                        <li>Grup konsultansi via WA setelah training selesai</li>
                    </ul>
                </div>
                <b>Biaya</b>
                <div class="biaya">
                    <?php 
                       $additionalInfo = "";
                       $hrg = "";
                       $multiplier = "";
                       $psrtaString = "";
                       if($detail->pilihan_kelas == 'reg'){
                           $coret = $detail->biaya_coret;
                           $hrg = $detail->harga;
                           $jdwl = (!empty($this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row())) ? $this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row()->tanggal : "";
                           $additionalInfo .= "<i>(Kelas Reguler Offline: Jadwal $jdwl)</i>";
                       }else if($detail->pilihan_kelas == 'private-offline'){
                           $coret = $detail->biaya_private_coret;
                           $additionalInfo .= "<i>(Kelas ".strtolower(str_replace("-", " ", $detail->pilihan_kelas)).")</i>";
                           $hrg = $detail->harga;
                       }else if($detail->pilihan_kelas == 'in-house'){
                           $coret = $detail->biaya_inhouse_coret;
                           $psrta = $detail->in_house_jumlah_peserta;
                           $psrtaString = "(Peserta: $psrta Orang)";
                           $pelaksanaan = date_format(date_create($detail->in_house_tanggal_mulai), "d-m-Y");
                           $additionalInfo .= "<i> (Kelas ".strtolower(str_replace("-", " ", $detail->pilihan_kelas)).": Pelaksanaan $pelaksanaan)</i>";
                           $hrg = ($detail->harga/$psrta);
                           $multiplier = " x ". $psrta;
                           
                       }else if($detail->pilihan_kelas == 'private-online'){
                           $coret = $detail->biaya_private_online_coret;
                           $additionalInfo .= "<i> (Kelas ".strtolower(str_replace("-", " ", $detail->pilihan_kelas)).")</i>";
                           $hrg = $detail->harga;
                       }else if($detail->pilihan_kelas == 'reg-online'){
                           $coret = $detail->biaya_reg_online_coret;
                           $jdwl = (!empty($this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row())) ? $this->db->query("SELECT * FROM jadwal WHERE id IN ('$detail->jadwal')")->row()->tanggal : "";
                           $additionalInfo .= "<i> (Kelas Reguler Online: Jadwal $jdwl)</i>";
                           $hrg = $detail->harga;
                       }else if($detail->pilihan_kelas == "inkubator"){
                           $coret = $detail->biaya_incubator_coret;
                           $additionalInfo .= "<i>(".$detail->pilihan_kelas.": Durasi ".$detail->durasi. " bulan)</i>";
                           $hrg = ($detail->harga/$detail->durasi);
                           $multiplier = " x ". $detail->durasi;
                       }
                       ?>
                    <?php $voucher = $detail->voucher;?>
                    <table style="width: 100%;" class="table-border">
                       <tr>
                            <td><?php echo $detail->judul?><br><small><?= $psrtaString?></small><br><small class="text-capitalize"><?= $additionalInfo?></small></td>
                            <td style="text-align: right;"><span class="text-danger"><del>Rp. <?php echo $this->etc->rps($coret)?></del></span>&nbsp;&nbsp;Rp. <?= $this->etc->rps($hrg) . $multiplier?>
                            <?php if(!empty($voucher)){?>
                            <br> 
                            (Voucher <span class="text-uppercase"><?= $voucher?></span>) 
                            <?php }?>
                            </td>
                        </tr>
                         <?php $subtotal = $detail->harga-$detail->random?>
                        <tr class="border_bottom">
                            <td>Kode Unik</td>
                            <td  style="text-align: right;">Rp. <?php echo $detail->random ?></td>
                        </tr>
                        <tr class="border_bottom">
                            <td class="text-right">Subotal</td>
                            <td  style="text-align: right;">Rp. <?php echo $this->etc->rps($subtotal)?></td>
                        </tr>
                        <tr class="border_bottom">
                            <td class="text-right">Total</td>
                            <td  style="text-align: right;"><b>Rp. <?php echo $this->etc->rps($subtotal)?></b></td>
                        </tr>
                    </table>
                    </div>
                        <b>Catatan :</b><br><i>Untuk In House Training dengan Pelaksanaan ditempat Bpk/Ibu, Cukup menambah biaya akomodasi <b>(transport dan penginapan)</b> untuk instruktur kami.</i><br><br>
                </div>
                <div class="break"></div>
                <div class="pembayaran"><br>
                <b>Pembayaran Bisa Melalui Rekening dibawah ini</b><br/><br/>
                    <?php 
                    $getPathRekening = base_url('411/assets/images/rekening/');
                    $rekening = $this->db->select("*, concat('$getPathRekening', filename) as fullpath")->from('rekening')->where(['is_active' => '1'])->get()->result();
                    ?>
                    <div class="center-x">
                        <?php foreach($rekening as $rr){?>
                            <img src="<?= $rr->fullpath?>" alt="<?= $rr->filename?>" style="width: 45%" onclick="copyRekening('<?= $rr->nomor_rekening?>')"
                                class="img img-fluid w-75"/><br>
                        <?php }?>
                        <img src="https://www.lauwba.com/assets/img/footer-rekening.png" style="width: 45%" class="img img-fluid w-75 mb-2">
                    </div>
                </ol>
            </div>
        </ol>
    </div>
  </div>

  <script>
    document.addEventListener("pagedjs:rendered", () => {
      document.querySelector("p").style.margin="0";
      document.querySelector("#print-btn").style.display = "block";
      document.querySelectorAll(".totalPages").forEach(el => {
        el.textContent = pagedjs.pages.length;
      });
    });
  </script>

</body>

</html>