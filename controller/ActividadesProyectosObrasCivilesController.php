<?php
require_once('../config/connection.php');
require_once('../models/ActividadesProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$actividadesProyectosObrasCiviles = new ActividadesProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_actividades_proyectos_obras_civiles":
        $actividadesProyectosObrasCiviles->registrar_actividades_proyectos_obras_civiles(
            $_POST["addActivityProyectoObraCivilID"],
            $_POST['tipoActividadID'],
            $_POST['nombreActividad'],
            $_POST['descripcionActividad'],
            $_POST['costoActividad'],
            $creadoPor
        );
        break;
}
