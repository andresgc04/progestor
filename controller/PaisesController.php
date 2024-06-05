<?php
require_once("../config/connection.php");
require_once("../models/Paises.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$paises = new Paises();

switch ($_GET["op"]) {
    case "registrar_pais":
        $paises->registrar_pais($_POST["nombrePais"], $creadoPor);
        break;
}
