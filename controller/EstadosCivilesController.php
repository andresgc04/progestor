<?php
require_once('../config/connection.php');
require_once('../models/EstadosCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$estadosCiviles = new EstadosCiviles();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_estados_civiles':
        $datos = $estadosCiviles->obtener_listado_opciones_estados_civiles();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el estado civil.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['ESTADO_CIVIL_ID'] . '">"' . $row['ESTADO_CIVIL'] . '"</option>';
            }

            echo $html;
        }
        break;
}
