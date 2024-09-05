<?php
require_once('../../../public/fpdf/fpdf.php');

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

$pdf->Output('I', 'Cotizacion' . date('Y-m-d'));
