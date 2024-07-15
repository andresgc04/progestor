<?php
require_once('../config/connection.php');
require_once('../models/TiposRecursosMateriales.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$tiposRecursosMateriales = new TiposRecursosMateriales();

switch ($_GET["op"]) {
    case 'registrar_tipos_recursos_materiales':
        $tiposRecursosMateriales->registrar_tipos_recursos_materiales($_POST['nombreTipoRecursoMaterial'], $creadoPor);
        break;
    case 'listado_tipos_recursos_materiales':
        $datos = $tiposRecursosMateriales->listado_tipos_recursos_materiales();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL_ID'];
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL'];

            if ($row['ESTADOS'] === 'ACTIVO') {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                              <div class="btn-group btn-group-sm">
                                <button type="button" id="' . $row['TIPO_RECURSO_MATERIAL_ID'] . '" onClick="verDetalleTipoRecursoMaterial(' . $row['TIPO_RECURSO_MATERIAL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                <button type="button" id="' . $row['TIPO_RECURSO_MATERIAL_ID'] . '" onClick="eliminarTipoRecursoMaterial(' . $row['TIPO_RECURSO_MATERIAL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    case 'obtener_listado_opciones_tipos_recursos_materiales':
        $datos = $tiposRecursosMateriales->obtener_listado_opciones_tipos_recursos_materiales();

        if (is_array($datos) == true and count($datos) > 0) {
            $html .= '<option selected disabled>Por favor seleccione el tipo de recurso material.</option>';

            foreach ($datos as $row) {
                $html .= '<option value="' . $row['TIPO_RECURSO_MATERIAL_ID'] . '">' . $row['TIPO_RECURSO_MATERIAL'] . '</option>';
            }

            echo $html;
        }
        break;
}
