<?php
require_once('../config/connection.php');
require_once('../models/Empleados.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$empleados = new Empleados();

switch ($_GET['op']) {
    case "registrar_empleado":
        $empleados->registrar_empleado(
            $_POST['primerNombre'],
            $_POST['segundoNombre'],
            $_POST['primerApellido'],
            $_POST['segundoApellido'],
            $_POST['sexoID'],
            $_POST['estadoCivilID'],
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
            $_POST['puestoID'],
            $_POST['departamentoID'],
            $_POST['supervisorID'],
            $_POST['salario'],
            $_POST['numeroSeguridadSocial'],
            $_POST['fechaContratacion'],
            $creadoPor
        );
        break;
    case 'listado_empleados':
        $datos = $empleados->listado_empleados();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['empleado_id'];
            $sub_array[] = $row['empleados'];
            $sub_array[] = $row['puestos'];
            $sub_array[] = $row['departamentos'];
            $sub_array[] = $row['supervisores'];
            $sub_array[] = $row['fechas_contrataciones'];

            if ($row['estados'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['empleado_id'] . '" onClick="verDetalleEmpleados(' . $row['empleado_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['empleado_id'] . '" onClick="eliminarEmpleados(' . $row['empleado_id'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                            ';

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
    case 'obtener_listado_opciones_supervisores_por_departamentoID':
        $datos = $empleados->obtener_listado_opciones_supervisores_por_departamentoID($_POST['departamentoID']);

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el supervisor.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['EMPLEADO_ID'] . '">' . $row['SUPERVISORES'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_empleados':
        $datos = $empleados->obtener_listado_opciones_empleados();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el empleado.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['empleado_id'] . '">' . $row['empleados'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_responsables_proyecto':
        $datos = $empleados->obtener_listado_opciones_responsables_proyecto();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el responsable del proyecto.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['EMPLEADO_ID'] . '">' . $row['EMPLEADO'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_responsables_proyecto_por_responsable_ID':
        $datos = $empleados->obtener_listado_opciones_responsables_proyecto_por_responsable_ID($_POST['responsableID']);

        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= '<option selected value="' . $row['EMPLEADO_ID'] . '">' . $row['EMPLEADO'] . '</option>';
            }
        }

        $datos2 = $empleados->obtener_listado_opciones_responsables_proyecto_diferente_responsable_ID($_POST['responsableID']);

        if (is_array($datos2) == true and count($datos2) > 0) {
            foreach ($datos2 as $row) {
                $html .= '<option value="' . $row['EMPLEADO_ID'] . '">' . $row['EMPLEADO'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_cedulas_empleados_por_cedula':
        $data = $empleados->obtener_cedulas_empleados_por_cedula($_POST['cedula']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'cedula' => $item['CEDULA'],
                ];

                // Agregar el elemento normalizado al array resultante
                $normalizedData = $normalizedItem;
            }

            // Crear un array asociativo con la clave "data"
            $response = array('data' => $normalizedData);

            // Convertir el array de objetos a formato JSON:
            $json = json_encode($response, JSON_UNESCAPED_UNICODE);

            // Configurar la cabecera para indicar que la respuesta es JSON
            header('Content-Type: application/json');

            // Retornar o imprimir el JSON
            echo $json;
        } else {
            echo json_encode(['data' => []]);
        }
        break;
}
