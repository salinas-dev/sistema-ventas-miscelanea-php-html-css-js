<?php
require('./fpdf185/fpdf.php');

// Obtener los parámetros de fecha y ID de venta enviados por AJAX
$fechaInicio = $_GET['fechaInicio'];
$fechaFinal = $_GET['fechaFinal'];

// Crear una nueva instancia de la clase FPDF
$pdf = new FPDF();

// Establecer el título del documento
$pdf->SetTitle('Reporte de Ventas');

// Agregar una página al PDF
$pdf->AddPage();

// Establecer la fuente y el tamaño del texto para el título
$pdf->SetFont('Arial', 'B', 20);

// Agregar el título al PDF
$pdf->Cell(0, 20, 'Reporte de Ventas', 0, 1, 'C');
$pdf->Ln(10);

// Establecer la fuente y el tamaño del texto para los encabezados de columna
$pdf->SetFont('Arial', 'B', 12);

// Establecer el color de fondo para los encabezados de columna
$pdf->SetFillColor(200, 200, 200);

// Agregar los encabezados de columna al PDF
$pdf->Cell(30, 10, 'Fecha', 1, 0, 'C', true); // Nuevo encabezado de columna para la fecha
$pdf->Cell(20, 10, 'No. Venta', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 1, 'C', true);

// Establecer la fuente y el tamaño del texto para los datos de ventas
$pdf->SetFont('Arial', '', 12);

// Conectarse a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_lanueva";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consultar los datos de ventas en el rango de fechas y con el ID de venta especificados
$sql = "SELECT DATE(vp.fecha) AS fecha_venta, vp.id_venta, p.nombre, p.precio_venta, dv.cantidad
        FROM venta_productos vp
        INNER JOIN detalle_venta dv ON vp.id_venta = dv.id_venta
        INNER JOIN productos p ON dv.id_producto = p.id_producto
        WHERE vp.fecha BETWEEN '$fechaInicio' AND '$fechaFinal'
        ORDER BY vp.fecha";

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    $totalVentas = 0;
    $fechaActual = null;

    while ($row = $result->fetch_assoc()) {
        // Verificar si la fecha actual es diferente a la fecha de venta actual
        if ($fechaActual !== $row['fecha_venta']) {
            // Mostrar el total de la fecha anterior
            if ($fechaActual !== null) {
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(150, 10, 'Total:', 1, 0, 'R');
                $pdf->Cell(30, 10, '$' . number_format($totalVentas, 2), 1, 1, 'C');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Ln(10); // Agregar un salto de línea

            }

            $fechaActual = $row['fecha_venta'];
            $totalVentas = 0;
        }

        $pdf->Cell(30, 10, $row['fecha_venta'], 1, 0, 'C');
        $pdf->Cell(20, 10, $row['id_venta'], 1, 0, 'C');
        $pdf->Cell(70, 10, $row['nombre'], 1, 0, 'L');
        $pdf->Cell(30, 10, '$' . $row['precio_venta'], 1, 0, 'R');
        $pdf->Cell(30, 10, $row['cantidad'], 1, 1, 'C');

        // Calcular el total de la venta actual
        $totalVentaActual = $row['precio_venta'] * $row['cantidad'];
        $totalVentas += $totalVentaActual;
    }

    // Mostrar el total de la última fecha
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, 10, 'Total:', 1, 0, 'R');
    $pdf->Cell(30, 10, '$' . number_format($totalVentas, 2), 1, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
} else {
    $pdf->Cell(0, 10, 'No se encontraron ventas en el rango de fechas especificado', 0, 1, 'C');
}

// Cerrar la conexión a la base de datos
$conn->close();

// Obtener la posición actual en la página
$currentY = $pdf->GetY();

// Calcular el espacio restante en la página para centrar el texto
$remainingSpace = ($pdf->GetPageHeight() - $currentY) / 2;

// Mover el puntero hacia abajo para centrar el texto
$pdf->Cell(0, $remainingSpace, '', 0, 1, 'C');

// Establecer la fuente y el tamaño del texto para el pie de página
$pdf->SetFont('Arial', 'I', 10);

// Agregar el número de página al pie de página
$pdf->Cell(0, 10, 'Página ' . $pdf->PageNo(), 0, 0, 'C');

// Generar el archivo PDF
$pdf->Output('D', 'reporte_ventas.pdf');
?>
