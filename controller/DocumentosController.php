<?php
require_once('../config/connection.php');
require_once('../models/Documentos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$documentos = new Documentos();

switch ($_GET['op']) {
    case 'registrar_documentos':
        $documentos->registrar_documentos(
            $_POST['addProjectDocumentsProyectoObraCivilID'],
            $_FILES['documento'],
            $creadoPor
        );
        break;
}
