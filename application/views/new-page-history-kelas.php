<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>History ajar</title>
    <style>
        @media print {
          #printPageButton {
            display: none;
          }
        }
    </style>
  </head>
  <body onload="window.print()">
        <div class='container p-5'>
        <h4 class="text-center">History Ajar<br><span class="nama--peserta text-success"><?= $peserta->nama_lengkap?></span></h4>
        <div class="border p-3">
          <ul style="list-style: none;">
            <li>Training: <span class="training font-weight-bold small"><?= $peserta->kelas?></span></li>
            <li>Kelas: <span class="kelas font-weight-bold small text-uppercase"><?= $peserta->pilihan_kelas?></span></li>
            <li>Trainer: <span class="trainer font-weight-bold small"><?= $peserta->tutor->nama?></span></li>
          </ul>
          <hr>
          <div class="text-right text-end my-2" id="print-container">
            <button class="btn btn-sm btn-outline-primary" onclick="window.print()" id="printPageButton"><i class="fa fa-print"></i> Cetak History</button>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead>
              <tr>
                <th>#</th>
                <th>Pelaksanaan</th>
                <th>Laporan Progress</th>
                <th>Progress (%)</th>
              </tr>
              </thead>
              <tbody>
                    <?php foreach($history as $i=>$h){?>
                      <tr>
                        <td><?= $i+1?></td>
                        <td class="font-weight-bold">
                          <?= $h->added_on?>&nbsp;&nbsp;&nbsp;<?= $h->jam_mulai?>-<?=$h->jam_selesai?></td>
                        <td><?= $h->progress?></td>
                        <td class="font-weight-bold"><?= $h->progressval?></td>
                      </tr>
                    <?php }?>
              </tbody>
            </table>
          </div>
        </div>

        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.history.replaceState({}, document.title, '.');
    </script>
  </body>
</html>