<?php
require_once('../config/connection.php');
require_once('../models/Empleados.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$empleados = new Empleados();

switch ($_GET['op']) {
    case 'listado_empleados':
        $datos = $empleados->listado_empleados();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['empleado_id'];
            $sub_array[] = $row['empleados'];
            $sub_array[] = $row['puestos'];
            $sub_array[] = $row['departamentos'];
            $sub_array[] = $row['supervisores'];
            $sub_array[] = $row['fechas_contrataciones'];

            if ($row['estados'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['empleado_id'] . '" onClick="verDetalleEmpleados(' . $row['empleado_id'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['empleado_id'] . '" onClick="eliminarEmpleados(' . $row['empleado_id'] . ')"class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_supervisores_por_departamentoID':
        $datos = $empleados->obtener_listado_opciones_supervisores_por_departamentoID($_POST['departamentoID']);

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el supervisor.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['EMPLEADO_ID'] . '">' . $row['SUPERVISORES'] . '</option>';
            }

            echo $html;
        }
        break;
}
