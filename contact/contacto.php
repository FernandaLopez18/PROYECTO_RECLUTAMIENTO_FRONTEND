<?php
$link = mysqli_connect ("localhost","root","","contacto") or die ("No se encuentra el servidor");
$db = mysqli_select_db ($link,'contacto') or die ("Error de conexión");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$tel = $_POST['tel'];
$mensaje = $_POST['mensaje'];

mysqli_query ($link,"INSERT INTO contacto VALUES('','nombre','correo','tel','mensaje')") or die ("Error al insertar datos");

echo 'Mensaje enviado correctamente ';

?>