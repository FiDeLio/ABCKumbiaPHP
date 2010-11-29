<?php

/** 
 * @author irojas_ex
 * 
 * 
 */
class Util {
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
	
	static function yyyymmdd($dato,$separador = "/"){
		
		$f = explode($separador,$dato);
		if ( $dato ){
			return $f[2]."-".$f[1]."-".$f[0];
		}else{
			return "";
		}
		
		
	}
	
	static function createExcel($filename, $arrydata){

		
		$excelfile = $_SERVER['DOCUMENT_ROOT']."/campana/".$filename;  
		$fp = fopen($excelfile, "wb");  
		if (!is_resource($fp)) {  
			die("Error al crear $excelfile");  
		}  
		
		fwrite($fp, serialize($arrydata));  
		fclose($fp);
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
		header ("Cache-Control: no-cache, must-revalidate");  
		header ("Pragma: no-cache");  
		header ("Content-type: application/x-msexcel");  
		header ("Content-Disposition: attachment; filename=\"" . $filename . "\"" );
		readfile($excelfile);
		
	}
}

?>