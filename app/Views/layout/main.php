<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('layout/head') ?>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- sidebar -->
            <?= $this->include('layout/sidebar') ?>
            <!-- close sidebar -->


            <!-- nav -->
            <?= $this->include('layout/nav') ?>
            <!-- close nav -->

            <main class="content">
                <?= $this->renderSection('content') ?>
            </main>

            <!-- footer -->
            <?= $this->include('layout/footer') ?>
            <!-- close footer -->
        </div>
    </div>
    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../assets/vendors/Flot/jquery.flot.js"></script>
    <script src="../assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../assets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../assets/vendors/moment/min/moment.min.js"></script>
    <script src="../assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>




    <!-- Custom Theme Scripts -->
    <script src="../assets/build/js/custom.min.js"></script>

    
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
</body>

</html>