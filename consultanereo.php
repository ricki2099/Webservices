<?php
require("conexion_servidor_bd.php");

function response($code=200, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"message"=>$message);  
        echo json_encode($response,JSON_PRETTY_PRINT);    
    }            
 }

$codigo = isset($_GET['codEstudiante'])?$_GET['codEstudiante']:'';

if ($codigo != '') {

	$consultar_registros="SELECT EST_COD,EST_NRO_IDEN,EST_NOMBRE,EST_CRA_COD,CRA_NOMBRE,EST_ACUERDO,EST_PEN_NRO,CASE WHEN EST_IND_CRED='N' THEN 'HORAS' WHEN EST_IND_CRED='S' THEN 'CRÉDITOS' ELSE 'N/A' END TIPO_PLAN,EOT_EMAIL_INS,EOT_EMAIL,EOT_TIPOSANGRE,EOT_RH
FROM ACEST
INNER JOIN ACESTOTR ON EST_COD=EOT_COD
INNER JOIN ACCRA ON CRA_COD=EST_CRA_COD
WHERE EST_COD IN (".$codigo.")";
	//echo $consultar_registros;
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
