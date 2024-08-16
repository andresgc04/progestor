<?php
require_once('../config/connection.php');
require_once('../models/RecursosMateriales.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$recursosMateriales = new RecursosMateriales();

switch ($_GET['op']) {
    case 'registrar_recursos_materiales':
        $recursosMateriales->registrar_recursos_materiales($_POST['tipoRecursoMaterialID'], $_POST['nombreRecursoMaterial'], $creadoPor);
        break;
    case 'listado_recursos_materiales':
        $datos = $recursosMateriales->listado_recursos_materiales();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['RECURSO_MATERIAL_ID'];
            $sub_array[] = $row['TIPOS_RECURSOS_MATERIALES'];
            $sub_array[] = $row['RECURSOS_MATERIALES'];

            if ($row['ESTADOS'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['RECURSO_MATERIAL_ID'] . '" onclick="verDetalleRecursoMaterial(' . $row['TIPO_RECURSO_MATERIAL_ID'] . ', ' . $row['RECURSO_MATERIAL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['RECURSO_MATERIAL_ID'] . '" onclick="eliminarRecursoMaterial(' . $row['TIPO_RECURSO_MATERIAL_ID'] . ', ' . $row['RECURSO_MATERIAL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_detalles_recursos_materiales_por_tipo_recurso_material_ID_recurso_material_ID':
        $data = $recursosMateriales->obtener_detalles_recursos_materiales_por_tipo_recurso_material_ID_recurso_material_ID($_POST['tipoRecursoMaterialID'], $_POST['recursoMaterialID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'recursoMaterialID' => $item['RECURSO_MATERIAL_ID'],
                    'tipoRecursoMaterialID' => $item['TIPO_RECURSO_MATERIAL_ID'],
                    'recursoMaterial' => $item['RECURSO_MATERIAL'],
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
