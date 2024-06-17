<?php
require_once('../config/connection.php');
require_once('../models/Usuarios.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$usuarios = new Usuarios();

//Codificar el password con hash:
$hashed_password = password_hash($_POST['nuevoPassword'], PASSWORD_DEFAULT);

switch ($_GET['op']) {
    case 'registrar_usuarios_clientes':
        $usuarios->registrar_usuarios_clientes(
            $_POST['primerNombre'],
            $_POST['segundoNombre'],
            $_POST['primerApellido'],
            $_POST['segundoApellido'],
            $_POST['sexoID'],
            $_POST['cedula'],
            $_POST['fechaNacimiento'],
            $_POST['nacionalidadID'],
            $_POST['paisID'],
            $_POST['provinciaID'],
            $_POST['ciudadID'],
            $_POST['direccion'],
            $_POST['telefonoResidencial'],
            $_POST['telefonoCelular'],
            $_POST['correoElectronico'],
            $_POST['tipoClienteID'],
            $_POST['nuevoNombreUsuario'],
            $hashed_password,
            $_POST[$creadoPor]
        );
        break;
}
