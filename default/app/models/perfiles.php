<?php
/**
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
class Perfiles extends ActiveRecord{
    protected function initialize(){
        $this->belongs_to('usuarios');
    }
}
?>
