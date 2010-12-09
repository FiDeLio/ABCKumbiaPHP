<?php
/**
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
class SubMenus extends ActiveRecord{
    protected function initialize(){
        $this->belongs_to('controllers');
    }
}
?>
