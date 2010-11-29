<?php
require_once '../lib/Configuracion.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/objetos/vista/vFormularioIngresar.php';
require_once '../lib/objetos/modelo/Formulario.php';
require_once '../lib/class.file.php';
/** 
 * @author giccelle
 * 
 * 
 */
class index {
	//TODO - Insert your code here
	
	private $_accion;

	function __construct() {
		$this->_accion = ((isset($_REQUEST['accion'])) ? $_REQUEST['accion'] : '');
		switch ( $this->_accion ) {
			case 'ingresar':
				$this->ingresar();
			default:
				$this->cIndex();
		}
	//TODO - Insert your code here
	}
	
	/**
	 * 
	 */
	function __destruct() {
		
	//TODO - Insert your code here
	}
	
	public function cIndex(){
		try {
			
			
			
			$oVista = new vFormularioIngresar();
			$oVista->ver();
			
		} catch (Exception $e) {
			echo $e->getMessage();
		} 
	}
	
	public function ingresar(){
		$oFormulario = new Formulario();
			
			$oFormulario->setEmpresa($_POST["empresa"]);
			$oFormulario->setSku($_POST["sku"]);
			$oFormulario->setSerie($_POST["serie"]);
			$oFormulario->setLote($_POST["lote"]);
			$oFormulario->setDescripcion($_POST["descripcion"]);
			$oFormulario->setImagen($_FILES["imagen"]["name"]);
			$oFormulario->setCalidad($_POST["calidad"]);
			$oFormulario->setFamilia($_POST["familia"]);
			$oFormulario->setPalabra($_POST["palabra"]);
			
			$oFormulario->insert();
			
			$F = new File();
			
			$F->UploadFile($_FILES["imagen"],'archivos',$_FILES["imagen"]["name"]);
			
			header("Location: respuesta.php");
	}
}
$oIndex = new index();
?>