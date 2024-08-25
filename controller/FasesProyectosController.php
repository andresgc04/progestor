<?php
require_once('../config/connection.php');
require_once('../models/FasesProyectos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$fasesProyectos = new FasesProyectos();

switch ($_GET['op']) {
    case "listado_fases_proyectos":
        $datos = $fasesProyectos->listado_fases_proyectos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['FASE_PROYECTO_ID'];
            $sub_array[] = $row['FASE_PROYECTO'];

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['FASE_PROYECTO_ID'] . '" onclick="verDetalleFaseProyecto(' . $row['FASE_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['FASE_PROYECTO_ID'] . '" onclick="eliminarFaseProyecto(' . $row['FASE_PROYECTO_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
