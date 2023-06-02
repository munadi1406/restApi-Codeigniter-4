<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>


<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger d-flex justify-content-end">
        <?php if (is_array(session('error'))) : ?>
            <?php foreach (session('error') as $error) : ?>
                <h5><?= $error ?></h3>
                <?php endforeach ?>
            <?php else : ?>
                <h5><?= esc(session('error')) ?></h5>
            <?php endif ?>
    </div>
<?php endif ?>

<div class="right_col" role="main">
    <?php var_dump(session('error'));?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Genre Add</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add <small>Genre</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="<?= base_url('admin/genre-add') ?>" method="POST">
                        <?= csrf_field() ?>
                            <span class="section">Genre Info</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Genre<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="genre" placeholder="Action..." />
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