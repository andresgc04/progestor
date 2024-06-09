<?php
require_once('../../public/php/constants/sessions-constants.php');

session_start();

$nombreUsario = $_SESSION[$NOMBRE_USUARIO];
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
                <li class="nav-header">GESTIONES</li>
                <li class="nav-item">
                    <a id="navLinkDashboard" href="../dashboard/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANTENIMIENTOS</li>
                <li class="nav-item">
                    <a id="navLinkMaintenance" href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
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
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->