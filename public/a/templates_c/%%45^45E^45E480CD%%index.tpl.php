<?php /* Smarty version 2.6.18, created on 2010-11-23 00:22:15
         compiled from index.tpl */ ?>
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
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "superior.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  </div>
  <div id="envoltorio">
  <div id="contenedor">
    <div id="lateral">
      <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "lateral.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

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
      
      <?php $_from = $this->_tpl_vars['datos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['afuera'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['afuera']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['dato']):
        $this->_foreach['afuera']['iteration']++;
?>
      <tr>
        <td><?php echo $this->_tpl_vars['dato']['empresa']; ?>
</td>
        <td><?php echo $this->_tpl_vars['dato']['sku']; ?>
</td>
        <td><?php echo $this->_tpl_vars['dato']['serie']; ?>
</td>
        <td class="centro"><a href="ver.php?id=<?php echo $this->_tpl_vars['dato']['idTabla']; ?>
"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
        
      </tr>
	  <?php endforeach; else: ?>
	  <tr>
	  <td colspan="4">No existen registros para desplegar.</td>
	  </tr>
	  <?php endif; unset($_from); ?>
    </table>
    <div id="paginacion"><?php echo $this->_tpl_vars['anterior']; ?>
 <?php echo $this->_tpl_vars['ventana']; ?>
 <?php echo $this->_tpl_vars['siguiente']; ?>
</div>
    <!-- <div id="paginacion">&lt;&lt; <a href="javascript:;">1</a> - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - 10 &gt;&gt;</div>-->
    </div>
    <div class="clear"></div>
    </div>
  <div id="colofon">
      <ul>
        <li></li>
        <li class="cyber">Desarrollo: Iv�n Rojas Marchant</li>
      </ul>
    </div>
  </div>
  <div id="abajo"><img src="images/generales/sombra_abajo.gif" alt=" " /></div>
</div>
</body>
</html>