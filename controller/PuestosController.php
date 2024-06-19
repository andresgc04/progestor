<?php
require_once('../config/connection.php');
require_once('../models/Puestos.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$puestos = new Puestos();

switch ($_GET['op']) {
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
