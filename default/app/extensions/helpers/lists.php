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
final class Lists{
    public static function loggerList($data){
        $tamaño =   count($data);
        $code   =   '';
        for($i=0;$i<$tamaño;$i++){
            $j=$tamaño-1-$i;
            $class  =   strtolower($data[$j]['tipo']);
            $code   .=   ' -------- '. $data[$j]['hora'].' -------- ';
            $code   .=  '<br/>Linea: '. $data[$j]['numero'];
            $code   .=  '<br/>Tipo: '. $data[$j]['tipo'];
            $code   .=  '<br/>Funcion Interna: '. $data[$j]['internal'];
            $code   .=  '<br/>SQL: '. $data[$j]['mensaje'];
            $code   .=  '<div class="' . $class . ' flash">' . $data[$j]['linea'] . '</div>';
            $code   .=  '<br/>';
        }
        return $code;
    }
    public static function loggerGrid($data){
        $tamaño =   count($data);
        $code   =   '<table class="table_grilla">';
        $code   .=   '<tr>';
        $code   .=  '<th>TIPO</th>';
        $code   .=  '<th>FECHA</th>';
        $code   .=  '<th>HORA</th>';
        $code   .=  '<th>LINEA DEL LOG</th>';
        $code   .=  '<th>FUNCION INTERNA</th>';
        $code   .=  '<th>SQL</th>';
        $code   .=  '</tr>';
        for($i=0;$i<$tamaño;$i++){
            $j=$tamaño-1-$i;
            $code .= '<tr>';
            $code .= '<td>' . $data[$j]['tipo'] . '</td>';
            $code .= '<td>' . $data[$j]['fecha'] . '</td>';
            $code .= '<td>' . $data[$j]['hora'] . '</td>';
            $code .= '<td>' . $data[$j]['numero'] . '</td>';
            $code .= '<td>' . $data[$j]['internal'] . '</td>';
            $code .= '<td>' . $data[$j]['mensaje'] . '</td>';
            $code .= '</tr>';
        }
        $code .= '</table>';
        return $code;
    }
}
?>