<?php
/**
 * ActiveRecord
 *
 * Esta clase es la clase padre de todos los modelos
 * de la aplicacion
 *
 * @category Kumbia
 * @package Db
 * @subpackage ActiveRecord
 */

// Carga el active record
Load::coreLib('kumbia_active_record');

class ActiveRecord extends KumbiaActiveRecord {
        public function input($method, $data, $msg=TRUE){
        try{
		if($method=='delete'){
			$this->find($data);
		}elseif($method=='update'){
			$this->find($data['id']);
		}
	        if($this->$method($data)){
			foreach($this->fields as $field) {
			    if (isset($data[$field])) {
			        $this->$field = $data[$field];
			    }
                }
                if($msg){
                       Flash::success('Operación exitosa!!!');
                }
                return true;
            }
            return false;
        } catch (Exception $e) {
            if(strstr($e, 'Duplicate entry')){
                Flash::error('Existen datos duplicados');
            }elseif(strstr($e, 'FOREIGN KEY')){
                $array_relations    =   explode('`', $e);
                Flash::error('Existen datos relacionados FK: ' . $array_relations[5]);
                Logger::warning($e);
            }else{
                //Load::lib('mail');
                //Mail::sendMailAdmin($e, $model_method);
                Logger::custom('MODELO', $e);
		Flash::error($e);
            }
            return false;
        }
    }
}
