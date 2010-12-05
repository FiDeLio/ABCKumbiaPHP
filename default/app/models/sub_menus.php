<?php
/**
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
?>
<?php 
class SubMenus extends ActiveRecord{
    protected function initialize(){
        $this->belongs_to('controllers');
    }
}
?>