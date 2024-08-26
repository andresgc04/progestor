<?php
require_once('../config/connection.php');
require_once('../models/ActividadesProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$actividadesProyectosObrasCiviles = new ActividadesProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_actividades_proyectos_obras_civiles":
        $actividadesProyectosObrasCiviles->registrar_actividades_proyectos_obras_civiles(
            $_POST["addActivityProyectoObraCivilID"],
            $_POST['faseProyectoID'],
            $_POST['tipoActividadID'],
            $_POST['actividadProyectoID'],
            $_POST['unidadMedida'],
            $_POST['cantidadActividades'],
            $_POST['costoActividadProyecto'],
            $_POST['subTotal'],
            $_POST['itbis'],
            $_POST['costoTotalActividad'],
            $creadoPor
        );
        break;
    case "listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID":
        $datos = $actividadesProyectosObrasCiviles->listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID($_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ACTIVIDAD_PROYECTO_OBRA_CIVIL_ID'];
            $sub_array[] = $row['FASE_PROYECTO'];
            $sub_array[] = $row['TIPO_ACTIVIDAD'];
            $sub_array[] = $row['ACTIVIDAD_PROYECTO'];
            $sub_array[] = $row['COSTO_ACTIVIDAD_PROYECTO'];

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" id="' . $row['ACTIVIDAD_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleActividadProyectoObraCivil(' . $row['ACTIVIDAD_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                        <button type="button" id="' . $row['ACTIVIDAD_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="eliminarActividadProyectoObraCivil(' . $row['ACTIVIDAD_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_detalles_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID':
        $data = $actividadesProyectosObrasCiviles->obtener_detalles_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID(
            $_POST['actividadProyectoObraCivilID'],
            $_POST['proyectoObraCivilID']
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'actividadID' => $item['ACTIVIDAD_ID'],
                    'proyectoObraCivilID' => $item['PROYECTO_OBRA_CIVIL_ID'],
                    'tipoActividadID' => $item['TIPO_ACTIVIDAD_ID'],
                    'nombreActividad' => $item['NOMBRE_ACTIVIDAD'],
                    'descripcionActividad' => $item['DESCRIPCION_ACTIVIDAD'],
                    'costoActividad' => $item['COSTO_ACTIVIDAD']
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
    case "modificar_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID":
        $actividadesProyectosObrasCiviles->modificar_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID(
            $_POST["modifyTipoActividadID"],
            $_POST['modifyNombreActividad'],
            $_POST['modifyDescripcionActividad'],
            $_POST['modifyCostoActividad'],
            $modificadoPor,
            $_POST['modifyActividadProyectoObraCivilID'],
            $_POST['modifyProyectoObraCivilID'],
        );
        break;
}
