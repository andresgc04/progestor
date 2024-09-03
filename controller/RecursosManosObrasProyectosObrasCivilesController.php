<?php
require_once('../config/connection.php');
require_once('../models/RecursosManosObrasProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosManosObrasProyectosObrasCiviles = new RecursosManosObrasProyectosObrasCiviles();

switch ($_GET['op']) {
    case "listado_recursos_manos_obras_proyectos_obras_civiles":
        $datos = $recursosManosObrasProyectosObrasCiviles->listado_recursos_manos_obras_proyectos_obras_civiles();
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
}
