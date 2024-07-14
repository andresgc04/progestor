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
        <title>Progestor | Registrar Nuevo Proveedor</title>
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
                                            <i class="fas fa-user-friends mr-1"></i>
                                            <span>Registrar Nuevo Proveedor</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="newSuppliersForm" name="newSuppliersForm" method="POST">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos Básicos:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nombreProveedor">Nombre Del Proveedor:</label>
                                                        <input type="text" id="nombreProveedor" name="nombreProveedor" class="form-control" placeholder="Ingrese el nombre del proveedor.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="tipoProveedorID">Tipo De Proveedor:</label>
                                                        <select id="tipoProveedorID" name="tipoProveedorID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="condicionPagoID">Condici&oacute;n De Pago:</label>
                                                        <select id="condicionPagoID" name="condicionPagoID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos De Dirección:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="paisID">Pa&iacute;s:</label>
                                                        <select id="paisID" name="paisID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="provinciaID">Provincia:</label>
                                                        <select id="provinciaID" name="provinciaID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="ciudadID">Ciudad:</label>
                                                        <select id="ciudadID" name="ciudadID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="direccion">Direcci&oacute;n:</label>
                                                        <input type="text" id="direccion" name="direccion" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos De Contacto:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="telefono">Télefono:</label>
                                                        <input type="text" id="telefono" name="telefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="correoElectronico">Correo Electr&oacute;nico:</label>
                                                        <input type="text" id="correoElectronico" name="correoElectronico" class="form-control" placeholder="Ingrese el correo electronico.">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos Del Representante De Ventas:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nombreRepresentanteVentas">Nombre Del Representante De Ventas:</label>
                                                        <input type="text" id="nombreRepresentanteVentas" name="nombreRepresentanteVentas" class="form-control" placeholder="Ingrese el nombre del representante de ventas.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="contactoRepresentanteVentas">Contacto Del Representante De Ventas:</label>
                                                        <input type="text" id="contactoRepresentanteVentas" name="contactoRepresentanteVentas" class="form-control" placeholder="Ingrese la información sobre el contacto del representante de ventas.">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="mr-2">Cancelar</span><span><i class="fas fa-times-circle"></i></span></button>
                                                <button type="submit" class="btn btn-primary"><span class="mr-2">Guardar</span><span><i class="fas fa-save"></i></span></button>
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
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_types_suppliers_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_payment_conditions_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_countries_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_provinces_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_cities_options.js"></script>
        <script type="text/javascript" src="new-suppliers.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>