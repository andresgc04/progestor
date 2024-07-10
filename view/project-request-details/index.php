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
                                            <i class="fas fa-user-tie mr-1"></i>
                                            <span>Detalle Solicitud De Proyectos</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="projectRequestDetailsForm" name="projectRequestDetailsForm" method="POST">
                                        <div class="card-body">
                                            <input type="hidden" id="solicitudProyectoID" name="solicitudProyectoID" class="form-control" />

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos De La Solicitud Del Proyecto::</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="descripcionProyecto">Descripción Del Proyecto:</label>
                                                        <textarea id="descripcionProyecto" name="descripcionProyecto" class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="objetivoProyecto">Objetivo Del Proyecto:</label>
                                                        <textarea id="objetivoProyecto" name="objetivoProyecto" class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="presupuestoProyecto">Presupuesto Del Proyecto:</label>
                                                        <input type="text" id="presupuestoProyecto" name="presupuestoProyecto" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="estadoSolicitud">Estado De La Solicitud:</label>
                                                        <input type="text" id="estadoSolicitud" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Requerimientos De La Solicitud Del Proyecto:</p>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                                                    <button type="button" id="addNewProjectRequestRequirementButton" class="btn btn-primary"><span class="mr-1">Agregar Nuevo Requerimiento</span> <i class="fas fa-plus-circle"></i></button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table id="listadoRequerimientosSolicitudesProyectosDataTable" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>DESCRIPCI&Oacute;N DEL REQUERIMIENTO</th>
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
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" id="backButton" onclick="retroceder()" class="btn btn-info"><span class="mr-2">Retroceder</span><span><i class="fas fa-reply"></i></span></button>

                                                <button type="button" id="validateUpdateRequestDetailsButton" onclick="validateUpdateRequestDetails()" class="btn btn-primary"><span class="mr-2">Modificar</span><span><i class="fas fa-save"></i></span></button>

                                                <button type="button" id="validateCancelProjectRequestDetailsButton" onclick="validateCancelProjectRequestDetails()" class="btn btn-danger"><span class="mr-2">Cancelar</span><span><i class="fas fa-ban"></i></span></button>

                                                <button type="button" id="validateSubmissionProjectRequestDetailButton" onclick="validateApproveProjectRequestDetails()" class="btn btn-success"><span class="mr-2">Someter</span><span><i class="fas fa-check-circle"></i></span></button>

                                            </div>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>

                                    <?php require_once('components/add-new-project-request-requirement-form-modal.php') ?>
                                    <?php require_once('components/update-project-request-requirement-form-modal.php') ?>
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
        <script type="text/javascript" src="../../public/js/functions/select2-elements/set-select2-elements.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_sex_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_marital_statuses.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_nationalities_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_countries_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_provinces_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_cities_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_positions.options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_department_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_employees_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/get-params/get-params.js"></script>
        <script type="text/javascript" src="project-request-details.js"></script>
        <script type="text/javascript" src="update-project-request-details.js"></script>
        <script type="text/javascript" src="cancel-project-request-details.js"></script>
        <script type="text/javascript" src="approve-project-request-details.js"></script>
        <script type="text/javascript" src="add-new-project-request-requirement.js"></script>
        <script type="text/javascript" src="update-project-request-requirement.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>