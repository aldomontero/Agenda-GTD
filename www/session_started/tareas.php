<?php require_once('../Connections/redx.php'); ?>
<?php
$display = "none";

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

$colname_tareas = "-1";
if (isset($_COOKIE['usuario'])) {
  $colname_tareas = $_COOKIE['usuario'];
}

if (isset($_GET['insertar'])) {
  $display = "block";
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tarea (Pk_tarea, Nom_tarea, Fech_tarea, Descripcion_tarea, Fk_categorias, Energia, usuario) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Pk_tarea'], "int"),
                       GetSQLValueString($_POST['Nom_tarea'], "text"),
                       GetSQLValueString($_POST['Fech_tarea'], "date"),
                       GetSQLValueString($_POST['Descripcion_tarea'], "text"),
                       GetSQLValueString($_POST['Fk_categorias'], "int"),
                       GetSQLValueString($_POST['Energia'], "text"),
                       GetSQLValueString($colname_tareas, "int"));

  mysql_select_db($database_redx, $redx);
  $Result1 = mysql_query($insertSQL, $redx) or die(mysql_error());
}

mysql_select_db($database_redx, $redx);
$query_tareas = sprintf("SELECT Pk_tarea, Nom_tarea, Fech_tarea, Descripcion_tarea, Nombre_categoria, Energia FROM tarea JOIN categorias WHERE usuario = %s GROUP BY Pk_tarea", GetSQLValueString($colname_tareas, "int"));
$tareas = mysql_query($query_tareas, $redx) or die(mysql_error());
$totalRows_tareas = mysql_num_rows($tareas);

mysql_select_db($database_redx, $redx);
$query_categorias = "SELECT * FROM categorias";
$categorias = mysql_query($query_categorias, $redx) or die(mysql_error());

$totalRows_categorias = mysql_num_rows($categorias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mis tareas</title>

<link href="../estilos.css" rel="stylesheet" type="text/css" />
<script src="../global.js" language="javascript" type="text/javascript" ></script>
</head>

<body class="cuerpoPredeterminado">

<?php 
	$page = 2;
	include_once "barner_top.php";
?>

<table bgcolor="#FFFFFF" class="tablaContenido" width="800"><tr><td>
    <p class="parrafoTitulo">
    <!-- ### INICIO DE CONTENIDO ### -->
    
    Mis tareas</p>
    <p class="parrafoNormal">Listado de mis tareas.    </p>
    <table border="1">
      <tr>
        <td>Clave</td>
        <td>Nombre de la tarea</td>
        <td>Fecha</td>
        <td>Descripcion</td>
        <td>Categoría</td>
        <td>Energia</td>
        </tr>
      <?php while ($row_tareas = mysql_fetch_assoc($tareas)) { ?>
        <tr>
          <td><?php echo $row_tareas['Pk_tarea']; ?></td>
          <td><?php echo $row_tareas['Nom_tarea']; ?></td>
          <td><?php echo $row_tareas['Fech_tarea']; ?></td>
          <td><?php echo $row_tareas['Descripcion_tarea']; ?></td>
          <td><?php echo $row_tareas['Nombre_categoria']; ?></td>
          <td><?php echo $row_tareas['Energia']; ?></td>
          </tr>
        <?php }  ?>
    </table>
    <p class="parrafoNormal"><a href="tareas.php?insertar=true">Registrar nueva tarea</a></p>
    <div style="display: <?php echo $display; ?>">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <p class="parrafoNormal"><strong>Registrar nueva tarea</strong></p>
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nombre:</td>
            <td><input type="text" name="Nom_tarea" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Fecha (año/mes/día):</td>
            <td><input type="text" name="Fech_tarea" value="<?php echo date("Y/m/d") ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Descripcion:</td>
            <td><textarea name="Descripcion_tarea" cols="32"></textarea></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">categoría:</td>
            <td><select name="Fk_categorias">
              <?php while ($row_categorias = mysql_fetch_assoc($categorias)) {
?>
              <option value="<?php echo $row_categorias['Pk_categorias']?>" ><?php echo $row_categorias['Nombre_categoria']?></option>
              <?php
}
?>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Energía:</td>
            <td><label>
              <select name="Energia" id="Energia">
                <option value="Poco">Poco</option>
                <option value="Media">Media</option>
                <option value="Mucha">Mucha</option>
              </select>
            </label></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Insertar tarea" /></td>
          </tr>
        </table>
        <input type="hidden" name="Pk_tarea" value="" />
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    </div>
    <p class="parrafoNormal">&nbsp;</p></td></tr></table>
        <!-- ### FIN DE CONTENIDO ### -->
</td>
  </tr>
</table>

<p class="parrafoCreditos">© RED X.</p>

</body>
</html>
<?php
mysql_free_result($tareas);

mysql_free_result($categorias);
?>
