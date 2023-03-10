<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success d-flex justify-content-end">
        <h1><?php echo session('success'); ?></h1>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger d-flex justify-content-end">
        <h1><?php echo session('danger'); ?></h1>
    </div>
<?php endif;
session()->remove('success');
session()->remove('error'); ?>


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Films Edit</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Post <small>Films</small></h2>
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
                    <div class="x_content row ">
                        <div class="col-12">
                            <span class="section">Films Info</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align  col-2">Title<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control"  placeholder="Game Of Thrones" required value="<?= $data['title'] ?>" readonly />
                                </div>
                            </div>
                            <?php
                            // LOOPING LINK
                            foreach ($link as $dataLink) : ?>
                                <div style="display: <?= $dataLink['tipe'] === "Series" ? '' : 'none' ?>;">Eps : <?= $dataLink['tipe'] === "Series" ? $dataLink['episode'] : '' ?></div>
                                <form action="<?= base_url('admin/link-edit') ?>" method="POST" class="w-100">
                                    <input type="hidden" value="<?= $data['title']?>" name="title">
                                    <div class="field item form-group ">
                                        <label class="col-form-label label-align col-2"><?= $dataLink['quality'] ?><span class="required">*</span></label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" <?= $dataLink['quality'] ? 'checked' : '' ?> name="quality<?= $dataLink['quality'] ?>">
                                            </div>
                                        </div>
                                        <div class="w-100 m-auto">
                                            <input type="hidden" name="id_link" value="<?= $dataLink['id_link'] ?>">
                                            <input type="hidden" name="film_id" value="<?= $dataLink['film_id'] ?>">

                                            <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link GD" name="gd" value="<?= $dataLink['GD'] ?>">
                                            <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link UTB" name="utb" value="<?= $dataLink['UTB'] ?>">
                                            <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link MG" name="mg" value="<?= $dataLink['MG'] ?>">
                                        </div>
                                        <button type="submit" class="btn btn-info">Edit</button>
                                    </div>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>











<?= $this->endSection() ?>