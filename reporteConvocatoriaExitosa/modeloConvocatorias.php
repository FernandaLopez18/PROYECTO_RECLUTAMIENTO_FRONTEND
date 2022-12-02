<?php 
 
 class modeloConvocatorias{
    private $puesto;
    private $habilidades;
    private $fecha_inicio;
    private $fecha_fin;
    private $no_postulado;

    function inicializar($a,$b,$c,$d,$e){
        $this->puesto        = $a;
        $this->habilidades   = $b;
        $this->fecha_inicio  = $c;
        $this->fecha_fin     = $d;
        $this->no_postulado  = $e;
    }

    function conectarBD(){
        $conexion = mysqli_connect("localhost","root","","outsourcing") 
        or die ("Problemas en la conexion a la base de datos");
        return $conexion;
    }

    function listarConvocatoriasV(){
        $id = $_SESSION['id'];
        
        $registro=mysqli_query($this->conectarBD(), "SELECT DISTINCT c.id, c.puesto, c.habilidades, c.fecha_inicio, c.fecha_fin, c.no_postulado 
        FROM empresas e INNER JOIN convocatorias c WHERE c.id_empresa='$id' AND c.no_postulado=0") 
        or die("Problemas con la comsulta".mysqli_error($this->conectarBD()));

    echo "<table class='table table-hover table-striped table-responsive'>";
    echo "<thead>
    <tr>
    <th scope='col'>Id</th>
    <th scope='col'>Puesto</th>
    <th scope='col'>Habilidades</th>
    <th scope='col'>Fecha Inicio</th>
    <th scope='col'>Fecha Fin</th>
    <th scope='col'>Postulados</th>
    </tr>
    </thead>";
        while($reg=mysqli_fetch_array($registro)){
            echo '<tr><td>'.$reg['id'].'</td>';
            echo '<td>'.$reg['puesto'].'</td>';
            echo '<td>'.$reg['habilidades'].'</td>';
            echo '<td>'.$reg['fecha_inicio'].'</td>';
            echo '<td>'.$reg['fecha_fin'].'</td>';
            echo '<td>'.$reg['no_postulado'].'</td>';    
    }
    echo "</table>";
    
    }
    function listarConvocatoriasE(){
        $id = $_SESSION['id'];
        
        $registro=mysqli_query($this->conectarBD(), "SELECT DISTINCT c.id, c.puesto, c.habilidades, c.fecha_inicio, c.fecha_fin, c.no_postulado 
        FROM empresas e INNER JOIN convocatorias c WHERE c.id_empresa='$id' AND c.no_postulado=1") 
        or die("Problemas con la comsulta".mysqli_error($this->conectarBD()));

    echo "<table class='table table-hover table-striped table-responsive'>";
    echo "<thead>
    <tr>
    <th scope='col'>Id</th>
    <th scope='col'>Puesto</th>
    <th scope='col'>Habilidades</th>
    <th scope='col'>Fecha Inicio</th>
    <th scope='col'>Fecha Fin</th>
    <th scope='col'>Postulados</th>
    </tr>
    </thead>";
        while($reg=mysqli_fetch_array($registro)){
            echo '<tr><td>'.$reg['id'].'</td>';
            echo '<td>'.$reg['puesto'].'</td>';
            echo '<td>'.$reg['habilidades'].'</td>';
            echo '<td>'.$reg['fecha_inicio'].'</td>';
            echo '<td>'.$reg['fecha_fin'].'</td>';
            echo '<td>'.$reg['no_postulado'].'</td>';    
    }
    echo "</table>";
    
    }


    function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
}
?>