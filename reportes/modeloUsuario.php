<?php 

class modeloUsuario{
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $edad;
    private $telefono;
    private $correo;

    function inicializar($a,$b,$c,$d,$e,$f){
        $this->nombre            = $a;
        $this->apellido_paterno  = $b;
        $this->apellido_materno  = $c;
        $this->edad              = $d;
        $this->telefono          = $e;
        $this->correo            = $f;
    }

    function conectarBD(){
        $conexion = mysqli_connect("localhost","root","","outsourcing") 
        or die ("Problemas en la conexion a la base de datos");
        return $conexion;
    }

    function listarUsuarios(){

        $registro=mysqli_query($this->conectarBD(), "SELECT * FROM aspirante") 
        or die("Problemas con la comsulta".mysqli_error($this->conectarBD()));

    echo "<table class='table table-hover table-striped table-responsive'>";
    echo "<thead>
    <tr>
    <th scope='col'>Id</th>
    <th scope='col'>Nombre</th>
    <th scope='col'>Apellido Paterno</th>
    <th scope='col'>Apellido Materno</th>
    <th scope='col'>Edad</th>
    <th scope='col'>Teléfono</th>
    <th scope='col'>Correo</th>
    </tr>
    </thead>";
        while($reg=mysqli_fetch_array($registro)){
            echo '<tr><td>'.$reg['id'].'</td>';
            echo '<td>'.$reg['nombre'].'</td>';
            echo '<td>'.$reg['apellido_paterno'].'</td>';
            echo '<td>'.$reg['apellido_materno'].'</td>';
            echo '<td>'.$reg['edad'].'</td>';
            echo '<td>'.$reg['telefono'].'</td>';
            echo '<td>'.$reg['correo'].'</td>';      
    }
    echo "</table>";
    
    }


    function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
}
?>