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
    case 'listado_usuarios_asignados_empleados':
        $datos = $usuarios->listado_usuarios_asignados_empleados();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['usuario_id'];
            $sub_array[] = $row['empleados'];
            $sub_array[] = $row['usuarios'];
            $sub_array[] = $row['roles'];

            if ($row['estados'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['usuario_id'] . '" onclick="verDetalleUsuariosAsignadosEmpleados(' . $row['usuario_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['usuario_id'] . '" onclick="eliminarUsuarioAsignadoEmpleado(' . $row['usuario_id'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>';

            $data[] = $sub_array;
        }

        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($resultados);
        break;
}
