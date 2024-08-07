<?php
require_once('../config/connection.php');
require_once('../models/TiposDocumentos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposDocumentos = new TiposDocumentos();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_tipos_documentos':
        $datos = $tiposDocumentos->obtener_listado_opciones_tipos_documentos();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de documento.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_DOCUMENTO_ID'] . '">' . $row['TIPO_DOCUMENTO'] . '</option>';
            }

            echo $html;
        }
        break;
}
