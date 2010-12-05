<?php
/**
 * Fechas
 * PHP version 5
 * LICENSE
 *
 * This source file is subject to the GNU/GPL that is bundled
 * with this package in the file docs/LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to fidel.oyarzo@gmail.com so we can send you a copy immediately.
 *
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
////////////////////////////////////////////////////
//Convierte fecha de mysql a normal
////////////////////////////////////////////////////
function fsalida($fecha, $sw=FALSE){
	if(isset($fecha)){
		$afecha = explode(' ', $fecha);
		$fecha = str_replace("-","/",$afecha[0]);
	    list($anio,$mes,$dia)=explode("/",$fecha);
	    $hora = '';
	    if($sw) if($afecha[1]) $hora = $afecha[1];
	    return trim($dia)."/".trim($mes)."/".trim($anio) . ' ' . $hora;
	}
}  
////////////////////////////////////////////////////
//Convierte fecha de normal a mysql
////////////////////////////////////////////////////
function fentrada($fecha){
	if(!empty($fecha)){
		$fecha = str_replace("-","/",$fecha);
	    list($dia,$mes,$anio)=explode("/",$fecha);
	    return trim($anio)."/".trim($mes)."/".trim($dia);
	}
}  
/**
 * $f1="30/01/1993";
 * $f2="30-01-1992";
 * if (compara_fechas($f1,$f2) <0)
 *       echo "$f1 es menor que $f2 <br>";
 * if (compara_fechas($f1,$f2) >0)
 *       echo "$f1 es mayor que $f2 <br>";
 * if (compara_fechas($f1,$f2) ==0)
 *       echo "$f1 es igual  que $f2 <br>";
 */
function compara_fechas($fecha1,$fecha2){
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
		list($dia1,$mes1,$año1)=split("/",$fecha1);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
		list($dia1,$mes1,$año1)=split("-",$fecha1);
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
		list($dia2,$mes2,$año2)=split("/",$fecha2);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
		list($dia2,$mes2,$año2)=split("-",$fecha2);
	$dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
	return ($dif);
}
function restar_horas($hora_ini, $hora_fin){
    return (date("H:i:s", strtotime("00:00:00") + strtotime($hora_fin) - strtotime($hora_ini) ));
}
?>