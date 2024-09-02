<?php
require_once('../config/connection.php');
require_once('../models/RecursosManosObras.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosManosObras = new RecursosManosObras();

switch ($_GET['op']) {
    case "registrar_tipos_pagos":
        $recursosManosObras->registrar_recursos_manos_obras(
            $_POST['recursoManoObra'],
            $_POST['tipoPagoID'],
            $_POST['costoPagoRecursoManoObra'],
            $creadoPor
        );
        break;
}
