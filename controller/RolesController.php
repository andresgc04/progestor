<?php
require_once('../config/connection.php');
require_once('../models/Roles.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$roles = new Roles();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_roles':
        $datos = $roles->obtener_listado_opciones_roles();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el rol.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['rol_id'] . '">' . $row['rol'] . '</option>';
            }

            echo $html;
        }
        break;
}
