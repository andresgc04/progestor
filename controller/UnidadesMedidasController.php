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
}
