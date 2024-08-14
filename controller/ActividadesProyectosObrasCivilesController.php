<?php
require_once('../config/connection.php');
require_once('../models/ActividadesProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$actividadesProyectosObrasCiviles = new ActividadesProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_actividades_proyectos_obras_civiles":
        $actividadesProyectosObrasCiviles->registrar_actividades_proyectos_obras_civiles(
            $_POST["addActivityProyectoObraCivilID"],
            $_POST['tipoActividadID'],
            $_POST['nombreActividad'],
            $_POST['descripcionActividad'],
            $_POST['costoActividad'],
            $creadoPor
        );
        break;
    case "listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID":
        $datos = $actividadesProyectosObrasCiviles->listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID($_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ACTIVIDAD_ID'];
            $sub_array[] = $row['TIPO_ACTIVIDAD'];
            $sub_array[] = $row['NOMBRE_ACTIVIDAD'];
            $sub_array[] = $row['COSTO_ACTIVIDAD'];

            if ($row["ESTADO"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" id="' . $row['ACTIVIDAD_ID'] . '" onclick="verDetalleActividadProyectoObraCivil(' . $row['ACTIVIDAD_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                        <button type="button" id="' . $row['ACTIVIDAD_ID'] . '" onclick="eliminarActividadProyectoObraCivil(' . $row['ACTIVIDAD_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
