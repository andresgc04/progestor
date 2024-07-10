<?php
require_once('../../config/connection.php');
require_once('../../models/Usuarios.php');
require_once('../../public/php/constants/sessions-constants.php');

//session_start();

$nombreUsario = $_SESSION[$NOMBRE_USUARIO];
$usuarioID = $_SESSION[$USUARIO_ID];

$usuarios = new Usuarios();

$datos = $usuarios->obtener_informacion_usuario_logeado($usuarioID);

if (!empty($datos)) {
    foreach ($datos as $row) {
        $_SESSION["nombreEmpleado"] = $row['empleados'];
        $_SESSION["nombreCliente"] = $row['nombre_cliente'];
        $_SESSION["rol"] = $row['rol'];
    }
};
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="../../public/lib/adminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Progestor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../public/lib/adminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["nombreEmpleado"] != null ? $_SESSION["nombreEmpleado"] : $_SESSION["nombreCliente"] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">GESTIONES</li>
                <li class="nav-item">
                    <a id="navLinkDashboard" href="../dashboard/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if ($_SESSION['rol'] == 'Cliente') { ?>
                    <li class="nav-item">
                        <a id="navLinkHomeProjectRequests" href="../home-project-requests/" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Solicitudes Proyectos</p>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] === 'GERENTE DE PROYECTOS') { ?>
                    <li class="nav-item">
                        <a id="navLinkViewHomeProjectRequests" href="../view-home-project-requests/" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Ver Solicitudes Proyectos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="navLinkHomeProjects" href="../home-projects/" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Gestión Proyectos</p>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] == 'Administrador') { ?>
                    <li class="nav-item">
                        <a id="navLinkHomeEmployees" href="../home-employees/" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Empleados</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="navLinkHomeSuppliers" href="../home-suppliers/" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Proveedores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="navLinkUsers" href="#" class="nav-link">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="navLinkHomeAssignUserEmployee" href="../home-assign-user-employee/" class="nav-link">
                                    <i class="fas fa-user nav-icon"></i>
                                    <p>Asignar Usuario A Empleado</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a id="navLinkMaterialResources" href="#" class="nav-link">
                            <i class="fas fa-warehouse nav-icon"></i>
                            <p>
                                Recursos Materiales
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="navLinkHomeTypesMaterialResources" href="../home-types-material-resources/" class="nav-link">
                                    <i class="fas fa-warehouse nav-icon"></i>
                                    <p>Tipos De Recursos Materiales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomeMaterialResources" href="../home-material-resources/" class="nav-link">
                                    <i class="fas fa-warehouse nav-icon"></i>
                                    <p>Recursos Materiales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomeMaterialResourcesSuppliers" href="../home-countries/" class="nav-link">
                                    <i class="fas fa-warehouse nav-icon"></i>
                                    <p>Recursos Materiales Por Proveedores</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] == 'Administrador') { ?>
                    <li class="nav-header">MANTENIMIENTOS</li>
                    <li class="nav-item">
                        <a id="navLinkMaintenance" href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Mantenimientos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="navLinkHomeCities" href="../home-cities/" class="nav-link">
                                    <i class="fas fa-city nav-icon"></i>
                                    <p>Ciudades</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomeCountries" href="../home-countries/" class="nav-link">
                                    <i class="fas fa-city nav-icon"></i>
                                    <p>Pa&iacute;ses</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomeProvinces" href="../home-provinces/" class="nav-link">
                                    <i class="fas fa-city nav-icon"></i>
                                    <p>Provincias</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomePositions" href="../home-positions/" class="nav-link">
                                    <i class="far fa-id-badge nav-icon"></i>
                                    <p>Puestos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomeRoles" href="../home-roles/" class="nav-link">
                                    <i class="fas fa-user-tag nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navLinkHomeTypesSuppliers" href="../home-types-suppliers/" class="nav-link">
                                    <i class="fas fa-people-arrows nav-icon"></i>
                                    <p>Tipos Proveedores</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->