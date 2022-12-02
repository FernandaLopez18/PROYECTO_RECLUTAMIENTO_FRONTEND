<?php 
 

class modeloExamen{
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $examenConocimiento;
    private $examenPsicometrico;

    function inicializar($a,$b,$c,$d,$e){
        $this->nombre             = $a;
        $this->apellido_paterno   = $b;
        $this->apellido_materno   = $c;
        $this->examenConocimiento = $d;
        $this->examenPsicometrico = $e;
    }

    function conectarBD(){
        $conexion = mysqli_connect("localhost","root","","outsourcing") 
        or die ("Problemas en la conexion a la base de datos");
        return $conexion;
    }

    function listarResultados(){
        $id = $_SESSION['id'];
        
        $registro=mysqli_query($this->conectarBD(), "SELECT DISTINCT u.id, a.nombre, a.apellido_paterno, a.apellido_materno, u.examenConocimiento, u.examenPsicometrico 
        FROM resultadoexamenes u INNER JOIN empresas e INNER JOIN aspirante a WHERE u.id_empresa='$id' AND u.id=a.id") 
        or die("Problemas con la comsulta".mysqli_error($this->conectarBD()));

    echo "<table class='table table-hover table-striped table-responsive'>";
    echo "<thead>
    <tr>
    <th scope='col'>Folio</th>
    <th scope='col'>Nombre</th>
    <th scope='col'>Apellido Paterno</th>
    <th scope='col'>Apellido Materno</th>
    <th scope='col'>Exámen Conocimiento</th>
    <th scope='col'>Exámen Psicométrico</th>
    </tr>
    </thead>";
        while($reg=mysqli_fetch_array($registro)){
            echo '<tr><td>'.$reg['id'].'</td>';
            echo '<td>'.$reg['nombre'].'</td>';
            echo '<td>'.$reg['apellido_paterno'].'</td>';
            echo '<td>'.$reg['apellido_materno'].'</td>';
            echo '<td>'.$reg['examenConocimiento'].'</td>';
            echo '<td>'.$reg['examenPsicometrico'].'</td>';    
    }
    echo "</table>";
    
    }


    function cerrarBD(){
        mysqli_close($this->conectarBD());
    }

}
?>