<?php
require_once '../lib/Configuracion.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/objetos/vista/vIndex.php';
require_once '../lib/objetos/modelo/Formulario.php';
require_once '../lib/objetos/modelo/class.paginador.php';
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
			$oFormulario = new Formulario();
			if (isset($_GET["pagina"])){
				$pagina = $_GET["pagina"];
			}
			else {
				$pagina = 1;
			}
			$query	= $oFormulario->all();	

			$paginador = new Paginador();
			$datos		= $paginador->datosPaginador($query, Configuracion::LIMITE, $pagina, Configuracion::VENTANA);
			
	



			$ventana	= $paginador->getVentana();
			$anterior	= $paginador->getAnteriorChar();
			$siguiente	= $paginador->getSiguienteChar();
			
			$oVista = new vIndex();
			$oVista->assign("ventana",$ventana);
			$oVista->assign("anterior",$anterior);
			$oVista->assign("siguiente",$siguiente);
			$oVista->assign("datos",$datos);
			
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