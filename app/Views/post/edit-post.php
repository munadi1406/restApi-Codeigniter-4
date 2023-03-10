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
                <h3>Films Edit</h3>
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
                        <h2>Edit Post <small>Films</small></h2>
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
                    <div class="x_content row flex-md-row-reverse flex-md-col">
                        <div class="col-md-6 border h-50 d-flex justify-content-center ">
                            <img src="<?php echo $data['image'] ?>" alt="<?= $data['title'] ?>" width="300px">
                        </div>
                        <form class="col-md-6" action="<?= base_url('admin/post-edit') ?>" method="post" enctype="multipart/form-data" >
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="film_id" value="<?= $data['film_id'] ?>">
                            <input type="hidden" name="imageBefore" value="<?= $data['image'] ?>">
                            <span class="section">Films Info</span>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align  col-2">Title<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="title" placeholder="Game Of Thrones" required value="<?= $data['title'] ?>" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align  col-2">Desc<span class="required">*</span></label>
                                <div class="w-100">
                                    <textarea required="required" name='desc' class="w-100"><?= $data['desc'] ?></textarea>
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align  col-2">Date<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="date" class='date' required="required" type="Date" value="<?= $data['date'] ?>" />
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label for="genre" class="col-form-label  label-align  col-2 ">Genre:</label><br>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="action" value="action" name="genre[]" <?php echo in_array("action", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="action">Action</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="comedy" value="comedy" name="genre[]" <?php echo in_array("comedy", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="comedy">Comedy</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="drama" value="drama" name="genre[]" <?php echo in_array("drama", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="drama">Drama</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="horror" value="horror" name="genre[]" <?php echo in_array("horror", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="horror">Horror</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="sci-fi" value="sci-fi" name="genre[]" <?php echo in_array("sci-fi", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="sci-fi">Sci-Fi</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="romance" value="romance" name="genre[]" <?php echo in_array("romance", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="romance">Romance</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="adventure" value="adventure" name="genre[]" <?php echo in_array("adventure", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="adventure">Adventure</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="fantasy" value="fantasy" name="genre[]" <?php echo in_array("fantasy", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="fantasy">Fantasy</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="thriller" value="thriller" name="genre[]" <?php echo in_array("thriller", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="thriller">Thriller</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="mystery" value="mystery" name="genre[]" <?php echo in_array("mystery", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="mystery">Mystery</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Crime" value="Crime" name="genre[]" <?php echo in_array("Crime", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Crime">Crime</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Documentary" value="Documentary" name="genre[]" <?php echo in_array("Documentary", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Documentary">Documentary</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Family" value="Family" name="genre[]" <?php echo in_array("Family", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Family">Family</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Drama" value="Drama" name="genre[]" <?php echo in_array("Drama", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Drama">Drama</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Music" value="Music" name="genre[]" <?php echo in_array("Music", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Music">Music</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Sport" value="Sport" name="genre[]" <?php echo in_array("Sport", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Sport">Sport</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="War" value="War" name="genre[]" <?php echo in_array("War", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="War">War</label>
                                    </div>
                                    <div class="form-check form-check-inline border col-3">
                                        <input class="form-check-input" type="checkbox" id="Western" value="Western" name="genre[]" <?php echo in_array("Western", explode(",", $data['name'])) ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="Western">Western</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group ">
                                <label class="col-form-label  label-align  col-2">Tipe<span class="required">*</span></label>
                                <select class="form-control w-100 disabled" name="tipe" disabled>
                                    <option value="Movie" <?php echo $data['tipe'] == 'Movie' ? 'selected' : '' ?>>Movie</option>
                                    <option value="Series" <?php echo $data['tipe'] == 'Series' ? 'selected' : '' ?>>Series</option>
                                </select>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label  label-align  col-2">Trailer<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="trailer" placeholder="https://example.com" value="<?= $data['trailer'] ?>" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label  label-align  col-2">Subtitle<span class="required">*</span></label>
                                <div class="w-100">
                                    <input class="form-control" name="subtitle" placeholder="https://example.com" value="<?= $data['subtitle'] ?>" />
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