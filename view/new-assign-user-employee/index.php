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
                                            <i class="fas fa-user mr-1"></i>
                                            <span>Asignar Usuario A Empleado</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="newAssignUserEmployeeForm" name="newAssignUserEmployeeForm" method="POST">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="empleadoID">Empleado:</label>
                                                        <select id="empleadoID" name="empleadoID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="rolID">Rol:</label>
                                                        <select id="rolID" name="rolID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nombreUsuarioEmpleado">Nombre De Usuario:</label>
                                                        <input type="text" id="nombreUsuarioEmpleado" name="nombreUsuarioEmpleado" class="form-control" placeholder="Ingrese el nombre de usuario.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="passwordUsuarioEmpleado">Password:</label>
                                                        <input type="password" id="passwordUsuarioEmpleado" name="passwordUsuarioEmpleado" class="form-control" placeholder="Ingrese el password del usuario.">
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
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_employees_options.js"></script>
        <script type="text/javascript" src="new-assign-user-employee.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>