<?php
require_once("../config/connection.php");
require_once("../models/CategoriasTiposProyectosObrasCiviles.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$categoriasTiposProyectosObrasCiviles = new CategoriasTiposProyectosObrasCiviles();

switch ($_GET['op']) {
    case 'obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID':
        $datos = $categoriasTiposProyectosObrasCiviles->obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID($_POST['tipoProyectoObraCivilID']);

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la categoría del proyecto.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID'] . '">' . $row['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_categoria_tipo_proyecto_obra_civil_ID_tipo_proyecto_obra_civil_ID':
        $datos = $categoriasTiposProyectosObrasCiviles->obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_categoria_tipo_proyecto_obra_civil_ID_tipo_proyecto_obra_civil_ID(
            $_POST['categoriaTipoProyectoObraCivilID'],
            $_POST['tipoProyectoObraCivilID']
        );

        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= '<option selected value="' . $row['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID'] . '">' . $row['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL'] . '</option>';
            }
        }

        $datos2 = $categoriasTiposProyectosObrasCiviles->obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_diferente_categoria_tipo_proyecto_obra_civil_ID_tipo_proyecto_obra_civil_ID(
            $_POST['categoriaTipoProyectoObraCivilID'],
            $_POST['tipoProyectoObraCivilID']
        );

        if (is_array($datos2) == true and count($datos2) > 0) {
            foreach ($datos2 as $row) {
                $html .= '<option value="' . $row['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID'] . '">' . $row['CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL'] . '</option>';
            }

            echo $html;
        }
        break;
}
