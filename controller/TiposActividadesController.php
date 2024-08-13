<?php
require_once('../config/connection.php');
require_once('../models/TiposActividades.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$tiposActividades = new TiposActividades();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_tipos_actividades':
        $datos = $tiposActividades->obtener_listado_opciones_tipos_actividades();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de actividad.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_ACTIVIDAD_ID'] . '">' . $row['TIPO_ACTIVIDAD'] . '</option>';
            }

            echo $html;
        }
        break;
}