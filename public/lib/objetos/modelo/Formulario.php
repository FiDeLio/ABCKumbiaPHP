<?php

require_once ('Modelo.php');

/** 
 * @author giccelle
 * 
 * 
 */
class Formulario extends Modelo {
	//TODO - Insert your code here
	
	private $empresa;
	private $sku;
	private $serie;
	private $lote;
	private $descripcion;
	private $imagen;
	private $calidad;
	private $familia;
	private $palabra;

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
	
	public function insert(){
		
		$sql="INSERT INTO tabla
				(empresa,
				 sku,
				 serie,
				 lote,
				 descripcion,
				 imagen,
				 calidad_total,
				 familia,
				 palabra_clave)
				 VALUES
				 ( '".$this->empresa."'
				 ,'".$this->sku."'
				 ,'".$this->serie."'
				 ,'".$this->lote."'
				 ,'".$this->descripcion."'
				 ,'".$this->imagen."'
				 ,'".$this->calidad."'
				 ,'".$this->familia."'
				 ,'".$this->palabra."' )
				 ";
		
		$this->mssqlQuery($sql,Configuracion::SQLNONE);
		
	}
	
	public function all(){
		$sql = "SELECT 
					idTabla
					,empresa
					,sku
					,serie
					,lote
					,descripcion
					,imagen
					,calidad_total
					,familia
					,palabra_clave
				FROM tabla
				ORDER BY empresa ASC";
		
		return $sql;
	}
	
	/**
	 * @return the $empresa
	 */
	public function getEmpresa() {
		return $this->empresa;
	}

	/**
	 * @return the $sku
	 */
	public function getSku() {
		return $this->sku;
	}

	/**
	 * @return the $serie
	 */
	public function getSerie() {
		return $this->serie;
	}

	/**
	 * @return the $lote
	 */
	public function getLote() {
		return $this->lote;
	}

	/**
	 * @return the $descripcion
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	 * @return the $imagen
	 */
	public function getImagen() {
		return $this->imagen;
	}

	/**
	 * @return the $calidad
	 */
	public function getCalidad() {
		return $this->calidad;
	}

	/**
	 * @return the $familia
	 */
	public function getFamilia() {
		return $this->familia;
	}

	/**
	 * @return the $palabra
	 */
	public function getPalabra() {
		return $this->palabra;
	}

	/**
	 * @param $empresa the $empresa to set
	 */
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}

	/**
	 * @param $sku the $sku to set
	 */
	public function setSku($sku) {
		$this->sku = $sku;
	}

	/**
	 * @param $serie the $serie to set
	 */
	public function setSerie($serie) {
		$this->serie = $serie;
	}

	/**
	 * @param $lote the $lote to set
	 */
	public function setLote($lote) {
		$this->lote = $lote;
	}

	/**
	 * @param $descripcion the $descripcion to set
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	/**
	 * @param $imagen the $imagen to set
	 */
	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	/**
	 * @param $calidad the $calidad to set
	 */
	public function setCalidad($calidad) {
		$this->calidad = $calidad;
	}

	/**
	 * @param $familia the $familia to set
	 */
	public function setFamilia($familia) {
		$this->familia = $familia;
	}

	/**
	 * @param $palabra the $palabra to set
	 */
	public function setPalabra($palabra) {
		$this->palabra = $palabra;
	}

}

?>