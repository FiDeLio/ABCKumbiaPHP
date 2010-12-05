<?php
/**
 * SAV (Sistema de administracion de visitas)
 * PHP version 5
 * LICENSE
 *
 *
 * Controlador Perfiles
 * 
 * @category app
 * @package controllers
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
Load::model('perfiles');
class PerfilesController extends ApplicationController{
    public function index(){
        Flash::info('Listado de Perfiles');
        $perfiles = new Perfiles();
        $this->items = $perfiles->find();
    }
    /**
     * Formulario para crear un registro
     * 
     */    
    public function create(){
        Flash::info('Mantenedor de Perfiles');
        if(Input::hasPost('perfiles')){
            $perfiles  =   new Perfiles();
            if($perfiles->input('create', Input::post('perfiles'))){
                $this->perfiles = Input::post('perfiles');
            }
        }
    }
    /**
     * Formulario para ediar un registro
     * 
     */    
    public function edit($id=null, $reader=false){
        Flash::warning('Mantenedor de Perfiles');
        $this->reader = (boolean)$reader;
        $perfiles  =   new Perfiles();
        if(Input::hasPost('perfiles')){
            if($perfiles->input('update', Input::post('perfiles'))){
                Router::route_to('action: index');
            }
        }else{
            $this->perfiles = $perfiles->find($id);
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
     * Elimina un registro
     */    
    public function delete($id=null){
        View::response('view');
        View::select(NULL);
        $perfiles  =   new Perfiles();
        $perfiles->find($id);
        $perfiles->input('delete', $id);
        Router::route_to('action: index');
    }
}
