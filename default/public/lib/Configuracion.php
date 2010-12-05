<?php

/** 
 * @author irojas_ex
 * 
 * 
 */
class Configuracion {
	//TODO - Insert your code here
	
	function __construct() {
		
	//TODO - Insert your code here
	}
	
	/**
	 * 
	 */
	function __destruct() {
		
	//TODO - Insert your code here
	}
	
	/**
	 * 
	 * constante que define la lectura de los archivos
	 * de extension ".tpl"
	 * 
	 * @var string
	 */
	const DIR_TEMPLATE = './';
	
	/**
	 * 
	 * constante que define la carpeta 
	 * en la cual se almacenan los archivos 
	 * compilados que genera smarty
	 * 
	 * @var string
	 */
	const DIR_TEMPLATE_C = 'templates_c/';
	
	
	/**
	 * constante que define el servidor 
	 * de la base de datos
	 * 
	 * @var string
	 */
	const DB_URL = 'localhost';
	
	
	/**
	 * 
	 * constante que define el usuario
	 * de la base de datos
	 * 
	 * @var string
	 */
	const DB_USR = 'ptovtama_ivan';
	
	/**
	 * constante que define el password
	 * de la base de datos
	 * 
	 * @var string
	 */
	const DB_PSS = 'ivan';
	
	/**
	 * constante que define la base de datos
	 * 
	 * @var string
	 */
	const DB_SQM = 'ptovtama_prueba';
	
	/**
	 * 
	 * constantes para definir el tipo de array 
	 * en el resultado de la query
	 * 
	 * @var int
	 */
	const SQLNONE = 0;
	const SQLASSOC = 1;
	const SQLROW = 2;
	const SQLARRAY = 3;
	
	const LIMITE = 10;
	const VENTANA = 15;
	
	
}

?>