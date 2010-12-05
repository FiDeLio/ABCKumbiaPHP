<?php
/**
 * Cobros Consultores
 * PHP version 5
 * LICENSE
 *
 *
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
Load::model('usuarios');
Load::model('perfiles');
class UsuariosController extends ApplicationController{
    public function index(){
	Flash::info('Listado de Usuarios');
	$usuarios = new Usuarios();
	$this->usuarios = $usuarios->find();
    }    
    public function create (){
	Flash::info('Mantenedor de Usuarios');
        if(Input::hasPost('usuarios')){
            $obj = new Usuarios();
	    $obj->password =	sha1($obj->password);
            $obj->input('create', Input::post('usuarios'));
        }
    }
    public function edit($id = null, $reader=false){
	Flash::warning('Mantenedor de Usuarios');
        $this->reader = (boolean)$reader;
    	if($id != null){
            $this->usuarios = Load::model('usuarios')->find($id);
    	}
        if(Input::hasPost('usuarios')){
	    $data	=	Input::post('usuarios');
	    $usuarios	=	new Usuarios(Input::post('usuarios'));
	    if(!empty($data['clave'])){
		$usuarios->password	=	sha1($data['clave']);
	    }else{
		$usuarios->password	=	$usuarios->password;
	    }
            if(!$usuarios->update()){
                Flash::error('Falló Operación');
                $this->usuaios = $this->post('usuarios');
            } else {
               return Router::redirect($this->controller_name);
            }
        }
    }
    /**
     * Redirecciona al Formulario para ediar.
     * 
     */       
    public function read($id){
        View::select(NULL);
        Router::route_to("action: edit", "parameters: $id/true");        
    }      
    /**
     * Eliminar un registro
     * 
     * @param int $id
     */
    public function delete($id = null)
    {
        if ($id) {
	    $usuarios = new Usuarios();
	    $usuarios->input('delete', $id);
        }
	Router::redirect($this->controller_name);
	$this->render(null,null);
    }

    public function changePassword($id=null){
	Flash::info('Cambiar clave de acceso');
	if(Input::post('data')){
	    Load::model('usuarios')->changePassword(Input::post('data'));
	}
    }
    /**
     *Salir del sistema y cambia el estado de coneccion
     *Elimina todas las variables del usuario en la base de datos
     */
    public function iExit()
    {
	Load::lib('auth');
        Auth::destroy_identity();
	Load::model('sesiones')->destroy();
        Router::route_to('controller: index');
    }     
}
?>