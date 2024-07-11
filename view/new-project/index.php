<?php
require_once("../../public/php/constants/sessions-constants.php");

session_start();

$usuarioID = $_SESSION[$USUARIO_ID];

if (isset($usuarioID)) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <!-- Head -->
    <?php require_once('../head/head.php') ?>
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
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-clipboard-list mr-1"></i>
                                            <span>Creación Del Proyecto</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="newProjectForm" name="newProjectForm" method="POST">
                                        <div class="card-body">
                                            <input type="hidden" id="solicitudProyectoID" name="solicitudProyectoID" class="form-control" />

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos Del Proyecto:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nombreProyecto">Nombre Del Proyecto:</label>
                                                        <textarea id="nombreProyecto" name="nombreProyecto" class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="descripcionProyecto">Descripción Del Proyecto:</label>
                                                        <textarea id="descripcionProyecto" name="descripcionProyecto" class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="tipoProyectoObraCivilID">Tipo Del Proyecto:</label>
                                                        <select id="tipoProyectoObraCivilID" name="tipoProyectoObraCivilID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="categoriaTipoProyectoObraCivilID">Categoría Del Proyecto:</label>
                                                        <select id="categoriaTipoProyectoObraCivilID" name="categoriaTipoProyectoObraCivilID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="responsableID">Responsable Del Proyecto:</label>
                                                        <select id="responsableID" name="responsableID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fechaInicioProyecto">Fecha De Inicio Del Proyecto:</label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input id="fechaInicioProyecto" name="fechaInicioProyecto" type="text" class="form-control datetimepicker-input" data-target="#fechaInicioProyecto" />
                                                            <div class="input-group-append" data-target="#fechaInicioProyecto" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fechaFinalizacionProyecto">Fecha De Finalización Del Proyecto:</label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input id="fechaFinalizacionProyecto" name="fechaFinalizacionProyecto" type="text" class="form-control datetimepicker-input" data-target="#fechaFinalizacionProyecto" />
                                                            <div class="input-group-append" data-target="#fechaFinalizacionProyecto" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" id="saveNewProjectButton" class="btn btn-primary"><span class="mr-2">Guardar Proyecto</span><span><i class="fas fa-plus-circle"></i></span></button>
                                            </div>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                                <!-- /.card -->
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
        <script type="text/javascript" src="../../public/js/functions/get-params/get-params.js"></script>
        <script type="text/javascript" src="../../public/js/functions/select2-elements/set-select2-elements.js"></script>
        <script type="text/javascript" src="new-project.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>