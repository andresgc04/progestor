<?php
require_once('../config/connection.php');
require_once('../models/SolicitudesProyectos.php');
require_once('../public/php/constants/sessions-constants.php');

$usuarioID = $_SESSION[$USUARIO_ID];
$creadoPor = $_SESSION[$USUARIO_ID];

$solicitudesProyectos = new SolicitudesProyectos();

switch ($_GET['op']) {
    case 'registrar_solicitudes_proyectos':
        $solicitudesProyectos->registrar_solicitudes_proyectos($_POST['descripcionProyecto'], $_POST['objetivoProyecto'], $_POST['presupuesto'], $_POST['requerimientoSolicitudProyecto'], $creadoPor);
        break;
    case 'listado_solicitudes_proyectos_por_usuarioID':
        $datos = $solicitudesProyectos->listado_solicitudes_proyectos_por_usuarioID($usuarioID);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['solicitud_proyecto_id'];
            $sub_array[] = $row['descripcion_proyecto'];
            $sub_array[] = $row['objetivo_proyecto'];
            $sub_array[] = $row['solicitado_por'];
            $sub_array[] = $row['fecha_solicitud'];

            if ($row['estado'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            if ($row['estado'] === "PENDIENTE DE APROBACIÓN") {
                $sub_array[] = '<span class="badge badge-primary">PENDIENTE DE APROBACIÓN</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onClick="verDetalleSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onClick="eliminarDetalleSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_encabezado_solicitudes_proyectos_por_solicitud_proyecto_ID':
        $data = $solicitudesProyectos->obtener_encabezado_solicitudes_proyectos_por_solicitud_proyecto_ID($_POST['solicitudProyectoID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'puestoID' => $item['SOLICITUD_PROYECTO_ID'],
                    'puesto' => $item['DESCRIPCION_PROYECTO'],
                    'objetivoProyecto' => $item['OBJETIVO_PROYECTO'],
                    'presupuestoProyecto' => $item['PRESUPUESTO_PROYECTO'],
                    'estado' => $item['ESTADO']
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
