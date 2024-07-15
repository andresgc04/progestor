<?php
require_once('../config/connection.php');
require_once('../models/CondicionesPagos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$condicionesPagos = new CondicionesPagos();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_condiciones_pagos':
        $datos = $condicionesPagos->obtener_listado_opciones_condiciones_pagos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la condición de pago.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['CONDICION_PAGO_ID'] . '">' . $row['CONDICION_PAGO'] . '</option>';
            }

            echo $html;
        }
        break;
}
