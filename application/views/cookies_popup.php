<div class="fixed-bottom bg-primary cookie-container d-none" style="margin-bottom: 45px;z-index: 9999999999;">
    <div class="container-fluid p-2 ">
        <div class="row">
            <div class="col-md-9 text-md-right text-left">
                <p class="text-white mt-2">Kami menggunakan cookie untuk kenyamanan browsing anda. Dengan melanjutkan browsing, anda menyetujui penggunaan cookie pada web kami. <a href="https://id.wikipedia.org/wiki/Kuki_HTTP" target="_blank">Pelajari Lebih Lanjut</a></p>
            </div>
            <div class="col-md-3">
                <button class="btn btn-warning set-coookie mt-1">Saya Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".set-coookie").on("click", function(){
      let url = "<?php echo site_url('welcome/acceptCookies')?>";
      $.get(url, null, function(data){
         console.log(data); 
      });
      $(".cookie-container").addClass("d-none");
    })
</script>