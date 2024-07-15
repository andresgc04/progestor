<?php
require_once('../config/connection.php');
require_once('../models/Sexos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$sexos = new Sexos();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_sexos':
        $datos = $sexos->obtener_listado_opciones_sexos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el sexo.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['SEXO_ID'] . '">' . $row['SEXO'] . '</option>';
            }

            echo $html;
        }
        break;
}
