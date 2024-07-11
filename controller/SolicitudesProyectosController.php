<?php
require_once('../config/connection.php');
require_once('../models/SolicitudesProyectos.php');
require_once('../public/php/constants/sessions-constants.php');

$usuarioID = $_SESSION[$USUARIO_ID];
$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

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

            if ($row['estado'] === "PENDIENTE") {
                $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            }

            if ($row['estado'] === "CANCELADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            $sub_array[] = $row['estado'] === 'ACTIVO' ? '<td class="text-right py-0 align-middle">
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="verDetalleSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="eliminarSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                            </div>
                                                          </td>'
                :
                '<td class="text-right py-0 align-middle">
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="verDetalleSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="eliminarSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')"class="btn btn-danger disabled"><i class="fas fa-trash"></i></button>
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
    case 'obtener_encabezado_solicitudes_proyectos_por_solicitud_proyecto_ID':
        $data = $solicitudesProyectos->obtener_encabezado_solicitudes_proyectos_por_solicitud_proyecto_ID($_POST['solicitudProyectoID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'solicitudProyectoID' => $item['SOLICITUD_PROYECTO_ID'],
                    'descripcionProyecto' => $item['DESCRIPCION_PROYECTO'],
                    'objetivoProyecto' => $item['OBJETIVO_PROYECTO'],
                    'presupuestoProyecto' => $item['PRESUPUESTO_PROYECTO'],
                    'nombreCliente' => $item['NOMBRE_CLIENTE'],
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
    case 'obtener_requerimientos_solicitudes_proyectos_por_solicitud_proyecto_ID':
        $datos = $solicitudesProyectos->obtener_requerimientos_solicitudes_proyectos_por_solicitud_proyecto_ID($_POST['solicitudProyectoID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'];
            $sub_array[] = $row['DESCRIPCION_REQUERIMIENTO'];

            if ($row['ESTADO'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            if ($row['ESTADO'] === "PENDIENTE") {
                $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            }

            if ($row['ESTADO'] === "CANCELADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            if ($row['ESTADO'] === "RECHAZADO") {
                $sub_array[] = '<span class="badge badge-danger">RECHAZADO</span>';
            }

            if ($row['ESTADO'] === "APROBADO") {
                $sub_array[] = '<span class="badge badge-success">APROBADO</span>';
            }

            $sub_array[] = $row['ESTADO'] === 'ACTIVO' ? '<td class="text-right py-0 align-middle">
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" id="' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . '" onclick="verDetallesRequerimientosSolicitudesProyectos(' . $row['SOLICITUD_PROYECTO_ID'] . ', ' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                <button type="button" id="' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . '" onclick="eliminarRequerimientoSolicitudesProyectos(' . $row['SOLICITUD_PROYECTO_ID'] . ', ' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                            </div>
                                                          </td>' :
                '<td class="text-right py-0 align-middle">
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" id="' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . '" onclick="verDetallesRequerimientosSolicitudesProyectos(' . $row['SOLICITUD_PROYECTO_ID'] . ', ' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info disabled"><i class="fas fa-eye"></i></button>
                                                                <button type="button" id="' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . '" onclick="eliminarRequerimientoSolicitudesProyectos(' . $row['SOLICITUD_PROYECTO_ID'] . ', ' . $row['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'] . ')"class="btn btn-danger disabled"><i class="fas fa-trash"></i></button>
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
    case 'modificar_solicitudes_proyectos_por_solicitud_proyecto_ID':
        $solicitudesProyectos->modificar_solicitudes_proyectos_por_solicitud_proyecto_ID(
            $_POST['descripcionProyecto'],
            $_POST['objetivoProyecto'],
            $_POST['presupuestoProyecto'],
            $modificadoPor,
            $_POST['solicitudProyectoID']
        );
        break;
    case 'modificar_solicitudes_proyectos_cambiar_estado_activo_cancelado_por_solicitud_proyecto_ID':
        $solicitudesProyectos->modificar_solicitudes_proyectos_cambiar_estado_activo_cancelado_por_solicitud_proyecto_ID(
            $_POST['descripcionProyecto'],
            $_POST['objetivoProyecto'],
            $_POST['presupuestoProyecto'],
            $modificadoPor,
            $_POST['solicitudProyectoID']
        );
        break;
    case 'modificar_solicitudes_proyectos_cambiar_estado_activo_aprobado_por_solicitud_proyecto_ID':
        $solicitudesProyectos->modificar_solicitudes_proyectos_cambiar_estado_activo_aprobado_por_solicitud_proyecto_ID(
            $_POST['descripcionProyecto'],
            $_POST['objetivoProyecto'],
            $_POST['presupuestoProyecto'],
            $modificadoPor,
            $_POST['solicitudProyectoID']
        );
        break;
    case 'agregar_nueva_descripcion_requerimiento_solicitud_proyecto':
        $solicitudesProyectos->agregar_nueva_descripcion_requerimiento_solicitud_proyecto(
            $_POST['agregarSolicitudProyectoID'],
            $_POST['agregarDescripcionRequerimiento'],
            $creadoPor
        );
        break;
    case 'obtener_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID':
        $data = $solicitudesProyectos->obtener_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID(
            $_POST['solicitudProyectoID'],
            $_POST['requerimientoSolicitudProyectoID']
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'solicitudProyectoID' => $item['SOLICITUD_PROYECTO_ID'],
                    'requerimientoSolicitudProyectoID' => $item['REQUERIMIENTO_SOLICITUD_PROYECTO_ID'],
                    'descripcionRequerimiento' => $item['DESCRIPCION_REQUERIMIENTO'],
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
    case 'modificar_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID':
        $solicitudesProyectos->modificar_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID(
            $_POST['modificarDescripcionRequerimiento'],
            $modificadoPor,
            $_POST['modificarSolicitudProyectoID'],
            $_POST['modificarRequerimientoSolicitudProyectoID']
        );
        break;
    case 'modificar_requerimiento_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID':
        $solicitudesProyectos->modificar_requerimiento_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID(
            $modificadoPor,
            $_POST['solicitudProyectoID'],
            $_POST['requerimientoSolicitudProyectoID']
        );
        break;
    case 'modificar_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID':
        $solicitudesProyectos->modificar_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID(
            $modificadoPor,
            $_POST['solicitudProyectoID']
        );
        break;
    case 'ver_listado_solicitudes_proyectos':
        $datos = $solicitudesProyectos->ver_listado_solicitudes_proyectos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['solicitud_proyecto_id'];
            $sub_array[] = $row['descripcion_proyecto'];
            $sub_array[] = $row['objetivo_proyecto'];
            $sub_array[] = $row['solicitado_por'];
            $sub_array[] = $row['fecha_solicitud'];

            if ($row['estado'] === "PENDIENTE") {
                $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            }

            if ($row['estado'] === "RECHAZADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            if ($row['estado'] === "APROBADO") {
                $sub_array[] = '<span class="badge badge-success">APROBADO</span>';
            }

            $sub_array[] = $row['estado'] === 'ACTIVO' ? '<td class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="verDetalleSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                </div>
                                                              </td>'
                :
                '<td class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="verDetalleSolicitudProyecto(' . $row['solicitud_proyecto_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
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
}
