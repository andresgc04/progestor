<?php
require_once('../config/connection.php');
require_once('../models/TiposProveedores.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposProveedores = new TiposProveedores();

switch ($_GET['op']) {
    case "registrar_tipos_proveedores":
        $tiposProveedores->registrar_tipos_proveedores($_POST['tipoProveedor'], $creadoPor);
        break;
    case "listado_tipos_proveedores":
        $datos = $tiposProveedores->listado_tipos_proveedores();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['TIPO_PROVEEDOR_ID'];
            $sub_array[] = $row['TIPO_PROVEEDOR'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['TIPO_PROVEEDOR_ID'] . '" onclick="verDetalleTipoProveedor(' . $row['TIPO_PROVEEDOR_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['TIPO_PROVEEDOR_ID'] . '" onclick="eliminarTipoProveedor(' . $row['TIPO_PROVEEDOR_ID'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_tipos_proveedores':
        $datos = $tiposProveedores->obtener_listado_opciones_tipos_proveedores();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de proveedor.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_PROVEEDOR_ID'] . '">' . $row['TIPO_PROVEEDOR'] . '</option>';
            }

            echo $html;
        }
        break;
    case 'obtener_detalles_tipos_proveedores_por_tipo_proveedor_ID':
        $data = $tiposProveedores->obtener_detalles_tipos_proveedores_por_tipo_proveedor_ID($_POST['tipoProveedorID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'tipoProveedorID' => $item['TIPO_PROVEEDOR_ID'],
                    'tipoProveedor' => $item['TIPO_PROVEEDOR']
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
