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
?>
<?php
class Controllers extends ActiveRecord
{
//	public $debug = true;
    public function initialize()
    {
        //Relaciones
        $this->belongs_to('perfiles');
        $this->belongs_to('menus', 'fk: menus_id');
    }
    /**
     * Obtiene el menu de acuerdo al perfil
     * @return array()
     */
    public function getMenu(){
	$perfiles_id		=	Load::model('sesiones')->getData('perfiles_id');
	$sql = "SELECT distinct menus.id, menus.nombre, menus.orden FROM controllers 
		inner join menus on menus.id = controllers.menus_id
		WHERE controllers.perfiles_id = $perfiles_id
		 ORDER BY menus.orden";
    	return $this->find_all_by_sql($sql);
    }
    /**
     * Obtiene el Menu
     * @return array()
     */
    public function getSubMenu($menus_id)
    {
	$perfiles_id	=	Load::model('sesiones')->getData('perfiles_id');
    	$criterio	=	"perfiles_id = $perfiles_id and menus_id = $menus_id and status = 'A'";
	unset($what);
        return $this->find($criterio, 'order: orden');
    }
    public function getSubMenu2($controller_id){
	$sql = "SELECT id, url, nombre, orden FROM sub_menus 
		WHERE controllers_id = $controller_id
		 ORDER BY orden";
    	return $this->find_all_by_sql($sql);	
    }
    /**
     *Metodo utilizado para llenar un select de la creacion de los sub menus
     */
    public function getMenusFlotantes($id){
	return $this->find("menus_id = $id and url = '.'", "order: nombre");
    }
}