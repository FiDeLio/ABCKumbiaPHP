<?php


class Modelo{


	private $conexion;
	private $link = true;
	private $debug = true;
	private $results;
	private $sUser;
	
	function __construct(){
	
		$this->conexionDB();
	}
	
	function __destruct(){
	
	
	}
	
	public function conexionDB($dbUrl=Configuracion::DB_URL,$dbUsr=Configuracion::DB_USR,$dbPss=Configuracion::DB_PSS,$dbSqm=Configuracion::DB_SQM){
	
		$this->conexion = mysql_connect($dbUrl,$dbUsr,$dbPss,$dbSqm);
		
		if ( !$this->conexion ){
			if ($this->debug){
				exit('Error al <p>conectar</p> a la base de datos <br/>');			
			}
		}
		if ($dbSqm != ''){
			if(!@mysql_select_db($dbSqm,$this->conexion)){
				if($this->debug){
					exit('Error al <p>selccionar</p> la base de datos <br/>');
				}
			}
		}
		
	
	}
	
	public function mssqlQuery( $query='',$tipoQuery ){
		
		$array = NULL;
		if (!empty($query)){
			$salida = mysql_query($query,$this->conexion);
			$this->results = $salida;
			if(!$salida){
				if ($this->debug){
					exit("Error al realizar la consulta :<br /> $query <br />" );
				}
				$array = false;
			} else {
				switch ($tipoQuery){
					case 0:	$array = true;
							break;
					case 1:	while ( $row = @mysql_fetch_assoc($salida) ){  
								$array[] = $row;
							}
							break;
					case 2:	while ( $row = @mysql_fetch_row($salida)){
								$array[] = $row;
							}
							break;
					case 3:	while ( $row = @mysql_fetch_array($salida)){
								$array[] = $row;
							}
							break;
					default:
							while ( $row = @mysql_fetch_assoc($salida)){
								$array[] = $row;
							}
											
				}
			}			
		}
		return $array;	
	}
	
	public function numRows(){
		return @mysql_num_rows($this->results);
	}
		
	public function close(){
		return @mysql_close($this->conexion);		
	}
		
}