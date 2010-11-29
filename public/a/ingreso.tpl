<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador - Ingreso</title>
<script language="javascript" type="text/javascript" src="../js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="../js/scriptaculous/src/scriptaculous.js"></script>
<script language="javascript" type="text/javascript" src="../js/calendar/datepicker.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../js/calendar/datepicker.css" />
<script language="javascript" type="text/javascript" src="../js/jsFnG.js"></script>
<script language="javascript" type="text/javascript" src="../js/funciones.js"></script>
<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../js/tinymce.js"></script>
<link rel="shortcut icon" href="favico.ico" />
<link href="css/interior.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="todo">
  <div id="arriba"><img src="images/generales/sombra_arriba.gif" alt=" " /></div>
  <div id="superior">
    {{include_php file="superior.php"}}
  </div>
  <div id="envoltorio">
  <div id="contenedor">
    <div id="lateral">
      {{include_php file="lateral.php"}}
    </div>
    <div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero">Usted está en: <a href="entrada.php" target="_top">Portada</a></li>
        <li class="ultimo"><a href="index.php">Formulario</a></li>
      </ul>
      </div>
    <div class="clear"></div>
    <h1>Formulario</h1>
    <h2>&nbsp;</h2>
    
    <form id="form" name="form" method="post" action="" enctype="multipart/form-data" onsubmit="">
    <input type="hidden" name="accion" value="ingresar" />
      <table width="533" border="0" align="center" cellpadding="0" cellspacing="0" class="ingreso">
        <tr>
          <td>Empresa:</td>
          <td colspan="2"><span>
            <input name="empresa" type="text" class="bloque" value="" id="empresa" size="70" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
        
        <tr>
          <td>SKU:</td>
          <td colspan="2"><span>
            <input name="sku" type="text" class="bloque" value="" id="sku" size="20" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
		<tr>
          <td>Serie:</td>
          <td colspan="2"><span>
            <input name="serie" type="text" class="bloque" value="" id="serie" size="20" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
        <tr>
          <td>Lote:</td>
          <td colspan="2"><span>
            <input name="lote" type="text" class="bloque" value="" id="lote" size="20" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
        <tr>
          <td>Descripción:</td>
          <td colspan="2"><label>
            <textarea  name="descripcion" cols="70" rows="3" class="bloque" id="descripcion"></textarea>
            </label><span class="chico">máximo 500 caracteres.</span></td>
        </tr>
        
        <tr>
          <td  class="arriba">Imagen:</td>
          <td  class="arriba">Ubicación:</td>
          <td  class="arriba"><input name="imagen" type="file" class="bloque" id="imagen"  size="50" />
            <span class="archivo">jpg, gif<a href="javascript:;"></a></span> <span class="chico"> Tamaño: 70 x 52 píxeles - Peso m&aacute;ximo 1 Mb.</span></td>
        </tr>
        <tr>
          <td>Calidad Total:</td>
          <td colspan="2"><span>
            <input name="calidad" type="text" class="bloque" value="" id="calidad" size="20" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
        
        <tr>
          <td>Familia:</td>
          <td colspan="2"><span>
            <input name="familia" type="text" class="bloque" value="" id="familia" size="20" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
        
        <tr>
          <td>Palabra Clave:</td>
          <td colspan="2"><span>
            <input name="palabra" type="text" class="bloque" value="" id="palabra" size="20" maxlength="150" />
            
          </span><span class="chico">máximo 150 caracteres.</span></td>
        </tr>
        
      </table>
        
    <div id="botonera"><input type="image" src="images/generales/bot_guardar.gif" alt="Guardar Cambios" />
    <a href="noticias.php"> <img src="images/generales/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" /></a></div>
    </div>
    </form>
    <div class="clear"></div>
    </div>
  <div id="colofon">

    </div>
  </div>
  <div id="abajo"><img src="images/generales/sombra_abajo.gif" alt=" " /></div>
</div>
<script type="text/javascript">
	<!--
	var dpck	= new DatePicker({
	relative	: 'fecha',
	language	: 'sp',
	disableFutureDate : false,
	enableCloseEffect : false,
	enableShowEffect : false
	});
	  dpck.setDateFormat([ "dd", "mm", "yyyy" ], "/");
	-->
</script>
</body>
</html>
