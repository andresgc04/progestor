<?php
require_once("../config/connection.php");
require_once("../models/Provincias.php");
require_once("../public/php/constants/sessions-constants.php");

$creadoPor = $_SESSION[$USUARIO_ID];

$provincias = new Provincias();

switch ($_GET["op"]) {
    case "listado_provincias":
        $datos = $provincias->listado_provincias();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['PROVINCIA_ID'];
            $sub_array[] = $row['PAIS'];
            $sub_array[] = $row['PROVINCIA'];

            if ($row['ESTADO'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                              <div class="btn-group btn-group-sm">
                                <button type="button" id="' . $row['PROVINCIA_ID'] . '" onClick="verDetalleProvincia(' . $row['PAIS_ID'] . ', ' . $row['PROVINCIA_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                <button type="button" id="' . $row['PROVINCIA_ID'] . '" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
