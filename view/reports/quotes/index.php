<?php
require_once('../../../public/fpdf/fpdf.php');
require_once('../../../config/connection.php');

require_once('../../../models/ProyectosObrasCiviles.php');
require_once('../../../models/ActividadesProyectosObrasCiviles.php');
require_once('../../../models/RecursosMaterialesProyectosObrasCiviles.php');
require_once('../../../models/RecursosManosObrasProyectosObrasCiviles.php');

$proyectoObraCivilID = $_GET['proyectoObraCivilID'];
$solicitudProyectoID = $_GET['solicitudProyectoObraCivilID'];

$proyectosObrasCiviles = new ProyectosObrasCiviles();
$actividadesProyectosObrasCiviles = new ActividadesProyectosObrasCiviles();
$recursosMaterialesProyectosObrasCiviles = new RecursosMaterialesProyectosObrasCiviles();
$recursosManosObrasProyectosObrasCiviles = new RecursosManosObrasProyectosObrasCiviles();

$data = $proyectosObrasCiviles->obtener_datos_proyectos_obras_civiles_por_proyecto_obra_civil_ID_solicitud_proyecto_ID(
    $proyectoObraCivilID,
    $solicitudProyectoID
);

if (is_array($data) == true and count($data) > 0) {
    foreach ($data as $item) {
        $cliente = $item['NOMBRE_CLIENTE'];
        $descripcionProyectoObraCivil = $item['DESCRIPCION_PROYECTO'];
    }
}

class PDF extends FPDF
{
    //Page header:
    function Header()
    {
        $this->AddLink();
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(150);
        $this->Cell(132, 10, 'Progestor', 0, 0, 'C');
        $this->Ln(20);
        $this->Ln(10);
    }

    //Page footer:
    function Footer()
    {
        //Position at 1.5 cm from bottom:
        $this->SetY(-18);

        //Arial italic 8:
        $this->SetFont('Arial', 'I', 10);

        //Page number:
        $this->Cell(0, 10, 'Pagina' . $this->PageNo() . 'de {nb}', 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A3');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0, 'Multidom S.R.L', 0, 0, 'L');
$pdf->Ln(10);
$pdf->Cell(0, 0, 'Direccion: C/2da.San Pedro de Macoris, Rep.Dominicana', 0, 0, 'L');
$pdf->Ln(10);
$pdf->Cell(0, 0, 'Telefono: +1 (809) 392-9967');
$pdf->Ln(10);
$pdf->Cell(0, 0, 'Correo Electronico: multidomsrl@gmail.com');
$pdf->Ln(20);
$pdf->Cell(0, 0, 'Cotizacion No.: ' . mt_rand(0, 1000000));
$pdf->Ln(10);
$pdf->Cell(0, 0, 'Fecha: ' . date('d-m-Y'));
$pdf->Ln(20);
$pdf->Cell(0, 0, 'Cliente: ' . $cliente);
$pdf->Ln(10);
$pdf->Cell(0, 0, 'Descripcion Del Proyecto:');
$pdf->Ln(7);
$pdf->Cell(0, 0, $descripcionProyectoObraCivil);
$pdf->Ln(20);
$pdf->Cell(0, 0, 'Detalle De La Cotizacion', 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 0, 'Reglon De Actividades:');
$pdf->Ln(10);

//Encabezado de la tabla de actividades:
$pdf->SetFillColor(232, 232, 230);
$pdf->Cell(100, 10, 'Fase Del Proyecto', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Tipo De Actividad', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Actividad', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Costo De La Actividad', 1, 1, 'C', 1);

//Cuerpo de la tabla de actividades:
$datos = $actividadesProyectosObrasCiviles->listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID($proyectoObraCivilID);

foreach ($datos as $row) {
    $pdf->Cell(100, 10, $row['FASE_PROYECTO'], 1, 0, 'L');
    $pdf->Cell(100, 10, $row['TIPO_ACTIVIDAD'], 1, 0, 'L');
    $pdf->Cell(100, 10, $row['ACTIVIDAD_PROYECTO'], 1, 0, 'L');
    $pdf->Cell(100, 10, "RD$ " . number_format($row['COSTO_TOTAL'], 2, '.', ','), 1, 1, 'L');
}

$pdf->Ln(20);
$pdf->Cell(0, 0, 'Reglon De Recursos Materiales:');
$pdf->Ln(10);

//Encabezado de la tabla de recursos materiales:
$pdf->SetFillColor(232, 232, 230);
$pdf->Cell(100, 10, 'Fase Del Proyecto', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Tipo De Recurso Material', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Recurso Material', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Costo Del Recurso Matrerial', 1, 1, 'C', 1);

//Cuerpo de la tabla de recursos materiales:
$datos = $recursosMaterialesProyectosObrasCiviles->listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID($proyectoObraCivilID);

foreach ($datos as $row) {
    $pdf->Cell(100, 10, $row['FASE_PROYECTO'], 1, 0, 'L');
    $pdf->Cell(100, 10, $row['TIPO_RECURSO_MATERIAL'], 1, 0, 'L');
    $pdf->Cell(100, 10, $row['RECURSO_MATERIAL'], 1, 0, 'L');
    $pdf->Cell(100, 10, "RD$ " . number_format($row['COSTO_TOTAL'], 2, '.', ','), 1, 1, 'L');
}

$pdf->Ln(20);
$pdf->Cell(0, 0, 'Reglon De Recursos De Manos De Obras:');
$pdf->Ln(10);

//Encabezado de la tabla de recursos de manos de obras:
$pdf->SetFillColor(232, 232, 230);
$pdf->Cell(100, 10, 'Fase Del Proyecto', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Recurso De Mano De Obra', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Tipo De Pago', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Costo Del Recurso De Mano De Obra', 1, 1, 'C', 1);

//Cuerpo de la tabla de recursos de manos de obras:
$datos = $recursosManosObrasProyectosObrasCiviles->listado_recursos_manos_obras_proyectos_obras_civiles($proyectoObraCivilID);

foreach ($datos as $row) {
    $pdf->Cell(100, 10, $row['FASE_PROYECTO'], 1, 0, 'L');
    $pdf->Cell(100, 10, $row['RECURSO_MANO_OBRA'], 1, 0, 'L');
    $pdf->Cell(100, 10, $row['TIPO_PAGO'], 1, 0, 'L');
    $pdf->Cell(100, 10, "RD$ " . number_format($row['COSTO_TOTAL'], 2, '.', ','), 1, 1, 'L');
}

$pdf->Output('I', 'Cotizacion' . date('Y-m-d'));
