<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<?php if (session()->has('success_message')) : ?>
    <div class="alert alert-success d-flex justify-content-end">
        <h1>
            <?php echo session('success_message'); ?>
        </h1>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger d-flex justify-content-end">
        <?php if (is_array(session('error'))) : ?>
            <?php foreach (session('error') as $error) : ?>
                <h5>
                    <?= esc($error) ?>
                    </h3>
                <?php endforeach ?>
            <?php else : ?>
                <h5>
                    <?= esc(session('error')) ?>
                </h5>
            <?php endif ?>
    </div>
<?php endif; ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data <small>Users</small></h3>
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
                        <h2>Data<small>Useres</small></h2>
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
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_id" class="display border hover dt-responsive nowrap" >
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
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>