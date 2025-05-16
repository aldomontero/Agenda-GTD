<?php

$class_inicio = "Des";
$class_registro = "Des";
$class_ayuda = "Des";

$image_inicio = "un";
$image_registro = "un";
$image_ayuda = "un";

switch($page){
	case 1:
		$class_inicio = "";
		$image_inicio = "";
		break;
	case 2:
		$class_registro = "";
		$image_registro = "";
		break;
	case 3:
		$class_ayuda = "";
		$image_ayuda = "";
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
              <td width="3" height="30"><img src="images/middlebar_<?php echo $image_inicio ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_inicio ?>Seleccionado"><a class="vinculosPestana" target="_self" href="index.php">Inicio</a></td>
              <td width="3" height="30"><img src="images/middlebar_<?php echo $image_inicio ?>selected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="td<?php echo $class_registro ?>Link" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="images/middlebar_<?php echo $image_registro ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_registro ?>Seleccionado"><a class="vinculosPestana" target="_self" href="registro.php">Registro</a></td>
              <td width="3" height="30"><img src="images/middlebar_<?php echo $image_registro ?>selected_right.gif" width="3" height="30" /></td>
            </tr>
          </table></td>
          
          <td class="td<?php echo $class_ayuda ?>Link" width="102"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3" height="30"><img src="images/middlebar_<?php echo $image_ayuda ?>selected_left.gif" width="3" height="30" /></td>
              <td class="boton<?php echo $class_ayuda ?>Seleccionado"><a class="vinculosPestana" target="_self" href="ayuda.php">Ayuda</a></td>
              <td width="3" height="30"><img src="images/middlebar_<?php echo $image_ayuda ?>selected_right.gif" width="3" height="30" /></td>
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
          