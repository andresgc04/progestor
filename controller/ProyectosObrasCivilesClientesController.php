<?php
require_once('../config/connection.php');
require_once('../models/ProyectosObrasCivilesClientes.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];

$proyectosObrasCivilesClientes = new ProyectosObrasCivilesClientes();

switch ($_GET['op']) {
    case 'listado_proyectos_obras_civiles_clientes':
        $datos = $proyectosObrasCivilesClientes->listado_proyectos_obras_civiles_clientes($creadoPor);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['PROYECTO_OBRA_CIVIL_ID'];
            $sub_array[] = $row['NOMBRE_PROYECTO'];
            $sub_array[] = $row['TIPO_PROYECTO_OBRA_CIVIL'];

            if ($row['ESTADO'] === "ACTIVO") {
                $sub_array[] = '<span class="badge badge-primary">ACTIVO</span>';
            }

            if ($row['ESTADO'] === "PENDIENTE") {
                $sub_array[] = '<span class="badge badge-warning">PENDIENTE</span>';
            }

            if ($row['ESTADO'] === "CANCELADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            if ($row['ESTADO'] === "RECHAZADO") {
                $sub_array[] = '<span class="badge badge-danger">CANCELADO</span>';
            }

            if ($row['ESTADO'] === "APROBADO") {
                $sub_array[] = '<span class="badge badge-success">APROBADO</span>';
            }

            $sub_array[] = '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" id="' . $row['PROYECTO_OBRA_CIVIL_ID'] . '" onclick="verDetalleProyecto(' . $row['PROYECTO_OBRA_CIVIL_ID'] . ', ' . $row['SOLICITUD_PROYECTO_ID'] . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
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
