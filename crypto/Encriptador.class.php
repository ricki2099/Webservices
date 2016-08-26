<?php

/**
 * IMPORTANTE: La frase de seguridad predeterminada debe cambiarse antes instalar el aplicativo. Cambiarla después puede dejar
 * inservible la instalación si esta depende de variables codificadas con la clave anterior 
 * (p.e. si se guardaron datos codificados en la base de datos o en config.inc.php).
 * 
 * 
 * @todo Mejorar la clase para que acepte otras semillas. 
 * 
 */
require_once ("aes.class.php");
require_once ("aesctr.class.php");
class Encriptador {
	private static $instance;
	private $llave;
	private $iv;
	//Se requiere una semilla de 16, 24 o 32 caracteres
	const SEMILLA = '6cHp/6qmJ!Y!$Q/L';
	
	// Constructor
	function __construct($llave = '') {
		if ($llave === '') {
			// Llave predeterminada
			$this->llave = self::SEMILLA;
		} else {
			$this->llave = $llave;
		}
		
	}

	public static function singleton() {
		if (! isset ( self::$instance )) {
			$className = __CLASS__;
			self::$instance = new $className ();
		}
		return self::$instance;
	}
	
	function decodificar($cadena) {
		
		$cadena=$this->base64url_decode($cadena);
		if (function_exists ( 'mcrypt_decrypt' )) {
			$cadena =  mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, $this->llave, $cadena , MCRYPT_MODE_ECB ) ;
		} else {
			$cadena = AesCtr::decrypt ( $cadena , $this->llave, 256 );
		}
		$cadena=trim($cadena);
		return $cadena;
	}
	
	/**
	 *
	 * Método para decodificar la cadena GET para obtener las variables de la petición
	 *
	 * @param
	 *        	$cadena
	 * @return boolean
	 */
	function decodificar_url($cadena) {
		$cadena = $this->decodificar ( $cadena );
		
		parse_str ( $cadena, $matriz );
		
		foreach ( $matriz as $clave => $valor ) {
			$_REQUEST [$clave] = $valor;
		}
		
		return true;
	}

	function base64url_decode($data) {
                return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
        }
}

?>
