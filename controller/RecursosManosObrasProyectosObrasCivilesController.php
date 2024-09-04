<?php
require_once('../config/connection.php');
require_once('../models/RecursosManosObrasProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosManosObrasProyectosObrasCiviles = new RecursosManosObrasProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_recursos_manos_obras_proyectos_obras_civiles":
        $recursosManosObrasProyectosObrasCiviles->registrar_recursos_manos_obras_proyectos_obras_civiles(
            $_POST['addLaborResourcesProyectoObraCivilID'],
            $_POST['faseProyectoIDRecursoManoObra'],
            $_POST['recursoManoObraID'],
            $_POST['tipoPago'],
            $_POST['cantidadRecursosManosObras'],
            $_POST['costoRecursoManoObra'],
            $_POST['costoTotalRecursoManoObra'],
            $creadoPor
        );
        break;
    case "listado_recursos_manos_obras_proyectos_obras_civiles":
        $datos = $recursosManosObrasProyectosObrasCiviles->listado_recursos_manos_obras_proyectos_obras_civiles($_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID'];
            $sub_array[] = $row['FASE_PROYECTO'];
            $sub_array[] = $row['RECURSO_MANO_OBRA'];
            $sub_array[] = $row['TIPO_PAGO'];
            $sub_array[] = $row['COSTO_TOTAL'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" id="' . $row['RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleRecursoManoObraProyectoObraCivil(' . $row['RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                            <button type="button" id="' . $row['RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="eliminarRecursoManoObraProyectoObraCivil(' . $row['RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_costos_totales_recursos_manos_obras_proyectos_obras_civiles_por_proyecto_obra_civil_ID':
        $data = $recursosManosObrasProyectosObrasCiviles->obtener_costos_totales_recursos_manos_obras_proyectos_obras_civiles_por_proyecto_obra_civil_ID(
            $_POST['proyectoObraCivilID']
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'costoTotal' => $item['COSTO_TOTAL']
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
