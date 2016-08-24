<?php
 $conectado = mysql_connect ("localhost","l6000018","14sivuLEze");
 if (!$conectado)
 { echo ("NO SE PUDO CONECTAR AL SERVIDOR MySQL.<br>");
 }
 if (!mysql_select_db ("l6000018_nereo", $conectado))
 {
 echo "Error al intentar conectar con la base de datos nereo.<br>";
 exit();
 }
?>