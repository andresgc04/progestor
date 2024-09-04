<?php
require_once('../config/connection.php');
require_once('../models/RecursosManosObras.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosManosObras = new RecursosManosObras();

switch ($_GET['op']) {
    case "registrar_recursos_manos_obras":
        $recursosManosObras->registrar_recursos_manos_obras(
            $_POST['recursoManoObra'],
            $_POST['tipoPagoID'],
            $_POST['costoPagoRecursoManoObra'],
            $creadoPor
        );
        break;
    case "listado_recursos_manos_obras":
        $datos = $recursosManosObras->listado_recursos_manos_obras();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['RECURSO_MANO_OBRA_ID'];
            $sub_array[] = $row['RECURSO_MANO_OBRA'];
            $sub_array[] = $row['TIPO_PAGO'];
            $sub_array[] = $row['COSTO_PAGO_RECURSO_MANO_OBRA'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" id="' . $row['RECURSO_MANO_OBRA_ID'] . '" onclick="verDetalleRecursoManoObra(' . $row['RECURSO_MANO_OBRA_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                            <button type="button" id="' . $row['RECURSO_MANO_OBRA_ID'] . '" onclick="eliminarRecursoManoObra(' . $row['RECURSO_MANO_OBRA_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_recursos_manos_obras':
        $datos = $recursosManosObras->obtener_listado_opciones_recursos_manos_obras();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el recurso de mano de obra.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['RECURSO_MANO_OBRA_ID'] . '">' . $row['RECURSO_MANO_OBRA'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_tipos_pagos_costos_pagos_recursos_manos_obras_por_recurso_mano_obra_ID':
        $data = $recursosManosObras->obtener_tipos_pagos_costos_pagos_recursos_manos_obras_por_recurso_mano_obra_ID($_POST['recursoManoObraID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'tipoPago' => $item['TIPO_PAGO'],
                    'costoPagoRecursoManoObra' => $item['COSTO_PAGO_RECURSO_MANO_OBRA'],
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
}
