<?php
/**
 * Modelo Documentos
 * 
 * @category app
 * @package models
 */
class Documentos extends ActiveRecord
{
    public $logger = true;
    /**
     * Obtiene un array de ciudades
     * @param char
     * @return array()
     */
    public function distinctCiudades(){
            $criterio	=	'';
            if(!$carteras=Load::model('carteras')->carteraActiva()){
                    Flash::warning("No existe cartera activa para esta empresa");
                    return array();
            }
            $sql = "select distinct (ciudes) as id, ciudes from documentos where carteras_id = $carteras->id order by ciudes";
            return $this->find_all_by_sql($sql);
    }
	/**
	 * Core de las consultras a las carteras
	 * parametros
	 * 0 => type (ciudad, rut, cancelado ...)
	 * @param $what
	 * @return array()
	 */
	public function getDoc($conditions, $value){
		$criterio		=	'';
		if($conditions 	== 'RUT'){
			$criterio	=	"(rut = '{$value}' or folfiscal = '{$value}')";
		}elseif($conditions == 'CIUDAD'){
			$criterio	=	"ciudes = '{$value}'";
		}elseif($conditions == 'TRAMOS'){
			if($what['tramos']==0){
				$ini	=	1;
				$fin	=	30;
			}elseif($what['tramos']==1){
				$ini	=	31;
				$fin	=	60;
			}elseif($what['tramos']==2){
				$ini	=	61;
				$fin	=	90;
			}elseif($what['tramos']==3){
				$ini	=	91;
				$fin	=	120;
			}elseif($what['tramos']==4){
				$ini	=	121;
				$fin	=	150;
			}elseif($what['tramos']==5){
				$ini	=	151;
				$fin	=	180;
			}elseif($what['tramos']==6){
				$fin	=	180;
			}elseif($what['tramos']==7){
				$ini	=	0;
				$fin	=	500;
			}
			if($what['tramos']==6){
				$criterio	=	"tramonormal > \"$fin\" AND orifac = \"{$what['orifac']}\"  AND (estados_id = 10 or estados_id = 14)";
			}else{
				$criterio	=	"tramonormal BETWEEN \"$ini\" AND \"$fin\" AND orifac = \"{$what['orifac']}\" AND (estados_id = 10 or estados_id = 14)";
			}
		}elseif($conditions == 'ESTADOS'){
			$criterio	=	"estados_id = {$what['estados_id']}";
		}elseif($conditions == 'USUARIOS'){
			if($what['fecha']!=''){
				Load::lib('date');
				$fecha		=	fentrada($what['fecha']);
				$criterio	=	"fecmod BETWEEN \"$fecha 00:00\" AND \"$fecha 23:59\" AND usuarios_id = {$what['usuarios_id']} ";
			}else{
				Flash::warning('Seleccione una fecha v&aacute;lida');
				return array();
			}
		}else{
			Flash::error('Error para obtener un criterio, consulte con su administrador');
			return array();			
		}
		$carteras       =   Load::model('carteras')->carteraActiva();
		$criterio	.=  " and carteras_id = $carteras->id";
		return $this->find($criterio, 'order: nombredeudor, tramonormal desc');
	}
        public function changeStatus($id, $t){
            $this->find($id);
            $this->ticket = $t;
            $this->update();
        }
}