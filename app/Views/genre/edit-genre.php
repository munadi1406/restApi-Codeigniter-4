<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>



<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show text-right" role="alert">
        <?php if (is_array(session('error'))) : ?>
            <?php foreach (session('error') as $error) : ?>
                <h1> <?= esc($error) ?></h1>
            <?php endforeach ?>
        <?php else : ?>
            <h1><?= esc(session('error')) ?></h1>
        <?php endif ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Genre Edit</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit <small>Genre</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="<?= base_url('admin/genre-update') ?>" method="POST">
                        <?= csrf_field() ?>
                            <span class="section">Genre Info</span>
                            <div class="field item form-group">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <label class="col-form-label  label-align mr-2 col-1">Genre<span class="required">*</span></label>
                                <div class="w-100">
                                    <?php var_dump($data)?>
                                    <input class="form-control" name="genre" placeholder="Action..." value="<?= $data['genre']?>"/>
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