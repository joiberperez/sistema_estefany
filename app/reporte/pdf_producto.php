<?php
require '../../vendor/autoload.php';


if(!defined("ROOT")){
    include "../config/config.php";

}

include ROOT . "/models/modeloProducto.php";
include ROOT . "/config/clase.php";

class PDF extends \FPDF {
    function Header() {
        // Configuración del encabezado
        
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Productos agotados ', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Configuración del pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo()), 0, 0, 'C');
    }

    function Table($header, $data) {
        // Ancho de las columnas
        $w = array(20, 70, 30, 25, 45); // Ancho de las columnas
        
        // Encabezado de la tabla
        for ($i = 0; $i < count($header); $i++) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C');
        }
        $this->Ln();

        // Datos de la tabla
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            $this->Cell($w[0], 10, $row['id'], 1, 0, 'C');
            $this->Cell($w[1], 10, $row['nombre'], 1, 0, 'C');
            $this->Cell($w[2], 10, "$" . $row['precio'], 1, 0, 'C');
            $this->Cell($w[3], 10, $row['cantidad'], 1, 0, 'C');
            $this->Cell($w[4], 10, $row['categoria_nombre'], 1, 0, 'C');
            
            $this->Ln();
        }
    }
}




function generar_pdf(){
    // Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();

// Definir encabezados
$header = array('Codigo', 'Nombre', 'Precio', 'Cantidad','categoria');

// Definir datos (ejemplo)

$filtro = $_GET["filtro"];

$modelo = new ModeloProducto();
$sql = "
        SELECT 
            p.*, 
            c.nombre AS categoria_nombre, 
            i.cantidad_disponible AS cantidad
        FROM 
            producto p
        LEFT JOIN 
            categoria c ON p.categoria_id = c.id
        LEFT JOIN 
            inventario i ON p.id = i.producto_id
        WHERE 
            i.cantidad_disponible <= $filtro";
$data = $modelo->conn->query($sql);
$data = $data->fetchAll(PDO::FETCH_ASSOC);



// Crear tabla
$pdf->Table($header, $data);

// Generar el PDF
$pdf->Output();

}

generar_pdf();
?>