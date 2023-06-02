<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php if (session()->has('success_message')) : ?>
    <div class="alert alert-success d-flex justify-content-end">
        <h1>
            <?php echo session('success_message'); ?>
        </h1>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger d-flex justify-content-end">
        <?php if (is_array(session('error'))) : ?>
            <?php foreach (session('error') as $error) : ?>
                <h5>
                    <?= esc($error) ?>
                    </h3>
                <?php endforeach ?>
            <?php else : ?>
                <h5>
                    <?= esc(session('error')) ?>
                </h5>
            <?php endif ?>
    </div>
<?php endif; ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data <small>Genre</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data<small>Genre</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_id" class="display border hover dt-responsive " cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Genre</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($data as $datas) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $datas['genre'] ?></td>
                                                    <td>
                                                        <div style=" display: flex; ">
                                                            <form action="<?= base_url('admin/edit') ?>" method="POST">
                                                                <input type="hidden" name="id" value="<?= $datas['id'] ?>">
                                                                <button type="submit" title="Edit Film <?= $datas['genre'] ?>" class="btn btn-success "><i class="fa fa-wrench"></i></button>
                                                            </form>
                                                            <form action="<?= base_url('admin/post-delete/' . $datas['id']) ?>" method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" title="Hapus <?= $datas['genre']?>" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>