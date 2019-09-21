<?php $this->load->view('popup');?>
</div>
</main>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script  defer src="https://www.googletagmanager.com/gtag/js?id=UA-68309693-2"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js" defer></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js" defer></script>
<script type="text/javascript" src="https://unpkg.com/jquery-easy-loading@2.0.0-rc.2/dist/jquery.loading.js" defer></script>

<script  defer>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-68309693-2');
</script>
<script defer>
    function showLoading(){
        $('body').loading();
    }
    function stopLoading(){
        $('body').loading('stop');
    }
    $(".tb_onsite_upload_btn_wrap").addClass("d-none");
</script>

</div>
<div class="clearfix"></div>
<div class="footer_graph"></div>
<div class="clearfix"></div>
<div class="footer1">
    <!--<div class="clearfix divider_dashed1"></div>-->

    <div class="container-fluid">
        <div class="row">
            <div class="p-4 col-md-3">
                <img src="<?php echo base_url('assets/img/logo-lauwba-techno-putih.webp') ?>" alt="logo lauwba putih" class="img-fluid mb-3">
                <p class="text-left text-light"> PT. Lauwba Techno Indonesia merupakan perusahaan yang bergerak dibidang teknologi informasi khususnya IT Consultant, Software Development, IT Training & Digital Marketing dengan
                    <span class="font-weight-bold">SKT.KEMENKUMHAM RI NO AHU-0022789.AH.01.01</span>
                </p>
                <!--<p> <a href="#" class="text-light mt-2" style="text-decoration: none">-->
                <!--        <i class="fa d-inline mr-3 fa-map-marker text-muted"></i>Yogyakarta : Jl. Kusumanegara No 224 Yogyakarta</a> </p>-->
                <!--<p> <a href="#" class="text-light mt-2" style="text-decoration: none">-->
                <!--        <i class="fa d-inline mr-3 fa-map-marker text-muted"></i>Jakarta (Jabotabek) : Jl. Bougenvile II No.2, Jombang, Ciputat, South Tangerang City</a> </p>-->
                <!--<p> <a href="#" class="text-light mt-2" style="text-decoration: none">-->
                <!--        <i class="fa d-inline mr-3 fa-map-marker text-muted"></i>Makassar : (Samping STMIK Dipanegara) Jl. Perintis Kemerdekaan No.4Makassar, Sulawesi Selatan</a> </p>-->
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light ">Tentang Kami</h2>
                <ul class="list-unstyled"> 
                    <a href="<?php echo base_url() ?>" class="text-light ">Profil</a> <br> 
                    <a href="<?php echo base_url('infront/teams') ?>" class="text-light ">Teams</a> <br> 
                    <a href="<?php echo base_url('infront/contact') ?>" class="text-light ">Kontak</a> <br> 
                    <a href="<?php echo base_url('infront/portofolio') ?>" class="text-light ">Portofolio</a> <br> 


                </ul>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light ">Contact</h2>
                <p> <a href="tel:02744281507" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-phone"></i>0274-4435 9440</a> </p>
                <p> <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konsultasi%20tentang%20training/kursus%20di%20Lauwba..." class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206</a> </p>
                <p> <a href="#" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-envelope-o"></i>info@lauwba.com</a> </p>

            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light display-3"></h2>
                <br>
                <p> <a target="_blank" href="http://www.facebook.com/LauwbaTechno" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-facebook-square"></i>Lauwba Techno Indonesia</a> </p>
                <p> <a target="_blank" href="https://twitter.com/@lauwbatechno" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-twitter-square"></i>@lauwbatechno</a> </p>
                <p> <a target="_blank" href="https://www.instagram.com/lauwba_techno/" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-instagram"></i>@lauwba_techno</a> </p>
                        
                <!-- Histats.com  (div with counter) -->
                <div id="histats_counter"></div>
                <!-- Histats.com  START  (aync)-->
                <script type="text/javascript">var _Hasync = _Hasync || [];
                    _Hasync.push(['Histats.start', '1,4406956,4,111,175,25,00011111']);
                    _Hasync.push(['Histats.fasi', '1']);
                    _Hasync.push(['Histats.track_hits', '']);
                    (function () {
                        var hs = document.createElement('script');
                        hs.type = 'text/javascript';
                        hs.async = true;
                        hs.src = ('//s10.histats.com/js15_as.js');
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                    })();</script>
                <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4406956&101" alt="" border="0"></a></noscript>
                <!-- Histats.com  END  -->
            </div>
            <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">
