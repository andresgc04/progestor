<?php
require_once('../config/connection.php');
require_once('../models/Departamentos.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$departamentos = new Departamentos();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_departamentos':
        $datos = $departamentos->obtener_listado_opciones_departamentos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el departamento.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['DEPARTAMENTO_ID'] . '">' . $row['DEPARTAMENTO'] . '</option>';
            }

            echo $html;
        }
        break;
}
