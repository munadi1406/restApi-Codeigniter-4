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
                <h3>Users Edit</h3>
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
                        <h2>Users<small>Edit</small></h2>
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
                    <div class="x_content ">
                        <form class="" action="<?= base_url('update-users') ?>" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id_users" value="<?= $data['id_users'] ?>">
                            <span class="section">Users Detail</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Username<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="username" value="<?= $data['username'] ?>" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Email<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control disable" name="email" value="<?= $data['email'] ?>" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Role<span class="required">*</span></label>
                                <select name="role" id="" class="form-control">
                                    <option value="admin" <?= $data['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= $data['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                </select>
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