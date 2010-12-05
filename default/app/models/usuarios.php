<?php
/**
 *
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
Load::model('sesiones');
class Usuarios extends ActiveRecord{
    protected function initialize(){
        $this->belongs_to('perfiles');
    }
    public function changePassword($data){
        if($data){
            $usuario		=	Load::model('usuarios')->find(Load::model('sesiones')->getData('usuarios_id'));
            if(sha1($data['old'])!=$usuario->password){
                Flash::warning('Clave actual no corresponde, intente nuevamente');
            }elseif($data['new']!=$data['rep']){
                Flash::warning('Clave nueva no son iguales, intente nuevamente');
            }elseif(empty($data['new']) or empty($data['rep'])){
                Flash::warning('La clave nueva no puede ser vac&iacute;a o en blanco');
            }else{
                $usuario->password = sha1($data['new']);
                if($usuario->update()){
                    Flash::success('Clave cambiada con &eacute;xito!!');
                }else{
                    Flash::error('Error al intentar de cambiar la clave, intente con una nueva clave');
                }
            }
        }        
    }
    /**
     *Obtengo una lista de usuarios
     *Activos o Desactivos segun su critorio
     */
    public function getUsuarios($status=null){
        if($status != null){
            $conditions = "where status = '$status'";
        }
        $sql = "select id, concat_ws(' ', apellidos, nombres) as nombres from
        usuarios $conditions order by apellidos";
        return $this->find_all_by_sql($sql);
    }
}
?>