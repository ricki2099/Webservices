<?php

$usuario = 'westudiante';
$clave = 'KUALALUMPUR2013TKC';
$servidor = '10.20.0.36';
$puerto = '1521';
$db = 'SUDD';
//echo $usuario.'<br>'.$clave.'<br>'.$servidor . ':' . $puerto . '/' . $db.'<br>'.'UTF8';
 $conectado = oci_connect ( $usuario, $clave, $servidor . ':' . $puerto . '/' . $db, 'UTF8');
 /*if($conectado) {
     return $enlace;
 } else {
     $error =oci_error();
 }*/

