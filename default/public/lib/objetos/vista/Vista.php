<?php

/** 
 * @author irojas_ex
 * 
 * 
 */
class Vista extends Smarty {
	//TODO - Insert your code here
	
		
	function __construct() {
		parent::Smarty();		
	//TODO - Insert your code here
		$this->template_dir = Configuracion::DIR_TEMPLATE;
		$this->compile_dir = Configuracion::DIR_TEMPLATE_C;
		$this->left_delimiter = '{{';
		$this->right_delimiter = '}}';
		$this->cache_lifetime = 10;
	}
	
	/**
	 * 
	 */
	function __destruct() {
		
	//TODO - Insert your code here
	}
	
	
	public function view($aParametros = array()){
		
		foreach ( $aParametros as $dato => $key ){
			$this->assign($key,$dato);
		}
		
	}
	
}

?>