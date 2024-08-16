<?php
require_once('../config/connection.php');
require_once('../models/TiposRecursosMateriales.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$modificadoPor = $creadoPor;

$tiposRecursosMateriales = new TiposRecursosMateriales();

switch ($_GET["op"]) {
    case 'registrar_tipos_recursos_materiales':
        $tiposRecursosMateriales->registrar_tipos_recursos_materiales($_POST['nombreTipoRecursoMaterial'], $creadoPor);
        break;
    case 'listado_tipos_recursos_materiales':
        $datos = $tiposRecursosMateriales->listado_tipos_recursos_materiales();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL_ID'];
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL'];

            if ($row['ESTADOS'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                              <div class="btn-group btn-group-sm">
                                <button type="button" id="' . $row['TIPO_RECURSO_MATERIAL_ID'] . '" onclick="verDetalleTipoRecursoMaterial(' . $row['TIPO_RECURSO_MATERIAL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                <button type="button" id="' . $row['TIPO_RECURSO_MATERIAL_ID'] . '" onclick="eliminarTipoRecursoMaterial(' . $row['TIPO_RECURSO_MATERIAL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_detalles_tipos_recursos_materiales_por_tipo_recurso_material_ID':
        $data = $tiposRecursosMateriales->obtener_detalles_tipos_recursos_materiales_por_tipo_recurso_material_ID($_POST['tipoRecursoMaterialID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'tipoRecursoMaterialID' => $item['TIPO_RECURSO_MATERIAL_ID'],
                    'tipoRecursoMaterial' => $item['TIPO_RECURSO_MATERIAL'],
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
    case 'modificar_tipos_recursos_materiales':
        $tiposRecursosMateriales->modificar_tipos_recursos_materiales($_POST['modificarNombreTipoRecursoMaterial'], $modificadoPor, $_POST['tipoRecursoMaterialID']);
        break;
    case 'eliminar_tipos_recursos_materiales':
        $tiposRecursosMateriales->eliminar_tipos_recursos_materiales($modificadoPor, $_POST['tipoRecursoMaterialID']);
        break;
    case 'obtener_listado_opciones_tipos_recursos_materiales':
        $datos = $tiposRecursosMateriales->obtener_listado_opciones_tipos_recursos_materiales();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de recurso material.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_RECURSO_MATERIAL_ID'] . '">' . $row['TIPO_RECURSO_MATERIAL'] . '</option>';
            }

            echo $html;
        }
        break;
}
