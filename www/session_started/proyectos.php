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

$colname_misproyectos = "-1";
$colname_misgrupos = "-1";
$colname_misproyectos_insertar = "-1";
$colname_listaproyectos = "-1";
if (isset($_COOKIE['usuario'])) {
  $colname_misproyectos = $_COOKIE['usuario'];
  $colname_misgrupos = $_COOKIE['usuario'];
  $colname_listaproyectos = $_COOKIE['usuario'];
  $colname_misproyectos_insertar = $_COOKIE['usuario'];
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO proyecto (Pk_clave_proyecto, Nom_proyecto, Decripcion_proyecto, usuario) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Pk_clave_proyecto'], "int"),
                       GetSQLValueString($_POST['Nom_proyecto'], "text"),
                       GetSQLValueString($_POST['Decripcion_proyecto'], "text"),
                       GetSQLValueString($colname_misproyectos, "int"));

  mysql_select_db($database_redx, $redx);
  $Result1 = mysql_query($insertSQL, $redx) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO grupo_proyecto (Pk_clave, Fk_Id_grupo, Fk_clave_proyecto) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Fk_Id_grupo'].$_POST['Fk_clave_proyecto'], "int"),
                       GetSQLValueString($_POST['Fk_Id_grupo'], "int"),
                       GetSQLValueString($_POST['Fk_clave_proyecto'], "int"));

  mysql_select_db($database_redx, $redx);
  $Result1 = mysql_query($insertSQL, $redx) or $errorEntraGrupo = "Error al insertar, la contraseña no coinciden ó ya pertenece a este grupo.";
  
}

mysql_select_db($database_redx, $redx);
$query_misproyectos = sprintf("SELECT Pk_clave_proyecto, Nom_proyecto, Decripcion_proyecto FROM proyecto WHERE usuario = %s", GetSQLValueString($colname_misproyectos, "int"));
$misproyectos = mysql_query($query_misproyectos, $redx) or die(mysql_error());

$totalRows_misproyectos = mysql_num_rows($misproyectos);

mysql_select_db($database_redx, $redx);
$query_listaproyectos = sprintf("SELECT grupo_proyecto.Pk_clave, grupo.Nom_Grupo, proyecto.Nom_proyecto FROM proyecto INNER JOIN (grupo INNER JOIN grupo_proyecto ON grupo_proyecto.Fk_Id_grupo = grupo.Pk_Id_grupo) ON grupo_proyecto.Fk_clave_proyecto = proyecto.Pk_clave_proyecto WHERE grupo.usuario = %s", GetSQLValueString($colname_listaproyectos, "int"));
$listaproyectos = mysql_query($query_listaproyectos, $redx) or die(mysql_error());
$totalRows_listaproyectos = mysql_num_rows($listaproyectos);

mysql_select_db($database_redx, $redx);
$query_misgrupos = sprintf("SELECT Pk_Id_grupo, Nom_Grupo FROM grupo WHERE usuario = %s", GetSQLValueString($colname_misgrupos, "int"));
$misgrupos = mysql_query($query_misgrupos, $redx) or die(mysql_error());
$totalRows_misgrupos = mysql_num_rows($misgrupos);

mysql_select_db($database_redx, $redx);
$query_misproyectos_insertar = sprintf("SELECT Pk_clave_proyecto, Nom_proyecto FROM proyecto WHERE usuario = %s", GetSQLValueString($colname_misproyectos_insertar, "int"));
$misproyectos_insertar = mysql_query($query_misproyectos_insertar, $redx) or die(mysql_error());
$totalRows_misproyectos_insertar = mysql_num_rows($misproyectos_insertar);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mis proyectos</title>

<link href="../estilos.css" rel="stylesheet" type="text/css" />
<script src="../global.js" language="javascript" type="text/javascript" ></script>
</head>

<body class="cuerpoPredeterminado">

<?php 
	$page = 4;
	include_once "barner_top.php" 
