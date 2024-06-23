<?php
require_once('../config/connection.php');
require_once('../models/TiposProveedores.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposProveedores = new TiposProveedores();

switch ($_GET['op']) {
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
}
