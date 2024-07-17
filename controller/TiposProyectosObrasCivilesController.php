<?php
require_once('../config/connection.php');
require_once('../models/TiposProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposProyectosObrasCiviles = new TiposProyectosObrasCiviles();

switch ($_GET['op']) {
    case "obtener_listado_opciones_tipos_proyectos_obras_civiles":
        $datos = $tiposProyectosObrasCiviles->obtener_listado_opciones_tipos_proyectos_obras_civiles();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= "<option selected disabled>Por favor seleccione el tipo del proyecto.</option>";

            foreach ($datos as $row) {
                $html .= "<option value='" . $row['TIPO_PROYECTO_OBRA_CIVIL_ID'] . "'>" . $row['TIPO_PROYECTO_OBRA_CIVIL'] . "</option>";
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID':
        $datos = $tiposProyectosObrasCiviles->obtener_listado_opciones_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID($_POST['tipoProyectoObraCivilID']);

        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= '<option selected value="' . $row['TIPO_PROYECTO_OBRA_CIVIL_ID'] . '">' . $row['TIPO_PROYECTO_OBRA_CIVIL'] . '</option>';
            }
        }

        $datos2 = $tiposProyectosObrasCiviles->obtener_listado_opciones_tipos_proyectos_obras_civiles_diferente_tipo_proyecto_obra_civil_ID($_POST['tipoProyectoObraCivilID']);

        if (is_array($datos2) == true and count($datos2) > 0) {
            foreach ($datos2 as $row) {
                $html .= '<option value="' . $row['TIPO_PROYECTO_OBRA_CIVIL_ID'] . '">' . $row['TIPO_PROYECTO_OBRA_CIVIL'] . '</option>';
            }

            echo $html;
        }
        break;
}
