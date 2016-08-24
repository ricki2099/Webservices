<?php
require("conexion_servidor_bd.php");

$consultar_registros="SELECT EST_COD,EST_NRO_IDEN,EST_NOMBRE,EST_CRA_COD||'-'||CRA_NOMBRE,EST_ACUERDO,EST_PEN_NRO,CASE WHEN EST_IND_CRED='N' THEN 'HORAS' WHEN EST_IND_CRED='S' THEN 'CRÉDITOS' ELSE 'N/A' END TIPO_PLAN,EOT_EMAIL_INS,EOT_EMAIL,EOT_TIPOSANGRE,EOT_RH
FROM ACEST
INNER JOIN ACESTOTR ON EST_COD=EOT_COD
INNER JOIN ACCRA ON CRA_COD=EST_CRA_COD
WHERE EST_COD IN (20122078098)";

//echo $consultar_registros;
$cadenaParser = OCIParse($conectado,$consultar_registros);

$busqueda=OCIExecute($cadenaParser);

if ($busqueda) {
	while ($tabla=oci_fetch_array($cadenaParser, OCI_BOTH)){
                $datos[]=$tabla;
        }
}

echo json_encode($datos);

?>
