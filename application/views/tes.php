<div class="container" style="margin-top: 180px">
    <a id="klik" class="btn btn-sm btn-danger"> Klik Me</a>
</div>

<script>
    const pendaftarTimeOut = setInterval(getPendaftar, 1500);
    
    function getPendaftar(){
        $.get("https://lauwba.com/webservices/getRandomPendaftar", function(res){
             Toastify({
                text: res.nama_lengkap + " Telah Mendaftar",
                offset: {
                    x: 60, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                    y: 40 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                },
                duration: 3000,
                gravity: 'bottom',
                position: 'left',
                style: {
                     background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
        }).showToast();
        }, 'json');
    }
    $("#klik").click(function(){
       
    });
</script>