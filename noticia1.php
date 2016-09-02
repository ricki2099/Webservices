<?php
require("conexion_servidor_bd.php");
$consultar_registros="SELECT * FROM noticia ";
//oci_parse('SET CHARACTER SET utf8');
// se cambia esta linea
$registros=OCIParse($conectado,$consultar_registros);
//$totalregistros=mysql_num_rows($registros);
//se cambia linea
while ($tabla=oci_fetch_array($registros, OCI_BOTH)){
	$datos[]=$tabla;
	}
//header("Content-Type: image/gif");
echo json_encode($datos);
?>
