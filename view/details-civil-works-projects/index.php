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
                                        <label for="nombreProyecto">Nombre Del Proyecto:</label>
                                        <input type="text" id="nombreProyecto" name="nombreProyecto" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="objetivoProyecto">Objetivo Del Proyecto:</label>
                                        <input type="text" id="objetivoProyecto" name="objetivoProyecto" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcionProyecto">Descripción Del Proyecto:</label>
                                        <textarea id="descripcionProyecto" name="descripcionProyecto" class="form-control" rows="3" readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoProyectoObraCivil">Tipo De Proyecto Obra Civil:</label>
                                        <input type="text" id="tipoProyectoObraCivil" name="tipoProyectoObraCivil" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoriaTipoProyectoObraCivil">Categoria De Tipo De Proyecto Obra Civil:</label>
                                        <input type="text" id="categoriaTipoProyectoObraCivil" name="categoriaTipoProyectoObraCivil" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="solicitadoPor">Solicitado Por:</label>
                                        <input type="text" id="solicitadoPor" name="solicitadoPor" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaEstimadaDeseada">Fecha Estimada Deseada:</label>
                                        <input type="text" id="fechaEstimadaDeseada" name="fechaEstimadaDeseada" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="responsableProyecto">Responsable Del Proyecto:</label>
                                        <input type="text" id="responsableProyecto" name="responsableProyecto" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaInicioProyecto">Fecha De Inicio Del Proyecto:</label>
                                        <input type="text" id="fechaInicioProyecto" name="fechaInicioProyecto" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="estadoProyecto">Estado:</label>
                                        <input type="text" id="estadoProyecto" name="estadoProyecto" class="form-control" readonly>
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
        <script type="text/javascript" src="../../public/js/functions/get-params/get-params.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_project_managers_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_types_civil_works_projects_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_categories_types_projects_civil_works.js"></script>
        <script type="text/javascript" src="details-civil-works-projects.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>