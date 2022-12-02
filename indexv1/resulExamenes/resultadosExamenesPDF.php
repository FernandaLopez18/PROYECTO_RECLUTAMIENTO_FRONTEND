<?php
require('../fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    require 'conexion.php';
    $consulta = $conexion->query("SELECT * FROM empresas");
    $resultado_info= $consulta->fetch_object();
    // Logo
    $this->Image('../empresa/imagenes/edificio.jpg',60,5,20);
    
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    //Nombre de la empresa
    $this->Cell(50);
    $this->Cell(110,15,utf8_decode($resultado_info->nombre_empresa),0,1,'C',0 );
    $this->Ln(10);

    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->SetTextColor(31, 97, 141);
    $this->SetFont('Arial','B',15);
    $this->Cell(70,10,utf8_decode('Reporte de Resultados de Exámenes'),0,1,'C',0);
    // Salto de línea
    $this->Ln(10);

    //Titulo de la tabla
    $this->SetTextColor(21, 67, 96 );  //Color de texto
    $this->SetFont('Arial','B',11);
    $this->Cell(20, 10, 'Folio', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Paterno', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Materno', 1, 0, 'C', 0);
    $this->Cell(35, 10,'Conocimiento', 1, 0, 'C', 0);
    $this->Cell(35, 10,utf8_decode('Psicométrico'), 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',12);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'conexion.php';
$consulta = "SELECT DISTINCT u.id, a.nombre, a.apellido_paterno, a.apellido_materno, u.examenConocimiento, u.examenPsicometrico 
FROM resultadoexamenes u INNER JOIN empresas e INNER JOIN aspirante a WHERE u.id_empresa=2 AND u.id=a.id";
$resultado= $conexion->query($consulta);


$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


while($row = $resultado->fetch_assoc()){
    $pdf->Cell(20, 10, $row['id'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['apellido_paterno'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['apellido_materno'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['examenConocimiento'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['examenPsicometrico'], 1, 1, 'C', 0);
}


$pdf->Output();
?>