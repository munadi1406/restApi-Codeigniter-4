<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data <small>Views</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data<small>View Post</small></h2>
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
                        <div class="row">
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                <div class="tile-stats bg-primary text-light">
                                    <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
                                    <div class="count"><?= $dataCount['totalPengunjung'] ?></div>
                                    <h3>Total Pengunjung</h3>
                                    <p>Total Seluruh Pengunjung</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                 <div class="tile-stats bg-secondary text-light">
                                <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
                                    <div class="count"><?= $dataCount['pengunjungPerTahun'] ?></div>

                                    <h3>Tahun</h3>
                                    <p>Total Pengunjung Tahun Ini</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                 <div class="tile-stats bg-success text-light">
                                <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
                                    <div class="count"><?= $dataCount['pengunjungPerBulan'] ?></div>

                                    <h3>Bulan</h3>
                                    <p>Total Pengunjung Bulan Ini</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                 <div class="tile-stats bg-info text-light">
                                <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
                                    <div class="count"><?= $dataCount['pengunjungPerMinggu'] ?></div>

                                    <h3>Minggu</h3>
                                    <p>Total Pengunjung 7 Hari Terakhir</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                 <div class="tile-stats bg-dark text-light">
                                <div class="icon"><i class="fa fa-signal" style="color:white;"></i></div>
                                    <div class="count"><?= $dataCount['pengunjungPerHari'] ?></div>

                                    <h3>Hari</h3>
                                    <p>Total Pengunjung Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_id" class="display border hover dt-responsive nowrap">
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
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>