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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$errorEntraGrupo = "";
$display = "none";
if (isset($_GET['insertar'])) {
  $display = "block";
}

$colname_grupoasociacion = "-1";
$colname_grupo = "-1";
if (isset($_COOKIE['usuario'])) {
  $colname_grupo = $_COOKIE['usuario'];
  $colname_grupoasociacion = $_COOKIE['usuario'];
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO grupo (Pk_Id_grupo, Nom_Grupo, Password_grupo, usuario) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Pk_Id_grupo'], "int"),
                       GetSQLValueString($_POST['Nom_Grupo'], "text"),
                       GetSQLValueString($_POST['Password_grupo'], "text"),
                       GetSQLValueString($colname_grupo, "int"));

  mysql_select_db($database_redx, $redx);
  $Result1 = mysql_query($insertSQL, $redx) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	
  $idgrupo = $_POST['Fk_Id_grupo'];
  $insertSQL = sprintf("INSERT INTO usuario_grupo (Pk_clave, Fk_Id_grupo, Fk_usuario) VALUES (%s, %s, %s)",
                       GetSQLValueString($idgrupo.$colname_grupo, "int"),
                       GetSQLValueString($idgrupo, "int"),
                       GetSQLValueString($colname_grupo, "int"));

  mysql_select_db($database_redx, $redx);
  $grupostodos = mysql_query("SELECT Password_grupo FROM grupo WHERE Pk_Id_grupo = $idgrupo", $redx) or die(mysql_error());
    $row_grupostodos = mysql_fetch_assoc($grupostodos);
  if($_POST['passinsert'] == $row_grupostodos['Password_grupo']){
    mysql_select_db($database_redx, $redx);
    $Result1 = mysql_query($insertSQL, $redx) or $errorEntraGrupo = "Error al insertar, la contraseña no coinciden ó ya pertenece a este grupo.";
  } else {
	$errorEntraGrupo = "Error al insertar, la contraseña no coinciden ó ya pertenece a este grupo.";
  }
}

mysql_select_db($database_redx, $redx);
$query_grupo = sprintf("SELECT Pk_Id_grupo, Password_grupo, Nom_Grupo FROM grupo WHERE usuario = %s", GetSQLValueString($colname_grupo, "int"));
$grupo = mysql_query($query_grupo, $redx) or die(mysql_error());
$totalRows_grupo = mysql_num_rows($grupo);

mysql_select_db($database_redx, $redx);
$query_grupoasociacion = sprintf("SELECT Nom_Grupo FROM usuario_grupo JOIN grupo ON usuario_grupo.Fk_Id_grupo = grupo.Pk_Id_grupo WHERE Fk_usuario = %s", GetSQLValueString($colname_grupoasociacion, "int"));
$grupoasociacion = mysql_query($query_grupoasociacion, $redx) or die(mysql_error());
$totalRows_grupoasociacion = mysql_num_rows($grupoasociacion);

mysql_select_db($database_redx, $redx);
$query_grupostodos = "SELECT * FROM grupo";
$grupostodos = mysql_query($query_grupostodos, $redx) or die(mysql_error());
$totalRows_grupostodos = mysql_num_rows($grupostodos);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mis grupos</title>

<link href="../estilos.css" rel="stylesheet" type="text/css" />
<script src="../global.js" language="javascript" type="text/javascript" ></script>
</head>

<body class="cuerpoPredeterminado">

<?php 
	$page = 3;
	include_once "barner_top.php" 
?>

<table bgcolor="#FFFFFF" class="tablaContenido" width="800"><tr><td>
    <p class="parrafoTitulo">
    <!-- ### INICIO DE CONTENIDO ### -->
    
    Mis grupos</p>
    <p class="parrafoNormal">Este es el listado de tus grupos hechos, si deseas agregar otro has clic <a href="grupos.php?insertar=true">Aquí</a>. </p>
    <table border="1">
      <tr>
        <td>Clave</td>
        <td>Password</td>
        <td>Nom_Grupo</td>
        </tr>
      <?php while ($row_grupo = mysql_fetch_assoc($grupo)) { ?>
        <tr>
          <td><?php echo $row_grupo['Pk_Id_grupo']; ?></td>
          <td><?php echo $row_grupo['Password_grupo']; ?></td>
          <td><?php echo $row_grupo['Nom_Grupo']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <div style="display: <?php echo $display; ?>">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <p class="parrafoNormal"><strong>Insertar nuevo grupo</strong></p>
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nombre del nuevo grupo:</td>
            <td><input type="text" name="Nom_Grupo" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Contraseña de acceso:</td>
            <td><input type="password" name="Password_grupo" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Insertar grupo" /></td>
          </tr>
        </table>
        <input type="hidden" name="Pk_Id_grupo" value="" />
        <input type="hidden" name="usuario" value="" />
        <input type="hidden" name="MM_insert" value="form1" />
    </form>
    </div>
    <p class="parrafoNormal"><strong>Grupos a los que pertenezco</strong>, pertenece a otros grupos seleccionando el grupo al que desees pertenecer.</p>
    <p class="parrafoNormal" style="color:#F00"><?php echo $errorEntraGrupo; ?>
    <div align="center">
      <table border="1">
        <tr>
          <td width="313">Grupo</td>
          </tr>
        <?php while ($row_grupoasociacion = mysql_fetch_assoc($grupoasociacion)) { ?>
          <tr>
            <td><?php echo $row_grupoasociacion ? $row_grupoasociacion['Nom_Grupo'] : "No hay elementos";  ?></td>
            </tr>
          <?php } ?>
      </table>
    </div>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Grupo:</td>
          <td><select name="Fk_Id_grupo">
            <?php
            while ($row_grupostodos = mysql_fetch_assoc($grupostodos)) {
?>
            <option value="<?php echo $row_grupostodos['Pk_Id_grupo']?>" ><?php echo $row_grupostodos['Nom_Grupo']?></option>
            <?php
}
?>
            </select></td>
          </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Contraseña de acceso:</td>
          <td><input type="password" name="passinsert" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Pertenecer" /></td>
          </tr>
        </table>
      <input type="hidden" name="Pk_clave" value="" />
      <input type="hidden" name="MM_insert" value="form2" />
    </form></td></tr></table>
        <!-- ### FIN DE CONTENIDO ### -->
</td>
  </tr>
</table>

<p class="parrafoCreditos">© RED X.</p>

</body>
</html>
<?php
mysql_free_result($grupo);

mysql_free_result($grupoasociacion);

mysql_free_result($grupostodos);
?>
