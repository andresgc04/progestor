<?php
require_once('../config/connection.php');
require_once('../models/RecursosMaterialesProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosMaterialesProyectosObrasCiviles = new RecursosMaterialesProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_recursos_materiales_proyectos_obras_civiles":
        $recursosMaterialesProyectosObrasCiviles->registrar_recursos_materiales_proyectos_obras_civiles(
            $_POST["addResourceMaterialProyectoObraCivilID"],
            $_POST['faseProyectoIDRecursoMaterial'],
            $_POST['proveedorID'],
            $_POST['tipoRecursoMaterialID'],
            $_POST['recursoMaterialID'],
            $_POST['unidadMedidaRecursoMaterial'],
            $_POST['cantidadRecursosMateriales'],
            $_POST['costoRecursoMaterial'],
            $_POST['subTotalRecursoMaterial'],
            $_POST['itbisRecursoMaterial'],
            $_POST['costoTotalRecursoMaterial'],
            $creadoPor
        );
        break;
}
