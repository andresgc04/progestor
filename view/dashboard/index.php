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
        <title>Progestor | Dashboard</title>
        <?php require_once('../links/links.php') ?>
    </head>
    <!-- /. Head -->

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <?php require_once('../preloader/preloader.php') ?>
            <!-- <%- include("../../templates/preloader.ejs"); %> -->
            <!-- /. Preloader -->

            <!-- Navbar -->
            <?php require_once('../navbar/navbar.php') ?>
            <!-- <%- include("../../templates/navbar.ejs") %> -->
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once('../main-sidebar-container/main-sidebar-container.php') ?>
            <!-- <%- include("../../templates/main-sidebar-container.ejs") %> -->
            <!-- /. Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php require_once('../content-header/content-header.php') ?>
                <!-- <%- include("../../templates/content-header.ejs", { titleContentHeader: -->
                <!-- 'Dashboard', linkContentHeader:'/dashboard', -->
                <!-- titleBreadCrumbContentHeader: 'Dashboard', -->
                <!-- subtitleBreadCrumbContentHeader: 'Dashboard'}); %> -->
                <!-- /.content-header -->

                <!-- Main content -->
                <!-- Aqui va el contenido del dashboard-->
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Footer -->
            <?php require_once('../footer/footer.php') ?>
            <!-- <%- include("../../templates/footer.ejs"); %> -->
            <!-- /.Footer-->

            <!-- Control Sidebar -->
            <?php require_once('../control-sidebar/control-sidebar.php') ?>
            <!-- <%- include("../../templates/control-sidebar.ejs"); %> -->
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <?php require_once('../scripts/scripts.php') ?>
        <script type="text/javascript" src="../../public/js/functions/content-header/set-content-header-titles.js"></script>
        <script type="text/javascript" src="../../public/js/functions/nav-link/set-nav-link-active.js"></script>
        <script type="text/javascript" src="dashboard.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>