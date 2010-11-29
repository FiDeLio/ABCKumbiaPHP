<?php
class Button{
    public static function submit($string, $attrs=null){
        $code = self::js();
        $code .= '<div class="button">&nbsp;'.PHP_EOL;
        $code .= Form::submit($string, $attrs);
        $code .= '&nbsp;</div>'.PHP_EOL;
        return $code;
    }
    public static function none($text, $attrs=null){
        $code = self::js();
        $code .= '<span class="button">&nbsp;'.PHP_EOL;
        $code .= Form::button($text, $attrs);
        $code .= '&nbsp;</span>'.PHP_EOL;
        return $code;        
    }
    public static function link($action, $text, $attrs=null){
        $code = self::js();
        $code .= '<span class="button">&nbsp;'.PHP_EOL;
        $code .= Html::link($action, $text, $attrs);
        $code .= '&nbsp;</span>'.PHP_EOL;
        return $code;        
    }
    private static function js(){
        $code = '';       
        $code .= '<script type="text/javascript">'.PHP_EOL;
        $code .= '$(function() {'.PHP_EOL;
        $code .= '$("a, input:submit, input:button", ".button").button();'.PHP_EOL;
	$code .= '});'.PHP_EOL;
        $code .= '</script>'.PHP_EOL;
        return $code;
    }
}
?>