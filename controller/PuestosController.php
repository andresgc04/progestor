<?php
require_once('../config/connection.php');
require_once('../models/Puestos.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$puestos = new Puestos();

switch ($_GET['op']) {
    case "listado_puestos":
        $datos = $puestos->listado_puestos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['PUESTO_ID'];
            $sub_array[] = $row['PUESTO'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['PUESTO_ID'] . '" onclick="verDetallePuesto(' . $row['PUESTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['PUESTO_ID'] . '" onclick="eliminarPuesto(' . $row['PUESTO_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_puestos':
        $datos = $puestos->obtener_listado_opciones_puestos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el puesto.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['PUESTO_ID'] . '">"' . $row['PUESTO'] . '"</option>';
            }

            echo $html;
        }
        break;
}
