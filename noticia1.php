<?php
require("conexion_servidor_bd.php");


$consultar_registros="SELECT
nombre,
descripcion,
enlace,
tipo,
anio,
periodo,
fecha_radicacion,
usr_remitente,
imagen
FROM general.noticia
WHERE estado=1
AND now()::date BETWEEN fecha_inicio AND fecha_fin
ORDER BY fecha_radicacion DESC";

//oci_parse('SET CHARACTER SET utf8');

// se cambia esta linea

$registros=OCIParse($conectado,$consultar_registros);

//$totalregistros=mysql_num_rows($registros);

//se cambia linea
$busqueda=OCIExecute($registros);
	if ($busqueda) {

while ($tabla=oci_fetch_array($registros, OCI_BOTH)){

	$datos[]=$tabla;

	}
}else {
	$datos = array('No hay noticias');
}
//header("Content-Type: image/gif");

echo json_encode($datos);

?>
