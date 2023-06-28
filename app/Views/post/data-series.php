<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Post Filter By Series</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Desc</th>
                                <th>Tipe</th>
                                <th>Genre</th>
                                <th>Date</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Trailer</th>
                                <th>Subtitle</th>
                                <th>Status</th>
                                <th>Link</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $datas) : $images = basename($datas['image']) ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $datas['username'] ?></td>
                                    <td>
                                        <div style=" width: 100px; overflow:auto; ">
                                            <?= $datas['title'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="height:100px; width: 200px; overflow-y:auto; display: flex;justify-content: start; align-items: center;">
                                            <?= $datas['desc'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $datas['tipe'] ?>
                                        </div>
                                        <form action="<?= base_url('admin/episode') ?>" method="POST">
                                            <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                            <button type="submit" class="badge badge-primary border" style="display: <?= $datas['tipe'] === 'Series' ? '' : 'none' ?>;">add</button>
                                        </form>
                                    </td>
                                    <td>
                                        <?php
                                        $genres = explode(",", $datas['name']);
                                        $colors = array("badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-light", "badge-dark");
                                        $i = 0;
                                        foreach ($genres as $genre) : ?>
                                            <div class="badge <?= $colors[$i % count($colors)] ?>">
                                                <?= $genre ?>
                                            </div>
                                        <?php $i++;
                                        endforeach; ?>
                                    </td>

                                    <td>
                                        <?= $datas['date'] ?>
                                    </td>
                                    <td>
                                        <?= $datas['created_at'] ?>
                                    </td>
                                    <td>
                                        <?= $datas['updated_at'] ?>
                                    </td>
                                    <td><a href=" <?= $datas['trailer'] ?>" class="badge badge-danger" style="display: <?php echo $datas['trailer'] ? '' : 'none' ?>;" target="_blank">Trailer</a></td>
                                    <td><a href="<?= $datas['subtitle'] ?>" class="badge badge-info" style="display: <?= $datas['subtitle'] ? '' : 'none' ?>;" target="_blank">Subtitle</a></td>
                                    <td>
                                        <form action="<?= base_url('admin/update-status') ?>" method="post">
                                            <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                            <input type="hidden" name="status" value="<?= $datas['status'] ?>">
                                            <div class="w-100 badge badge-<?= $datas['status'] === 'show' ? 'primary' : 'danger' ?>">
                                                <i class="fa fa-<?= $datas['status'] === 'show' ? 'eye' : 'eye-slash' ?>"></i> <?= $datas['status'] ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 mt-1"><i class="fa fa-refresh"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <div style="max-height: 200px; overflow-x: auto;padding: 5px;">
                                            <?php
                                            $search_id = $datas['film_id'];
                                            $links = $datas['tipe'] === 'Series' ? $linkseries : $link;
                                            foreach ($links as $series) {
                                                if ($series['film_id'] == $search_id) { ?>
                                                    <div>
                                                        <?php echo $datas['tipe'] === 'Series' ? "Episode " . $series['episode'] . ' ' . $series['quality'] : $series['quality'] ?>
                                                    </div>
                                                    <div class="wrapper-link-post" style="display: <?php echo $series['quality'] ? 'flex' :  '' ?>; overflow: auto !important; max-height:200px !important ;">
                                                        <a href="<?php echo $series['GD'] ?>" style="margin-right:5px ; display:<?php echo $series['GD'] ? '' : 'none' ?>" class="badge badge-primary " target="_blank">GD</a>
                                                        <a href="<?php echo $series['UTB'] ?>" style="margin-right:5px; display:<?php echo $series['UTB'] ? '' : 'none' ?>" class="badge badge-success" target="_blank">UTB</a>
                                                        <a href="<?php echo $series['MG'] ?>" style=" display: <?php echo $series['MG'] ? '' : 'none' ?>" class="badge badge-danger " target="_blank">MG</a>
                                                    </div>
                                            <?php }
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td><img src="<?php echo $datas['image'] ?>" alt="" width="50" class="image" loading="lazy"></td>
                                    <td>
                                        <div style=" display: flex; ">
                                            <form action="<?= base_url('admin/edit') ?>" method="POST">
                                                <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                                <button type="submit" title="Edit Film <?= $datas['title'] ?>" class="btn btn-success "><i class="fa fa-wrench"></i></button>
                                            </form>
                                            <form action="<?= base_url('admin/link') ?>" method="POST">
                                                <input type="hidden" name="film_id" value="<?= $datas['film_id'] ?>">
                                                <button type="submit" title="Edit Link <?= $datas['title'] ?>" class="btn btn-secondary">Edit Link</button>
                                            </form>
                                            <form action="<?= base_url('admin/post-delete/' . $datas['film_id']) ?>" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" title="Hapus <?= $datas['title'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>