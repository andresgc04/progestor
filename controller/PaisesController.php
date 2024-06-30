<?php
require_once("../config/connection.php");
require_once("../models/Paises.php");
require_once("../public/php/constants/sessions-constants.php");

$creadoPor = $_SESSION[$USUARIO_ID];

$paises = new Paises();

switch ($_GET["op"]) {
    case "registrar_pais":
        $paises->registrar_pais($_POST["nombrePais"], $creadoPor);
        break;
    case "listado_paises":
        $datos = $paises->listado_paises();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['PAIS_ID'];
            $sub_array[] = $row['PAISES'];

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['PAIS_ID'] . '" onclick="verDetallePais(' . $row['PAIS_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['PAIS_ID'] . '" onclick="eliminarPais(' . $row['PAIS_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>';

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
    case "obtener_listado_opciones_paises":
        $datos = $paises->obtener_listado_opciones_paises();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= "<option selected disabled>Por favor seleccione el país.</option>";

            foreach ($datos as $row) {
                $html .= "<option value='" . $row['PAIS_ID'] . "'>" . $row['PAIS'] . "</option>";
            }

            echo $html;
        }
        break;
}
