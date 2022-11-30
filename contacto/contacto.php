<?php
//utnequipo0302.utn.red
$link = mysqli_connect ("68.66.226.122","utnequipo0302_utnequipo0302","vDY#g8Dv]%dQ","utnequipo0302_contacto") or die ("No se encuentra el servidor");
$db = mysqli_select_db ($link,'utnequipo0302_contacto') or die ("Error de conexión");
header("Location: cont.html");
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$tel = $_POST['tel'];
$mensaje = $_POST['mensaje'];

mysqli_query ($link,"INSERT INTO contacto (nombre,correo,tel,mensaje)VALUES('$nombre','$correo','$tel','$mensaje')") or die ("Error al insertar datos");


?>
