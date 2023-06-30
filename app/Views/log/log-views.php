<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          <?= $dataCount['totalPengunjung'] ?>
          <div class="text-white-50 small">Total Pengunjung</div>
        </div>
      </div>
    </div>


    <div class="col-lg-6 mb-4">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          <?= $dataCount['pengunjungPerTahun'] ?>
          <div class="text-white-50 small">Total Pengunjung Tahun Ini</div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card bg-info text-white shadow">
        <div class="card-body">
          <?= $dataCount['pengunjungPerBulan'] ?>
          <div class="text-white-50 small">Total Pengunjung Bulan Ini</div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card bg-danger text-white shadow">
        <div class="card-body">
          <?= $dataCount['pengunjungPerMinggu'] ?>
          <div class="text-white-50 small">Total Pengunjung 7 Hari Terakhir</div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 mb-4">
      <div class="card bg-white text-primary shadow">
        <div class="card-body">
          <?= $dataCount['pengunjungPerHari'] ?>
          <div class="text-primary-50 small">Total Pengunjung Hari Ini</div>
        </div>
      </div>
    </div>
  </div>
    <div class="row">
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Postingan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive col-lg-12">
                    <table class="table display " id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>views</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $datas) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $datas['title'] ?></td>
                                    <td><?= $datas['views'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>