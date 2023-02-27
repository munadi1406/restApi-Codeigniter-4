<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>


<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger d-flex justify-content-end">
        <?php if (is_array(session('error'))) : ?>
            <?php foreach (session('error') as $error) : ?>
                <h5><?= esc($error) ?></h3>
                <?php endforeach ?>
            <?php else : ?>
                <h5><?= esc(session('error')) ?></h5>
            <?php endif ?>
    </div>
<?php endif ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Epsiode Add</h3>
                <?php var_dump($data) ?>
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
                        <h2>Add Episode <small>Series</small></h2>
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
                        <form class="" action="<?= base_url('admin/episode-add') ?>" method="POST" >
                            <input type="hidden" name="film_id" value="<?= $data['film_id'] ?>">
                            <span class="section">Films Info</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Name<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="title" placeholder="Game Of Thrones" disabled value="<?= $data['title'] ?>" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Episode<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control disable" name="episode" value="<?= $data['episode'] + 1 ?>"  readonly/>
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align mr-2 col-1">1080<span class="required">*</span></label>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="Checkbox for following text input" value="1080" name="quality1080">
                                    </div>
                                </div>
                                <div class="w-100 m-auto">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link GD" name="gd1080">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link UTB" name="utb1080">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link MG" name="mg1080">
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align mr-2 col-1">720<span class="required">*</span></label>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="Checkbox for following text input" value="720" name="quality720">
                                    </div>
                                </div>
                                <div class="w-100 m-auto">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link GD" name="gd720">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link UTB" name="utb720">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link MG" name="mg720">
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align mr-2 col-1">540<span class="required">*</span></label>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="Checkbox for following text input" value="540" name="quality540">
                                    </div>
                                </div>
                                <div class="w-100 m-auto">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link GD" name="gd540">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link UTB" name="utb540">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Link MG" name="mg540">
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="w-100">
                                        <button type='submit' class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>