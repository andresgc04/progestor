<?php
require_once('../config/connection.php');
require_once('../models/RecursosManosObras.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosManosObras = new RecursosManosObras();

switch ($_GET['op']) {
    case "registrar_recursos_manos_obras":
        $recursosManosObras->registrar_recursos_manos_obras(
            $_POST['recursoManoObra'],
            $_POST['tipoPagoID'],
            $_POST['costoPagoRecursoManoObra'],
            $creadoPor
        );
        break;
    case "listado_recursos_manos_obras":
        $datos = $recursosManosObras->listado_recursos_manos_obras();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['RECURSO_MANO_OBRA_ID'];
            $sub_array[] = $row['RECURSO_MANO_OBRA'];
            $sub_array[] = $row['TIPO_PAGO'];
            $sub_array[] = $row['COSTO_PAGO_RECURSO_MANO_OBRA'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" id="' . $row['RECURSO_MANO_OBRA_ID'] . '" onclick="verDetalleRecursoManoObra(' . $row['RECURSO_MANO_OBRA_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                            <button type="button" id="' . $row['RECURSO_MANO_OBRA_ID'] . '" onclick="eliminarRecursoManoObra(' . $row['RECURSO_MANO_OBRA_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_recursos_manos_obras':
        $datos = $recursosManosObras->obtener_listado_opciones_recursos_manos_obras();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el recurso de mano de obra.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['RECURSO_MANO_OBRA_ID'] . '">' . $row['RECURSO_MANO_OBRA'] . '</option>';
            }

            echo $html;
        }
        break;
}
