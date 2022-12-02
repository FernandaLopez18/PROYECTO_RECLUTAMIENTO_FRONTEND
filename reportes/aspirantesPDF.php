<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../administrador/imagenes/IToLogo.png',15,8,15);
    // Logo
    $this->Image('../administrador/imagenes/IT Outsourcing.png',150,8,45);
    // Salto de línea
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de Aspirantes',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->SetTextColor(21, 67, 96 );  //Color de texto
    $this->SetFont('Arial','B',11);
    $this->Cell(10, 10, 'Id', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Paterno', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Materno', 1, 0, 'C', 0);
    $this->Cell(15, 10, 'Edad', 1, 0, 'C', 0);
    $this->Cell(30, 10,utf8_decode('Teléfono'), 1, 0, 'C', 0);
    $this->Cell(50, 10, 'Correo', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial Arial 12
    $this->SetFont('Arial','B',12);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'conexion.php';
$consulta = "SELECT * FROM aspirante";
$resultado= $conexion->query($consulta);


$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


while($row = $resultado->fetch_assoc()){
    $pdf->Cell(10, 10, $row['id'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['apellido_paterno'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['apellido_materno'], 1, 0, 'C', 0);
    $pdf->Cell(15, 10, $row['edad'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $row['correo'], 1, 1, 'C', 0);
}


$pdf->Output();
?>