<?php
require_once("../config/connection.php");
require_once("../models/ModulosSistemas.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$modulosSistemas = new ModulosSistemas();

switch ($_GET['op']) {
    case "registrar_modulos_sistemas":
        $modulosSistemas->registrar_modulos_sistemas($_POST["nombreModuloSistema"], $creadoPor);
        break;
    case "listado_modulos_sistemas":
        $datos = $modulosSistemas->listado_modulos_sistemas();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['MODULO_SISTEMA_ID'];
            $sub_array[] = $row['MODULO'];

            if ($row['ESTADO'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['MODULO_SISTEMA_ID'] . '" onclick="verDetalleModuloSistema(' . $row['MODULO_SISTEMA_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['MODULO_SISTEMA_ID'] . '" onclick="eliminarModuloSistema(' . $row['MODULO_SISTEMA_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                            ';

            $data[] = $sub_array;
        }

        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($resultados);
        break;
}
