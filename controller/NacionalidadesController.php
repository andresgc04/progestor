<?php
require_once('../config/connection.php');
require_once('../models/Nacionalidades.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$nacionalidades = new Nacionalidades();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_nacionalidades':
        $datos = $nacionalidades->obtener_listado_opciones_nacionalidades();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la nacionalidad.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['NACIONALIDAD_ID'] . '">' . $row['NACIONALIDAD'] . '</option>';
            }

            echo $html;
        }
        break;
}
