
<div class="wrapper-page">
    <?php $this->load->view('header-pdf') ?>
    <?php $ddataPorto = $this->db->query("SELECT * FROM gallery join album on album.id_album=gallery.id_album where gallery.id_album in ('20', '21', '22') order by seq asc LIMIT 18")->result()?>
    <h4 class="text-center">Portofolio IT Training</h4>
    <div class="row">
        <?php foreach($ddataPorto  as $dd){?>
        <div class="col-4">
            <div class="highslide-gallery">
                    <img style="height: 200px; width: 100%" class="lazyload img-thumbnail img-fluid" src="../../img_galeri/<?php echo $dd->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                </a>
                <div class="text-uppercase" style="margin-top: -52px;position: relative">
                    <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                     <?php echo $dd->jdl_gallery ?>
                    </p>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    <table class="d-none">
        <tr>
            <td>
                <div class="highslide-gallery">
                        <img style="height: 200px; width: 100%" class="lazyload img-thumbnail img-fluid" src="../../img_galeri/peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
                    </a>
                    <div class="text-uppercase" style="margin-top: -52px;position: relative">
                        <p style="padding: 8px; background: rgba(105, 105, 105, .8); color: white; font-size: 12px" class="text-center">
                         Peserta Training utusan dari BPJS Kesehatan Pusat
                        </p>
                    </div>
                </div>
            </td>
            <td class="text-center">
                <img src="<?= base_url('/assets/img/Picture9.png') ?>" alt="" width="50%" class="img-fluid"/><br>
                <small>In House Training Team IT BPJS Ketenagakerjaan Kanwil Jateng DIY</small>
            </td>
            <td class="text-center">
                <img src="<?= base_url('/assets/img/Picture10.png') ?>" alt="" width="50%" class="img-fluid" /><br>
                <small>DIKLAT Online Bag. Pusat Management Proyek PT. PLN (Persero)</small>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <img src="<?= base_url('/assets/img/Picture11.png') ?>" alt="" width="50%" class="img-fluid" /><br>
                <small>BIMTEK Humas Kota Banjarmasin</small>
            </td>
            <td class="text-center">
                <img src="<?= base_url('/assets/img/Picture12.png') ?>" alt="" width="50%"  class="img-fluid"/><br>
                <small>In House Training Android Flutter Team IT PT. Bakrie Pipe Industries</small>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <img src="<?= base_url('/assets/img/Picture13.png') ?>" alt="" width="50%" class="img-fluid"/><br>
                <small>Training TEKNISI Laptop & PC di LAB Terpadu STMIK AKAKOM Yogyakarta</small>
            </td>
        </tr>
    </table>
    
                <?php $this->load->view('footer-pdf') ?>
</div>