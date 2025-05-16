<?php

$class_inicio = "Des";
$class_tareas = "Des";
$class_grupos = "Des";
$class_proyectos = "Des";

$image_inicio = "un";
$image_tareas = "un";
$image_grupos = "un";
$image_proyectos = "un";

switch($page){
	case 1:
		$class_inicio = "";
		$image_inicio = "";
		break;
	case 2:
		$class_tareas = "";
		$image_tareas = "";
		break;
	case 3:
		$class_grupos= "";
		$image_grupos = "";
		break;
	case 4:
		$class_proyectos = "";
		$image_proyectos = "";
		break;
}
?>

  <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
      <td width="466" align="center" style="background-color: #4D4D4B">
        <table class="tablaBarner" width="800" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td><script language="javascript" type="text/javascript">
          escribirEnTop();
          </script></td>
        </tr>
        <tr>
      <td class="tablaPestanas" align="center">
        <table width="800" height="30" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="td<?php echo $class_inicio ?>Link" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_inicio ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_inicio ?>Seleccionado"><a class="vinculosPestana" target="_self" href="index.php">Inicio</a></td>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_inicio ?>selected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="td<?php echo $class_tareas ?>Link" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_tareas ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_tareas ?>Seleccionado"><a class="vinculosPestana" target="_self" href="tareas.php">Mis tareas</a></td>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_tareas ?>selected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="td<?php echo $class_grupos?>Link" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_grupos ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_grupos?>Seleccionado"><a class="vinculosPestana" target="_self" href="grupos.php">Mis grupos</a></td>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_grupos ?>selected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="td<?php echo $class_proyectos ?>Link" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_proyectos ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_proyectos?>Seleccionado"><a class="vinculosPestana" target="_self" href="proyectos.php">Mis Proyectos</a></td>
              <td width="3" height="30"><img src="../images/middlebar_<?php echo $image_proyectos ?>selected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="tdDesLink" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="../images/middlebar_unselected_left.gif" width="3" height="30" /></td>
              <td class="botonDesSeleccionado"><a class="vinculosPestana" target="_self" href="../index.php">Salir</a></td>
              <td width="3" height="30"><img src="../images/middlebar_unselected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="tdDesLink">
          </td>
        </tr>
      </table></td>
    </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td align="center">
          