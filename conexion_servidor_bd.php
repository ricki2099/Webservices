<?php

require_once ("crypto/Encriptador.class.php");
require_once ("crypto/aes.class.php");
require_once ("crypto/aesctr.class.php");

$cripto = Encriptador::singleton ();

$usuario = $cripto->decodificar('XuqbQE5fJClCrh_7S0V03LtYUh4m-JVtMKpigK_I_7U','');
$clave = $cripto->decodificar('pxo0glo8SHotPar6mWviY8npzt1F4tCsDVy4lIv-1AY','');
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

