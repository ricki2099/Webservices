<?php
require("conexion_servidor_bd.php");
$codigo = isset($_GET['codEstudiante'])?$_GET['codEstudiante']:'';

function response($code=200, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"message"=>$message);  
        echo json_encode($response,JSON_PRETTY_PRINT);    
    }            
 }

if ($codigo != '') {
$consultar_registros = "SELECT DISTINCT
  INS_ASI_COD COD_ESPACIO,
  ASI_NOMBRE NOMBRE_ESPACIO,
  CUR_CRA_COD||'-'||CUR_GRUPO GRUPO,
  INS_EST_COD COD_EST,
  EST_NOMBRE NOMBRE_ESTUDIANTE,
  DECODE (NOB_NOMBRE,'SIN OBSERVACION','',NOB_NOMBRE) OBS,
  INS_ANO ANO,
  INS_PER PERIODO,
  CUR_PAR1 PPAR,
  INS_NOTA_PAR1 NOTA_PAR1,
  CUR_PAR2 PPAR2,
  INS_NOTA_PAR2 NOTA_PAR2,
  CUR_PAR3 PPAR3,
  INS_NOTA_PAR3 NOTA_PAR3,
  CUR_PAR4 PPAR4,
  INS_NOTA_PAR4 NOTA_PAR4,
  CUR_PAR5 PPAR5,
  INS_NOTA_PAR5 NOTA_PAR5,
  CUR_PAR6 PPAR6,
  INS_NOTA_PAR6 NOTA_PAR6,
  CUR_LAB PLAB,
  INS_NOTA_LAB NOTA_LAB,
  CUR_EXA PEXA,
  INS_NOTA_EXA NOTA_EXA,
  CUR_HAB PHAB,
  INS_NOTA_HAB NOTA_HAB,
  INS_NOTA_ACU NOTA_ACUM,
  INS_NOTA NOTA_DEF,  
  INS_TOT_FALLAS FALLAS,
  DOC_NOMBRE||' '||DOC_APELLIDO DOCENTE
  FROM ACINS
INNER JOIN ACCURSOS ON CUR_ID=INS_GR
INNER JOIN ACHORARIOS ON HOR_ID_CURSO=CUR_ID
INNER JOIN ACEST ON EST_COD=INS_EST_COD
INNER JOIN ACASI ON ASI_COD=INS_ASI_COD
INNER JOIN ACASPERI ON APE_ANO=INS_ANO AND APE_PER=INS_PER
LEFT OUTER JOIN ACNOTOBS ON NOB_COD=INS_OBS
LEFT OUTER JOIN ACCARGAS ON CAR_HOR_ID=HOR_ID
LEFT OUTER JOIN ACDOCENTE ON DOC_NRO_IDEN=CAR_DOC_NRO
WHERE HOR_ESTADO='A'
AND APE_ESTADO='A'
AND EST_COD IN (".$codigo.")
ORDER BY INS_ANO,INS_PER,INS_EST_COD,INS_ASI_COD,CUR_CRA_COD||'-'||CUR_GRUPO";

//echo $consultar_registros; 20051085002
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
echo json_encode($datos);

?>
