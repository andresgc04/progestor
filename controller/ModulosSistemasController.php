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
    case 'obtener_detalle_modulo_sistema_por_modulo_sistema_ID':
        $data = $modulosSistemas->obtener_detalle_modulo_sistema_por_modulo_sistema_ID($_POST['moduloSistemaID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'moduloSistemaID' => $item['MODULO_SISTEMA_ID'],
                    'modulo' => $item['MODULO']
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
    case 'modificar_modulos_sistemas_por_modulo_sistema_ID':
        $modulosSistemas->modificar_modulos_sistemas_por_modulo_sistema_ID($_POST['modificarNombreModuloSistema'], $modificadoPor, $_POST['moduloSistemaID']);
        break;
}
