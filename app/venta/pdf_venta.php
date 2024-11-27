<?php
require '../../vendor/autoload.php';
if (!defined("ROOT")) {
    include "../config/config.php";
}
include ROOT . "/models/modeloVenta.php";
include ROOT . "/models/modeloCliente.php";

class PDF extends \FPDF
{
    // Encabezado
    function Header()
    {
        // Título
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('Factura N° '. $_GET["venta_id"]), 0, 1, 'C');
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}
function generar_PDF($venta, $cliente, $productos)
{

    $pdf = new PDF();
    $pdf->AddPage();

    // Fuente
    $pdf->SetFont('Arial', '', 10);

    // Datos de la empresa
    $pdf->Cell(0, 6, utf8_decode('Plasticos y Repostería Santa Elena'), 0, 1);
    $pdf->Cell(0, 6, 'Avenida Lastra 1892, CABA', 0, 1);
    $pdf->Cell(0, 6, 'CUIT-NIF: 32-20191209-3', 0, 1);
    $pdf->Cell(0, 6, 'Teléfono: 555-312-111', 0, 1);
    $pdf->Cell(0, 6, 'E-mail: ferrete@donmanuel2.com', 0, 1);

    $pdf->Ln(5);

    // Datos del cliente
    $pdf->SetFillColor(200, 200, 200);
    $pdf->Cell(0, 6, 'Datos del cliente', 1, 1, 'L', true);
    $pdf->Cell(0, 6, 'Nombre: '. $cliente["nombre_cliente"], 1, 1);
    $pdf->Cell(0, 6, utf8_decode('Cédula: '. $cliente["cedula_cliente"]), 1, 1);
    $pdf->Cell(0, 6, utf8_decode('Teléfono: '. $cliente["telefono_cliente"]), 1, 1);


    $pdf->Ln(5);

    // Fecha
    
    $fechaFormateada = date('d-m-Y', strtotime($venta["fecha_venta"]));
    $pdf->Cell(0, 6, 'Fecha de Venta: '.$fechaFormateada, 1, 1, 'R');


    $pdf->Ln(5);

    // Tabla de productos
    $pdf->SetFillColor(220, 220, 220);
    $pdf->Cell(25, 6, 'CODIGO', 1, 0, 'C', true);
    $pdf->Cell(70, 6, 'NOMBRE', 1, 0, 'C', true);
    $pdf->Cell(35, 6, 'PRECIO UNITARIO', 1, 0, 'C', true);
    $pdf->Cell(30, 6, 'CANTIDAD', 1, 0, 'C', true);
    $pdf->Cell(30, 6, 'MONTO', 1, 1, 'C', true);

    // Productos
    

    foreach ($productos as $producto) {
        $precioUnitario =   $producto["precio_total"] / $producto["cantidad"];
        $pdf->Cell(25, 6, $producto["codigo_producto"], 1);
        $pdf->Cell(70, 6, $producto["nombre_producto"], 1);
        $pdf->Cell(35, 6, '$' . number_format($precioUnitario, 2, ',', '.'), 1, 0, 'R');
        $pdf->Cell(30, 6, number_format($producto["cantidad"], 2, ',', '.'), 1, 0, 'R');
        $pdf->Cell(30, 6, '$' . number_format($producto["precio_total"], 2, ',', '.'), 1, 1, 'R');
    }

    // Totales
    $pdf->Ln(5);
   


    $pdf->Cell(130, 6, '', 0);
    $pdf->Cell(30, 6, 'TOTAL', 1, 0, 'C', true);
    $pdf->Cell(30, 6, '$'. $venta["total"], 1, 1, 'R');
    $pdf->Cell(130, 6, '', 0);
    $pdf->Cell(30, 6, 'ToTAL BS', 1, 0,'C',true);
    $pdf->Cell(30, 6, $venta["total_bs"]."BS", 1, 1, 'R');

    $pdf->Ln(10);

    // Firmas


    // Salvar el PDF
    $pdf->Output('I', 'venta_'.  $_GET["venta_id"] .'.pdf');
}
function obtenerDatosVenta($venta_id)
{
    
    $modelo_venta = new ModeloVenta();
    $modelo_venta = $modelo_venta->conn->query("SELECT 
    v.*
FROM 
    venta AS v
WHERE 
    v.id = $venta_id");
$data = $modelo_venta->fetch(PDO::FETCH_ASSOC);
return $data;
}
function obtenerDatosProductosVenta($venta_id){
    
    $modelo = new ModeloDetalleVenta();
    $modelo = $modelo->conn->query("SELECT p.id AS codigo_producto, p.nombre AS nombre_producto, vp.cantidad, 
           vp.precio_unitario as precio_total
    FROM venta_producto AS vp 
    INNER JOIN producto AS p ON vp.producto_id = p.id 
    WHERE vp.venta_id = $venta_id");
    $data = $modelo->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    
}
function obtenerDatosCliente($venta_id){
    
    $modelo_cliente = new ModeloCliente();
    $modelo_cliente = $modelo_cliente->conn->query("SELECT nombre_cliente, apellido_cliente, cedula_cliente, telefono_cliente 
    FROM cliente 
    INNER JOIN venta ON cliente.id_cliente = venta.cliente_id 
    WHERE venta.id = $venta_id");
    $data = $modelo_cliente->fetch(PDO::FETCH_ASSOC);
    return $data;

}
function obtenerDatos() {
    $venta_id = $_GET["venta_id"];
    $venta = obtenerDatosVenta($venta_id);
    $cliente = obtenerDatosCliente($venta_id);
    $productos = obtenerDatosProductosVenta($venta_id);
    generar_PDF($venta,$cliente,$productos);
}
// Crear PDF
obtenerDatos();