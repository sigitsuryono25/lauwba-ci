<?= $this->load->view('headfoot/header')?>
<div class="container-fluid p-0  mb-4" style="margin-top: 110px">
    <div class="head">
        <div class="overlay">
            <h4 class="text-white h-text  text-right font-weight-bold pt-5 px-5 pb-3">
                Daftar Workshop di LTI
            </h4>
        </div>

    </div>
    <div class="container">
        <div class="upcoming p-4">
            <div class="text-center text-primary font-weight-bold ">
                <span class="h4 pb-2"><b>Workshop Berikutnya (upcoming)</b></span><br>
                <span class="border-bottom border-primary">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mt-2">
                    <img src="https://www.rumahcoding.co.id/wp-content/uploads/2020/02/Creative-Design-Poster-768x768.jpg"
                        class="img-fluid rounded" alt="">
                </div>
                <div class="col-md-6 mt-2">
                    <img src="https://www.rumahcoding.co.id/wp-content/uploads/2020/02/Creative-Design-Poster-768x768.jpg"
                        class="img-fluid rounded" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="telah-berlalu p-4">
        <div class="container">
            <div class="text-center text-white font-weight-bold ">
                <span class="h4 pb-2"><b>Workshop yang telah berlalu</b></span><br>
                <span class="border-bottom border-white">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mt-2">
                    <img src="https://www.rumahcoding.co.id/wp-content/uploads/2020/02/Creative-Design-Poster-768x768.jpg"
                        class="img-fluid rounded" alt="">
                </div>
                <div class="col-md-6 mt-2">
                    <img src="https://www.rumahcoding.co.id/wp-content/uploads/2020/02/Creative-Design-Poster-768x768.jpg"
                        class="img-fluid rounded" alt="">
                </div>
                <div class="col-md-6 mt-2">
                    <img src="https://www.rumahcoding.co.id/wp-content/uploads/2020/02/Creative-Design-Poster-768x768.jpg"
                        class="img-fluid rounded" alt="">
                </div>
                <div class="col-md-6 mt-2">
                    <img src="https://www.rumahcoding.co.id/wp-content/uploads/2020/02/Creative-Design-Poster-768x768.jpg"
                        class="img-fluid rounded" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->load->view('module_it_training_courses')?>
<?= $this->load->view('module_testimoni')?>
<?= $this->load->view('headfoot/footer')?>