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
        <title>Progestor | Detalle De Solicitud De Proyecto</title>
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
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-user-tie mr-1"></i>
                                            <span>Detalle Solicitud Del Proyecto</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="projectRequestDetailsForm" name="projectRequestDetailsForm" method="POST">
                                        <div class="card-body">
                                            <input type="hidden" id="solicitudProyectoID" name="solicitudProyectoID" class="form-control" />

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos De La Solicitud Del Proyecto:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nombreProyecto">Nombre Del Proyecto:</label>
                                                        <input type="text" id="nombreProyecto" name="nombreProyecto" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="objetivoProyecto">Objetivo Del Proyecto:</label>
                                                        <input type="text" id="objetivoProyecto" name="objetivoProyecto" class="form-control" readonly />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="descripcionProyecto">Descripción Del Proyecto:</label>
                                                        <textarea id="descripcionProyecto" class="form-control" rows="3" readonly></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="dimensionMetroLargoTerreno">Dimension De Largo Del Terreno (M):</label>
                                                        <input type="text" id="dimensionMetroLargoTerreno" name="dimensionMetroLargoTerreno" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="dimensionMetroAnchoTerreno">Dimension De Ancho Del Terreno (M):</label>
                                                        <input type="text" id="dimensionMetroAnchoTerreno" name="dimensionMetroAnchoTerreno" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="areaTotalTerreno">Area Del Terreno (M2):</label>
                                                        <input type="text" id="areaTotalTerreno" name="areaTotalTerreno" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="ubicacion">Ubicacion:</label>
                                                        <textarea id="ubicacion" name="ubicacion" class="form-control" rows="3" readonly></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="presupuestoEstimadoProyecto">Presupuesto Estimado:</label>
                                                        <input type="text" id="presupuestoEstimadoProyecto" name="presupuestoEstimadoProyecto" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fechaEstimadaDeseada">Fecha Estimada Deseada:</label>
                                                        <input type="text" id="fechaEstimadaDeseada" class="form-control" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="verificacionTitulo">Tiene El Título De La Propiedad?</label>
                                                        <input type="text" id="verificacionTitulo" name="verificacionTitulo" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="solicitadoPor">Solicitado Por:</label>
                                                        <input type="text" id="solicitadoPor" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
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

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table id="listadoRequerimientosSolicitudesProyectosDataTable" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>DESCRIPCI&Oacute;N DEL REQUERIMIENTO</th>
                                                                    <th>ESTADO</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Documentos De La Solicitud Del Proyecto:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table id="listadoDocumentosSolicitudesProyectosDataTable" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>NOMBRE DOCUMENTO</th>
                                                                    <th>TIPO DOCUMENTO</th>
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
                                                <button type="button" id="rejectProjectRequestButton" onclick="rejectProjectRequest()" class="btn btn-danger"><span class="mr-2">Rechazar</span><span><i class="fas fa-ban"></i></span></button>

                                                <button type="button" id="approveProjectRequestButton" onclick="approveProjectRequest()" class="btn btn-success"><span class="mr-2">Aprobar</span><span><i class="fas fa-check-circle"></i></span></button>

                                                <button type="button" id="createNewProjectButton" class="btn btn-primary" style="display:none"><span class="mr-2">Crear Proyecto</span><span><i class="fas fa-plus-circle"></i></span></button>
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
        <script type="text/javascript" src="view-project-request-details.js"></script>
        <script type="text/javascript" src="reject-project-request.js"></script>
        <script type="text/javascript" src="approve-project-request.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>