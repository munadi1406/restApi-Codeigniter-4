<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Log Activity</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Visit Time</th>
                                <th>Ip Address</th>
                                <th>Browser</th>
                                <th>Operating System</th>
                                <th>Visited Page</th>
                                <th>Arrival Time</th>
                                <th>Referer</th>
                                <th>Screen Resolution</th>
                                <th>Device</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $datas) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $datas['visit_time'] ?></td>
                                    <td><?= $datas['ip_address'] ?></td>
                                    <td><?= $datas['browser'] ?></td>
                                    <td><?= $datas['operating_system'] ?></td>
                                    <td><?= $datas['visited_page'] ?></td>
                                    <td><?= $datas['arrival_time'] ?></td>
                                    <td><?= $datas['referrer'] ?></td>
                                    <td><?= $datas['screen_resolution'] ?></td>
                                    <td><?= $datas['device'] ?></td>
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