<?php
require '../fpdf/fpdf.php';
require '../config/database.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['juegos']) ? $_SESSION['carrito']['juegos'] : null;

$lista_carrito = array();

/*Carrito*/
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {

        //Pasteles
        $sql = $con->prepare("SELECT id_juego, nombre, costo, descuento, $cantidad AS cantidad FROM juegos WHERE id_juego=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

$pdf = new FPDF($orientation = 'P', $unit = 'mm');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);
// Agregamos los datos de la empresa
$pdf->Cell(5, $textypos, "Factura de compra Board Games Store");
$pdf->SetFont('Arial', 'B', 10);
$pdf->setY(30);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "DE:");
$pdf->SetFont('Arial', '', 10);
$pdf->setY(35);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "Board Games Store S.A. de C.V.");
$pdf->setY(40);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "Avenida San Claudio #234 Puebla,Pue.");
$pdf->setY(45);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "Tel: +52 234 126 98 73");
$pdf->setY(50);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "Correo: boardgamesstore@gmail.com");

// Agregamos los datos del cliente
$pdf->SetFont('Arial', 'B', 10);
$pdf->setY(30);
$pdf->setX(75);
$pdf->Cell(5, $textypos, "PARA:");
$pdf->SetFont('Arial', '', 10);
$pdf->setY(35);
$pdf->setX(75);
$pdf->Cell(5, $textypos, "John Doe");
$pdf->setY(40);
$pdf->setX(75);
$pdf->Cell(5, $textypos, "Calle Juarez 1, Col. Cuauhtemoc, CDMX");
$pdf->setY(45);
$pdf->setX(75);
$pdf->Cell(5, $textypos, "Tel: +52 55 23 456 122");
$pdf->setY(50);
$pdf->setX(75);
$pdf->Cell(5, $textypos, "Correo: sb-tij47915691154@personal.example.com");

// Agregamos los datos del cliente
$pdf->SetFont('Arial', 'B', 10);
$pdf->setY(30);
$pdf->setX(135);
$pdf->Cell(5, $textypos, "FACTURA #12345");
$pdf->SetFont('Arial', '', 10);
$pdf->setY(35);
$pdf->setX(135);
$pdf->Cell(5, $textypos, "Fecha: 16/Mayo/2022");
$pdf->setY(45);
$pdf->setX(135);
$pdf->Cell(5, $textypos, "");
$pdf->setY(50);
$pdf->setX(135);
$pdf->Cell(5, $textypos, "");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);
$pdf->setX(135);
$pdf->Ln();
/////////////////////////////

//// Array de Cabecera
$header = array("Nombre", "Cantidad", "Precio", "Descuento", "Subtotal");

// Column widths
$w = array(85, 25, 25, 25, 25);

// Header
for ($i = 0; $i < count($header); $i++)
    $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
$pdf->Ln();

//Impresion 
//// Arrar de Productos
$total = 0;
$subtotal = 0;
foreach ($lista_carrito as $item) {
    $_id = $item['id_juego'];
    $nombre = $item['nombre'];
    $precio = $item['costo'];
    $cantidad = $item['cantidad'];
    $descuento = $item['descuento'];

    $precio = $item['costo'];
    $cantidad = $item['cantidad'];
    $descuento = $item['descuento'];


    $precio_descuento = $precio - (((int)$precio * (int)$descuento) / 100);
    $subtotal = (int)$cantidad * (int)$precio_descuento;
    $total += $subtotal;


    $pdf->Cell($w[0], 6, $nombre, 1, 0, 'C');
    $pdf->Cell($w[1], 6, $cantidad, 1, 0, 'C');
    $pdf->Cell($w[2], 6, "$" . number_format($precio, 2, '.', ','), 1, 0, 'C');
    $pdf->Cell($w[2], 6, $descuento . "%", 1, 0, 'C');
    $pdf->Cell($w[3], 6, "$" . number_format($precio_descuento, 2, '.', ','), 1, 0, 'C');

    $pdf->Ln();
}


/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($lista_carrito) * 10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
$pdf->Ln();
/////////////////////////////
$header = array("", "");

//cOLUMNAS 
$datos2 = array(
    array("Subtotal", $total,),
    array("Impuestos", 0,),
    array("Total", $total,),
);

// Column widths
$w2 = array(40, 40);
// Header

$pdf->Ln();

foreach ($datos2 as $row) {

    $pdf->setX(115);
    $pdf->Cell($w2[0], 6, $row[0], 1);
    $pdf->Cell($w2[1], 6, "$" . number_format($row[1], 2, '.', ','), 1, 0, 'R');

    $pdf->Ln();
}

/////////////////////////////

$yposdinamic += (count($lista_carrito) * 10);
$pdf->SetFont('Arial', 'B', 10);

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "APLICAN TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial', '', 10);

$pdf->setY($yposdinamic + 10);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "Vuelva pronto.");
$pdf->setY($yposdinamic + 20);
$pdf->setX(10);
$pdf->Cell(5, $textypos, "Desarrollado por Pats y Juan");






//Salida del PDF
$pdf->Output();
