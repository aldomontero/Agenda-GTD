<?php require_once('../Connections/redx.php'); ?>
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

$colname_datos = "-1";
if (isset($_COOKIE['usuario'])) {
  $colname_datos = $_COOKIE['usuario'];
}
mysql_select_db($database_redx, $redx);
$query_datos = sprintf("SELECT Nombre, Direccion, Municipio FROM usuario WHERE Pk_usuario = %s", GetSQLValueString($colname_datos, "int"));
$datos = mysql_query($query_datos, $redx) or die(mysql_error());
$row_datos = mysql_fetch_assoc($datos);
$totalRows_datos = mysql_num_rows($datos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda GTD</title>

<link href="../estilos.css" rel="stylesheet" type="text/css" />
<script src="../global.js" language="javascript" type="text/javascript" ></script>
</head>

<body class="cuerpoPredeterminado">

<?php 
	$page = 1;
	include_once "barner_top.php" ;
?>

<table bgcolor="#FFFFFF" class="tablaContenido" width="800"><tr><td>
    <p class="parrafoTitulo">
    <!-- ### INICIO DE CONTENIDO ### -->
    
    Bienvenido </p>
    <p class="parrafoNormal">Bienvenido a tu sesión en.</p>
    <p align="center" class="parrafoNormal"><img src="../images/RED.jpg" width="385" height="317" /></p>
    <p class="parrafoNormal">Estos son tus datos.</p>
    <table border="1">
      <tr>
        <td>Nombre</td>
        <td>Direccion</td>
        <td>Municipio</td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_datos['Nombre']; ?></td>
          <td><?php echo $row_datos['Direccion']; ?></td>
          <td><?php echo $row_datos['Municipio']; ?></td>
        </tr>
        <?php } while ($row_datos = mysql_fetch_assoc($datos)); ?>
    </table>
    <p class="parrafoNormal">&nbsp;</p></td></tr></table>
        <!-- ### FIN DE CONTENIDO ### -->
</td>
  </tr>
</table>

<p class="parrafoCreditos">© RED X.</p>

</body>
</html>
<?php
mysql_free_result($datos);
?>
