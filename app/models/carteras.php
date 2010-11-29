<?php
class Carteras extends ActiveRecord{
    /**
     * Obtiene la cartera activa según
     * de la empresa que se esté utilizando
     * el sistema
     * @return cartera activa
     */
    public function carteraActiva(){
        $empresas_id    =   Load::model('sesiones')->getData('empresas_id');
        return $this->find_first("empresas_id = $empresas_id and status = 'A'");
    }    
}
?>