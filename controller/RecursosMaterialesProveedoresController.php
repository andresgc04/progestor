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
}