//var _Hasync= _Hasync|| [];
//_Hasync.push(['Histats.start', '1,4989660,4,15,170,40,00011111']);
//_Hasync.push(['Histats.fasi', '1']);
//_Hasync.push(['Histats.track_hits', '']);
//(function() {
//var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
//hs.src = ('//s10.histats.com/js15_as.js');
//(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
//})();
</script>
<!--<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4989660&101" alt="" border="0"></a></noscript>-->
            
            <div class="col-md-12">
                <!--<p class="lead text-center text-light"> Terdaftar sebagai MEMBER:-->
                <!--    <img src="<?php echo base_url('img/google-partner-lauwba.jpg') ?>" class="img-fluid mb-3">-->

                <p class="lead text-center text-light"> PT. Lauwba Techno Indonesia &copy; <?php echo date("Y") ?></p>

            </div>
        </div>
    </div>
    <a id="back-to-top" class="float" style="cursor: pointer">
        <i class="fa fa-arrow-up my-float text-light"></i>
    </a>

    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script type="text/javascript" defer>
    var footerUsed = "<?= $this->input->get('used_footer') == 0?>";
                    hs.graphicsDir = "<?php echo base_url() ?>" + 'assets/highslide/graphics/';
                    hs.align = 'center';
                    hs.transitions = ['expand', 'crossfade'];
                    hs.outlineType = 'rounded-white';
                    hs.fadeInOut = true;
                    hs.dimmingOpacity = 0.75;

                    // Add the controlbar
                    if (hs.addSlideshow)
                        hs.addSlideshow({
                            //slideshowGroup: 'group1',
                            interval: 5000,
                            repeat: false,
                            useControls: false,
                            fixedControls: 'fit',
                            overlayOptions: {
                                opacity: .75,
                                position: 'bottom center',
                                hideOnMouseOut: true
                            }
                        });
    </script>
    <script  defer>
        function parentRegister(){
            window.location.assign("<?= site_url('infront/daftar')?>");
        }
        
        function openUrl(url){
           window.location.assign(url);
        }
        
        function parentJadwal(id){
            window.location.assign("<?= site_url('infront/jadwal#')?>" + id);
        }
        function hubWa(){
            window.location.assign('https://api.whatsapp.com/send?phone=6282221777206&text=Nama%3A%20%0D%0AAsal%3A%20%0D%0AMau%20Private%20Project%2FWebinar%3A...')
        }
        function autoResize(){
            $('#kelas-compare').height($('#kelas-compare').contents().height());
        }
    
        $('.phone').mask("(62) 000-0000-0000");
        $(document).ready(function () {
            // $('[data-toggle="popover"]').popover();   
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function () {
                $('#back-to-top').tooltip('hide');
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
            $('#back-to-top').tooltip('show');

        });
    </script>
    
    <?php if(!isset($_GET['used_footer'])){ ?>
    <script  defer>
    const pendaftarTimeOut = setInterval(getPendaftar, 7000);
    function getPendaftar(){
        $.get("https://lauwba.com/webservices/getRandomPendaftar", function(res){
             Toastify({
                text: res.nama_lengkap + "<br>" + res.instansi + "<br><b>Telah MENDAFTAR</b><br><small style='color: red'>"+ res.judul +"</small>",
                offset: {
                    x: 60, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                    y: 40 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                },
                duration: 2000,
                gravity: 'bottom',
                position: 'left',
                escapeMarkup: false,
                style: {
                     background: "linear-gradient(to right, #FFF, #FFF)",
                     color: "#000",
                     'border-radius': "10px",
                     'font-size': "11px",
                     'box-shadow': "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)"
                }
        }).showToast();
        }, 'json');
    }
    </script>
    

    <!--widgetwhats-->
    <script defer src="https://s.widgetwhats.com/wwwa.js" data-wwwa="5630"></script>
    <!--Start of Tawk.to Script-->
    // <script type="text/javascript">
    //     var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    //     (function () {
    //         var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
    //         s1.async = true;
    //         s1.src = 'https://embed.tawk.to/55336119970a9a5c23b8fd43/default';
    //         s1.charset = 'UTF-8';
    //         s1.setAttribute('crossorigin', '*');
    //         s0.parentNode.insertBefore(s1, s0);
    //     })();
    // </script>
    <!--End of Tawk.to Script-->
    <script defer>
        function getCookie(name) {
        var dc = document.cookie;
        var prefix = name + "=";
        var begin = dc.indexOf("; " + prefix);
        if (begin == -1) {
            begin = dc.indexOf(prefix);
            if (begin != 0) return null;
        }
        else
        {
            begin += 2;
            var end = document.cookie.indexOf(";", begin);
            if (end == -1) {
            end = dc.length;
            }
        }
        // because unescape has been deprecated, replaced with decodeURI
        //return unescape(dc.substring(begin + prefix.length, end));
        return decodeURI(dc.substring(begin + prefix.length, end));
    } 
    </script>
    <?php }?>
    <script  defer>
            $(function () {
                $('.lazyload').Lazy();
                $("img").each(function () {
                    $(this).addClass("img-fluid lazyload");
                })
                $("iframe").each(function () {
                    $(this).addClass("w-100");
                })
                
                $(".bg-title").removeClass("img-fluid lazyload");
            });
            $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
          if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
          }
          var $subMenu = $(this).next('.dropdown-menu');
          $subMenu.toggleClass('show');
        
        
          $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass('show');
          });
        
        
          return false;
        });
        
        document.addEventListener("click", e => {
          const wrapper = e.target.closest(".youtube");
          if (!wrapper) return;
          const iframe = document.createElement("iframe");
          iframe.addClass
          iframe.src = "https://www.youtube.com/embed/" + wrapper.dataset.embed + "?autoplay=1";
          iframe.frameBorder = "0";
          iframe.style.width = "100%";
          iframe.style.height = "200px";
          iframe.allow = "autoplay; encrypted-media";
          iframe.allowFullscreen = true;
         
          const label = document.createElement("label");
          label.textContent = wrapper.dataset.title;
          label.style.textAlign = "left";
          label.style.fontSize = "16px";
        
          wrapper.innerHTML = "";
          wrapper.appendChild(iframe);
          wrapper.appendChild(label);
        });

    </script>
    <!--Checked Cookie-->
    <?php 
    if(empty($this->input->cookie('lauwba_popup', TRUE))){
        $this->load->view("cookies_popup");
    }
    ?>

<script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "44ef243e4dfb4c9cafe0c5bed2dc8b13"}'></script>
<!-- End Cloudflare Web Analytics -->

</body>
</html>
