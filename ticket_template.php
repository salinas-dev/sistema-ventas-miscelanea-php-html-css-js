<?php
require('fpdf185/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Cabecera del PDF
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Ticket de Venta', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        // Pie de página del PDF
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Establecer el número total de páginas

$pdf->AddPage();

// Contenido del PDF
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 10, 'Fecha: ' . date("Y-m-d"), 0, 1);
$pdf->Cell(0, 10, 'Hora: ' . date("H:i:s"), 0, 1);
$pdf->Cell(0, 10, 'Total: $' . $total, 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Codigo', 1, 0, 'C');
$pdf->Cell(80, 10, 'Descripcion', 1, 0, 'C');
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(40, 10, 'Precio', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
foreach ($productosVendidos as $producto) {
    $pdf->Cell(40, 10, $producto["id_producto"], 1, 0, 'C');
    $pdf->Cell(80, 10, $producto["nombre"], 1, 0, 'C');
    $pdf->Cell(30, 10, $producto["cantidad"], 1, 0, 'C');
    $pdf->Cell(40, 10, '$' . $producto["precio_venta"], 1, 1, 'C');
}

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total: $' . $total, 0, 1, 'R');

$pdf->Ln(20);

// Establecer el formato del ticket
$pdf->SetLineWidth(0.4);
$pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY());

// Generar salida del PDF
$pdf->Output('ticket.pdf', 'D');
?>
