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
    $this->Cell(70,10,utf8_decode('Reporte de Convocatorias Exitosas'),0,1,'C',0);
    // Salto de línea
    $this->Ln(10);

    //Titulo de la tabla
    $this->SetTextColor(21, 67, 96 );  //Color de texto
    $this->SetFont('Arial','B',11);
    $this->Cell(20, 10, 'Id', 1, 0, 'C', 0);
    $this->Cell(45, 10, 'Puesto', 1, 0, 'C', 0);
    $this->Cell(35, 10, 'Habilidades', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Fecha Inicio', 1, 0, 'C', 0);
    $this->Cell(35, 10,'Fecha Fin', 1, 0, 'C', 0);
    $this->Cell(25, 10,'Postulados', 1, 1, 'C', 0);
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
$consulta = "SELECT DISTINCT c.id, c.puesto, c.habilidades, c.fecha_inicio, c.fecha_fin, c.no_postulado 
FROM empresas e INNER JOIN convocatorias c WHERE c.id_empresa=2 AND c.no_postulado=1";
$resultado= $conexion->query($consulta);


$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


while($row = $resultado->fetch_assoc()){
    $pdf->Cell(20, 10, $row['id'], 1, 0, 'C', 0);
    $pdf->Cell(45, 10, utf8_decode($row['puesto']), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($row['habilidades']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['fecha_inicio'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['fecha_fin'], 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['no_postulado'], 1, 1, 'C', 0);
}


$pdf->Output();
?>