?>

<table bgcolor="#FFFFFF" class="tablaContenido" width="800"><tr><td>
    <p class="parrafoTitulo">
    <!-- ### INICIO DE CONTENIDO ### -->
    
    Mis proyectos</p>
    <p class="parrafoNormal">Listado de tus proyectos, para agregar otro has clic <a href="proyectos.php?insertar=true">aquí</a>. </p>
<table border="1">
  <tr>
    <td>Clave</td>
    <td>Nombre</td>
        <td>Descripcion</td>
    </tr>
      <?php while ($row_misproyectos = mysql_fetch_assoc($misproyectos)) { ?>
        <tr>
          <td><?php echo $row_misproyectos['Pk_clave_proyecto']; ?></td>
          <td><?php echo $row_misproyectos['Nom_proyecto']; ?></td>
          <td><?php echo $row_misproyectos['Decripcion_proyecto']; ?></td>
          </tr>
        <?php } ; ?>
</table>
<p class="parrafoNormal">&nbsp;</p>
<div style="display: <?php echo $display; ?>">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p class="parrafoNormal"><strong>Insertar nuevo proyecto</strong></p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre proyecto:</td>
      <td><input type="text" name="Nom_proyecto" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Descripcion proyecto:</td>
      <td><input type="text" name="Decripcion_proyecto" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Registrar" /></td>
    </tr>
  </table>
  <input type="hidden" name="Pk_clave_proyecto" value="" />
  <input type="hidden" name="usuario" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
<p class="parrafoNormal"><strong>Añadir proyectos a mis grupos</strong>. </p>
<p class="parrafoNormal">Primero aparece la relación de grupos y proyectos y, a continuación, podrá seguir agregando más en el formulario de registro que aparece más abajo.</p>
<div align="center">
<p class="parrafoNormal" style="color:#F00"><?php echo $errorEntraGrupo; ?>
  <table border="1">
    <tr>
      <td width="137">Pk_clave</td>
      <td width="188">Nombre Grupo</td>
      <td width="187">Nombre proyecto</td>
      </tr>
    <?php while ($row_listaproyectos = mysql_fetch_assoc($listaproyectos)) { ?>
      <tr>
        <td><?php echo $row_listaproyectos['Pk_clave']; ?></td>
        <td><?php echo $row_listaproyectos['Nom_Grupo']; ?></td>
        <td><?php echo $row_listaproyectos['Nom_proyecto']; ?></td>
        </tr>
      <?php } ; ?>
  </table>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td width="53" align="right" nowrap="nowrap">Grupo:</td>
      <td width="320"><select name="Fk_Id_grupo">
        <?php
        while ($row_misgrupos = mysql_fetch_assoc($misgrupos)) {
?>
        <option value="<?php echo $row_misgrupos['Pk_Id_grupo']?>" ><?php echo $row_misgrupos['Nom_Grupo']?></option>
        <?php
} ;
?>
        </select></td>
      </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Proyecto:</td>
      <td><select name="Fk_clave_proyecto">
        <?php
        while ($row_misproyectos_insertar = mysql_fetch_assoc($misproyectos_insertar)) {
?>
        <option value="<?php echo $row_misproyectos_insertar['Pk_clave_proyecto']?>" ><?php echo $row_misproyectos_insertar['Nom_proyecto']?></option>
        <?php
} ;
?>
        </select></td>
      </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Añadir" /></td>
      </tr>
    </table>
  <input type="hidden" name="Pk_clave" value="" />
  <input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
<p class="parrafoNormal">&nbsp;</p></td></tr></table>
        <!-- ### FIN DE CONTENIDO ### -->
</td>
  </tr>
</table>

<p class="parrafoCreditos">© RED X.</p>

</body>
</html>
<?php
mysql_free_result($misproyectos);

mysql_free_result($listaproyectos);

mysql_free_result($misgrupos);

mysql_free_result($misproyectos_insertar);
?>
