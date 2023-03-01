<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

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
                                    <table id="table_id" class="display border hover dt-responsive " cellspacing="0" width="100%"">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Desc</th>
                                                <th>Tipe</th>
                                                <th>Genre</th>
                                                <th>Date</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>trailer</th>
                                                <th>Subtitle</th>
                                                <th>Status</th>
                                                <th>link</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($data as $datas) : $images = basename($datas['image']) ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td ><?= $datas['username'] ?></td>
                                                    <td>
                                                        <div style=" width: 100px; overflow:auto; ">
                                        <?= $datas['title'] ?>
                                </div>
                                </td>
                                <td>
                                    <div style="height:100px; width: 200px; overflow-y:auto; display: flex;justify-content: start; align-items: center;">
                                        <?= $datas['desc'] ?>
                                </div>
                                </td>
                                <td>
                                    <div>
                                        <?= $datas['tipe'] ?>
                                    </div>
                                    <form action="<?= base_url('admin/episode') ?>" method="POST">
                                        <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                        <button type="submit" class="badge badge-primary border" style="display: <?= $datas['tipe'] === 'Series' ? '' : 'none' ?>;">add</button>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                                $genres = explode(",", $datas['name']);
                                                $colors = array("badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-light", "badge-dark");
                                                $i = 0;
                                                foreach ($genres as $genre) : ?>
                                        <div class="badge <?= $colors[$i % count($colors)] ?>">
                                            <?= $genre ?>
                                        </div>
                                    <?php $i++;
                                                endforeach; ?>
                                </td>

                                <td>
                                    <?= $datas['date'] ?>
                                </td>
                                <td>
                                    <?= $datas['created_at'] ?>
                                </td>
                                <td>
                                    <?= $datas['updated_at'] ?>
                                </td>
                                <td><a href=" <?= $datas['trailer'] ?>" class="badge badge-danger" style="display: <?php echo $datas['trailer'] ? '' : 'none' ?>;" target="_blank">Trailer</a></td>
                                <td><a href="<?= $datas['subtitle'] ?>" class="badge badge-info" style="display: <?= $datas['subtitle'] ? '' : 'none' ?>;" target="_blank">Subtitle</a></td>
                                <td>
                                    <div class=" badge badge-primary">
                                        <?= $datas['status'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="max-height: 200px; overflow-x: auto;padding: 5px;">
                                        <?php
                                                $search_id = $datas['film_id'];
                                                $links = $datas['tipe'] === 'Series' ? $linkseries : $link;
                                                foreach ($links as $series) {
                                                    if ($series['film_id'] == $search_id) { ?>
                                                <div>
                                                    <?php echo $datas['tipe'] === 'Series' ? "Episode " . $series['episode'] . ' ' . $series['quality'] : $series['quality'] ?>
                                                </div>
                                                <div class="wrapper-link-post" style="display: <?php echo $series['quality'] ? 'flex' :  '' ?>; overflow: auto !important; max-height:200px !important ;">
                                                    <a href="<?php echo $series['GD'] ?>" style="margin-right:5px ; display:<?php echo $series['GD'] ? '' : 'none' ?>" class="badge badge-primary " target="_blank">GD</a>
                                                    <a href="<?php echo $series['UTB'] ?>" style="margin-right:5px; display:<?php echo $series['UTB'] ? '' : 'none' ?>" class="badge badge-success" target="_blank">UTB</a>
                                                    <a href="<?php echo $series['MG'] ?>" style=" display: <?php echo $series['MG'] ? '' : 'none' ?>" class="badge badge-danger " target="_blank">MG</a>
                                                </div>
                                        <?php }
                                                }
                                        ?>
                                    </div>
                                </td>
                                <td><img src="<?php echo $datas['image'] ?>" alt="" width="50" class="image" loading="lazy"></td>
                                <td>
                                    <form action="<?= base_url('admin/edit') ?>" method="POST">
                                        <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                        <button type="submit" class="btn btn-success">Edit Film</button>
                                    </form>
                                    <form action="<?= base_url('admin/link') ?>" method="POST">
                                        <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                        <button type="submit" class="btn btn-secondary">Edit Link</button>
                                    </form>
                                    <form action="<?= base_url('admin/post-delete/' . $datas['film_id']) ?>" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
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