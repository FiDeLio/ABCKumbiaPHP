<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador - Ingreso</title>
<link rel="shortcut icon" href="favico.ico" />
<link href="css/interior.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/lateral.js"></script>
<script>

	function borrarRegistro(ID) {
		ok=window.confirm("¿Está seguro de eliminar la Noticia?")
		if(ok) {
			location.href="eliminaNoticia.php?id="+ID;
		}
	
	}

</script>
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
        <li class="ultimo"><a href="index.php">Listado</a></li>
      </ul>
      </div>
    <div class="clear"></div>
    <h1>Listado</h1>
    <h2>&nbsp;</h2>
    
    <div id="botonera"><a href="formularioIngresar.php"><img src="images/generales/bot_nuevo.gif" alt="Crear Nuevo" width="85" height="17" border="0" /></a></div>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="datos">
      <tr>
        <th width="13%" scope="col">Fecha</th>
        <th width="50%" scope="col">Título</th>
        <th width="15%" scope="col">Publicado</th>
        <th width="15%" scope="col">Ver</th>
        
      </tr>
      
      {{foreach  name=afuera from=$datos item=dato}}
      <tr>
        <td>{{$dato.empresa}}</td>
        <td>{{$dato.sku}}</td>
        <td>{{$dato.serie}}</td>
        <td class="centro"><a href="ver.php?id={{$dato.idTabla}}"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
        
      </tr>
	  {{foreachelse}}
	  <tr>
	  <td colspan="4">No existen registros para desplegar.</td>
	  </tr>
	  {{/foreach}}
    </table>
    <div id="paginacion">{{$anterior}} {{$ventana}} {{$siguiente}}</div>
    <!-- <div id="paginacion">&lt;&lt; <a href="javascript:;">1</a> - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - 10 &gt;&gt;</div>-->
    </div>
    <div class="clear"></div>
    </div>
  <div id="colofon">

    </div>
  </div>
  <div id="abajo"><img src="images/generales/sombra_abajo.gif" alt=" " /></div>
</div>
</body>
</html>
