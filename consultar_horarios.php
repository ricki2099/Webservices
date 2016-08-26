<?php
require("conexion_servidor_bd.php");
$codigo = isset($_GET['codEstudiante'])?$_GET['codEstudiante']:'';
$datos = array();
if ($codigo != '') {
$consultar_registros=" SELECT  EST_COD,EST_NOMBRE,EST_NRO_IDEN,INS_ASI_COD,ASI_NOMBRE,CUR_CRA_COD CODIGOCRA,CUR_GRUPO GRUPO, DIA_NOMBRE,DIA_COD,achorarios.HOR_HORA,achorarios.HOR_SAL_ID_ESPACIO,SED_NOMBRE,EDI_NOMBRE,gesalones.SAL_NOMBRE,acdocente.DOC_APELLIDO APELLIDO,acdocente.DOC_NOMBRE DOCENTE,DOC_EMAIL,DOC_EMAIL_INS
FROM acest
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
AND EST_COD IN (".$codigo.")
ORDER BY DIA_COD,DIA_NOMBRE,EST_COD,ASI_COD,CODIGOCRA,GRUPO,HOR_HORA";

//echo $consultar_registros; //20051085002
$cadenaParser = OCIParse($conectado,$consultar_registros);

$busqueda=OCIExecute($cadenaParser);

	if ($busqueda) {
		while ($tabla=oci_fetch_array($cadenaParser, OCI_BOTH)){
			$datos[]=$tabla;
		}	
	}
} else {
	$datos = array('No se ingresó ningún código');
}

$j = 0;

foreach($datos AS $dato) {
	if(!isset($horario)){ 
		$horario[] = $dato;
	} else { 
		if (($dato['INS_ASI_COD'] == $horario[$j]['INS_ASI_COD']) && ($dato['DIA_COD'] == $horario[$j]['DIA_COD'])) {
			$horario[$j]['HOR_HORA'].='-'.($dato['HOR_HORA']+1); 
		} else {
			$horario[] = $dato;
			$j++;
		}
	}
}

echo json_encode($horario);
?>
