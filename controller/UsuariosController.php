<?php
require_once('../config/connection.php');
require_once('../models/Usuarios.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$usuarios = new Usuarios();

//Codificar el password con hash:
$hashed_password_individual_client = password_hash($_POST['nuevoPasswordClienteIndividual'], PASSWORD_DEFAULT);
$hashed_user_employee_password = password_hash($_POST['passwordUsuarioEmpleado'], PASSWORD_DEFAULT);
$hashed_password_user_private_business_client = password_hash($_POST['nuevoPasswordClienteEmpresa'], PASSWORD_DEFAULT);

switch ($_GET['op']) {
    case 'registrar_usuarios_empleados':
        $usuarios->registrar_usuarios_empleados($_POST['empleadoID'], $_POST['nombreUsuarioEmpleado'], $hashed_user_employee_password, $_POST['rolID'], $creadoPor);
        break;
    case 'registrar_usuarios_clientes_individuales':
        $usuarios->registrar_usuarios_clientes_individuales(
            $_POST['nombreClienteClienteIndividual'],
            $_POST['telefonoClienteIndividual'],
            $_POST['correoElectronicoClienteIndividual'],
            $_POST['paisIDClienteIndividual'],
            $_POST['provinciaIDClienteIndividual'],
            $_POST['ciudadIDClienteIndividual'],
            $_POST['direccionClienteIndividual'],
            $_POST['apellidoClienteClienteIndividual'],
            $_POST['sexoIDClienteIndividual'],
            $_POST['cedulaClienteIndividual'],
            $_POST['fechaNacimientoClienteIndividual'],
            $_POST['nacionalidadIDClienteIndividual'],
            $_POST['nuevoNombreUsuarioClienteIndividual'],
            $hashed_password_individual_client,
            $creadoPor
        );
        break;
    case 'registrar_usuarios_clientes_empresas_privadas':
        $usuarios->registrar_usuarios_clientes_empresas_privadas(
            $_POST['nombreEmpresaClienteEmpresa'],
            $_POST['tipoClienteIDClienteEmpresa'],
            $_POST['telefonoClienteEmpresa'],
            $_POST['correoElectronicoClienteEmpresa'],
            $_POST['paisIDClienteEmpresa'],
            $_POST['provinciaIDClienteEmpresa'],
            $_POST['ciudadIDClienteEmpresa'],
            $_POST['direccionClienteEmpresa'],
            $_POST['rncClienteEmpresa'],
            $_POST['nombreContactoClienteEmpresa'],
            $_POST['cargoContactoClienteEmpresa'],
            $_POST['numeroEmpleadosClienteEmpresa'],
            $_POST['sectorClienteEmpresa'],
            $_POST['nuevoNombreUsuarioClienteEmpresa'],
            $hashed_password_user_private_business_client,
            $creadoPor
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
