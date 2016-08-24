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
session_start();
$cod=$_SESSION['codigo'];
$consultar_registros="SELECT EST_COD,EST_NOMBRE FROM accest WHERE EST_COD=(20122078098);";
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado);
$totalregistros=mysql_num_rows($registros);
for ($contador=0;$contador<$totalregistros;$contador++)
{

$EST_COD=mysql_result($registros,$contador,"EST_COD");
$EST_NOMBRE =mysql_result($registros,$contador,"EST_NOMBRE");
echo("Código: ".$EST_COD);
echo('<br>Nombre: '.$EST_NOMBRE);




}

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
session_start();
$cod=$_SESSION['codigo'];
$consultar_registros=" SELECT EST_COD,EST_NOMBRE,EST_NRO_IDEN,INS_ASI_COD,ASI_NOMBRE,CUR_CRA_COD CODIGOCRA,CUR_GRUPO GRUPO, DIA_NOMBRE,achorarios.HOR_HORA,achorarios.HOR_SAL_ID_ESPACIO,SED_NOM,EDI_NOMBRE,gesalones.SAL_NOMBRE,acdocente.DOC_APELLIDO APELLIDO,acdocente.DOC_NOMBRE DOCENTE,DOC_EMAIL,DOC_EMAIL_INS
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
ORDER BY DIA_NOMBRE,EST_COD,ASI_COD,CODIGOCRA,GRUPO,HOR_HORA;";
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado);
$totalregistros=mysql_num_rows($registros);
for ($contador=0;$contador<$totalregistros;$contador++)
{

$INS_ASI_COD=mysql_result($registros,$contador,"INS_ASI_COD");
$ASI_NOMBRE=mysql_result($registros,$contador,"ASI_NOMBRE");
$CODIGOCRA=mysql_result($registros,$contador,"CODIGOCRA");
$GRUPO=mysql_result($registros,$contador,"GRUPO");
$DIA_NOMBRE=mysql_result($registros,$contador,"DIA_NOMBRE");
$HOR_HORA=mysql_result($registros,$contador,"HOR_HORA");
$HOR_SAL_ID_ESPACIO=mysql_result($registros,$contador,"HOR_SAL_ID_ESPACIO");
$SED_NOM=mysql_result($registros,$contador,"SED_NOM");
$EDI_NOMBRE=mysql_result($registros,$contador,"EDI_NOMBRE");
$SAL_NOMBRE=mysql_result($registros,$contador,"SAL_NOMBRE");
$DOCENTE=mysql_result($registros,$contador,"DOCENTE");
$APELLIDO=mysql_result($registros,$contador,"APELLIDO");




echo("<td>".$INS_ASI_COD."</td>");
echo("<td>".$ASI_NOMBRE."</td>");
echo("<td>".$CODIGOCRA);
echo("-".$GRUPO."</td>");
echo("<td>".$DIA_NOMBRE."</td>");
echo("<td><br>".$HOR_HORA);
echo("-".$HOR_SAL_ID_ESPACIO."</td>");
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