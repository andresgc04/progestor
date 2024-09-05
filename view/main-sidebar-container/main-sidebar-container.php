<?php
require_once('../../config/connection.php');
require_once('../../models/Usuarios.php');
require_once('../../models/AccesosModulosSistemas.php');
require_once('../../public/php/constants/sessions-constants.php');

//session_start();
$accesosModulosSistemas = new AccesosModulosSistemas();

$nombreUsario = $_SESSION[$NOMBRE_USUARIO];
$usuarioID = $_SESSION[$USUARIO_ID];
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
                <a href="#" class="d-block"><?php echo $nombreUsario ?></a>
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
                <?php
                $datos = $accesosModulosSistemas->obtener_accesos_modulos_sistemas_usuarios_por_usuario_ID($usuarioID);

                foreach ($datos as $row) {
                    $sub_array = array();

                    $sub_array[] = $row['MODULO'];

                    foreach ($sub_array as $modulo) {
                        if ($modulo == 'Dashboard') {
                            echo '<li class="nav-header">GESTIONES</li>
                                    <li class="nav-item">
                                        <a id="navLinkDashboard" href="../dashboard/" class="nav-link">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li>';
                        } elseif ($modulo == 'Proyectos' || $modulo == 'PROYECTOS' || $modulo == 'proyectos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeProjects" href="../home-clients-civil-works-projects/" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Proyectos</p>
                                    </a>
                                </li>';
                        } elseif ($modulo == 'Solicitudes Proyectos' || $modulo == 'SOLICITUDES PROYECTOS' || $modulo == 'solicitudes proyectos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeProjectRequests" href="../home-project-requests/" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Solicitudes Proyectos</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Ver Solicitudes Proyectos' || $modulo == 'VER SOLICITUDES PROYECTOS' || $modulo == 'ver solicitudes proyectos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkViewHomeProjectRequests" href="../view-home-project-requests/" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Ver Solicitudes Proyectos</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Gestión Proyectos' || $modulo == 'GESTIÓN PROYECTOS' || $modulo == 'gestión proyectos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeProjects" href="../home-civil-works-projects/" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Gestión Proyectos</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Empleados' || $modulo == 'EMPLEADOS' || $modulo == 'empleados') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeEmployees" href="../home-employees/" class="nav-link">
                                        <i class="nav-icon fas fa-user-tie"></i>
                                        <p>Empleados</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Proveedores' || $modulo == 'PROVEEDORES' || $modulo == 'proveedores') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeSuppliers" href="../home-suppliers/" class="nav-link">
                                        <i class="nav-icon fas fa-user-friends"></i>
                                        <p>Proveedores</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Asignar Usuario A Empleado' || $modulo == 'ASIGNAR USUARIO A EMPLEADO' || $modulo == 'asignar usuario a empleado') {
                            echo '<li class="nav-item">
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
                                </li>';
                        } elseif ($modulo == 'Tipos De Recursos Materiales' || $modulo == 'TIPOS DE RECURSOS MATERIALES' || $modulo == 'tipos de recursos materiales') {
                            echo '<li class="nav-item">
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
                                        </li>';
                        } elseif ($modulo == 'Recursos Materiales' || $modulo == 'RECURSOS MATERIALES' || $modulo == 'recursos materiales') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeMaterialResources" href="../home-material-resources/" class="nav-link">
                                        <i class="fas fa-warehouse nav-icon"></i>
                                             <p>Recursos Materiales</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Recursos Materiales Por Proveedores' || $modulo == 'RECURSOS MATERIALES POR PROVEEDORES' || $modulo == 'recursos materiales por proveedores') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeMaterialResourcesSuppliers" href="../home-material-resources-suppliers/" class="nav-link">
                                        <i class="fas fa-warehouse nav-icon"></i>
                                        <p>Recursos Materiales Por Proveedores</p>
                                    </a>
                                  </li>
                                </ul>
                            </li>';
                        } elseif ($modulo == 'Módulos Del Sistema' || $modulo == 'MÓDULOS DEL SISTEMA' || $modulo == 'módulo del sistema') {
                            echo '<li class="nav-header">MANTENIMIENTOS DE SEGURIDAD</li>
                                    <li class="nav-item">
                                        <a id="navLinkHomeSystemModules" href="../home-system-modules/" class="nav-link">
                                            <i class="nav-icon fas fa-th-large"></i>
                                            <p>Módulos Del Sistema</p>
                                        </a>
                                    </li>';
                        } elseif ($modulo == 'Roles' || $modulo == 'ROLES' || $modulo == 'roles') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeRoles" href="../home-roles/" class="nav-link">
                                        <i class="fas fa-user-tag nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Asignar Módulo Del Sistema A Un Rol' || $modulo == 'ASIGNAR MÓDULO DEL SISTEMA A UN ROL' || $modulo == 'asignar módulo del sistema a un rol') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeAssignSystemModuleRole" href="../home-assign-system-module-role/" class="nav-link">
                                        <i class="fas fa-sitemap nav-icon"></i>
                                        <p>Asignar Módulo Del Sistema A Un Rol</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Ciudades' || $modulo == 'CIUDADES' || $modulo == 'ciudades') {
                            echo '<li class="nav-header">MANTENIMIENTOS</li>
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
                                            </li>';
                        } elseif ($modulo == 'Paises' || $modulo == 'PAISES' || $modulo == 'paises') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeCountries" href="../home-countries/" class="nav-link">
                                        <i class="fas fa-city nav-icon"></i>
                                        <p>Pa&iacute;ses</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Provincias' || $modulo == 'PROVINCIAS' || $modulo == 'provincias') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeProvinces" href="../home-provinces/" class="nav-link">
                                        <i class="fas fa-city nav-icon"></i>
                                        <p>Provincias</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Puestos' || $modulo == 'PUESTOS' || $modulo == 'puestos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomePositions" href="../home-positions/" class="nav-link">
                                        <i class="far fa-id-badge nav-icon"></i>
                                        <p>Puestos</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Tipos Proveedores' || $modulo == 'TIPOS PROVEEDORES' || $modulo == 'tipos proveedores') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeTypesSuppliers" href="../home-types-suppliers/" class="nav-link">
                                        <i class="fas fa-people-arrows nav-icon"></i>
                                        <p>Tipos Proveedores</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Unidades Medidas' || $modulo == 'UNIDADES MEDIDAS' || $modulo == 'unidades medidas') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeUnitMeasurement" href="../home-unit-measurement/" class="nav-link">
                                        <i class="fas fa-weight nav-icon"></i>
                                        <p>Unidades Medidas</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Fases Proyectos' || $modulo == 'FASES PROYECTOS' || $modulo == 'fases proyectos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeProjectPhases" href="../home-project-phases/" class="nav-link">
                                        <i class="fas fa-project-diagram nav-icon"></i>
                                        <p>Fases Del Proyecto</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Actividades Proyectos' || $modulo == 'ACTIVIDADES PROYECTOS' || $modulo == 'actividades proyectos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeProjectActivities" href="../home-project-activities/" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Actividades De Los Proyectos</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Tipos Pagos' || $modulo == 'TIPOS PAGOS' || $modulo == 'tipos pagos') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeTypesPayments" href="../home-types-payments/" class="nav-link">
                                        <i class="fas fa-money-check-alt nav-icon"></i>
                                        <p>Tipos De Pagos</p>
                                    </a>
                                  </li>';
                        } elseif ($modulo == 'Recursos Manos Obras' || $modulo == 'RECURSOS MANOS OBRAS' || $modulo == 'recursos manos obras') {
                            echo '<li class="nav-item">
                                    <a id="navLinkHomeLaborResources" href="../home-labor-resources/" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Recursos De Manos De Obras</p>
                                    </a>
                                  </li>
                                </ul>
                            </li>';
                        }
                    };
                }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->