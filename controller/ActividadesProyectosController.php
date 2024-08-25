<?php
require_once("../config/connection.php");
require_once("../models/ActividadesProyectos.php");
require_once("../public/php/constants/sessions-constants.php");

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$actividadesProyectos = new ActividadesProyectos();

switch ($_GET['op']) {
    case "registrar_actividades_proyectos":
        $actividadesProyectos->registrar_actividades_proyectos(
            $_POST["tipoActividadID"],
            $_POST['actividadProyecto'],
            $_POST['unidadMedidaID'],
            $_POST['costoActividadProyecto'],
            $creadoPor
        );
        break;
    case "listado_actividades_proyectos":
        $datos = $actividadesProyectos->listado_actividades_proyectos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ACTIVIDAD_PROYECTO_ID'];
            $sub_array[] = $row['TIPO_ACTIVIDAD'];
            $sub_array[] = $row['ACTIVIDAD_PROYECTO'];
            $sub_array[] = $row['UNIDAD_MEDIDA'];

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['ACTIVIDAD_PROYECTO_ID'] . '" onclick="verDetalleActividadProyecto(' . $row['ACTIVIDAD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                    <button type="button" id="' . $row['ACTIVIDAD_PROYECTO_ID'] . '" onclick="eliminarActividadProyecto(' . $row['ACTIVIDAD_PROYECTO_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
