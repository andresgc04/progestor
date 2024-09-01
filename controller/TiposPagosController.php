<?php
require_once('../config/connection.php');
require_once('../models/TiposPagos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$tiposPagos = new TiposPagos();

switch ($_GET['op']) {
    case "registrar_tipos_pagos":
        $tiposPagos->registrar_tipos_pagos($_POST['tipoPago'], $creadoPor);
        break;
    case "listado_tipos_pagos":
        $datos = $tiposPagos->listado_tipos_pagos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['TIPO_PAGO_ID'];
            $sub_array[] = $row['TIPO_PAGO'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" id="' . $row['TIPO_PAGO_ID'] . '" onclick="verDetalleTipoPago(' . $row['TIPO_PAGO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                        <button type="button" id="' . $row['TIPO_PAGO_ID'] . '" onclick="eliminarTipoPago(' . $row['TIPO_PAGO_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_tipos_pagos':
        $datos = $tiposPagos->obtener_listado_opciones_tipos_pagos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de pago.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_PAGO_ID'] . '">' . $row['TIPO_PAGO'] . '</option>';
            }

            echo $html;
        }
        break;
}
