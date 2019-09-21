<?php
$idDaftar = $this->uri->segment(2);
$history = $this->db->query("SELECT * FROM history_trans WHERE id_daftar in ('$idDaftar')")->result();
$totalBayar = $this->db->query("SELECT SUM(jumlah_bayar) as totalBayar FROM history_trans WHERE id_daftar in ('$idDaftar')")->row()->totalBayar;
$detail->expired_invoices = date_format(date_add(date_create($detail->terdaftar_pada), date_interval_create_from_date_string("5 days")), 'd-m-Y');
$status = "Belum Dibayar";
if($totalBayar == ($detail->harga-$detail->random)){
    $status = "Lunas";
}else if($totalBayar > 0 && $totalBayar < ($detail->harga-$detail->random)){
    $status = "Sudah Dibayarkan";
}else if($totalBayar == 0 && ($detail->expired_invoices < date('Y-m-d'))){
    $status = "Expired";    
}
$getPathRekening = base_url('411/assets/images/rekening/');
$rekening = $this->db->select("*, concat('$getPathRekening', filename) as fullpath")->from('rekening')->where(['is_active' => '1'])->get()->result();
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<title><?php echo $detail->nama?> | PT Lauwba Techno Indonesia</title>
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
              <a type="button" href="javascript:void(0)" class="btn btn-outline-dark" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
              <a type="button" href="javascript:void(0)" onclick="window.print()" class="btn btn-dark" download><i class="fa fa-download"></i> Download</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 ">
                <img src="https://www.lauwba.com/assets/img/logo-lauwba-techno-indonesia.png" alt="lauwba logo" 
                    class="img img-fluid w-20">
            </div>
            <div class="col-md-4 text-center mt-4">
                <span class="font-weight-bold">Tagihan #<?php echo $detail->id?></span><br>
                <span>Tgl Tagihan : <?php echo date_format(date_create($detail->terdaftar_pada), 'd-m-Y')?></span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-danger"><?= $status?></h3>
                    </div>
                    <div class="col-md-6 mt-2" >
                        <p >Jatuh Tempo: <u><i><b><?php echo $detail->expired_invoices ?></b></i></u></p>
                    </div>
                </div>
                <div class="">
                    <span class="font-weight-bold">Ditagihkan Kepada</span><br>
                    <span class="text-uppercase"><?php echo $detail->nama?></span><br>
                    <span class="text-uppercase"><?php echo $detail->instansi?></span>
                </div>
                <div class="mt-5">
                    <span class="font-weight-bold">Dibayarkan Kepada</span><br>
                    <span class="">PT. Lauwba Techno Indonesia</span><br>
                    <span class="">Gedung PT. Lauwba Techno Indonesia, Karangploso,  Piyungan,  Bantul, Daerah Istimewa Yogyakarta 55792 (Sebelah Timur PONPES Islamic Center Binbaz Putri)</span><br>
                    <span>Telp. 0274-4281-507</span><br>
                    <span>WA. 08 222 1 777 206</span><br>
                    <span><i>www.lauwba.com</i></span>
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
        <h6 class="text-danger mt-2">Invoice id: <?php echo $detail->uuid?></h6>
        <table class="table font-weight-bold">
            <tr>
                <td colspan='2'><?php echo $detail->judul_aplikasi?><small><?= $psrtaString?></small><br><small class="text-capitalize"><?= $additionalInfo?></small></td>
            </tr>
            <?php $subtotal = $detail->harga + $detail->biaya_kelas?>
            <tr>
                <td class="text-right">Total</td>
                <td class="text-right">Rp. <?php echo $this->etc->rps($subtotal)?></td>
            </tr>
        </table>
        <?php if(!empty($history)){?>
        <h5>Riwayat bayar</h5>
        <table class="table table-sm table-bordered">
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
                <li>Harap Transfer sesuai nominal diatas untuk memudahkan proses verifikasi</li>
                <li>Konfirmasi Pembayaran silahkan WA/SMS di <a href="https://api.whatsapp.com/send?phone=6282221777206&text=&source=&data=" target="_blank"><b>08 222 1 777 206 (klik disini)</b></a></li>
                <li>DP bisa minimal 50%(Diusahakan langsung pelunasan di awal sesuai nominal diatas untuk memudahkan proses verifikasi dan untuk bisa langsung mendapatkan modul pembelajaran)</li>
                <li>Pelunasan paling lambat tanggal <b><?php echo date_format(date_create($detail->expired_invoices), 'd-m-Y')?></b> atau <b>1 hari</b> sebelum training dimulai</li>
                <li>Bagi peserta kelas online atau yang dari luar kota, silahkan <b><i>mengirimkan alamat lengkap Anda </b></i>via Chat WA <a href="https://api.whatsapp.com/send?phone=6282221777206&text=&source=&data=" target="_blank"><b>08 222 1 777 206 (klik disini)</a> 
                </b>agar kami bisa langsung mengirimkan <b><i>Buku/Modul yang akan digunakan</b></i>
            </ol>
        </div>
        <div class="container-fluid">
            <h6 class="text-danger"><b>Silahkan <b>Download </b> Berkas-berkas pendukung dibawah ini jika dibutuhkan:</b></h6>
            <ul style="list-style: none;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
function exportToPdf(){
    var element = document.getElementsByClassName('canvas_div_pdf')[0];
    html2pdf().from(element).save('filename.pdf');
}
    	function getPDF(){

		var HTML_Width = $(".canvas_div_pdf").width();
		var HTML_Height = $(".canvas_div_pdf").height();
		var top_left_margin = 15;
		var PDF_Width = HTML_Width+(top_left_margin*2);
		var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
		var canvas_image_width = HTML_Width;
		var canvas_image_height = HTML_Height;
		
		var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
		

		html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
			canvas.getContext('2d');
			
			console.log(canvas.height+"  "+canvas.width);
			
			
			var imgData = canvas.toDataURL("image/jpeg", 1.0);
			var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
		    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
			
			
			for (var i = 1; i <= totalPDFPages; i++) { 
				pdf.addPage(PDF_Width, PDF_Height);
				pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
			}
			
		    pdf.save("HTML-Document.pdf");
        });
	};
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