<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

  <div class="row">
    <div class="card shadow mb-4 w-100">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Like</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive col-lg-12">
          <table class="table display " id="myTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Like</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data as $datas) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $datas['title'] ?></td>
                  <td><?= $datas['likes'] ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>