<?php
require_once("../../public/php/constants/sessions-constants.php");

session_start();

$usuarioID = $_SESSION[$USUARIO_ID];

if (isset($usuarioID)) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Progestor | Detalles Del Proyecto</title>
        <?php require_once('../links/links.php') ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">General</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Project Name</label>
                                        <input type="text" id="inputName" class="form-control" value="AdminLTE">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Project Description</label>
                                        <textarea id="inputDescription" class="form-control" rows="4">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Status</label>
                                        <select id="inputStatus" class="form-control custom-select">
                                            <option disabled>Select one</option>
                                            <option>On Hold</option>
                                            <option>Canceled</option>
                                            <option selected>Success</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Client Company</label>
                                        <input type="text" id="inputClientCompany" class="form-control" value="Deveint Inc">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputProjectLeader">Project Leader</label>
                                        <input type="text" id="inputProjectLeader" class="form-control" value="Tony Chicken">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Budget</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">Estimated budget</label>
                                        <input type="number" id="inputEstimatedBudget" class="form-control" value="2300" step="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSpentBudget">Total amount spent</label>
                                        <input type="number" id="inputSpentBudget" class="form-control" value="2000" step="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Estimated project duration</label>
                                        <input type="number" id="inputEstimatedDuration" class="form-control" value="20" step="0.1">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Files</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>File Size</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>Functional-requirements.docx</td>
                                                <td>49.8005 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>UAT.pdf</td>
                                                <td>28.4883 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>Email-from-flatbal.mln</td>
                                                <td>57.9003 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>Logo.png</td>
                                                <td>50.5190 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <tr>
                                                <td>Contract-10_12_2014.docx</td>
                                                <td>44.9715 kb</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
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
        <script type="text/javascript" src="details-civil-works-projects.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../index.php");
}
?>