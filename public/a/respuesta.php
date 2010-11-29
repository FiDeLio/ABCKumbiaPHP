<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador - Ingreso</title>
<link rel="shortcut icon" href="favico.ico" />
<link href="css/interior.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="todo">
  <div id="arriba"><img src="images/generales/sombra_arriba.gif" alt=" " /></div>
  <div id="superior">
   <?php require_once 'superior.php';?> 
  </div>
  <div id="envoltorio">
  <div id="contenedor">
    <div id="lateral">
      <?php require_once 'lateral.php';?>
    </div>
    <div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero">Usted est√° en: <a href="entrada.php" target="_top">Portada</a></li>
        <li class="ultimo">Aministrador Ingreso</li>
      </ul>
      </div>
    <div class="clear"></div>
    <h1>Administrador Ingreso</h1>
    <form id="form1" name="form1" method="post" action="">
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="ingreso">
        <tr>
          <td class="mensaje">&nbsp;</td>
        </tr>
        <tr>
          <td class="mensaje"></td>
        </tr>
        <tr>
          <td class="mensaje"><span></span></td>
          </tr>
        <tr>
          <td class="mensaje">Registro ingresado</td>
        </tr>
        
        <tr>
          <td class="mensaje"><span></span></td>
        </tr>
        <tr>
          <td class="mensaje"></td>
        </tr>
        
        <tr>
          <td class="mensaje">&nbsp;</td>
        </tr>
      </table>
        </form>
    <div id="botonera"><a href="index.php"><img src="images/generales/bot_volver.gif" alt="volver" width="59" height="17" border="0" /></a></div>
    </div>
    <div class="clear"></div>
    </div>
  <div id="colofon">
      <ul>
        <li></li>
        <li class="cyber">Desarrollo: Iv·n Rojas Marchant</li>
      </ul>
    </div>
  </div>
  <div id="abajo"><img src="images/generales/sombra_abajo.gif" alt=" " /></div>
</div>
</body>
</html>
