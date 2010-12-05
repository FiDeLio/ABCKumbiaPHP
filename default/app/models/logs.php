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
class Logs extends ActiveRecord{
    //public $debug=TRUE;
    public function initialize(){
        $this->belongs_to('usuarios');
        $this->belongs_to('perfiles');
    }
    public function getLogs($fecha){
        Load::lib('date');
        $fecha = fentrada($fecha);
        $sql = "SELECT usuarios.id AS id,
                usuarios.nombres AS nombres,
                usuarios.apellidos AS apellidos,
                perfiles.nombre AS perfil,
                logs.ip AS ip,
                logs.url as url,
                DATE_FORMAT(logs.fecha_at, '%d-%m-%Y') AS fecha_ini,
                DATE_FORMAT(logs.fecha_at, '%H:%i:%s') as hora_ini,
                DATE_FORMAT(logs.fecha_in, '%d-%m-%Y') AS fecha_fin,
                DATE_FORMAT(logs.fecha_in, '%H:%i:%s') as hora_fin,
                SUBTIME(DATE_FORMAT(logs.fecha_in, '%H:%i:%s'),
                DATE_FORMAT(logs.fecha_at, '%H:%i:%s')) as duracion from logs
                inner join usuarios on usuarios.id = logs.usuarios_id
                inner join perfiles on perfiles.id = usuarios.perfiles_id
                where
                logs.fecha_in > '$fecha 00:00' and logs.fecha_in < '$fecha 23:59'
                ";
        return $this->find_all_by_sql($sql);
    }
}
?>