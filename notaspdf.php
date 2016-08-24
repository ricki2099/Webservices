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
<h3 align="center">Consulta de Notas</h3>
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
<tr><th colspan="6">Notas</th></tr>
<tr>
<th>Cod Asig</th>
<th>Asignatura</th>


<th>Periodo</th>

<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Nota</th>
<th>%</th>
<th>Def</th>
<th>Obs</th>

</tr>

<?php
require("conexion_servidor_bd.php");
$consultar_registros="SELECT DISTINCT
  INS_ASI_COD COD_ESPACIO,
  ASI_NOMBRE NOMBRE_ESPACIO,
  CUR_CRA_COD||'-'||CUR_GRUPO GRUPO,
  INS_EST_COD COD_EST,
  EST_NOMBRE NOMBRE_ESTUDIANTE,
  ELT (NOB_NOMBRE,'SIN OBSERVACION','',NOB_NOMBRE) OBS,
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
  FROM acins
INNER JOIN accursos ON CUR_ID=INS_GR
INNER JOIN achorarios ON HOR_ID_CURSO=CUR_ID
INNER JOIN accest ON EST_COD=INS_EST_COD
INNER JOIN acasi ON ASI_COD=INS_ASI_COD
INNER JOIN acasperi ON APE_ANO=INS_ANO AND APE_PER=INS_PER
LEFT OUTER JOIN acnotobs ON NOB_COD=INS_OBS
LEFT OUTER JOIN accargas ON CAR_HOR_ID=HOR_ID
LEFT OUTER JOIN acdocente ON DOC_NRO_IDEN=CAR_DOC_NRO
WHERE HOR_ESTADO='A'
AND APE_ESTADO='A'
AND EST_COD IN (20122078098)
ORDER BY INS_ANO,INS_PER,INS_EST_COD,INS_ASI_COD,CUR_CRA_COD||'-'||CUR_GRUPO;";
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado);
$totalregistros=mysql_num_rows($registros);
for ($contador=0;$contador<$totalregistros;$contador++)
{
$COD_ESPACIO=mysql_result($registros,$contador,"COD_ESPACIO");
$NOMBRE_ESPACIO=mysql_result($registros,$contador,"NOMBRE_ESPACIO");

$COD_EST=mysql_result($registros,$contador,"COD_EST");
$NOMBRE_ESTUDIANTE=mysql_result($registros,$contador,"NOMBRE_ESTUDIANTE");
$OBS=mysql_result($registros,$contador,"OBS");
$ANO=mysql_result($registros,$contador,"ANO");
$PERIODO=mysql_result($registros,$contador,"PERIODO");
$PPAR=mysql_result($registros,$contador,"PPAR");
$NOTA_PAR1=mysql_result($registros,$contador,"NOTA_PAR1");
$PPAR2=mysql_result($registros,$contador,"PPAR2");
$NOTA_PAR2=mysql_result($registros,$contador,"NOTA_PAR2");
$PPAR3=mysql_result($registros,$contador,"PPAR3");
$NOTA_PAR3=mysql_result($registros,$contador,"NOTA_PAR3");
$PPAR4=mysql_result($registros,$contador,"PPAR4");
$NOTA_PAR4=mysql_result($registros,$contador,"NOTA_PAR4");
$PPAR5=mysql_result($registros,$contador,"PPAR5");
$NOTA_PAR5=mysql_result($registros,$contador,"NOTA_PAR5");
$PPAR6=mysql_result($registros,$contador,"PPAR6");
$NOTA_PAR6=mysql_result($registros,$contador,"NOTA_PAR6");
$PLAB=mysql_result($registros,$contador,"PLAB");
$NOTA_LAB=mysql_result($registros,$contador,"NOTA_LAB");
$PEXA=mysql_result($registros,$contador,"PEXA");
$NOTA_EXA=mysql_result($registros,$contador,"NOTA_EXA");
$PHAB=mysql_result($registros,$contador,"PHAB");
$NOTA_HAB=mysql_result($registros,$contador,"NOTA_HAB");
$NOTA_DEF=mysql_result($registros,$contador,"NOTA_DEF");


echo("<tr><td>".$COD_ESPACIO."</td>");
echo("<td>".$NOMBRE_ESPACIO."</td>");

echo("<td>".$ANO);
echo("-".$PERIODO."</td>");
echo("<td>".$PPAR."</td>");
echo("<td>".$NOTA_PAR1."</td>");
echo("<td>".$PPAR2."</td>");
echo("<td>".$NOTA_PAR2."</td>");
echo("<td>".$PPAR3."</td>");
echo("<td>".$NOTA_PAR3."</td>");
echo("<td>".$PPAR4."</td>");
echo("<td>".$NOTA_PAR4."</td>");
echo("<td>".$PPAR5."</td>");
echo("<td>".$NOTA_PAR5."</td>");
echo("<td>".$PPAR6."</td>");
echo("<td>".$NOTA_PAR6."</td>");
echo("<td>".$PLAB."</td>");
echo("<td>".$NOTA_LAB."</td>");
echo("<td>".$PLAB."</td>");
echo("<td>".$PEXA."</td>");
echo("<td>".$NOTA_EXA."</td>");
echo("<td>".$PHAB."</td>");
echo("<td>".$NOTA_HAB."</td>");
echo("<td>".$NOTA_DEF."</td>");
echo("<td>".$OBS."</td></tr>");

}

?>
</table>

 
</body>

</html>