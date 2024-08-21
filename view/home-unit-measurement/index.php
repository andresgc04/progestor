<?php
require_once("../../public/php/constants/sessions-constants.php");

session_start();

$usuarioID = $_SESSION[$USUARIO_ID];

if (isset($usuarioID)) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <!-- Head -->

    <head>
        <title>Progestor | Listado De Unidades De Medidas</title>
        <?php require_once('../links/links.php') ?>
    </head>
    <!-- /. Head -->

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <?php require_once('../preloader/preloader.php') ?>
            <!-- /. Preloader -->

            <!-- Navbar -->
            <?php require_once('../navbar/navbar.php') ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once('../main-sidebar-container/main-sidebar-container.php') ?>
            <!-- /. Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php require_once('../content-header/content-header.php') ?>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Main row -->
                        <div class="row">
                            <!-- col content -->
                            <section class="col-xl-12 col-lg-12">
                                <!-- Custom tabs (Charts with tabs)-->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-user-tag mr-1"></i>
                                            <span>Listado De Unidades De Medidas</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="d-flex justify-content-end">
                                                    <button id="newUnitMeasurementButton" type="button" class="btn btn-primary">
                                                        <span class="mr-1">Registrar Nueva Unidad De Medida</span>
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table id="listadoUnidadesMedidasDataTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>UNIDAD DE MEDIDA</th>
                                                                <th>ESTADO</th>
                                                                <th>ACCIONES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <?php require_once('components/new-unit-measurement.php') ?>
                                <?php require_once('components/update-unit-measurement.php') ?>

                            </section>
                            <!-- /. col content -->
                        </div>
                        <!-- /.row (main row) -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Footer -->
            <?php require_once('../footer/footer.php') ?>
            <!-- /.Footer-->

            <!-- Control Sidebar -->
            <?php require_once('../control-sidebar/control-sidebar.php') ?>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <?php require_once('../scripts/scripts.php') ?>
        <script type="text/javascript" src="../../public/js/functions/content-header/set-content-header-titles.js"></script>
        <script type="text/javascript" src="../../public/js/functions/nav-link/set-nav-link-active.js"></script>
        <script type="text/javascript" src="home-unit-measurement.js"></script>
        <script type="text/javascript" src="new-unit-measurement.js"></script>
        <script type="text/javascript" src="update-unit-measurement.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>