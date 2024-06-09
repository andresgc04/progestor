<?php
require_once('../config/connection.php');
require_once('../models/Ciudades.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$ciudades = new Ciudades();

switch ($_GET["op"]) {
    case "registrar_ciudad":
        $ciudades->registrar_ciudad($_POST['paisID'], $_POST['provinciaID'], $_POST['nombreCiudad'], $creadoPor);
        break;
    case "listado_ciudades":
        $datos = $ciudades->listado_ciudades();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['CIUDAD_ID'];
            $sub_array[] = $row['PAIS'];
            $sub_array[] = $row['PROVINCIA'];
            $sub_array[] = $row['CIUDAD'];

            if ($row['ESTADO'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['CIUDAD_ID'] . '" onClick="verDetalleCiudad(' . $row['PAIS_ID'] . ', ' . $row['PROVINCIA_ID'] . ',' . $row['CIUDAD_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['CIUDAD_ID'] . '" onClick="eliminarCiudad(' . $row['PAIS_ID'] . ', ' . $row['PROVINCIA_ID'] . ',' . $row['CIUDAD_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_ciudades':
        $datos = $ciudades->obtener_listado_opciones_ciudades();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la ciudad.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['CIUDAD_ID'] . '">"' . $row['CIUDAD'] . '"</option>';
            }

            echo $html;
        }
        break;
}
