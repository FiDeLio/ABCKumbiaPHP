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
 * @author Camilo Tilaguy ->Onizukar <onizukar@hotmail.com>
 *
 */
class Logger{
    private $path = 'temp/logs/';
    /**
     *Filtra un log por criterios
     *
     *Carga un log.txt y filtra su contenido mediante caracteres
     *Si una linea tiene fecha y hora y esta con el formato [] esa linea tambien tiene u tipo []
     *
     * warning, error, debug, alert, critical, notice, info, emergence, modelo ....
     *
     *La hora la sacamos del primer substring [] y quitando los caracteres inutiles
     *
     *El tipo lo sacamos del segundo substring de []
     *
     *El mensaje lo ubicamos mediante un substring de comillas dobles "" (estas comillas estan dentro de <em></em>)
     *
     *@param $file String nombre del log.txt
     *
     *@return array
     */
    public function filtrar($file)
    {
        $path = APP_PATH . $this->path . $file;
        if(file_exists($path))
        {
            //abrimos el archivo
            $log = file($path);
            $logs = array();
            $pos = 0;
            $lenght = count($log);
            for($nu = 0; $nu < $lenght; $nu++)
            {
                //Comprobamos si hay mas de un [] dentro del la linea
                if(substr_count($log[$nu],'[') > 1 )
                {
                    $fecha_tipo = explode(']',$log[$nu],40);
                    $mensajes = explode('"',$log[$nu]);
                    $linea = array ('numero' => $nu,
                                    'fecha' => $this->dateFormat(substr($fecha_tipo[0],1, -14)),
                                    'hora' => substr($fecha_tipo[0],16,8),
                                    'tipo' => substr($fecha_tipo[1],1),
                                    'mensaje' => $mensajes[1],
                                    'linea' => $log[$nu]);
                    $logs[$pos] = $linea;
                    $pos++;
                }
                if(strstr($log[$nu], "internal function")){
                    $this->additems($logs[$pos-1], array('internal' => substr ($log[$nu], 23)));
                }
            }
            return $logs;
        }
        return false;
    }
    public function lists(){
        $path = APP_PATH . $this->path;
        $dir = scandir($path,0);
        $vec = array();
        $pos = 0;
        foreach($dir as $item):
                if(substr_count($item,'log'))
                {
                    $vec[$pos] = Html::link("utils/logger/$item",$item);
                    $pos++;
                }
        endforeach;
        return $vec;
    }
    private function dateFormat($date){
        //Sat, 06 Mar 10
        
        return $date;
    }
    private function additems(&$arr) {
       $args = func_get_args();
       $ret=0;
       foreach ($args as $arg) {
           if (is_array($arg)) {
               foreach ($arg as $key => $value) {
                   $arr[$key] = $value;
                   $ret++;
               }
           }else{
               $arr[$arg] = '';
           }
       }
       return $ret;
    }    
}
?>