<?php
require_once('../config/connection.php');
require_once('../models/RecursosMaterialesProyectosObrasCiviles.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$recursosMaterialesProyectosObrasCiviles = new RecursosMaterialesProyectosObrasCiviles();

switch ($_GET['op']) {
    case "registrar_recursos_materiales_proyectos_obras_civiles":
        $recursosMaterialesProyectosObrasCiviles->registrar_recursos_materiales_proyectos_obras_civiles(
            $_POST["addResourceMaterialProyectoObraCivilID"],
            $_POST['faseProyectoIDRecursoMaterial'],
            $_POST['proveedorID'],
            $_POST['tipoRecursoMaterialID'],
            $_POST['recursoMaterialID'],
            $_POST['unidadMedidaRecursoMaterial'],
            $_POST['cantidadRecursosMateriales'],
            $_POST['costoRecursoMaterial'],
            $_POST['subTotalRecursoMaterial'],
            $_POST['itbisRecursoMaterial'],
            $_POST['costoTotalRecursoMaterial'],
            $creadoPor
        );
        break;
    case "listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID":
        $datos = $recursosMaterialesProyectosObrasCiviles->listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID($_POST['proyectoObraCivilID']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'];
            $sub_array[] = $row['FASE_PROYECTO'];
            $sub_array[] = $row['TIPO_RECURSO_MATERIAL'];
            $sub_array[] = $row['RECURSO_MATERIAL'];
            $sub_array[] = $row['COSTO_TOTAL'];

            if ($row["ESTADOS"] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" id="' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleRecursoMaterialProyectoObraCivil(' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                            <button type="button" id="' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . '" onclick="eliminarRecursoMaterialProyectoObraCivil(' . $row['RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['PROYECTO_OBRA_CIVIL_ID'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
