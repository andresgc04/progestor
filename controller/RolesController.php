<?php
require_once('../config/connection.php');
require_once('../models/Roles.php');
require_once('../public/php/constants/sessions-constants.php');

$creadoPor = $_SESSION[$USUARIO_ID];

$roles = new Roles();

switch ($_GET['op']) {
    case "registrar_roles":
        $roles->registrar_roles($_POST["rol"], $creadoPor);
        break;
    case "listado_roles":
        $datos = $roles->listado_roles();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ROL_ID'];
            $sub_array[] = $row['ROL'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['ROL_ID'] . '" onclick="verDetalleRol(' . $row['ROL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['ROL_ID'] . '" onclick="eliminarRol(' . $row['ROL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_roles':
        $datos = $roles->obtener_listado_opciones_roles();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el rol.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['rol_id'] . '">' . $row['rol'] . '</option>';
            }

            echo $html;
        }
        break;
}
