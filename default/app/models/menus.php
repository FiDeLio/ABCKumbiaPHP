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
class Menus extends ActiveRecord
{
    //public $debug=true;
    protected function initialize()
    {
        //Relaciones
        $this->belongs_to('perfiles');
        $this->belongs_to('submenus');
    }
    public function createAndOrder($items, $nombre){
        $i=1;
        foreach($items as $v => $k):
            if($v>0){
                $this->find($v);
                $this->orden = $i;
                $this->update();
            }else{
                if(!empty($nombre)){
                    $this->nombre = $nombre;
                    $this->orden = $i;
                    $this->create();
                }
            }
            $i++;
        endforeach;
    }
}