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

<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Link</h6>
            </div>
            <div class="col-lg-12">
                <div class="field item form-group">
                    <label class="col-form-label  label-align  col-2">Title<span class="required">*</span></label>
                    <div class="w-100">
                        <input class="form-control" placeholder="Game Of Thrones" required value="<?= $data['title'] ?>" readonly />
                    </div>
                </div>
                <?php
                // LOOPING LINK
                foreach ($link as $dataLink) : ?>
                    <div style="display: <?= $dataLink['tipe'] === "Series" ? '' : 'none' ?>;">Eps : <?= $dataLink['tipe'] === "Series" ? $dataLink['episode'] : '' ?></div>
                    <form action="<?= base_url('admin/link-edit') ?>" method="POST" class="w-100">
                        <input type="hidden" value="<?= $data['title'] ?>" name="title">
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
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <?php if ($dataLink['tipe'] === "Series") : ?>
                                <a href="<?= base_url('admin/delete-episode/' . $dataLink['id_episode']) ?>" class="btn btn-danger">Hapus Episode</a>
                            <?php endif; ?>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>