<?php
require_once('../config/connection.php');
require_once('../models/RecursosMateriales.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$recursosMateriales = new RecursosMateriales();

switch ($_GET['op']) {
    case 'registrar_recursos_materiales':
        $recursosMateriales->registrar_recursos_materiales($_POST['tipoRecursoMaterialID'], $_POST['nombreRecursoMaterial'], $creadoPor);
        break;
}
