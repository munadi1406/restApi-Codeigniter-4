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

<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Genre</h6>
            </div>
            <form class="col-lg-12" action="<?= base_url('admin/genre-add') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="field item form-group">
                    <label class="col-form-label  label-align mr-2 col-1">Genre<span class="required">*</span></label>
                    <div class="w-100">
                        <input class="form-control" name="genre" placeholder="Action..." type="text" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label  label-align mr-2 col-1">Cols<span class="required">*</span></label>
                    <div class="w-100">
                        <input class="form-control" name="cols" placeholder="Action..." type="number" />
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

<?= $this->endSection() ?>