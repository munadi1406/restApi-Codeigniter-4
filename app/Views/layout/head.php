<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?= base_url('assets/images/icon.png') ?>" type="image/ico" />

<title><?= 'MKDIR | '.$title ?? "MKDIR DATA CENTER" ?></title>


<!-- Bootstrap -->
<link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
<!-- Font Awesome -->
<link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
<!-- NProgress -->
<link href="<?= base_url('assets/vendors/nprogress/nprogress.css')?>" rel="stylesheet">
<!-- iCheck -->
<link href="<?= base_url('assets/vendors/iCheck/skins/flat/green.css')?>" rel="stylesheet">

<!-- bootstrap-progressbar -->
<link href="<?= base_url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')?>" rel="stylesheet">
<!-- JQVMap -->
<link href="<?= base_url('assets/vendors/jqvmap/dist/jqvmap.min.css')?>" rel="stylesheet" />
<!-- bootstrap-daterangepicker -->
<link href="<?= base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')?>" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="<?= base_url('assets/build/css/custom.min.css')?>" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
<style>
    .dropzone {
  border: 2px dashed #ccc;
  padding: 20px;
  text-align: center;
  cursor: pointer;
}

.dropzone.highlight {
  border-color: #00a0d2;
}

#preview {
  display: flex;
  flex-wrap: wrap;
}

.preview-image {
  width: 150px;
  height: 150px;
  margin-right: 10px;
  margin-bottom: 10px;
  object-fit: cover;
}

</style>