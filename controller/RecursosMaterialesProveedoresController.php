<?php
require_once("../config/connection.php");
require_once("../models/RecursosMaterialesProveedores.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosMaterialesProveedores = new RecursosMaterialesProveedores();

switch ($_GET['op']) {
    case 'registrar_recursos_materiales_proveedores':
        $recursosMaterialesProveedores->registrar_recursos_materiales_proveedores($_POST['recursoMaterialID'], $_POST['proveedorID'], $_POST['costoRecursoMaterial'], $creadoPor);
        break;
    case 'listado_recursos_materiales_proveedores':
        $datos = $recursosMaterialesProveedores->listado_recursos_materiales_proveedores();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL'];
            $sub_array[] = $row['RECURSO_MATERIAL'];
            $sub_array[] = $row['NOMBRE_PROVEEDOR'];
            $sub_array[] = $row['COSTO_RECURSO_MATERIAL'];

            if ($row['ESTADOS'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['RECURSO_MATERIAL_ID'] . '" onclick="verDetalleRecursoMaterialProveedor(' . $row['RECURSO_MATERIAL_ID'] . ', ' . $row['PROVEEDOR_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['RECURSO_MATERIAL_ID'] . '" onclick="eliminarRecursoMaterialProveedor(' . $row['RECURSO_MATERIAL_ID'] . ', ' . $row['PROVEEDOR_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_detalles_recursos_materiales_proveedores_por_recurso_material_ID_proveedor_ID':
        $data = $recursosMaterialesProveedores->obtener_detalles_recursos_materiales_proveedores_por_recurso_material_ID_proveedor_ID($_POST['recursoMaterialID'], $_POST['proveedorID']);

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'tipoRecursoMaterialID' => $item['TIPO_RECURSO_MATERIAL_ID'],
                    'recursoMaterialID' => $item['RECURSO_MATERIAL_ID'],
                    'proveedorID' => $item['PROVEEDOR_ID'],
                    'costoRecursoMaterial' => $item['COSTO_RECURSO_MATERIAL'],
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
    case 'modificar_recursos_materiales_proveedores':
        $recursosMaterialesProveedores->modificar_recursos_materiales_proveedores(
            $_POST['modificarRecursoMaterialID'],
            $_POST['modificarProveedorID'],
            $_POST['modificarCostoRecursoMaterial'],
            $modificadoPor,
            $_POST['updateRecursoMaterialID'],
            $_POST['updateProveedorID']
        );
        break;
    case 'eliminar_recursos_materiales_proveedores':
        $recursosMaterialesProveedores->eliminar_recursos_materiales_proveedores(
            $modificadoPor,
            $_POST['recursoMaterialID'],
            $_POST['proveedorID']
        );
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
}
