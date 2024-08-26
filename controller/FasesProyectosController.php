<?php
require_once('../config/connection.php');
require_once('../models/FasesProyectos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$fasesProyectos = new FasesProyectos();

switch ($_GET['op']) {
    case "registrar_fases_proyectos":
        $fasesProyectos->registrar_fases_proyectos($_POST["faseProyecto"], $creadoPor);
        break;
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
    case 'obtener_listado_opciones_fases_proyectos':
        $datos = $fasesProyectos->obtener_listado_opciones_fases_proyectos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la fase del proyecto.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['FASE_PROYECTO_ID'] . '">' . $row['FASE_PROYECTO'] . '</option>';
            }

            echo $html;
        }
        break;
}
