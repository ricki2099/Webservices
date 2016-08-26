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

$codigo = isset($_GET['codEstudiante'])?$_GET['codEstudiante']:'';

if ($codigo != '') {
$consultar_registros="SELECT EST_COD,EST_NOMBRE FROM acest WHERE EST_COD=(".$codigo.")";

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
//var_dump($registro);exit;

echo("Código: ".$registro[0]['EST_COD']);
echo('<br>Nombre: '.$registro[0]['EST_NOMBRE']);


?>
<table border="2" cellpadding="2" cellspacing="0" align="center">
<tr><th colspan="31">Notas</th></tr>
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
<th>Acu</th>
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
  FROM acins
INNER JOIN accursos ON CUR_ID=INS_GR
INNER JOIN achorarios ON HOR_ID_CURSO=CUR_ID
INNER JOIN acest ON EST_COD=INS_EST_COD
INNER JOIN acasi ON ASI_COD=INS_ASI_COD
INNER JOIN acasperi ON APE_ANO=INS_ANO AND APE_PER=INS_PER
LEFT OUTER JOIN acnotobs ON NOB_COD=INS_OBS
LEFT OUTER JOIN accargas ON CAR_HOR_ID=HOR_ID
LEFT OUTER JOIN acdocente ON DOC_NRO_IDEN=CAR_DOC_NRO
WHERE HOR_ESTADO='A'
AND APE_ESTADO='A'
AND EST_COD IN (".$codigo.")
ORDER BY INS_ANO,INS_PER,INS_EST_COD,INS_ASI_COD,CUR_CRA_COD||'-'||CUR_GRUPO";
//echo $consultar_registros;
$cadenaParser = OCIParse($conectado,$consultar_registros);

$busqueda=OCIExecute($cadenaParser);

if ($busqueda) {
        while ($tabla=oci_fetch_array($cadenaParser, OCI_BOTH)){
                $datos[]=$tabla;
        }
}
//var_dump($datos);

foreach($datos AS $dato){
$COD_ESPACIO=$dato["COD_ESPACIO"];
$NOMBRE_ESPACIO=$dato["NOMBRE_ESPACIO"];

$COD_EST=$dato["COD_EST"];
$NOMBRE_ESTUDIANTE=$dato["NOMBRE_ESTUDIANTE"];
$OBS=isset($dato["OBS"])?$dato["OBS"]:'';
$ANO=$dato["ANO"];
$PERIODO=$dato["PERIODO"];
$PPAR=isset($dato["PPAR"])?$dato["PPAR"]:'';
$NOTA_PAR1=isset($dato["NOTA_PAR1"])?$dato["NOTA_PAR1"]:'';
$PPAR2=isset($dato["PPAR2"])?$dato["PPAR2"]:'';
$NOTA_PAR2=isset($dato["NOTA_PAR2"])?$dato["NOTA_PAR2"]:'';
$PPAR3=isset($dato["PPAR3"])?$dato["PPAR3"]:'';
$NOTA_PAR3=isset($dato["NOTA_PAR3"])?$dato["NOTA_PAR3"]:'';
$PPAR4=isset($dato["PPAR4"])?$dato["PPAR4"]:'';
$NOTA_PAR4=isset($dato["NOTA_PAR4"])?$dato["NOTA_PAR4"]:'';
$PPAR5=isset($dato["PPAR5"])?$dato["PPAR5"]:'';
$NOTA_PAR5=isset($dato["NOTA_PAR5"])?$dato["NOTA_PAR5"]:'';
$PPAR6=isset($dato["PPAR6"])?$dato["PPAR6"]:'';
$NOTA_PAR6=isset($dato["NOTA_PAR6"])?$dato["NOTA_PAR6"]:'';
$PLAB=isset($dato["PLAB"])?$dato["PLAB"]:'';
$NOTA_LAB=isset($dato["NOTA_LAB"])?$dato["NOTA_LAB"]:'';
$PEXA=isset($dato["PEXA"])?$dato["PEXA"]:'';
$NOTA_EXA=isset($dato["NOTA_EXA"])?$dato["NOTA_EXA"]:'';
$PHAB=isset($dato["PHAB"])?$dato["PHAB"]:'';
$NOTA_HAB=isset($dato["NOTA_HAB"])?$dato["NOTA_HAB"]:'';
$NOTA_DEF=isset($dato["NOTA_DEF"])?$dato["NOTA_DEF"]:'';


echo("<tr><td align=center>".$COD_ESPACIO."</td>");
echo("<td>".$NOMBRE_ESPACIO."</td>");

echo("<td>".$ANO);
echo("-".$PERIODO."</td>");
echo("<td align=center>".$PPAR."</td>");
echo("<td align=center>".$NOTA_PAR1."</td>");
echo("<td align=center>".$PPAR2."</td>");
echo("<td align=center>".$NOTA_PAR2."</td>");
echo("<td align=center>".$PPAR3."</td>");
echo("<td align=center>".$NOTA_PAR3."</td>");
echo("<td align=center>".$PPAR4."</td>");
echo("<td align=center>".$NOTA_PAR4."</td>");
echo("<td align=center>".$PPAR5."</td>");
echo("<td align=center>".$NOTA_PAR5."</td>");
echo("<td align=center>".$PPAR6."</td>");
echo("<td align=center>".$NOTA_PAR6."</td>");
echo("<td align=center>".$PLAB."</td>");
echo("<td align=center>".$NOTA_LAB."</td>");
echo("<td align=center>".$PLAB."</td>");
echo("<td align=center>".$PEXA."</td>");
echo("<td align=center>".$NOTA_EXA."</td>");
echo("<td align=center>".$PHAB."</td>");
echo("<td align=center>".$NOTA_HAB."</td>");
echo("<td align=center>".$NOTA_DEF."</td>");
echo("<td align=center>".$OBS."</td></tr>");

}

} else {
        $datos = array('No se ingresó ningún código');
}
?>
</table>

 
</body>

</html>
