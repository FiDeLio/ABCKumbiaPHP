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
Load::model('menus');
Load::model('controllers');
Load::model('sub_menus');
Load::model('perfiles');
class MenusController extends ApplicationController
{
    /**
     * Lista los controladores...
     * @param int $page
     */
    public function index ()
    {
	Flash::info('Listado de Men&uacute;s');
	$controllers = new Controllers();
	$this->items = $controllers->find();
    }     
    /**
     * Crea un Controlador para el menu
     *
     */
    public function create ()
    {
        /**
         * Se verifica si el usuario envio el form (submit) y si ademas 
         * dentro del array POST existe uno llamado "controllers"
         * el cual aplica la autocarga de objeto para guardar los 
         * datos enviado por POST utilizando autocarga de objeto
         */
	Flash::info('Mantenerdor de Men&uacute;s');
	$perfiles		=	new Perfiles();
	$menus			=	new Menus();
    	//$this->perfiles		=	$perfiles->find();
    	$this->menus		=	$menus->find();
        if (Input::hasPost('controllers')) {
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            Load::model('controllers');
            $controller = new Controllers(Input::post('controllers'));
            if ($controller->save()) {
                //Mensaje de exito
                Flash::valid('Operación Exitosa');
            } else {
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->controllers = Input::post('controllers');
                /**
                 * NOTA: para que la autocarga aplique de forma correcta, es necesario que llame a la variable de instancia
                 * igual como esta el model de la vista, en este caso el model es "controllers"
                 */
            }
        }
    }
    /**
     * Edita un registro
     *
     * @param int $id
     */
    public function edit($id=null, $reader=false){
	Flash::warning('Mantenerdor de Men&uacute;s');
        $this->reader = (boolean)$reader;
        if ($id != null) {
            //Aplicando la autocarga de objeto, para comenzar la edición
            $this->controllers	=	Load::model('controllers')->find($id);
            $this->perfiles	=	Load::model('perfiles')->find();
            $this->menus	=	Load::model('menus')->find();
        } else {
            //enrutando al index para listar los menus
            Router::route_to('action: index');
        }
        //se verifica si se ha enviado el formulario (submit)
        if(Input::hasPost('controllers')){
            Load::model('controllers');
            $controller = new Controllers(Input::post('controllers'));
            if($controller->update()){
                //Mensaje de exito
                Flash::valid('Operación Exitosa!');
            } else {
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->controllers = Input::post('controllers');
            }
        }
    }
    public function read($id){
        View::select(NULL);
        Router::route_to("action: edit", "parameters: $id/true");        
    }
    
    
    public function indexMain($page=1){
	Flash::info('Listado de Men&uacute;s');
        $this->items	=	Load::model('menus')->paginate("page: $page");
    }
    public function createMain(){
	Flash::info('Mantendor del menú principal');
	$menus = new Menus();
    	if(Input::hasPost('menus')){
	    $menus->createAndOrder(Input::post('menus'), Input::post('nombre'));
    	}
	$this->menus	=	$menus->find('order: orden');
    }
    public function editMain($id=null){
	Flash::warning('Menús Principales');
    	if(Input::hasPost('menus')){
		Load::model('menus');
    		$menus	=	new	Menus(Input::post('menus'));
    		if($menus->save()){
    			Flash::valid('Operación Exitosa');
			Router::route_to('action: indexMain');
    		}else{
    			Flash::error('Falló Operación');
    			$this->menus	=	Input::post('menus');
    		}
    	}else{
	    $this->menus	=	Load::model('menus')->find($id);
	}
    }
    public function delete($id){
	View::response('view');
	Load::model('controllers')->delete($id);
	Flash::success('Registro Eliminado');
	View::select(null);
	Router::redirect("menus/index", 0);
    }
    public function indexSubMenu($page=1){
	Flash::info('Listado de Men&uacute;s');
        $this->items	=	Load::model('menus')->paginate("page: $page");
    }
    /**
     *Formulario para crear un submenu
     */
    public function createSubMenu(){
    	if(Input::hasPost('data')){
    	    $sub_menus	=	new	SubMenus();
    	    $sub_menus->input('create', Input::post('data'));
    	}
    }
    
    /**
     *para el submenu
     */
    public function getMenus(){
	View::template(NULL);
	$this->id = Input::post('id');
    }
}
