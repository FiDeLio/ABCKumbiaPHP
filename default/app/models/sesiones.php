<?php
/**
 * Solicitudes & ordenes de compra
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
class Sesiones extends ActiveRecord{
    //public $debug = true;
    public $s_username =   '';
    final protected function initialize(){
        $this->s_username   =   session_id();
    }
    public function exist(){
        if($this->count("conditions: username = '$this->s_username'")>0){
            $perfiles_id    =   $this->getData('perfiles_id');
            $url = Router::get('controller');
            /*if(Load::model('controllers')->find("perfiles_id = $perfiles_id and url like '$url%'")){
                return true;
            }else{
                return false;
            }*/
            return true;
        }else{
            return false;
        }
    }
    public function setData($key, $value){
        if($item            =   $this->find_first("username = '$this->s_username' and k = '$key'")){
            $sw             =   false;
            $this->id       =   $item->id;
        }else{
            $sw             =   true;
            $this->k        =   $key;
        }
        $this->username     =   $this->s_username;
        $this->v            =   $value;
        //no funciona el save "siempre actualiza"
        if($sw==true){
            $this->create();
        }else{
            $this->update();
        }
    }
    public function getData($key){
        if($item = $this->find_first("username = '$this->s_username' and k = '$key'")){
            return $item->v;
        }
        return 'NULL';
    }
    public function destroy(){
        $id     =   $this->getData('usuarios_id');
        $usuarios   =   Load::model('usuarios')->find($id);
        $usuarios->online = 0;
        $usuarios->update();
        foreach($this->find("v = '$id' and k = 'usuarios_id'") as $item){
            $this->delete("username = '$item->username'");
        }
    }
}
?>