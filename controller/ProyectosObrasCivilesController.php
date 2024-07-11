<?php
require_once('../config/connection.php');
require_once('../models/ProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$proyectosObrasCiviles = new ProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_proyectos_obras_civiles":
        $proyectosObrasCiviles->registrar_proyectos_obras_civiles(
            $_POST['solicitudProyectoID'],
            $_POST['nombreProyecto'],
            $_POST['descripcionProyecto'],
            $_POST['tipoProyectoObraCivilID'],
            $_POST['categoriaTipoProyectoObraCivilID'],
            $_POST['responsableID'],
            $_POST['fechaInicioProyecto'],
            $_POST['fechaFinalizacionProyecto'],
            $creadoPor
        );
        break;
}
