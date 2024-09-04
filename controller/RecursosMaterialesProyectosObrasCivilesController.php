<?php
require_once('../config/connection.php');
require_once('../models/RecursosMaterialesProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosMaterialesProyectosObrasCiviles = new RecursosMaterialesProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_recursos_materiales_proyectos_obras_civiles":
        $recursosMaterialesProyectosObrasCiviles->registrar_recursos_materiales_proyectos_obras_civiles(
            $_POST["addResourceMaterialProyectoObraCivilID"],
            $_POST['faseProyectoIDRecursoMaterial'],
            $_POST['proveedorID'],
            $_POST['tipoRecursoMaterialID'],
            $_POST['recursoMaterialID'],
            $_POST['unidadMedidaRecursoMaterial'],
            $_POST['cantidadRecursosMateriales'],
            $_POST['costoRecursoMaterial'],
            $_POST['subTotalRecursoMaterial'],
            $_POST['itbisRecursoMaterial'],
            $_POST['costoTotalRecursoMaterial'],
            $creadoPor
        );
        break;
    case "listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID":
        $datos = $recursosMaterialesProyectosObrasCiviles->listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID($_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'];
            $sub_array[] = $row['FASE_PROYECTO'];
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL'];
            $sub_array[] = $row['RECURSO_MATERIAL'];
            $sub_array[] = "RD$ " . number_format($row['COSTO_TOTAL'], 2, '.', ',');

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" id="' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleRecursoMaterialProyectoObraCivil(' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                            <button type="button" id="' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="eliminarRecursoMaterialProyectoObraCivil(' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_costos_totales_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID':
        $data = $recursosMaterialesProyectosObrasCiviles->obtener_costos_totales_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID(
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
