<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php if (session()->has('success_message')) : ?>
    <div class="alert alert-success d-flex justify-content-end">
        <h1><?php echo session('success_message'); ?></h1>
    </div>
    
<?php endif; ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data <small>Films</small></h3>
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
                        <h2>Detail<small>Films</small></h2>
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
                                    <table id="table_id" class="display hover dt-responsive " cellspacing="0" width="100%"">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Desc</th>
                                                <th>Tipe</th>
                                                <th>Date</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>link</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1;

                                            foreach ($data as $datas) :
                                                $images = basename($datas['image'])
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $datas['username'] ?></td>
                                                    <td><?= $datas['title'] ?></td>
                                                    <td><?= $datas['desc'] ?></td>
                                                    <td><?= $datas['tipe'] ?></td>
                                                    <td><?= $datas['date'] ?></td>
                                                    <td><?= $datas['created_at'] ?></td>
                                                    <td><div class=" badge badge-primary"><?= $datas['status'] ?>
                                </div>
                                </td>
                                <td>
                                    <?php
                                                $search_id = $datas['film_id'];

                                                if ($datas['tipe'] === 'Series') {
                                                    foreach ($linkseries as $series) {
                                                        if ($series['film_id'] == $search_id) { ?>
                                                <div><?php echo $datas['tipe'] === 'Series' ? "Episode " . $series['episode'] . ' ' . $series['quality'] : $series['quality'] ?></div>
                                                <div class="wrapper-link-post" style="display: <?php echo $series['quality'] ? 'flex' :  '' ?>; overflow: auto !important; max-height:200px !important ;">
                                                    <a href="<?php echo $series['GD'] ?>" style="margin-right:5px ; display:<?php echo $series['GD'] ? '' : 'none' ?>" class="badge badge-primary " target="_blank">GD</a>
                                                    <a href="<?php echo $series['UTB'] ?>" style="margin-right:5px; display:<?php echo $series['UTB'] ? '' : 'none' ?>" class="badge badge-success" target="_blank">UTB</a>
                                                    <a href="<?php echo $series['MG'] ?>" style=" display: <?php echo $series['MG'] ? '' : 'none' ?>" class="badge badge-danger " target="_blank">MG</a>
                                                </div>
                                            <?php }
                                                    }
                                                } else {
                                                    foreach ($link as $film) {
                                                        if ($film['film_id'] == $search_id) { ?>

                                                <div><?php echo $datas['tipe'] === 'Series' ? "Episode " . $film['episode'] . ' ' . $film['quality'] : $film['quality'] ?></div>
                                                <div class="wrapper-link-post" style="display: <?php echo $film['quality'] ? 'flex' :  '' ?>; overflay-auto">
                                                    <a href="<?php echo $film['GD'] ?>" style="margin-right:5px ; display:<?php echo $film['GD'] ? '' : 'none' ?>" class="badge badge-primary " target="_blank">GD</a>
                                                    <a href="<?php echo $film['UTB'] ?>" style="margin-right:5px; display:<?php echo $film['UTB'] ? '' : 'none' ?>" class="badge badge-success" target="_blank">UTB</a>
                                                    <a href="<?php echo $film['MG'] ?>" style=" display: <?php echo $film['MG'] ? '' : 'none' ?>" class="badge badge-danger " target="_blank">MG</a>
                                                </div>
                                    <?php
                                                        }
                                                    }
                                                }
                                    ?>
                                </td>
                                <td><img src="<?php echo $datas['image'] ?>" alt="" width="50"></td>
                                <td>
                                    <a href="" class="btn btn-info">Edit</a>
                                    <a href="" class="btn btn-warning">Hapus</a>
                                </td>
                                </tr>
                            <?php endforeach; ?>
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