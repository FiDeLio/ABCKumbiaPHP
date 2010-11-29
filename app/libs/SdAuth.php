<?php
/**
 * Solicitudes & ordenes de compra
 * PHP version 5
 * LICENSE
 *
 *
 * @author Fidel Oyarzo <fidel.oyarzo@gmail.com>
 */
?>
<?php
//use_extensions('session');
require_once CORE_PATH . 'libs/session/session.php';
class SdAuth
{
    /**
     * islogin
     *
     * @param void
     * @return ture/false
     */
    public static function isLogged ()
    {
	if (Load::model('sesiones')->exist()){
	    Load::lib('online');
	    Online::setUser();
	    if(isset($_POST['sel_usuarios_id'])){
		return self::adminCheck($_POST['sel_usuarios_id']);
	    }
	    return true;
	} else {
	    if (isset($_POST['mode']) && $_POST['mode'] == 'auth_login') {
		$_SESSION['usuarios_usuario']	=	$_POST['usuarios_usuario'];
		$_SESSION['usuarios_password']	=	$_POST['usuarios_password'];
		return self::check($_POST['usuarios_usuario'], $_POST['usuarios_password'], FALSE);
	    }elseif(isset($_POST['mode']) && $_POST['mode'] == 'new_auth_login'){
		return self::check($_POST['usuarios_usuario'], $_POST['usuarios_password'], TRUE);
	    }else{
		return false;
	    }
	}
    }
    /**
     * check
     *
     * @param $username
     * @param $password
     * @return true/false
     */
    public static function adminCheck ($id)
    {
        Load::lib('auth');
	Load::model('sesiones');
	$password 			=	sha1($password);
        $auth = new Auth('model', 'class: usuarios', "id: $id");
        if ($auth->authenticate()){
	    $login 			=	$auth->get_identity();
	    if (Load::model('asignar_centros_de_costos')->getCcByUsuarios($login['id'])){
		$perfil 		=	 Load::model('perfiles')->find($login['perfiles_id']);
		Load::model('usuarios');
		$session		=	new Sesiones();
		//desconeta usuario con el mismo login
		$session->setData('usuarios_id', $login['id']);
		$session->destroy();
		//fin

		//$session->setData('sistema', $sistema);
		$session->setData('usuarios_id', $login['id']);
		$session->setData('perfiles_nombre', $perfil->nombre);
		$session->setData('usuarios_nombre', $login['nombres'] . ' ' . $login['apellidos']);
		$session->setData('perfiles_id', $login['perfiles_id']);
		$empresa		=	Load::model('empresas')->find_first("status ='A'");
		$session->setData('empresa_title', $empresa->razon_social);
		$session->setData('empresa_subtitle', $empresa->giro);
		$session->setData('empresa_ciudad', $empresa->ciudad);
		$session->setData('empresa_direccion', $empresa->direccion);
		$session->setData('logo', $empresa->logo);
		Load::model('sesiones')->setData('cc', null);
		//ruta de inicio segun el perfil
		$session->setData('controlador', $perfil->controlador);
		$session->setData('accion', $perfil->accion);
		//error_reporting(0);
		Router::redirect($perfil->controlador . '/' . $perfil->accion);
		return true;
	    }
        }
    }
    
    public static function check ($username, $password, $new_login=FALSE)
    {
        Load::lib('auth');
	Load::model('sesiones');
	$password 			=	sha1($password);
        $auth = new Auth('model', 'class: usuarios', "usuario: $username", "password: $password", "status: A");
        if ($auth->authenticate()){
	    $login 			=	$auth->get_identity();
	    if($login['online']==1 and  $new_login==FALSE){
		$_SESSION['new_login'] = true;
		return false;
	    }
	    $perfil 		=	 Load::model('perfiles')->find($login['perfiles_id']);
	    Load::model('usuarios');
	    $session		=	new Sesiones();
	    //desconeta usuario con el mismo login
	    //$session->setData('usuarios_id', $login['id']);
	    //$session->destroy();
	    //fin
	    $rec			=	new Usuarios();
	    $rec->find($login['id']);
	    $rec->online		=	1;
	    $rec->entradas		=	$rec->entradas + 1;
	    $rec->update();		
	    //$session->setData('sistema', $sistema);
	    $session->setData('usuarios_id', $login['id']);
	    $session->setData('perfiles_nombre', $perfil->nombre);
	    $session->setData('usuarios_nombre', $login['nombres'] . ' ' . $login['apellidos']);
	    $session->setData('perfiles_id', $login['perfiles_id']);
	    $session->setData('empresas_id', '0');
	    Router::redirect(PUBLIC_PATH . '/../..');
	    return true;
        }
	$_SESSION['msg']		=	"Usuario y/o Contraseña inválidas";
	return false;
    }    
    /**
     * logout
     *
     * @param void
     * @return void
     */
    public static function logout ()
    {
       
    }
}
