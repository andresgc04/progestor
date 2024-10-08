<?php
require_once('../config/connection.php');
require_once('../models/ProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$proyectosObrasCiviles = new ProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_proyectos_obras_civiles":
        $proyectosObrasCiviles->registrar_proyectos_obras_civiles(
            $_POST['solicitudProyectoID'],
            $_POST['tipoProyectoObraCivilID'],
            $_POST['categoriaTipoProyectoObraCivilID'],
            $_POST['responsableID'],
            $_POST['fechaInicioProyecto'],
            $creadoPor
        );
        break;
    case 'listado_proyectos_obras_civiles':
        $datos = $proyectosObrasCiviles->listado_proyectos_obras_civiles();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['PROYECTO_OBRA_CIVIL_ID'];
            $sub_array[] = $row['NOMBRE_PROYECTO'];
            $sub_array[] = $row['TIPO_PROYECTO_OBRA_CIVIL'];

            if ($row['ESTADO'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            // if ($row['estado'] === "PENDIENTE") {
            //     $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            // }

            // if ($row['estado'] === "CANCELADO") {
            //     $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            // }

            // if ($row['estado'] === "RECHAZADO") {
            //     $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            // }

            // if ($row['estado'] === "APROBADO") {
            //     $sub_array[] = '<span class="badge badge-success">APROBADO</span>';
            // }

            $sub_array[] = $row['ESTADO'] === 'ACTIVO' ? '<td class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" id="' . $row['PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                    <button type="button" id="' . $row['PROYECTO_OBRA_CIVIL_ID'] . '" onclick="eliminarProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                                </div>
                                                              </td>'
                :
                '<td class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" id="' . $row['PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                    <button type="button" id="' . $row['PROYECTO_OBRA_CIVIL_ID'] . '" onclick="eliminarProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')"class="btn btn-danger disabled"><i class="fas fa-trash"></i></button>
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
    case 'obtener_datos_proyectos_obras_civiles_por_proyecto_obra_civil_ID_solicitud_proyecto_ID':
        $data = $proyectosObrasCiviles->obtener_datos_proyectos_obras_civiles_por_proyecto_obra_civil_ID_solicitud_proyecto_ID(
            $_POST['proyectoObraCivilID'],
            $_POST['solicitudProyectoID']
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'proyectoObraCivilID' => $item['PROYECTO_OBRA_CIVIL_ID'],
                    'solicitudProyectoID' => $item['SOLICITUD_PROYECTO_ID'],
                    'nombreProyecto' => $item['NOMBRE_PROYECTO'],
                    'objetivoProyecto' => $item['OBJETIVO_PROYECTO'],
                    'descripcionProyecto' => $item['DESCRIPCION_PROYECTO'],
                    'dimensionMetroLargoTerreno' => $item['DIMENSION_METRO_LARGO_TERRENO'],
                    'dimensionMetroAnchoTerreno' => $item['DIMENSION_METRO_ANCHO_TERRENO'],
                    'areaTotalTerreno' => $item['AREA_TOTAL_TERRENO'],
                    'ubicacion' => $item['UBICACION'],
                    'presupuestoEstimadoProyecto' => $item['PRESUPUESTO_ESTIMADO_PROYECTO'],
                    'fechaEstimadaDeseada' => $item['FECHA_ESTIMADA_DESEADA'],
                    'verificacionTituloPropiedad' => $item['VERIFICACION_TITULO_PROPIEDAD'],
                    'nombreCliente' => $item['NOMBRE_CLIENTE'],
                    'tipoProyectoObraCivil' => $item['TIPO_PROYECTO_OBRA_CIVIL'],
                    'categoriaTipoProyectoObraCivil' => $item['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL'],
                    'responsable' => $item['RESPONSABLES'],
                    'fechaInicioProyecto' => $item['FECHA_INICIO_PROYECTO'],
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
    case 'obtener_documentos_proyectos_obras_civiles_por_solicitud_proyecto_ID_proyecto_obra_civil_ID':
        $datos = $proyectosObrasCiviles->obtener_documentos_proyectos_obras_civiles_por_solicitud_proyecto_ID_proyecto_obra_civil_ID($_POST['solicitudProyectoID'], $_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['DOCUMENTO_ID'];
            $sub_array[] = $row['NOMBRE_DOCUMENTO'];
            $sub_array[] = $row['TIPO_DOCUMENTO'];

            if ($row['ESTADOS'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            if ($row['ESTADOS'] === "PENDIENTE") {
                $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            }

            if ($row['ESTADOS'] === "CANCELADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            if ($row['ESTADOS'] === "RECHAZADO") {
                $sub_array[] = '<span class="badge badge-danger">RECHAZADO</span>';
            }

            if ($row['ESTADOS'] === "APROBADO") {
                $sub_array[] = '<span class="badge badge-success">APROBADO</span>';
            }

            $solicitudProyectoID = isset($row['SOLICITUD_PROYECTO_ID']) ? $row['SOLICITUD_PROYECTO_ID'] : 'null';
            $proyectoObraCivilID = isset($row['PROYECTO_OBRA_CIVIL_ID']) ? $row['PROYECTO_OBRA_CIVIL_ID'] : 'null';

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['DOCUMENTO_ID'] . '" onclick="verDetallesDocumentosProyectosObrasCiviles(' . $row['DOCUMENTO_ID'] . ',' . $solicitudProyectoID . ',' . $proyectoObraCivilID . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                        <button type="button" id="' . $row['DOCUMENTO_ID'] . '" onclick="eliminarDocumentosProyectosObrasCiviles(' . $row['DOCUMENTO_ID'] . ',' . $solicitudProyectoID . ',' . $proyectoObraCivilID . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_documentos_proyectos_obras_civiles_clientes_por_solicitud_proyecto_ID_proyecto_obra_civil_ID':
        $datos = $proyectosObrasCiviles->obtener_documentos_proyectos_obras_civiles_por_solicitud_proyecto_ID_proyecto_obra_civil_ID($_POST['solicitudProyectoID'], $_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['DOCUMENTO_ID'];
            $sub_array[] = $row['NOMBRE_DOCUMENTO'];
            $sub_array[] = $row['TIPO_DOCUMENTO'];

            if ($row['ESTADOS'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            if ($row['ESTADOS'] === "PENDIENTE") {
                $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            }

            if ($row['ESTADOS'] === "CANCELADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            if ($row['ESTADOS'] === "RECHAZADO") {
                $sub_array[] = '<span class="badge badge-danger">RECHAZADO</span>';
            }

            if ($row['ESTADOS'] === "APROBADO") {
                $sub_array[] = '<span class="badge badge-success">APROBADO</span>';
            }

            $solicitudProyectoID = isset($row['SOLICITUD_PROYECTO_ID']) ? $row['SOLICITUD_PROYECTO_ID'] : 'null';
            $proyectoObraCivilID = isset($row['PROYECTO_OBRA_CIVIL_ID']) ? $row['PROYECTO_OBRA_CIVIL_ID'] : 'null';

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" id="' . $row['DOCUMENTO_ID'] . '" onclick="verDetallesDocumentosProyectosObrasCiviles(' . $row['DOCUMENTO_ID'] . ',' . $solicitudProyectoID . ',' . $proyectoObraCivilID . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
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
    case 'obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID_proyecto_obra_civil_ID':
        $data = $proyectosObrasCiviles->obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID_proyecto_obra_civil_ID(
            $_POST['documentoID'],
            $_POST['solicitudProyectoID'],
            $_POST['proyectoObraCivilID']
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'nombreDocumento' => $item['NOMBRE_DOCUMENTO'],
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
