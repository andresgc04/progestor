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
        $this->Cell(105);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(225, 10, 'Cotizaciones', 0, 0, 'C');
        $this->Ln(20);
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

$pdf->Output('I', 'Cotizacion' . getdate());
