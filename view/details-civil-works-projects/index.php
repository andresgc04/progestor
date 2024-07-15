<?php
require_once("../../public/php/constants/sessions-constants.php");

session_start();

$usuarioID = $_SESSION[$USUARIO_ID];

if (isset($usuarioID)) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Progestor | Detalles Del Proyecto</title>
        <?php require_once('../links/links.php') ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Datos Basicos Del Proyecto</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="proyectoObraCivilID" name="proyectoObraCivilID" class="form-control" />
                                    <input type="hidden" id="solicitudProyectoID" name="solicitudProyectoID" class="form-control" />

                                    <div class="form-group">
                                        <label for="inputName">Nombre Del Proyecto:</label>
                                        <input type="text" id="inputName" class="form-control" value="AdminLTE">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Descripción Del Proyecto:</label>
                                        <textarea id="inputDescription" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="paisID">Tipo De Proyecto:</label>
                                                <select id="paisID" name="paisID" class="form-control select2" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="paisID">Categoría De Proyecto:</label>
                                                <select id="paisID" name="paisID" class="form-control select2" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
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
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
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
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="paisID">Responsable Del Proyecto:</label>
                                                <select id="paisID" name="paisID" class="form-control select2" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12 col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="inputProjectLeader">Estado Del Proyecto:</label>
                                                <input type="text" id="inputProjectLeader" class="form-control" value="Tony Chicken">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Actividades Del Proyecto</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary"><span>Agregar Nueva Actividad</span></button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="listadoSolicitudesProyectosDataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>TIPO DE ACTIVIDAD</th>
                                                    <th>ACTIVIDAD</th>
                                                    <th>ESTADO</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Files</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>File Size</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>Functional-requirements.docx</td>
                                                <td>49.8005 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>UAT.pdf</td>
                                                <td>28.4883 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>Email-from-flatbal.mln</td>
                                                <td>57.9003 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>Logo.png</td>
                                                <td>50.5190 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>Contract-10_12_2014.docx</td>
                                                <td>44.9715 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
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
        <script type="text/javascript" src="../../public/js/functions/select2-elements/set-select2-elements.js"></script>
        <script type="text/javascript" src="details-civil-works-projects.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>