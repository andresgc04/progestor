<?php
require_once('../config/connection.php');
require_once('../models/Proveedores.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$proveedores = new Proveedores();

switch ($_GET['op']) {
    case "registrar_proveedores":
        $proveedores->registrar_proveedores(
            $_POST['nombreProveedor'],
            $_POST['paisID'],
            $_POST['provinciaID'],
            $_POST['ciudadID'],
            $_POST['direccion'],
            $_POST['telefono'],
            $_POST['correoElectronico'],
            $_POST['condicionPagoID'],
            $_POST['tipoProveedorID'],
            $_POST['nombreRepresentanteVentas'],
            $_POST['contactoRepresentanteVentas'],
            $creadoPor
        );
        break;
    case "listado_proveedores":
        $datos = $proveedores->listado_proveedores();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['proveedor_id'];
            $sub_array[] = $row['proveedor'];
            $sub_array[] = $row['tipo_proveedor'];

            if ($row['estado'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['proveedor_id'] . '" onclick="verDetalleProveedor(' . $row['proveedor_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['proveedor_id'] . '" onclick="eliminarProveedor(' . $row['proveedor_id'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
