<?php
require("conexion_servidor_bd.php");
$consultar_registros="SELECT * FROM noticia;";
mysql_query('SET CHARACTER SET utf8');
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado);
//$totalregistros=mysql_num_rows($registros);
while ($tabla=mysql_fetch_array($registros)){
	$datos[]=$tabla;
	}

//header("Content-Type: image/gif");
echo json_encode($datos);



?>