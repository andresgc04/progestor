<?php
require_once("../config/connection.php");
require_once("../models/ActividadesProyectos.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$actividadesProyectos = new ActividadesProyectos();

switch ($_GET['op']) {
    case "registrar_actividades_proyectos":
        $actividadesProyectos->registrar_actividades_proyectos(
            $_POST["tipoActividadID"],
            $_POST['actividadProyecto'],
            $_POST['unidadMedidaID'],
            $_POST['costoActividadProyecto'],
            $creadoPor
        );
        break;
    case "listado_actividades_proyectos":
        $datos = $actividadesProyectos->listado_actividades_proyectos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ACTIVIDAD_PROYECTO_ID'];
            $sub_array[] = $row['TIPO_ACTIVIDAD'];
            $sub_array[] = $row['ACTIVIDAD_PROYECTO'];
            $sub_array[] = $row['UNIDAD_MEDIDA'];
            $sub_array[] = $row['COSTO_ACTIVIDAD_PROYECTO'];

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['ACTIVIDAD_PROYECTO_ID'] . '" onclick="verDetalleActividadProyecto(' . $row['ACTIVIDAD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['ACTIVIDAD_PROYECTO_ID'] . '" onclick="eliminarActividadProyecto(' . $row['ACTIVIDAD_PROYECTO_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_unidades_medidas_costos_actividades_proyectos_por_actividad_proyecto_ID':
        $data = $actividadesProyectos->obtener_unidades_medidas_costos_actividades_proyectos_por_actividad_proyecto_ID($_POST['actividadProyectoID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'unidadMedida' => $item['UNIDAD_MEDIDA'],
                    'costoActividadProyecto' => $item['COSTO_ACTIVIDAD_PROYECTO'],
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
    case 'obtener_listado_opciones_actividades_proyectos_por_tipo_actividad_ID':
        $datos = $actividadesProyectos->obtener_listado_opciones_actividades_proyectos_por_tipo_actividad_ID($_POST['tipoActividadID']);

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la actividad del proyecto.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['ACTIVIDAD_PROYECTO_ID'] . '">' . $row['ACTIVIDAD_PROYECTO'] . '</option>';
            }

            echo $html;
        }
        break;
}
