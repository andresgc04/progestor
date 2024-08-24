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
        <title>Progestor | Registrar Nueva Solicitud De Proyecto</title>
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
                                            <i class="fas fa-clipboard-list mr-1"></i>
                                            <span>Registrar Nueva Solicitud De Proyecto</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="newProjectRequestsForm" name="newProjectRequestsForm" method="POST">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos De La Solicitud Del Proyecto:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nombreProyecto">Nombre Del Proyecto:</label>
                                                        <input type="text" id="nombreProyecto" name="nombreProyecto" class="form-control" placeholder="Ingrese el nombre del proyecto.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="objetivoProyecto">Objetivo Del Proyecto:</label>
                                                        <input type="text" id="objetivoProyecto" name="objetivoProyecto" class="form-control" placeholder="Ingrese el objetivo del proyecto.">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="descripcionProyecto">Descripci&oacute;n Del Proyecto:</label>
                                                        <textarea id="descripcionProyecto" name="descripcionProyecto" class="form-control" rows="3" placeholder="Ingrese la descripción del proyecto."></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="dimensionMetroLargoTerreno">Dimension De Largo Del Terreno (M):</label>
                                                        <input type="text" id="dimensionMetroLargoTerreno" name="dimensionMetroLargoTerreno" class="form-control" placeholder="Ingrese la dimension del metro de largo del terreno (m).">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="dimensionMetroAnchoTerreno">Dimension De Ancho Del Terreno (M):</label>
                                                        <input type="text" id="dimensionMetroAnchoTerreno" name="dimensionMetroAnchoTerreno" class="form-control" placeholder="Ingrese la dimension del metro de ancho del terreno (m).">
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
                                                        <textarea id="ubicacion" name="ubicacion" class="form-control" rows="3" placeholder="Ingrese la ubicacion del terreno."></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="presupuestoEstimadoProyecto">Presupuesto Estimado:</label>
                                                        <input type="text" id="presupuestoEstimadoProyecto" name="presupuestoEstimadoProyecto" class="form-control" placeholder="Ingrese el presupuesto estimado para el proyecto.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fechaEstimadaDeseada">Fecha Estimada Deseada:</label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input id="fechaEstimadaDeseada" name="fechaEstimadaDeseada" type="text" class="form-control datetimepicker-input" data-target="#fechaEstimadaDeseada" />
                                                            <div class="input-group-append" data-target="#fechaEstimadaDeseada" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="verificacionTitulo">Tiene El Título De Propiedad?</label>
                                                        <select id="verificacionTitulo" name="verificacionTitulo" class="form-control select2" style="width: 100%;">
                                                            <option selected disabled>Por favor indique si tiene el titulo.</option>
                                                            <option value="SI">SI</option>
                                                            <option value="NO">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12" id="sectionDocumento" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="documento">Documento:</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="documento" name="documento">
                                                                <label class="custom-file-label" for="documento">Choose file</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Requerimientos Del Proyecto:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="row  mb-2">
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                            <div class="d-flex justify-content-end">
                                                                <button id="addProjectRequirementsButton" type="button" class="btn btn-primary"><span class="mr-2">Agregar Nuevo Requerimiento</span><i class="fas fa-plus-circle"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>DESCRIPCI&Oacute;N DEL REQUERIMIENTO</th>
                                                                            <th style="text-align: center;">ACCIONES</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="projectRequirementsTable"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between">
                                                <button id="cancelSaveNewProjectRequestsButton" type="button" class="btn btn-danger" data-dismiss="modal"><span class="mr-2">Cancelar</span><span><i class="fas fa-times-circle"></i></span></button>
                                                <button id="saveNewProjectRequestsButton" type="submit" class="btn btn-primary"><span class="mr-2">Guardar</span><span><i class="fas fa-save"></i></span></button>
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
        <script type="text/javascript" src="../../public/js/functions/select2-elements/set-select2-elements.js"></script>
        <script type="text/javascript" src="new-project-requests.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>