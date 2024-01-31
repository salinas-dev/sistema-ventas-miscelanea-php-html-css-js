<?php
// Archivo: ticket_venta.php

require 'fpdf185/fpdf.php';
include_once "conexion/conexion.php";

$id_venta = $_GET['id'];

class PDF extends FPDF
{
    function Header()
    {
        // Encabezado del ticket
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(190, 10, 'Ticket de Venta', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        // Pie de página del ticket
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 0, 'L');
    }
}

$consulta = $base_de_datos->prepare("
    SELECT
        venta_productos.id_venta,
        venta_productos.total_venta,
        venta_productos.fecha,
        GROUP_CONCAT(
            productos.id_producto,
            '..',
            productos.nombre,
            '..',
            detalle_venta.cantidad,
            '..',
            productos.precio_venta
            SEPARATOR '__'
        ) AS productos
    FROM
        venta_productos
    INNER JOIN
        detalle_venta ON detalle_venta.id_venta = venta_productos.id_venta
    INNER JOIN
        productos ON productos.id_producto = detalle_venta.id_producto
    WHERE
        venta_productos.id_venta = :id_venta
    GROUP BY
        venta_productos.id_venta
");

$consulta->bindParam(':id_venta', $id_venta);
$consulta->execute();

$venta = $consulta->fetch(PDO::FETCH_OBJ);

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'ID Venta:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $venta->id_venta, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Fecha:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $venta->fecha, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Productos:', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Codigo', 1, 0, 'L');
$pdf->Cell(60, 10, 'Descripcion', 1, 0, 'L');
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'L');
$pdf->Cell(30, 10, 'Precio', 1, 1, 'L');

foreach (explode("__", $venta->productos) as $productosConcatenados) {
    $producto = explode("..", $productosConcatenados);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, $producto[0], 1, 0, 'L');
    $pdf->Cell(60, 10, $producto[1], 1, 0, 'L');
    $pdf->Cell(30, 10, $producto[2], 1, 0, 'L');
    $pdf->Cell(30, 10, $producto[3], 1, 1, 'L');
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Total Venta:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $venta->total_venta, 0, 1, 'L');

$pdf->Output();
?>
