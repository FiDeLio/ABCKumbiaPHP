<?php

class Paginador extends Modelo  {

	var $todosDatos	= array();
	var $pagina		= "";
	var $totalPaginas = "";
	var $ventana	= "";
	var $limite		= "";
	var $datos		= array();
	var $totalResultados = "";
	
	function datosPaginador($query, $limite, $pagina, $ventana) {
		
		if ((!is_numeric($pagina)) || ($pagina<1)) {
			$pagina = 1;
		}
		$this->pagina				= $pagina;
		$this->ventana				= $ventana;
		$this->limite				= $limite;		
		$this->todosDatos			= $this->mssqlQuery($query,SQLASSOC);  
		$this->totalResultados		= count($this->todosDatos);
		$this->totalPaginas	 		= ceil($this->totalResultados / $this->limite);
		if (($this->pagina < 1) || ($this->pagina > $this->totalPaginas)) $this->pagina = 1;
		$queryLimite = $query . " LIMIT " . $this->limite * ($this->pagina - 1 ) . ", " . $this->limite  . "";
		
		$this->datos				=  $this->mssqlQuery($queryLimite,Configuracion::SQLASSOC);
		
				
		return $this->datos;//->getArray();	
	}
	
	function getVentana($get = '', $separador = '-'){
		$pag = "";
		$paginas = $this->totalPaginas;
		$limiteInf = ($this->pagina - $this->ventana < 1) ? 1 : ($this->pagina - $this->ventana);
		$limiteSup = ($this->pagina + $this->ventana > $paginas) ? $paginas : ($this->pagina + $this->ventana) ;
		
		for($i=$limiteInf; $i<=$limiteSup; $i++) {
			$pag = $pag."<a href=\"".$_SERVER["SCRIPT_NAME"]."?pagina=$i";	
			if ($get != '') {
				$pag .= "&amp;$get";
			}
			$pag .= "\">";
			if ($this->pagina == $i) {
				$pag .= "<b>";
			}
			$pag .=	"$i";
			if ($this->pagina == $i) {
				$pag .= "</b>";
			}
			$pag .= "</a>";
			if($i <= $limiteSup -1)
				$pag = $pag." ".$separador." ";
		}
		return $pag;
	}
	
	function getTodosDatos () {
		return $this->todosDatos;
	}
	
	function getAnteriorImagen($dirImagen, $width='', $height='', $get = '') {
		if ($this->pagina > 1) {
			$pagina = $this->pagina - 1;
			$link = "<a href=\"".$_SERVER["SCRIPT_NAME"]."?pagina=".$pagina;
			if ($get != '') {
				$link .= "&amp;$get";
			}
			$link .= '"><img src="'.$dirImagen.'" alt="Anterior" width="'.$width.'" height="'.$height.'" border="0" /></a>';
			return $link;
		}
		else return "&nbsp;";
	}

	function getSiguienteImagen($dirImagen, $width='', $height='', $get = '') {
		if ($this->pagina < $this->totalPaginas) {
			$pagina = $this->pagina + 1;
			$link = '<a href="'.$_SERVER["SCRIPT_NAME"].'?pagina='.$pagina;
			if ($get != '') {
				$link .= "&amp;$get";
			}
			$link .= '"><img src="'.$dirImagen.'" alt="Siguiente" width="'.$width.'" height="'.$height.'" border="0" /></a>';
			return $link;
		}
		else return "&nbsp;";
	}	

	
	function getAnteriorChar($char = '<<', $get = '') {
		if ($this->pagina > 1) {
			$pagina = $this->pagina - 1;
			$link = '<a href="'.$_SERVER["SCRIPT_NAME"].'?pagina='.$pagina;
			if ($get != '') {
				$link .= "&amp;$get";
			}
			$link .= '">'.$char.'</a>';
			return $link;
		}
		else return "&nbsp;";
	}	
	
	function getSiguienteChar($char = '>>', $get = '') {
		if ($this->pagina < $this->totalPaginas) {
			$pagina = $this->pagina + 1;
			$link = '<a href="'.$_SERVER["SCRIPT_NAME"].'?pagina='.$pagina;
			if ($get != '') {
				$link .= "&amp;$get";
			}
			$link .= '">'.$char.'</a>';
			return $link;
		}
		else return "&nbsp;";
	}	
	
}


?>