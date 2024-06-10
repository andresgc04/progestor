<?php
require_once('../config/connection.php');
require_once('../models/TiposRecursosMateriales.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposRecursosMateriales = new TiposRecursosMateriales();

switch ($_GET['op']) {
    case 'registrar_tipos_recursos_materiales':
        $tiposRecursosMateriales->registrar_tipos_recursos_materiales($_POST['nombreTipoRecursoMaterial'], $creadoPor);
        break;
}
