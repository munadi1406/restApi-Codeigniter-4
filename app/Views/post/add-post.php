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
                <h3>Films Post</h3>
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
                        <h2>Add Post <small>Films</small></h2>
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
                    <div class="x_content">
                        <form class="" action="<?php base_url('admin/post-add') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <span class="section">Films Info</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Name<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="title" placeholder="Game Of Thrones" required />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Desc<span class="required">*</span></label>
                                <div class="w-100">
                                    <textarea required="required" name='desc' class="w-100"></textarea>
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align mr-2 col-1">Date<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="date" class='date' required="required" type="Date" />
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label for="genre" class="col-form-label  label-align mr-2 col-1 ">Genre:</label><br>
                                <div class="d-flex flex-wrap">
                                    <?php foreach($data as $datas):?>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="action" value="<?= $datas['genre']?>" name="genre[]">
                                        <label class="form-check-label" for="action"><?= $datas['genre'] ?></label>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align mr-2 col-1">Tipe<span class="required">*</span></label>
                                <select class="form-control w-100" name="tipe">
                                    <option value="Movie">Movie</option>
                                    <option value="Series">Series</option>
                                </select>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Trailer<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="trailer" placeholder="https://example.com" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align mr-2 col-1">Subtitle<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="subtitle" placeholder="https://example.com" />
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align mr-2 col-1">1080<span class="required">*</span></label>
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
                                <label class="col-form-label  label-align mr-2 col-1">720<span class="required">*</span></label>
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
                                <label class="col-form-label  label-align mr-2 col-1">540<span class="required">*</span></label>
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
                            <div class="field item form-group">
                                <div class="w-100 m-auto">
                                    <div class="dropzone" id="dropzone">
                                        <span>Drag and drop files here, or click to select files</span>
                                        <input type="file" id="file-input" multiple style="display: none" name="image">
                                        <div class="preview" id="preview"></div>
                                    </div>
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

<script>
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-input');
    const preview = document.getElementById('preview');

    // Menambahkan event listener untuk menjaga tampilan dropzone
    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('highlight');
    });

    dropzone.addEventListener('dragleave', e => {
        dropzone.classList.remove('highlight');
    });

    // Menambahkan event listener untuk menerima file yang di-drop
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('highlight');
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // Menambahkan event listener untuk membuka dialog file picker saat di-klik
    dropzone.addEventListener('click', e => {
        fileInput.click();
    });

    // Menambahkan event listener untuk mendapatkan informasi file yang dipilih
    fileInput.addEventListener('change', e => {
        const files = e.target.files;
        handleFiles(files);
    });

    // Menampilkan preview gambar pada elemen preview
    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.classList.add('img-thumbnail');
                img.file = file;
                preview.appendChild(img);

                // Tambahkan tombol "Cancel"
                const cancelBtn = document.createElement('button');
                cancelBtn.classList.add('btn', 'btn-danger');
                cancelBtn.textContent = 'Cancel';
                img.parentNode.insertBefore(cancelBtn, img.nextSibling);

                // Tambahkan event listener pada tombol "Cancel"
                cancelBtn.addEventListener('click', e => {
                    img.remove();
                    cancelBtn.remove();
                });

                const reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
    }
</script>
<?= $this->endSection() ?>