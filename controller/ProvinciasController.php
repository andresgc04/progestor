<?php
require_once("../config/connection.php");
require_once("../models/Provincias.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$provincias = new Provincias();

switch ($_GET["op"]) {
    case "registrar_provincia":
        $provincias->registrar_provincia($_POST["paisID"], $_POST["nombreProvincia"], $creadoPor);
        break;
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
                                <button type="button" id="' . $row['PROVINCIA_ID'] . '" onclick="verDetalleProvincia(' . $row['PAIS_ID'] . ', ' . $row['PROVINCIA_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
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
    case "obtener_listado_opciones_provincias":
        $datos = $provincias->obtener_listado_opciones_provincias();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la provincia.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['PROVINCIA_ID'] . '">' . $row['PROVINCIA'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_listado_opciones_provincias_por_paisID':
        $datos = $provincias->obtener_listado_opciones_provincias_por_paisID($_POST['paisID']);

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione la provincia.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['PROVINCIA_ID'] . '">' . $row['PROVINCIA'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_detalles_provincias_por_pais_ID_provincia_ID':
        $data = $provincias->obtener_detalles_provincias_por_pais_ID_provincia_ID($_POST['paisID'], $_POST['provinciaID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'paisID' => $item['PAIS_ID'],
                    'provinciaID' => $item['PROVINCIA_ID'],
                    'provincia' => $item['PROVINCIA']
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
    case "modificar_provincias_por_pais_ID_provincia_ID":
        $provincias->modificar_provincias_por_pais_ID_provincia_ID(
            $_POST['modificarPaisID'],
            $_POST['modificarNombreProvincia'],
            $modificadoPor,
            $_POST['updatePaisID'],
            $_POST['updateProvinciaID']
        );
        break;
}
