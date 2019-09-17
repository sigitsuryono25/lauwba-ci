</div>
<div class="clearfix"></div>
<div class="footer_graph"></div>
<div class="clearfix"></div>
<div class="footer1">
    <div class="clearfix divider_dashed1"></div>
    <div class="container">
        <div class="row">
            <div class="p-4 col-md-3">
                <img src="<?php echo base_url('assets/img/logo-lauwba-techno-putih.png') ?>" class="img-fluid mb-3">
                <p> <a href="#" class="text-light mt-2">
                        <i class="fa d-inline mr-3 fa-map-marker text-muted"></i>Jl. Kusumanegara No. 224 Yogyakarta</a> </p>
                <p> <a href="#" class="text-light mt-2">
                        <i class="fa d-inline mr-3 fa-map-marker text-muted"></i>Jl. Kusumanegara No. 224 Yogyakarta</a> </p>
                <p> <a href="#" class="text-light mt-2">
                        <i class="fa d-inline mr-3 fa-map-marker text-muted"></i>Jl. Kusumanegara No. 224 Yogyakarta</a> </p>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light ">Mapsite</h2>
                <ul class="list-unstyled"> 
                    <a href="#" class="text-light ">Home</a> <br> 
                    <a href="#" class="text-light ">About us</a> <br> 
                    <a href="#" class="text-light ">Our services</a> <br> 
                    <a href="#" class="text-light ">Stories</a> 
                </ul>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light ">Contact</h2>
                <p> <a href="tel:02744281507" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-phone"></i>0274-428-1507</a> </p>
                <p> <a target="_blank" href="https://api.whatsapp.com/send?phone=6282221777206&text=Maaf%20Bu,%20Mau%20Konsultasi%20tentang%20training/kursus%20di%20Lauwba..." class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-whatsapp"></i>08 222 1 777 206</a> </p>
                <p> <a href="#" class="text-light ">
                        <i class="fa d-inline mr-3 text-muted fa-envelope-o"></i>info@lauwba.com</a> </p>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light ">Subscribe</h2>
                <form>
                    <fieldset class="form-group"> <label for="exampleInputEmail1">Get our newsletter</label> <input type="email" class="form-control" placeholder="Enter email"> </fieldset> <button type="submit" class="btn btn-outline-dark">Submit</button>
                </form>
            </div>
            <div class="col-md-12">
                <p class="lead text-center text-light"> Lauwba Techno Indonesia &copy; <?php echo date("Y") ?></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
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
    <script type="text/javascript">
        (function () {
            var options = {
                whatsapp: "+6282221777206", // WhatsApp number
                call_to_action: "Chat di WA Langsung...", // Call to action
                position: "right", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>
</body>
</html>
