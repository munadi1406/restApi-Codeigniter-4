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
<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Users</h6>
            </div>
            <form class="col-12" action="<?= base_url('update-users') ?>" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_users" value="<?= $data['id_users'] ?>">
                <div class="field item form-group">
                    <label class="col-form-label  label-align mr-2 ">Username<span class="required">*</span></label>
                    <div class="w-100">
                        <input class="form-control" name="username" value="<?= $data['username'] ?>" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label  label-align mr-2 ">Email<span class="required">*</span></label>
                    <div class="w-100">
                        <input class="form-control disable" name="email" value="<?= $data['email'] ?>" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label  label-align mr-2 ">Role<span class="required">*</span></label>
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

<?= $this->endSection() ?>