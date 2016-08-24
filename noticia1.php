<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Noticias</title>
</head>

<body>

<table border="2" cellpadding="2" cellspacing="0" align="center">

<tr><h3><th colspan="6">Noticias</th></h3></tr>
<tr>
<th>Descripción</th>
<th></th>
<th></th>


</tr>

<?php
require("conexion_servidor_bd.php");
$consultar_registros="SELECT * FROM noticia;";
$registros=mysql_db_query("l6000018_nereo",$consultar_registros,$conectado);
$totalregistros=mysql_num_rows($registros);
for ($contador=0;$contador<$totalregistros;$contador++)
{
$nit=mysql_result($registros,$contador,"id_noticia");
$empresa=mysql_result($registros,$contador,"nombre");
$direccion=mysql_result($registros,$contador,"descripcion");

$enlace=mysql_result($registros,$contador,"enlace");
$telefono=str_replace ( "[", "<a id='enlaceinterno' href='" . $enlace. "' target='_blank'>", $descrip.' [ver más...]' );

$ciudad= mysql_result($registros,$contador,"fecha_fin");
$credito=mysql_result($registros,$contador,"imagen");

?>

<?php
echo("<td>".$empresa." ");
echo(" ".$direccion."<br>");
echo(" ".$telefono." ");
echo(" ".$ciudad."</td></tr>");

}
?>

</table>

</body>

</html>
</body>
</html>