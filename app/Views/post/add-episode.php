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
                <h6 class="m-0 font-weight-bold text-primary">Add Episode</h6>
            </div>
                <form class="col-lg-12 d-block" action="<?= base_url('admin/episode-add') ?>" method="POST">
                    <input type="hidden" name="film_id" value="<?= $data['film_id'] ?>">
                    <span class="section">Films Info</span>
                    <div class="field item form-group">
                        <label class="col-form-label  label-align mr-2  w-100">Name<span class="required">*</span></label>
                        <div class="w-100">
                            <input class="form-control" name="title" placeholder="Game Of Thrones" disabled value="<?= $data['title'] ?>" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label  label-align mr-2 ">Episode<span class="required">*</span></label>
                        <div class="w-100">
                            <input class="form-control disable" name="episode" value="<?= $data['episode'] + 1 ?>"/>
                        </div>
                    </div>
                    <div class="field item form-group ">
                        <label class="col-form-label  label-align mr-2 ">1080<span class="required">*</span></label>
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
                        <label class="col-form-label  label-align mr-2 ">720<span class="required">*</span></label>
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
                        <label class="col-form-label  label-align mr-2 ">540<span class="required">*</span></label>
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



<?= $this->endSection() ?>