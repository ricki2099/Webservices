<html>

<head><title>Consultar registro con PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<script type="text/javascript">
var d = new Date();
document.write('<br>Fecha: '+d.getDate(),

'/'+d.getMonth(),
'/'+d.getFullYear(),'<br>',
'  Hora: '+d.getHours(),

':'+d.getMinutes());
</script>
<h3 align="center">Consultas de Notas</h3>
 <h3 align="center">  <input name="boton"  type="button" onClick="javascript:window.print(); " value="Guardar:" style="width:100px; height:50px " /></h3>

<?php
require("conexion_servidor_bd.php");
$codigo = isset($_GET['codEstudiante'])?$_GET['codEstudiante']:'';
if ($codigo != '') {
$consultar_registros="SELECT EST_COD,EST_NOMBRE FROM acest WHERE EST_COD=(".$codigo.")";
//echo $consultar_registros;
$cadenaParser = OCIParse($conectado,$consultar_registros);

$busqueda=OCIExecute($cadenaParser);

if ($busqueda) {
	// carga una a una las filas en $this->registro
	while ( $row = oci_fetch_array ( $cadenaParser, OCI_BOTH ) ) {
		$registro [] = $row;
	}
			
	// si por lo menos una fila es cargada a $this->registro entonces cuenta
	if (isset ( $registro )) {
		$conteo = count ( $registro );
	}
}
} else {
	$datos = array('No se ingresó ningún código');exit;
}
//var_dump($registro);exit;

echo("Código:<align=center> ".$registro[0]['EST_COD']);
echo("<br>Nombre: <align=center>".$registro[0]['EST_NOMBRE']);

?>
<table border="2" cellpadding="2" cellspacing="0" align="center">
  <tr><th colspan="8">Horario</th></tr>
<tr>
<th>Cod Asig</th>
<th>Asignatura</th>
<th>Grupo</th>
<th>Dia</th>
<th>Hora</th>
<th>Sede</th>
<th>Salón</th>
<th>Docente</th>

</tr>

<?php
require("conexion_servidor_bd.php");

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
//var_dump($datos);exit;
$horario = array();
$i = 0;
$j = 0;
foreach($datos AS $dato) {
	if($i==0){ 
		$horario[] = $dato;
		$i++;
	} else { 
		if ($dato['INS_ASI_COD'] == $horario[$j]['INS_ASI_COD']) {
			$horario[$j]['HOR_HORA'].='-'.($dato['HOR_HORA']+1); 
		} else {
			$horario[] = $dato;
			$i++;
			$j++;
		}
	}
}
//echo json_encode($horario);
foreach ($horario AS $dato) {

$INS_ASI_COD=$dato["INS_ASI_COD"];
$ASI_NOMBRE=$dato["ASI_NOMBRE"];
$CODIGOCRA=$dato["CODIGOCRA"];
$GRUPO=$dato["GRUPO"];
$DIA_NOMBRE=$dato["DIA_NOMBRE"];
$HOR_HORA=$dato["HOR_HORA"];
$HOR_SAL_ID_ESPACIO=$dato["HOR_SAL_ID_ESPACIO"];
$SED_NOM=$dato["SED_NOMBRE"];
$EDI_NOMBRE=$dato["EDI_NOMBRE"];
$SAL_NOMBRE=$dato["SAL_NOMBRE"];
$DOCENTE=isset($dato["DOCENTE"])?$dato["DOCENTE"]:'';
$APELLIDO=isset($dato["APELLIDO"])?$dato["APELLIDO"]:'';

echo("<td align=center>".$INS_ASI_COD."</td>");
echo("<td>".$ASI_NOMBRE."</td>");
echo("<td>".$CODIGOCRA);
echo("-".$GRUPO."</td>");
echo("<td align=center>".$DIA_NOMBRE."</td>");
echo("<td align=center><br>".$HOR_HORA."</td>");
echo("<td>".$SED_NOM."</td>");
echo("<td>".$EDI_NOMBRE);
echo("-".$SAL_NOMBRE."</td>");
echo("<td>".$DOCENTE);
echo(" ".$APELLIDO."</td></tr>");

}
?>
</table>

 
</body>

</html>
