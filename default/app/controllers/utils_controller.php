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
//Load::model('smtp_server');
//Load::model('modelo');
//Load::model('notificaciones');
//Load::model('tareas');

class UtilsController extends ApplicationController{
    public function index(){
        View::response('view');
        $config         =   Config::read("config");
        $date_month     =   date('m');
        $date_year      =   date('Y');
        $date_day       =   date('d');
        $Date           =   "$date_year-$date_month-$date_day";
        $this->filename =   "mydb_$Date.sql";
        $databases      =   Config::read("databases");
        $username       =   $databases[$config['application']['database']]['username'];
        $password       =   $databases[$config['application']['database']]['password'];
        $name           =   $databases[$config['application']['database']]['name'];
        $this->executa  =   "mysqldump -u $username --password=$password --opt $name";
    }
    public function logs(){
        Flash::info('Logs del sistema. Fecha hora: ' . date("d-m-Y H:m:s"));
        //Dialog::error('Hola Mundo');
        $this->fecha    =   date('d-m-Y');
        $this->items    =   array();
        if(Input::hasPost('fecha')){
            $fecha          =   Input::post('fecha');
            $this->items    =   Load::model('logs')->getLogs($fecha);
            //$this->items    =   Load::model('vlogs')->find("fecha_in = '" . "$fecha" . "'");
            $this->fecha    =   Input::post('fecha');
        }
    }
    public function logger($file=null){
        $this->data     =   array();
        $this->lists    =   Load::model('tools/logger')->lists();
        if($file!=null){
            $this->data =   Load::model('tools/logger')->filtrar($file);
        }
    }
    public function userInfo($id=null){
        if($id==null){
            Flash::warning('Usuario no encontrado');
        }else{
            if($this->usuarios   =   Load::model('usuarios')->find($id)){
                Flash::info('Datos del usuario');
            }else{
                Flash::warning('Usuario no encontrado');
            }
        }
    }
    public function entradasInfo($id=null){
        if($id==null){
            Flash::warning('Usuario no encontrado');
        }else{
            if($this->usuarios   =   Load::model('usuarios')->find($id)){
                Load::lib('date');
                Flash::info('Datos del usuario');
                $this->items   =   Load::model('logs')->find("usuarios_id = $id", "order: id desc");
            }else{
                Flash::warning('Usuario no encontrado');
            }
        }        
    }
    /**
     *Configuración para el envio de correos mediante phpmailer
     */
    public function smtpServer(){
        Flash::info('Cuenta SMTP');
        $server           =  new SmtpServer();
        $this->servidor   =  $server->find_first();
        $old              =  $this->servidor->password;
        $this->servidor->password = '';
        if(Input::hasPost('servidor')){
            $data   =   Input::post('servidor');
            if($data['password']==''){
               $data['password'] = $old; 
            }
            Modelo::input('smtp_server.save', $data);
            $this->servidor     =   Input::post('servidor');
        }
    }
    /**
     *cambia el estado de una notificacion, por se presiono el boton cerrar
    */
    public function notify(){
        View::response('view');
        View::select(NULL);
        $array_m    =   explode('.-', Input::post('m'));
        $notificaciones =   new Notificaciones();
        $notificaciones->updateStatus((int)$array_m[0]);
    }
    /**
     *Muestra un listado de tareas pendientes y/o finalizadas
    */
    public function tareas(){
        Flash::info('Tareas pendientes');
        $tareas         =   new Tareas();
        $this->items    =   $tareas->find();
    }
    /**
     *Formulario para crear tareas
    */
    public function createTareas(){
        Flash::info('Nuevas Tareas');
        if(Input::hasPost('tareas')){
            Modelo::input('tareas.create', Input::post('tareas'));
        }
    }    
}
?>