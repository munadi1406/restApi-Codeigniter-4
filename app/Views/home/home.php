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
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Post</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['countpost'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Post Show</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['countpostshow'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Movie</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['countpostmovie'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Series</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['countpostseries'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br />


  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          <?= $data['totalPengunjung'] ?>
          <div class="text-white-50 small">Total Pengunjung</div>
        </div>
      </div>
    </div>


    <div class="col-lg-6 mb-4">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          <?= $data['pengunjungPerTahun'] ?>
          <div class="text-white-50 small">Total Pengunjung Tahun Ini</div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card bg-info text-white shadow">
        <div class="card-body">
          <?= $data['pengunjungPerBulan'] ?>
          <div class="text-white-50 small">Total Pengunjung Bulan Ini</div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card bg-danger text-white shadow">
        <div class="card-body">
          <?= $data['pengunjungPerMinggu'] ?>
          <div class="text-white-50 small">Total Pengunjung 7 Hari Terakhir</div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 mb-4">
      <div class="card bg-secondary text-white shadow">
        <div class="card-body">
          <?= $data['pengunjungPerHari'] ?>
          <div class="text-white-50 small">Total Pengunjung Hari Ini</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Statistik Device</h6>
        </div>
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myChart" class="w-100 h-100"></canvas>
          </div>
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