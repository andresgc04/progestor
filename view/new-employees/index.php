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
        <title>Progestor | Registrar Nuevo Empleado</title>
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
                                            <span>Registrar Nuevo Empleado</span>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form id="newEmployeesForm" name="newEmployeesForm" method="POST">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos Básicos:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="primerNombre">Primer Nombre:</label>
                                                        <input type="text" id="primerNombre" name="primerNombre" class="form-control" placeholder="Ingrese el primer nombre.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="segundoNombre">Segundo Nombre:</label>
                                                        <input type="text" id="segundoNombre" name="segundoNombre" class="form-control" placeholder="Ingrese el segundo nombre.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="primerApellido">Primer Apellido:</label>
                                                        <input type="text" id="primerApellido" name="primerApellido" class="form-control" placeholder="Ingrese el primer apellido.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="segundoApellido">Segundo Apellido:</label>
                                                        <input type="text" id="segundoApellido" name="segundoApellido" class="form-control" placeholder="Ingrese el segundo apellido.">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="sexoID">Sexo:</label>
                                                        <select id="sexoID" name="sexoID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="estadoCivilID">Estado Civil:</label>
                                                        <select id="estadoCivilID" name="estadoCivilID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cedula">Cedula:</label>
                                                        <input type="text" id="cedula" name="cedula" class="form-control" data-inputmask='"mask": "999-9999999-9"' data-mask>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fechaNacimiento">Fecha De Nacimiento:</label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input id="fechaNacimiento" name="fechaNacimiento" type="text" class="form-control datetimepicker-input" data-target="#fechaNacimiento" />
                                                            <div class="input-group-append" data-target="#fechaNacimiento" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nacionalidadID">Nacionalidad:</label>
                                                        <select id="nacionalidadID" name="nacionalidadID" class="form-control select2" style="width: 100%;"></select>
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
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="telefonoResidencial">Télefono Residencial:</label>
                                                        <input type="text" id="telefonoResidencial" name="telefonoResidencial" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="telefonoCelular">Télefono Celular:</label>
                                                        <input type="text" id="telefonoCelular" name="telefonoCelular" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="correoElectronico">Correo Electr&oacute;nico:</label>
                                                        <input type="text" id="correoElectronico" name="correoElectronico" class="form-control" placeholder="Ingrese el correo electronico.">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <p class="text-bold">Datos Institucionales:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="puestoID">Puesto:</label>
                                                        <select id="puestoID" name="puestoID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="departamentoID">Departamento:</label>
                                                        <select id="departamentoID" name="departamentoID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="supervisorID">Supervisor:</label>
                                                        <select id="supervisorID" name="supervisorID" class="form-control select2" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="salario">Salario:</label>
                                                        <input type="text" id="salario" name="salario" class="form-control" placeholder="Ingrese el salario del empleado.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="numeroSeguridadSocial">Seguro Social:</label>
                                                        <input type="text" id="numeroSeguridadSocial" name="numeroSeguridadSocial" class="form-control" placeholder="Ingrese el número social del empleado.">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fechaContratacion">Fecha De Contrataci&oacute;n:</label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input id="fechaContratacion" name="fechaContratacion" type="text" class="form-control datetimepicker-input" data-target="#fechaContratacion" />
                                                            <div class="input-group-append" data-target="#fechaContratacion" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="mr-2">Cancelar</span><span><i class="fas fa-times-circle"></i></span></button>
                                                <button id="newEmployeeButton" type="submit" class="btn btn-primary"><span class="mr-2">Guardar</span><span><i class="fas fa-save"></i></span></button>
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
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_sex_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_marital_statuses.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_nationalities_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_countries_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_provinces_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_cities_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_positions.options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_department_options.js"></script>
        <script type="text/javascript" src="../../public/js/functions/components_select_list_options/select_list_employees_options.js"></script>
        <script type="text/javascript" src="new-employees.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>