<?php
$getPathRekening = base_url('411/assets/images/rekening/');
$rekening = $this->db->select("*, concat('$getPathRekening', filename) as fullpath")->from('rekening')->where(['is_active' => '1'])->get()->result();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    body{
        padding: 10px;
    }
    *{
        font-family: Arial, Helvetica, sans-serif;
    }
    tr.border_bottom td {
        border-bottom:1pt solid #E5E5E5;
        padding: .5em;
    }
</style>
<body style="width: 65%; margin: 0px auto;">
    <table style="width: 100%;">
        <tr>
            <td>
                <img src="https://www.lauwba.com/assets/img/logo-lauwba-techno-indonesia.png" alt="lauwba logo" style="width: 50%;">
            </td>
            <td style="text-align: center;">
                <span><b>Tagihan #<?php echo $detail->id?></b></span><br>
                <span>Tgl Tagihan : <br><b><?php echo date_format(date_create($detail->daftar_pada), 'd-m-Y')?></b></span>
            </td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td><h3 style="color: red">Belum Dibayar</h3></td>
            <td<p >Jatuh Tempo: <u><i><b><?php echo date_format(date_create($detail->expired_invoices), 'd-m-Y')?></b></i></u></p></td>
            <td rowspan="3" style="width: 35%; text-align: right;">
                <h3>Metode Pembayaran</h3>
                <img src="<?= base_url('assets/img/header-rekening.png')?>"  style="width: 75%;"/>
                <?php foreach($rekening as $rr){?>
                    <img src="<?= $rr->fullpath?>" alt="<?= $rr->filename?>" onclick="copyRekening('<?= $rr->nomor_rekening?>')"
                        style="width: 75%;"/>
                <?php }?>
                <img src="<?= base_url('assets/img/footer-rekening.png')?>" style="width: 75%;"/>
            </td>
        </tr>
        <tr>
            <td>
                <span style="font-weight: bold;">Ditagihkan Kepada</span><br>
                <span class="text-uppercase"><?php echo $detail->nama_lengkap?></span><br>
                <span class="text-uppercase"><?php echo $detail->instansi?></span>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <span style="font-weight: bold;">Dibayarkan Kepada</span><br>
                <span class="">PT. Lauwba Techno Indonesia</span><br>
                <span class="">Gedung PT. Lauwba Techno Indonesia, Karangploso,  Piyungan,  Bantul, Daerah Istimewa Yogyakarta 55792 (Sebelah Timur PONPES Islamic Center Binbaz Putri)</span><br>
                <span>Telp. 0274-4281-507</span><br>
                <span>WA. 08 222 1 777 206</span><br>
                <span><i>www.lauwba.com</i></span>
            </td>
        </tr>
    </table>
    <div class="container p-4">
        <h4 style="color: red; margin-top: 3em;">Invoice Item <?php echo $detail->id?></h4> 
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
        <table style="width: 100%;">
           <tr>
                <td><?php echo $detail->judul?><small><?= $psrtaString?></small><br><small class="text-capitalize"><?= $additionalInfo?></small></td>
                <td class="text-right"><span class="text-danger"><del>Rp. <?php echo $this->etc->rps($coret)?></del></span>&nbsp;&nbsp;Rp. <?= $this->etc->rps($hrg) . $multiplier?>
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
                <td  style="text-align: right;">Rp. <?php echo $this->etc->rps($subtotal)?></td>
            </tr>
        </table>
        <div class="container-fluid">
            <h4 style="font-weight: bold;"><b>Catatan:</b></h4>
           <ol>
               <li>Harap Simpan/Download Invoice ini</li>
                <li>Harap Transfer sesuai nominal diatas untuk memudahkan proses verifikasi</li>
                <li>Konfirmasi Pembayaran silahkan WA/SMS di <a href="https://api.whatsapp.com/send?phone=6282221777206&text=&source=&data=" target="_blank"><b>08 222 1 777 206 (klik disini)</b></a></li>
                <li>DP bisa minimal 50%(Diusahakan langsung pelunasan di awal sesuai nominal diatas untuk memudahkan proses verifikasi dan untuk bisa langsung mendapatkan modul pembelajaran)</li>
                <li>Pelunasan paling lambat tanggal <b><?php echo $this->etc->add_date($detail->daftar_pada)?></b> atau <b>1 hari</b> sebelum training dimulai</li>
                <li>Bagi peserta kelas online atau yang dari luar kota, silahkan <b><i>mengirimkan alamat lengkap Anda </b></i>via Chat WA <a href="https://api.whatsapp.com/send?phone=6282221777206&text=&source=&data=" target="_blank"><b>08 222 1 777 206 (klik disini)</a> 
                </b>agar kami bisa langsung mengirimkan <b><i>Buku/Modul yang akan digunakan</b></i>
            </ol>
        </div>
        <div class="container-fluid">
            <h6 class="text-danger"><b>Silahkan <b>Download </b> Berkas-berkas pendukung dibawah ini jika dibutuhkan:</b></h6>
            <ui style="list-style: none;">
                <li class="text-decoration-none"><a href="<?= site_url('surat-penawaran/'.$detail->id)?>" class="text-primary font-weight-bold"><i class="fa fa-download"></i> Surat Penawaran</a></li>
                <li class="text-decoration-none"><a href="<?= base_url('assets/berkas-pendukung/company-profile-pt-lauwba-techno-indonesia.pdf')?>" download class="text-primary font-weight-bold"><i class="fa fa-download"></i> Company Profile</a></li>
                <li class="text-decoration-none"><a href="<?= base_url('assets/berkas-pendukung/npwp-pt-lauwba-techno-indonesia.png')?>" download class="text-primary font-weight-bold"> <i class="fa fa-download"></i> NPWP</a></li>
                <li class="text-decoration-none"><a href="<?= base_url('assets/berkas-pendukung/form-registrasi.xlsx')?>" download class="text-primary font-weight-bold"><i class="fa fa-download"></i> Form Registrasi</a><i> (Khusus Peserta yang lebih dari 1 Orang atau peserta In House Training)</i></li>
            </ul>
        </div>
        <hr style="background-color: #EA3F33;">
        <div class="text-center">
            <p class="font-weight-bold">Legalitas Perusahaan</p>
            <p>SKT.KEMENKUMHAM RI <br>NO AHU-0022789.AH.01.01</p>
            <p>Nomor NPWP : 91.302.590.4-541.000</p>
            <p>PT. Lauwba Techno Indonesia </p>
        </div>
        <footer style="background-color: rgb(197, 197, 197);" class="p-3">
            <div class="containter-fluid text-center">
                <h4><i>www.lauwba.com</i></h4>
            </div>
        </footer>
    </div>
</body>
</html>