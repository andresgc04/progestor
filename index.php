<?php
require_once("config/connection.php");

if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {
    require_once("models/Usuarios.php");

    $usuarios = new Usuarios();
    $usuarios->login();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ProGestor | Iniciar Sesi&oacute;n</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/lib/adminLTE/plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="public/lib/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="public/lib/adminLTE/dist/css/adminlte.min.css" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index.php" class="h1"><b>Pro</b>Gestor</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Iniciar Sesión</p>

                <?php
                if (isset($_GET["m"])) {
                    switch ($_GET["m"]) {
                        case "1";
                ?>
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <span>El usuario y/o contraseña son incorrectos.</span>
                                </div>
                            </div>
                        <?php
                            break;

                        case "2";
                        ?>
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <span>Los campos estan vacios.</span>
                                </div>
                            </div>
                <?php
                            break;
                    }
                }
                ?>

                <form id="loginForm" action="" method="post" class="mb-3">
                    <div class="input-group mb-3">
                        <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" placeholder="Ingrese su usuario." />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="enviar" class="form-control" value="si" />
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                Iniciar
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">Olvidé mi contraseña</a>
                </p> -->
                <p class="mb-0">
                    <a id="newUserClientButton" type="button" class="text-center">Registrarse nuevo cliente</a>
                </p>

                <?php require_once('new-user-client-form-modal.php') ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="public/lib/adminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="public/lib/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/lib/adminLTE/dist/js/adminlte.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
</body>

</html>