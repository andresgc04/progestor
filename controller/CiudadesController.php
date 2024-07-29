<?php
require_once('../config/connection.php');
require_once('../models/Ciudades.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

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
                                    <button type="button" id="' . $row['CIUDAD_ID'] . '" onclick="verDetalleCiudad(' . $row['PAIS_ID'] . ', ' . $row['PROVINCIA_ID'] . ',' . $row['CIUDAD_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['CIUDAD_ID'] . '" onclick="eliminarCiudad(' . $row['PAIS_ID'] . ', ' . $row['PROVINCIA_ID'] . ',' . $row['CIUDAD_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_ciudades_por_paisID_provinciaID':
        $datos = $ciudades->obtener_listado_opciones_ciudades_por_paisID_provinciaID($_POST['paisID'], $_POST['provinciaID']);

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la ciudad.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['CIUDAD_ID'] . '">' . $row['CIUDAD'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_detalles_ciudades_por_pais_ID_provincia_ID_ciudad_ID':
        $data = $ciudades->obtener_detalles_ciudades_por_pais_ID_provincia_ID_ciudad_ID($_POST['paisID'], $_POST['provinciaID'], $_POST['ciudadID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'paisID' => $item['PAIS_ID'],
                    'provinciaID' => $item['PROVINCIA_ID'],
                    'ciudadID' => $item['CIUDAD_ID'],
                    'ciudad' => $item['CIUDAD']
                ];

                // Agregar el elemento normalizado al array resultante
                $normalizedData = $normalizedItem;
            }

            // Crear un array asociativo con la clave "data"
            $response = array('data' => $normalizedData);

            // Convertir el array de objetos a formato JSON:
            $json = json_encode($response, JSON_UNESCAPED_UNICODE);

            // Configurar la cabecera para indicar que la respuesta es JSON
            header('Content-Type: application/json');

            // Retornar o imprimir el JSON
            echo $json;
        } else {
            echo json_encode(['data' => []]);
        }
        break;
    case "modificar_ciudades_por_pais_ID_provincia_ID_ciudad_ID":
        $ciudades->modificar_ciudades_por_pais_ID_provincia_ID_ciudad_ID(
            $_POST['modificarPaisID'],
            $_POST['modificarProvinciaID'],
            $_POST['modificarNombreCiudad'],
            $modificadoPor,
            $_POST['updatePaisID'],
            $_POST['updateProvinciaID'],
            $_POST['updateCiudadID']
        );
        break;
    case "eliminar_ciudades_por_pais_ID_provincia_ID_ciudad_ID":
        $ciudades->eliminar_ciudades_por_pais_ID_provincia_ID_ciudad_ID(
            $modificadoPor,
            $_POST['paisID'],
            $_POST['provinciaID'],
            $_POST['ciudadID']
        );
        break;
}
