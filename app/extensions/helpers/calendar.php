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
class Calendar{
    public static function text($field, $attrs = NULL, $value = NULL){
        static $i = false;
        $code   =   '';
        if($i == false){
                $i = true;
                //$code   .=   Tag::js('jquery/ui/ui.core');
                
        }
        $code   .=   Form::text($field, $attrs, $value);
        $field  =   str_replace('.', '_', $field);
        $code   .=  "<script type=\"text/javascript\">
                    $(function() {
                        $(\"#" . $field . "\").datepicker({
                        altFormat: 'd/m/yy',
                        autoSize: true,
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesMin: ['Dom', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
                        firstDay: 1,
                        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                        monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                        dateFormat: 'dd/mm/yy',
                        changeMonth: true,
                        changeYear: true});
                    });
                    </script>";
        return $code;
    }
}
?>