<?php
require_once('../config/connection.php');
require_once('../models/SolicitudesProyectos.php');
require_once('../public/php/constants/sessions-constants.php');

$usuarioID = $_SESSION[$USUARIO_ID];
$creadoPor = $usuarioID;

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
}
