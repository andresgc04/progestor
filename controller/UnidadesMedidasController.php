<?php
require_once('../config/connection.php');
require_once('../models/UnidadesMedidas.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$unidadesMedidas = new UnidadesMedidas();

switch ($_GET['op']) {
    case 'registrar_unidades_medidas':
        $unidadesMedidas->registrar_unidades_medidas($_POST['unidadMedida'], $creadoPor);
        break;
    case 'listado_unidades_medidas':
        $datos = $unidadesMedidas->listado_unidades_medidas();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['UNIDAD_MEDIDA_ID'];
            $sub_array[] = $row['UNIDAD_MEDIDA'];

            if ($row['ESTADOS'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['UNIDAD_MEDIDA_ID'] . '" onclick="verDetalleUnidadMedida(' . $row['UNIDAD_MEDIDA_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['UNIDAD_MEDIDA_ID'] . '" onclick="eliminarUnidadMedida(' . $row['UNIDAD_MEDIDA_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_detalles_unidades_medidas_por_unidad_medida_ID':
        $data = $unidadesMedidas->obtener_detalles_unidades_medidas_por_unidad_medida_ID($_POST['unidadMedidaID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'unidadMedidaID' => $item['UNIDAD_MEDIDA_ID'],
                    'unidadMedida' => $item['UNIDAD_MEDIDA'],
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
    case 'modificar_unidades_medidas':
        $unidadesMedidas->modificar_unidades_medidas($_POST['modificarUnidadMedida'], $modificadoPor, $_POST['unidadMedidaID']);
        break;
    case 'eliminar_unidades_medidas':
        $unidadesMedidas->eliminar_unidades_medidas($modificadoPor, $_POST['unidadMedidaID']);
        break;
    case 'obtener_listado_opciones_unidades_medidas':
        $datos = $unidadesMedidas->obtener_listado_opciones_unidades_medidas();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la unidad de medida.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['UNIDAD_MEDIDA_ID'] . '">' . $row['UNIDAD_MEDIDA'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_unidades_medidas_por_unidad_medida_ID':
        $datos = $unidadesMedidas->obtener_listado_opciones_unidades_medidas_por_unidad_medida_ID($_POST['unidadMedidaID']);

        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= '<option selected value="' . $row['UNIDAD_MEDIDA_ID'] . '">' . $row['UNIDAD_MEDIDA'] . '</option>';
            }
        }

        $datos2 = $unidadesMedidas->obtener_listado_opciones_unidades_medidas_diferente_unidad_medida_ID($_POST['unidadMedidaID']);

        if (is_array($datos2) == true and count($datos2) > 0) {
            foreach ($datos2 as $row) {
                $html .= '<option value="' . $row['UNIDAD_MEDIDA_ID'] . '">' . $row['UNIDAD_MEDIDA'] . '</option>';
            }

            echo $html;
        }
        break;
}
