<?php
 $conectado = mysql_connect ("localhost","Usuario","Contraseña");
 if (!$conectado)
 { echo ("NO SE PUDO CONECTAR AL SERVIDOR MySQL.<br>");
 }
 if (!mysql_select_db ("l6000018_nereo", $conectado))
 {
 echo "Error al intentar conectar con la base de datos nereo.<br>";
 exit();
 }
?>
