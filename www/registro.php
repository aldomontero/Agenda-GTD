<?php require_once('Connections/redx.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (Pk_usuario, Nombre, Password, Direccion, Municipio) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Pk_usuario'], "int"),
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Municipio'], "text"));

  mysql_select_db($database_redx, $redx);
  $Result1 = mysql_query($insertSQL, $redx) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro</title>

<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="global.js" language="javascript" type="text/javascript" ></script>
</head>

<body class="cuerpoPredeterminado">

<?php 
	$page = 2;
	include_once "barner_top.php" 
?>
    
<table bgcolor="#FFFFFF" class="tablaContenido" width="800"><tr><td>
    <p class="parrafoTitulo">
    <!-- ### INICIO DE CONTENIDO ### -->
    
    Registrate</p>
    <p class="parrafoNormal">Rellena los campos para poder continuar.    </p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td height="50" align="right" nowrap="nowrap">Nombre:</td>
          <td><input type="text" name="Nombre" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td height="44" align="right" nowrap="nowrap">Password:</td>
          <td><input type="password" name="Password" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td height="42" align="right" nowrap="nowrap">Direccion:</td>
          <td><input type="text" name="Direccion" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td height="47" align="right" nowrap="nowrap">Municipio:</td>
          <td><input type="text" name="Municipio" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td height="43" align="right" nowrap="nowrap">&nbsp;</td>
          <td><input type="submit" value="Registrar" /></td>
          </tr>
        </table>
      <input type="hidden" name="Pk_usuario" value="" />
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p></td></tr></table>
        <!-- ### FIN DE CONTENIDO ### -->
</td>
  </tr>
</table>

<p class="parrafoCreditos">© RED X.</p>

</body>
</html>