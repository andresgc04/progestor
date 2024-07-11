<?php
require_once('../config/connection.php');
require_once('../models/ProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$proyectosObrasCiviles = new ProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_proyectos_obras_civiles":
        $proyectosObrasCiviles->registrar_proyectos_obras_civiles(
            $_POST['solicitudProyectoID'],
            $_POST['nombreProyecto'],
            $_POST['descripcionProyecto'],
            $_POST['tipoProyectoObraCivilID'],
            $_POST['categoriaTipoProyectoObraCivilID'],
            $_POST['responsableID'],
            $_POST['fechaInicioProyecto'],
            $_POST['fechaFinalizacionProyecto'],
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

            if ($row['estado'] === "ACTIVO") {
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

            $sub_array[] = $row['estado'] === 'ACTIVO' ? '<td class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="verDetalleProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="eliminarProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                                </div>
                                                              </td>'
                :
                '<td class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="verDetalleProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                                    <button type="button" id="' . $row['solicitud_proyecto_id'] . '" onclick="eliminarProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')"class="btn btn-danger disabled"><i class="fas fa-trash"></i></button>
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
