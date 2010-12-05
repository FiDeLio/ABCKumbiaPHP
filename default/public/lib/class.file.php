<?php

class File {
	
	/**
	 * variable de archivo
	 *
	 * @var string
	 */
	var $file;
	
	/**
	 * variable de ruta
	 *
	 * @var string
	 */
	var $rootFile;
	
	/**
	 * 
	 */
	function File($file = '') {
		
		$this->file = $file;
		$this->rootFile = $_SERVER['DOCUMENT_ROOT'].'/admin/';
		
	//TODO - Insert your code here
	}
	
	
	/**
	 * devuelve el nombre del archivo
	 *
	 * @param File $file
	 * @return string
	 */
	function nameFile($file){
		
		$f = explode("/",$file);
		$f = explode("\\",end($f));
		return end($f);
		
	}
	
	/**
	 * funcion sube archivo al servidor
	 *
	 * @param File $file
	 * @param File $folder
	 * @param File $nombreArchivo
	 * @return booleano
	 */
	function UploadFile($file, $folder, $nombreArchivo){
		
		
		$directorio = $this->rootFile.$folder."/";
		if (!$this->ExisteFolder($folder)){
			$this->CreateFolder($folder);
		}

			if (is_uploaded_file($file["tmp_name"])){
				
				if (!move_uploaded_file($file["tmp_name"], $directorio.$this->nameFile($nombreArchivo))){
					
					return false;
					
				}else {
					
					return true;
					
				}
			}else {
				
				return false;
				
			}
		
		
	}
	
	function UploadFile1($file, $folder, $nombreArchivo){
		
		
		$directorio = $this->rootFile.$folder."/";
		if (!$this->ExisteFolder($folder)){
			$this->CreateFolder($folder);
		}
		
		
			if (is_uploaded_file($file)){
				
				if (!move_uploaded_file($file, $directorio.$this->nameFile($nombreArchivo))){
					
					return false;
					
				}else {
					
					return true;
					
				}
			}else {
				
				return false;
				
			}
		
		
		
		
	}
	
	
	
	/**
	 * Enter description here...
	 *
	 * @param File $folder
	 * @return booleano 
	 */
	function ExisteFolder($folder){
		
		return is_dir($this->rootFile.$folder);
		
	}
	
	/**
	 * funcion para crear carpeta
	 *
	 * @param File $folder
	 * @return booleano
	 */
	function CreateFolder($folder){
		
		return mkdir($this->rootFile.$folder,0777);
		
	}
	
	function ExisteFile($folder, $file){
		
		return file_exists($this->rootFile.$folder."/".$this->nameFile($file));
		
	}
	
	/**
	 * funcion para borrar archivo
	 *
	 * @param File $file
	 * @param File $folder
	 */
	function DeleteFile($file, $folder){
		
		return @unlink($this->rootFile.$folder."/".$this->nameFile($file));
		
			
	}
	
	/**
	 * funcion para recortar imgen
	 *
	 * @param File $file
	 * @param File $folder
	 * @param File $alto
	 * @param File $ancho
	 * @param File $newFolder
	 * @param File $newFile
	 */
	function imageResize($file, $folder, $alto, $ancho, $newFolder, $newFile){
		
		ini_set("memory_limit", "68M");
		if (!$this->ExisteFolder($folder)){
			$this->CreateFolder($folder);
		}
	
		//$handle = imagecreatefromjpeg($file);
		
		$handle = imagecreatefromjpeg($this->rootFile.$folder.'/'.$this->nameFile($file));
		$x = imagesx($handle);
		$y = imagesy($handle);
		
		if ( $x > $y ){
			$max = $x;
			$min = $y;
		}
		
		if ( $x <= $y ){
			$max = $y;
			$min = $x;
		}
		
		if ( $alto > $ancho ){
			$size_in_pixel = $alto;
		}else {
			$size_in_pixel = $ancho;
		}
		
		$rate = $max/$size_in_pixel;
		$final_x = $x/$rate;
		$final_y = $y/$rate;
		
		if ( $final_x > $x ){
			$final_x = $x;
			$final_y = $y;
		}
		
		$final_x = ceil($final_x);
		$final_y = ceil($final_y);
		
		$black_picture = imagecreatetruecolor($final_x,$final_y);
		imagefill($black_picture, 0, 0, imagecolorallocate($black_picture, 255, 255, 255));
		imagecopyresampled($black_picture, $handle, 0, 0, 0, 0, $final_x, $final_y, $x, $y);
		
		if (!@imagejpeg($black_picture, $this->rootFile.$newFolder."/".$this->nameFile($newFile))){
			imagestring($black_picture, 1, $final_x-4, $final_y-8, ".", imagecolorallocate($black_picture, 0, 0, 0));
			trigger_error("no es posible cargar imagen", E_USER_WARNING);
		}
		
		imagedestroy($handle);
		imagedestroy($black_picture);
	}
	
	/**
	 * @return string
	 */
	function getFile() {
		return $this->file;
	}
	
	/**
	 * @return string
	 */
	function getRootFile() {
		return $this->rootFile;
	}
	
	/**
	 * @param string $file
	 */
	function setFile($file) {
		$this->file = $file;
	}
	
	/**
	 * @param string $rootFile
	 */
	function setRootFile($rootFile) {
		$this->rootFile = $rootFile;
	}

	
	
}

?>