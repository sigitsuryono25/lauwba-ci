
<div class="wrapper-page">
    <?php $this->load->view('header-pdf') ?>
    <?php $ddataPorto = $this->db->query("SELECT * FROM gallery join album on album.id_album=gallery.id_album where gallery.id_album='17' order by seq asc LIMIT 18")->result()?>
    <h4 class="text-center">Portofolio Mobile Apps</h4>
    <div class="row">
        <?php foreach($ddataPorto  as $dd){?>
        <div class="col-4">
            <div class="highslide-gallery">
                    <img class="lazyload img-thumbnail img-fluid" src="../../img_galeri/<?php echo $dd->gbr_gallery ?>" alt="peserta-training-utusan-dari-bpjs-kesehatan-pusat.png" title="Klik Untuk Memperbesar">
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
    
                <?php $this->load->view('footer-pdf') ?>
</div>