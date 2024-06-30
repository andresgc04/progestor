<?php
require_once('../config/connection.php');
require_once('../models/Puestos.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$puestos = new Puestos();

switch ($_GET['op']) {
    case "registrar_puestos":
        $puestos->registrar_puestos($_POST["puesto"], $creadoPor);
        break;
    case "listado_puestos":
        $datos = $puestos->listado_puestos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['PUESTO_ID'];
            $sub_array[] = $row['PUESTO'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['PUESTO_ID'] . '" onclick="verDetallePuesto(' . $row['PUESTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['PUESTO_ID'] . '" onclick="eliminarPuesto(' . $row['PUESTO_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_puestos':
        $datos = $puestos->obtener_listado_opciones_puestos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el puesto.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['PUESTO_ID'] . '">"' . $row['PUESTO'] . '"</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_detalle_puesto_por_puestoID':
        $data = $puestos->obtener_detalle_puesto_por_puestoID($_POST['puestoID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'puestoID' => $item['PUESTO_ID'],
                    'puesto' => $item['PUESTO']
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
    case 'modificar_puestos_por_puestoID':
        $puestos->modificar_puestos_por_puestoID($_POST['modificarPuesto'], $_POST['puestoID'], $modificadoPor);
        break;
    case 'eliminar_puestos_por_puestoID':
        $puestos->eliminar_puestos_por_puestoID($_POST['puestoID'], $modificadoPor);
        break;
}
