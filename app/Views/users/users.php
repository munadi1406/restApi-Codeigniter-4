<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show text-right" role="alert">
        <h1><?php echo session('success'); ?></h1>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif (session()->has('error')) : ?>

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
                <h6 class="m-0 font-weight-bold text-primary">Data Postingan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display " id="myTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;

                            foreach ($data as $datas) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $datas['username'] ?></td>
                                    <td><?= $datas['email'] ?></td>
                                    <td><?= $datas['role'] ?></td>
                                    <td>
                                        <form action="<?= base_url('users') ?>" method="post">
                                            <input type="hidden" name="user_id" value="<?= $datas['id_users'] ?>">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-wrench"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<?= $this->endSection() ?>