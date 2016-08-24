<?php
require("conexion_servidor_bd.php");
$consultar_registros=" SELECT EST_COD,EST_NOMBRE,EST_NRO_IDEN,INS_ASI_COD,ASI_NOMBRE,CUR_CRA_COD CODIGOCRA,CUR_GRUPO GRUPO, DIA_NOMBRE,DIA_COD,achorarios.HOR_HORA,achorarios.HOR_SAL_ID_ESPACIO,SED_NOM,EDI_NOMBRE,gesalones.SAL_NOMBRE,acdocente.DOC_APELLIDO APELLIDO,acdocente.DOC_NOMBRE DOCENTE,DOC_EMAIL,DOC_EMAIL_INS
FROM accest
INNER JOIN acins ON INS_EST_COD=EST_COD
INNER JOIN acasi ON ASI_COD=INS_ASI_COD
INNER JOIN accursos ON CUR_ID=INS_GR
INNER JOIN achorarios ON HOR_ID_CURSO=CUR_ID
INNER JOIN gesalones ON SAL_ID_ESPACIO=HOR_SAL_ID_ESPACIO
INNER JOIN gedia ON gedia.DIA_COD=achorarios.HOR_DIA_NRO
INNER JOIN geedificio ON EDI_COD=gesalones.SAL_EDIFICIO
INNER JOIN gesede ON SED_ID=gesalones.SAL_SED_ID
LEFT OUTER JOIN accargas ON CAR_HOR_ID=HOR_ID
LEFT OUTER JOIN acdocente ON DOC_NRO_IDEN=CAR_DOC_NRO
INNER JOIN acasperi ON APE_ANO=INS_ANO AND APE_PER=INS_PER
WHERE APE_ESTADO='A'
AND EST_COD IN (20122078098)
ORDER BY DIA_COD,DIA_NOMBRE,EST_COD,ASI_COD,CODIGOCRA,GRUPO,HOR_HORA;";
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado) or die(" No se puede ejecutar la consulta:". mysql_error());


while ($tabla=mysql_fetch_array($registros)){
	$datos[]=$tabla;

	}

echo json_encode($datos);

?>