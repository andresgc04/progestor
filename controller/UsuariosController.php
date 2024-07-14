<?php
require_once('../config/connection.php');
require_once('../models/Usuarios.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$usuarios = new Usuarios();

switch ($_GET['op']) {
    case 'registrar_usuarios_empleados':
        $usuarios->registrar_usuarios_empleados($_POST['empleadoID'], $_POST['nombreUsuarioEmpleado'], password_hash($_POST['passwordUsuarioEmpleado'], PASSWORD_DEFAULT), $_POST['rolID'], $creadoPor);
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
            password_hash($_POST['nuevoPasswordClienteIndividual'], PASSWORD_DEFAULT),
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
            password_hash($_POST['nuevoPasswordClienteEmpresa'], PASSWORD_DEFAULT),
            $creadoPor
        );
        break;
    case 'registrar_usuarios_clientes_empresas_gubernamentales':
        $usuarios->registrar_usuarios_clientes_empresas_gubernamentales(
            $_POST['nombreEmpresaClienteEmpresaGubernamental'],
            $_POST['tipoClienteIDClienteEmpresaGubernamental'],
            $_POST['telefonoClienteEmpresaGubernamental'],
            $_POST['correoElectronicoClienteEmpresaGubernamental'],
            $_POST['paisIDClienteEmpresaGubernamental'],
            $_POST['provinciaIDClienteEmpresaGubernamental'],
            $_POST['ciudadIDClienteEmpresaGubernamental'],
            $_POST['direccionClienteEmpresaGubernamental'],
            $_POST['rncClienteEmpresaGubernamental'],
            $_POST['nombreContactoClienteEmpresaGubernamental'],
            $_POST['cargoContactoClienteEmpresaGubernamental'],
            $_POST['sectorClienteEmpresaGubernamental'],
            $_POST['presupuestoAnualClienteEmpresaGubernamental'],
            $_POST['nuevoNombreUsuarioClienteEmpresaGubernamental'],
            password_hash($_POST['nuevoPasswordClienteEmpresaGubernamental'], PASSWORD_DEFAULT),
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
