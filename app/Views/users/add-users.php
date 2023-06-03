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
                <h3>Users Add</h3>
            </div>
            
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Users<small>add</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                           
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content ">
                        <form class="" action="<?= base_url('add-users') ?>" method="POST">
                            <span class="section">Users Detail</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Username<span class="required">*</span></label>
                                <div class="w-100">
                                    <input type="text" class="form-control" name="username"  required/>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Email<span class="required">*</span></label>
                                <div class="w-100">
                                    <input type="email" class="form-control " name="email"  required/>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Role<span class="required">*</span></label>
                                <select name="role" id="" class="form-control">
                                    <option value="admin" >Admin</option>
                                    <option value="user" >User</option>
                                </select>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Password<span class="required">*</span></label>
                                <div class="w-100">
                                    <input type="password" class="form-control" name="password"  required/>
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