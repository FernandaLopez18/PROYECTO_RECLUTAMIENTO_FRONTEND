<?php
$con = mysql_connect('localhost','root','','contacto') or die ('Error de conexión con servidor');

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$tel = $_POST['tel'];
$mensaje = $_POST['mensaje'];

$insert = mysql_query ("INSERT INTO `contacto`(`nombre`, `correo`, `tel`, `mensaje`) VALUES ('[$nombre]','[$correo]','[$tel]','[$mensaje]')");


/>