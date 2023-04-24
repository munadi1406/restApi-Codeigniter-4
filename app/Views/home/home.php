<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php

$osArray = array();
$osCountArray = array();
foreach ($data['os'] as $os) {
  $osArray[] = $os['operating_system'];
  $osCountArray[] = $os['count(operating_system)'];
}

// var_dump($osCountArray);
$osString = "'" . implode("', '", $osArray) . "'";
$osCountString = implode(',', $osCountArray);

?>
<div class="right_col h-100 d-flex flex-column" role="main">
  <!-- top tiles -->

  <div class="row tile_count">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="tile_stats_count">
        <span class="count_top"><i class="fa fa-newspaper-o"></i> Total Post </span>
        <div class="count"><?= $data['countpost'] ?></div>
        <a href="<?= base_url('admin/post-data') ?>" class="count_bottom"><i class="fa fa-chevron-right"></i> Show</a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="tile_stats_count">
        <span class="count_top"><i class="fa fa-eye"></i> Post Show</span>
        <div class="count"><?= $data['countpostshow'] ?></div>
        <a href="<?= base_url('admin/post-data') ?>" class="count_bottom"><i class="fa fa-chevron-right"></i> Show</a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="tile_stats_count">
        <span class="count_top"><i class="fa fa-youtube-play"></i> Movie</span>
        <div class="count green"><?= $data['countpostmovie'] ?></div>
        <a href="<?= base_url('admin/post-data') ?>" class="count_bottom"><i class="fa fa-chevron-right"></i> Show</a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="tile_stats_count">
        <span class="count_top"><i class="fa fa-youtube-play"></i> Series</span>
        <div class="count"><?= $data['countpostseries'] ?></div>
        <a class="count_bottom"><i class="fa fa-chevron-right"></i> Show</a>
      </div>
    </div>
  </div>

  <!-- /top tiles -->

  <br />


  <div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats bg-primary text-light">
        <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
        <div class="count"><?= $data['totalPengunjung'] ?></div>
        <h3>Total Pengunjung</h3>
        <p>Total Seluruh Pengunjung</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats bg-secondary text-light">
        <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
        <div class="count"><?= $data['pengunjungPerTahun'] ?></div>

        <h3>Tahun</h3>
        <p>Total Pengunjung Tahun Ini</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats bg-success text-light">
        <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
        <div class="count"><?= $data['pengunjungPerBulan'] ?></div>

        <h3>Bulan</h3>
        <p>Total Pengunjung Bulan Ini</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats bg-info text-light">
        <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
        <div class="count"><?= $data['pengunjungPerMinggu'] ?></div>

        <h3>Minggu</h3>
        <p>Total Pengunjung 7 Hari Terakhir</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats bg-dark text-light">
        <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
        <div class="count"><?= $data['pengunjungPerHari'] ?></div>

        <h3>Hari</h3>
        <p>Total Pengunjung Hari Ini</p>
      </div>
    </div>
  </div>
  <div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="" style="width: 80%;">
      <div class="x_panel tile fixed_height_400 overflow_hidden d-flex flex-column justify-center items-center">
        <div class="x_title">
          <h2>Device </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="myChart" class="w-100 h-100"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [<?= $osString ?>],
      datasets: [{
        label: 'Jumlah',
        data: [<?= $osCountString ?>],
        borderWidth: 1
      }]
    },
    options: {


    }
  });
</script>

<?= $this->endSection(); ?>