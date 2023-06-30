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
                <h6 class="m-0 font-weight-bold text-primary">Post Add</h6>
            </div>
            <div class="d-flex flex-row-reverse flex-wrap">
                <div class="col-md-6 border h-50 d-flex justify-content-center ">
                    <img src="<?php echo $data['image'] ?>" alt="<?= $data['title'] ?>" class="w-50 h-auto block">
                </div>
                <form class="col-md-6" action="<?= base_url('admin/post-edit') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="film_id" value="<?= $data['film_id'] ?>">
                    <input type="hidden" name="imageBefore" value="<?= $data['image'] ?>">
                    <div class="field item form-group">
                        <label class="col-form-label  label-align  ">Title<span class="required">*</span></label>
                        <div class="w-100">
                            <input class="form-control" name="title" placeholder="Game Of Thrones" required value="<?= $data['title'] ?>" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label  label-align  ">Desc<span class="required">*</span></label>
                        <div class="w-100">
                            <textarea required="required" name='desc' class="w-100"><?= $data['desc'] ?></textarea>
                        </div>
                    </div>
                    <div class="field item form-group ">
                        <label class="col-form-label  label-align  ">Date<span class="required">*</span></label>
                        <div class="w-100">
                            <input class="form-control" name="date" class='date' required="required" type="Date" value="<?= $data['date'] ?>" />
                        </div>
                    </div>
                    <div class="field item form-group ">
                        <label for="genre" class="col-form-label  label-align   ">Genre:</label><br>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($dataGenre as $genre) : ?>
                                <div class="form-check form-check-inline border col-3">
                                <input class="form-check-input" type="checkbox" id="<?= $genre['genre']?>" value="<?= $genre['genre']?>" name="genre[]" <?php if (in_array(strtolower($genre['genre']), array_map('strtolower', explode(",", $data['name'])))) echo "checked"; ?>>
                                    <label class="form-check-label" for="<?= $genre['genre']?>"><?= $genre['genre']?></label>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="field item form-group ">
                        <label class="col-form-label  label-align  ">Tipe<span class="required">*</span></label>
                        <select class="form-control w-100 disabled" name="tipe" disabled>
                            <option value="Movie" <?php echo $data['tipe'] == 'Movie' ? 'selected' : '' ?>>Movie</option>
                            <option value="Series" <?php echo $data['tipe'] == 'Series' ? 'selected' : '' ?>>Series</option>
                        </select>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label  label-align  ">Trailer<span class="required">*</span></label>
                        <div class="w-100">
                            <input class="form-control" name="trailer" placeholder="https://example.com" value="<?= $data['trailer'] ?>" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label  label-align  ">Subtitle<span class="required">*</span></label>
                        <div class="w-100">
                            <input class="form-control" name="subtitle" placeholder="https://example.com" value="<?= $data['subtitle'] ?>" />
                        </div>
                    </div>
                    <div class="field item form-group border" style="min-height: 100px;">
                        <div class="h-100 w-100">
                            <div class="dropzone d-flex justify-content-center align-items-center flex-column" style="min-height:100px" id="dropzone">
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