<?php
require_once('../config/connection.php');
require_once('../models/TiposClientes.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposClientes = new TiposClientes();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_tipos_clientes':
        $datos = $tiposClientes->obtener_listado_opciones_tipos_clientes();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de cliente.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_CLIENTE_ID'] . '">' . $row['TIPO_CLIENTE'] . '</option>';
            }

            echo $html;
        }
        break;
}
