<?php
require '../../vendor/autoload.php';


if(!defined("ROOT")){
    include "../config/config.php";

}

include ROOT . "/models/modeloVenta.php";
include ROOT . "/config/clase.php";

class PDF extends \FPDF {
    function Header() {
        // Configuración del encabezado
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Ventas '. $_GET["fechaInicio"] . " - " . $_GET["fechaFin"], 0, 1, 'C');
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
        $w = array(30, 50, 30, 30, 50); // Ancho de las columnas
        
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
            $this->Cell($w[1], 10, $row['fecha_venta'], 1, 0, 'C');
            $this->Cell($w[2], 10, "$" . $row['total'], 1, 0, 'C');
            $this->Cell($w[3], 10, "V-".$row['cliente_cedula'], 1, 0, 'C');
            $this->Cell($w[4], 10, $row['nombre_metodo_pago'], 1, 0, 'C');
            $this->Ln();
        }
    }
}




function generar_pdf(){
    // Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();

// Definir encabezados
$header = array('ID', 'Fecha Venta', 'Total', 'Cliente', utf8_decode('Método Pago'));

// Definir datos (ejemplo)
$fechaInicio = $_GET["fechaInicio"] ?? "";
$fechaInicio  = new DateTime($fechaInicio);
$fechaInicio = $fechaInicio->format('y-m-d');
$fechaFin = $_GET["fechaFin"] ?? "";
$fechaFin  = new DateTime($fechaFin);
$fechaFin = $fechaFin->format('y-m-d');

$modelo = new ModeloVenta();
$data = $modelo->conn->query("SELECT v.*,c.cedula_cliente AS cliente_cedula, mp.nombre as nombre_metodo_pago FROM venta v
LEFT JOIN cliente c ON v.cliente_id = c.id_cliente
LEFT JOIN metodo_pago mp ON v.metodo_pago_id = mp.id

WHERE fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin'");
$data = $data->fetchAll(PDO::FETCH_ASSOC);



// Crear tabla
$pdf->Table($header, $data);

// Generar el PDF
$pdf->Output();

}

generar_pdf();
?>