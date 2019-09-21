<?php
$idDaftar = $this->uri->segment(2);
$history = $this->db->query("SELECT * FROM history_trans WHERE id_daftar in ('$idDaftar')")->result();
$totalBayar = $this->db->query("SELECT SUM(jumlah_bayar) as totalBayar FROM history_trans WHERE id_daftar in ('$idDaftar')")->row()->totalBayar;
$status = "Belum Dibayar";
if($totalBayar == ($detail->harga-$detail->random)){
    $status = "Lunas";
}else if($totalBayar > 0 && $totalBayar < ($detail->harga-$detail->random)){
    $status = "Sudah Dibayarkan";
}
$getPathRekening = base_url('411/assets/images/rekening/');
$rekening = $this->db->select("*, concat('$getPathRekening', filename) as fullpath")->from('rekening')->where(['is_active' => '1'])->get()->result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title><?php echo $detail->nama_lengkap?> | LKP UNIKOM Yogyakarta</title>
</head>
<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }
</style>

<body>
    <div class="container p-4">
        <div class="text-right" id="printPageButton">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" href="javascript:void(0)" class="btn btn-outline-dark" onclick="window.print()"><i
                        class="fa fa-print"></i> Print</a>
                <a type="button" href="javascript:void(0)" onclick="window.print()" class="btn btn-dark" download><i
                        class="fa fa-download"></i> Download</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 ">
                <img src="https://lkp-unikom.com/assets/img/logo-lkp-unikom-hitam.png" alt="logo lkp-unikom"
                    class="img img-fluid w-20">
            </div>
            <div class="col-md-4 text-center mt-4">
                <span class="font-weight-bold">Tagihan #<?php echo $detail->id?></span><br>
                <span>Tgl Tagihan : <?php echo date_format(date_create($detail->daftar_pada), 'd-m-Y')?></span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-danger"><?= $status?></h3>
                    </div>
                    <div class="col-md-6 mt-2">
                        <p >Jatuh Tempo: <u><i><b><?php echo date_format(date_create($detail->expired_invoices), 'd-m-Y')?></b></i></u></p>
                    </div>
                </div>
                <div class="">
                    <span class="font-weight-bold">Ditagihkan Kepada</span><br>
                    <span class="text-uppercase"><?php echo $detail->nama_lengkap?></span><br>
                    <span class="text-uppercase"><?php echo $detail->instansi?></span>
                </div>
                <div class="mt-5">
                    <span class="font-weight-bold">Dibayarkan Kepada</span><br>
                    <span class="">LKP UNIKOM Yogyakarta (PT. Lauwba Techno Indonesia)</span><br>
                    <span class="">Jl. Taman Kenari A3, Depok, Sleman, Yogyakarta</span><br>
                    <span>Telp. 0274-4281-507</span><br>
                    <span>WA. 089-541-754-2255</span><br>
                    <span><i>www.lkp-unikom.com</i></span>
                </div>
            </div>
            <div class="col-md-4">
                <h6>Metode Pembayaran</h6>
                <img src="<?= base_url('assets/img/header-rekening.png')?>" class="img img-fluid w-100"/>
                <?php foreach($rekening as $rr){?>
                    <img src="<?= $rr->fullpath?>" alt="<?= $rr->filename?>" onclick="copyRekening('<?= $rr->nomor_rekening?>')"
                        class="img img-fluid w-100"/>
                <?php }?>
                <img src="<?= base_url('assets/img/footer-rekening.png')?>" class="img img-fluid w-100 mb-2"/>
                <small class="font-weight-bold">Klik salah satu rekening untuk menyalin nomor rekening</span>
            </div>
        </div>
        <h6 class="text-danger mt-2">Invoice Item <?php echo $detail->id?></h6>
        <?php 
       if($detail->pilihan_kelas == 'reg'){
           $coret = $detail->biaya_coret;
       }else if($detail->pilihan_kelas == 'private-offline'){
           $coret = $detail->biaya_private_coret;
       }else if($detail->pilihan_kelas == 'in-house'){
           $coret = $detail->biaya_inhouse_coret;
       }else if($detail->pilihan_kelas == 'private-online'){
           $coret = $detail->biaya_private_online_coret;
       }else if($detail->pilihan_kelas == 'reg-online'){
           $coret = $detail->biaya_reg_online_coret;
       }
       ?>
        <?php $voucher = $detail->voucher;?>
        <table class="table font-weight-bold">
            <tr>
                <td><?php echo $detail->judul?></td>
                <td class="text-right"><span class="text-danger"><del>Rp.
                            <?php echo $this->etc->rps($coret)?></del></span>&nbsp;&nbsp;Rp.
                    <?php echo $this->etc->rps($detail->harga)?>
                    <?php if(!empty($voucher)){?>
                    <br>
                    (Voucher <span class="text-uppercase"><?= $voucher?></span>)
                    <?php }?>
                </td>
            </tr>
            <?php $subtotal = $detail->harga-$detail->random?>
            <tr>
                <td>Kode Unik</td>
                <td class="text-right">Rp. <?php echo $detail->random ?></td>
            </tr>
            <tr>
                <td class="text-right">Subotal</td>
                <td class="text-right">Rp. <?php echo $this->etc->rps($subtotal)?></td>
            </tr>
            <tr>
                <td class="text-right">Total</td>
                <td class="text-right">Rp. <?php echo $this->etc->rps($subtotal)?></td>
            </tr>
        </table>
        <?php if(!empty($history)){?>
        <h5>Riwayat bayar</h5>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Bayar</th>
                    <th>Nominal Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($history as $kk=>$hh){?>
                <tr>
                    <td><?= $kk+1?></td>
                    <td><?= date_format(date_create($hh->transaksi_pada), 'd-m-Y')?></td>
                    <td class="text-right">Rp. <?= $this->etc->rps($hh->jumlah_bayar)?></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan="2" class="text-right">Total</td>
                    <td class="text-right font-weight-bold">Rp. <?= $this->etc->rps($totalBayar)?></td>
                </tr>
            </tbody>
        </table>
        <?php }?>
        
        <table class="table table-sm">
            <tr>
                <td class="h5 pt-3">Sisa Pembayaran</td>
                <td class="h5 pt-3 text-right text-danger"><u><i>Rp. <?= $this->etc->rps($subtotal-$totalBayar)?></i></u></td>
            </tr>
        </table>
        <hr>
        <div class="container-fluid">
            <h6 class="text-danger"><b>Catatan:</b></h6>
            
                <ol>
                    <li>Harap Simpan/Download Invoice ini</li>
                     <li>DP bisa minimal 50% untuk booking jadwal</li>
                    <li>Harap Transfer sesuai nominal diatas untuk memudahkan proses verifikasi</li>
                    <li>Konfirmasi Pembayaran silahkan WA/SMS di <a href="https://api.whatsapp.com/send?phone=6282221777206&text=&source=&data=" target="_blank"><b>08 222 1 777 206 (klik disini)</b></a></li>
                      <li>Bagi peserta kelas online atau yang dari luar kota, silahkan <b><i>mengirimkan alamat lengkap Anda
                    </b></i>via Chat WA <a href="https://api.whatsapp.com/send?phone=6282221777206&text=&source=&data="
                        target="_blank"><b>082221777206 (klik disini)</a>
                    </b>agar kami bisa langsung mengirimkan <b><i>Buku/Modul yang akan digunakan</b></i>
                    
                     <li>WAJIB melakukan pelunasan diawal sebelum kelas dimulai</li>
                   
                     <li> Tidak dapat dilakukan pembatalan training dan jasa lainnya, hanya bisa reschedule jadwal. Uang yang sudah dibayarkan tidak dapat dikembalikan</li>
                </ol>
            
            
        </div>
        <div class="container-fluid">
            <h6 class="text-danger"><b>Silahkan <b>Download </b> Berkas-berkas pendukung dibawah ini jika
                    dibutuhkan:</b></h6>
            <ul style="list-style: none;">
                <li class="text-decoration-none"><a href="<?= site_url('surat-penawaran/'.$detail->id)?>"
                        class="text-primary font-weight-bold"><i class="fa fa-download"></i> Surat Penawaran</a></li>
                <li class="text-decoration-none"><a
                        href="<?= base_url('assets/berkas-pendukung/company-profile-pt-lauwba-techno-indonesia.pdf')?>"
                        download class="text-primary font-weight-bold"><i class="fa fa-download"></i> Company
                        Profile</a></li>
                <li class="text-decoration-none"><a
                        href="<?= base_url('assets/berkas-pendukung/npwp-pt-lauwba-techno-indonesia.png')?>" download
                        class="text-primary font-weight-bold"> <i class="fa fa-download"></i> NPWP</a></li>
                <li class="text-decoration-none"><a
                        href="<?= base_url('assets/berkas-pendukung/form-registrasi.xlsx')?>" download
                        class="text-primary font-weight-bold"><i class="fa fa-download"></i> Form Registrasi</a><i>
                        (Khusus Peserta yang lebih dari 1 Orang atau peserta In House Training)</i></li>
            </ul>
        </div>
        <hr style="background-color: #EA3F33;">
        <!-- <div class="text-center">
            <p class="font-weight-bold">Legalitas Perusahaan</p>
            <p>SKT.KEMENKUMHAM RI <br>NO AHU-0022789.AH.01.01</p>
            <p>Nomor NPWP : 91.302.590.4-541.000</p>
            <p>PT. Lauwba Techno Indonesia </p>
        </div> -->
        <footer style="background-color: rgb(197, 197, 197);" class="p-3">
            <div class="containter-fluid text-center">
                <h4><i>www.lkp-unikom.com</i></h4>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        
	function copyRekening(textToCopy){
	    navigator.clipboard.writeText(textToCopy).then(
            function() {
              /* clipboard successfully set */
              window.alert('Nomor rekening berhasil di salin');
            }, 
            function() {
              /* clipboard write failed */
              window.alert('Nomor rekening gagal di salin')
            }
        )
	}
    </script>
</body>

</html>