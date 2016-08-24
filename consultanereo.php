<?php
require("config.inc.php");
require("conexion_servidor_bd.php");
session_start();
$cod=$_SESSION['codigo'];

$consultar_registros=" SELECT EST_COD,EST_NRO_IDEN,EST_NOMBRE,EST_CRA_COD CODIGOCRA,CRA_NOMBRE CRANOM,EST_ACUERDO,EST_PEN_NRO,CASE WHEN EST_IND_CREO='N' THEN 'HORAS' WHEN EST_IND_CREO='S' THEN 'CRÉDITOS' ELSE 'N/A' END TIPO_PLAN,EOT_EMAIL_INS,EOT_EMAIL,EOT_TIPOSANGRE,EOT_RH
FROM accest
INNER JOIN acestotr ON EST_COD=EOT_COD
INNER JOIN accra ON CRA_COD=EST_CRA_COD
WHERE EST_COD IN (20122078098)";



$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado) or die(" No se puede ejecutar la consulta:". mysql_error());

while ($tabla=mysql_fetch_array($registros)){
	$datos[]=$tabla;
	}

echo json_encode($datos);

?>