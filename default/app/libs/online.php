<?php
/**
 * Online
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
class Online{
    public function __construct(){
    }
    static  function setUser(){
        Load::model('logs');
        $lastid                  =      Load::model('sesiones')->getData('logs_id');
        $rec                     =      new Logs();
        $rec->find($lastid);
        $rec->usuarios_id        =      Load::model('sesiones')->getData('usuarios_id');
        $rec->perfiles_id        =      Load::model('sesiones')->getData('perfiles_id');
	$rec->url		 =	Router::get('route');
        $rec->ip                 =      $_SERVER['REMOTE_ADDR'];
        $rec->save();
        if($rec->id!=0)
            Load::model('sesiones')->setData('logs_id', $rec->id);
    }
}
?>
