<?php
require_once("../config/connection.php");
require_once("../models/Paises.php");
require_once("../public/php/constants/sessions-constants.php");

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

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
    case 'obtener_detalle_pais_por_paisID':
        $data = $paises->obtener_detalle_pais_por_paisID($_POST['paisID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'paisID' => $item['PAIS_ID'],
                    'pais' => $item['PAIS']
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
    case 'modificar_puestos_por_puestoID':
        $paises->modificar_paises_por_paisID($_POST['modificarNombrePais'], $_POST['paisID'], $modificadoPor);
        break;
    case 'eliminar_paises_por_paisID':
        $paises->eliminar_paises_por_paisID($_POST['paisID'], $modificadoPor);
        break;
}
