<?php

require_once ('Vista.php');

/** 
 * @author giccelle
 * 
 * 
 */
class vFormularioIngresar extends Vista {
	//TODO - Insert your code here
	

	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		//TODO - Insert your code here
	}
	
	/**
	 * 
	 */
	function __destruct() {
		
	//TODO - Insert your code here
	}
	
	public function ver(){
		$this->display('ingreso.tpl');
	}
}

?>