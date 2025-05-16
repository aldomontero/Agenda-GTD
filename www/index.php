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
?>
<?php


$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "session_started/index.php";
  $MM_redirectLoginFailed = "index.php?error=No se puede encontrar al usuario o password incorrecto";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_redx, $redx);
  
  $LoginRS__query=sprintf("SELECT Nombre, Password, Pk_usuario FROM usuario WHERE Nombre=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $redx) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	$row = mysql_fetch_array($LoginRS);
	setcookie("usuario", $row['Pk_usuario']);
    header("Location: " . $MM_redirectLoginSuccess);
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inicio Agenda GTD Red X</title>

<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="global.js" language="javascript" type="text/javascript" ></script>
</head>

<body class="cuerpoPredeterminado">

<?php 
	$page = 1;
	include_once "barner_top.php" 
?>
    
<table bgcolor="#FFFFFF" class="tablaContenido" width="800"><tr><td>
    <p class="parrafoTitulo">
    <!-- ### INICIO DE CONTENIDO ### -->
    
    Inicio</p>
    <p class="parrafoNormal">Bienvenidos al sistema GTD RED-X aqui podra mantener sus tareas en orden y con   la facilidad de realizacion, les proporcionamos una herramienta util para que   usted mismo elija como y cuando llevar a cabo cada tarea.</p>
    <p class="parrafoNormal">Si ya tienes cuenta que esperas empieza a ORGANIZARTE!!</p>
    <p class="parrafoNormal">Aun no la tienes???? No te preocupes. </p>
    <p style="color:#F00"><?php 
		if (isset($_GET['error'])) {
			echo $_GET['error'];
	    }
		?></p>
    <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
    <table align="center" width="213" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td colspan="2" align="center"><strong>INICIAR SESIÓN</strong></td>
        </tr>
      <tr>
        <td width="55"><p>Usuario:</p>
          <p>Password:</p></td>
        <td width="147">
            <input type="text" name="usuario" id="usuario" />
             &nbsp;<br />
            <input type="password" name="password" id="password" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div align="center">
            <input type="submit" name="button" id="button" value="Enviar" />
          </div></td>
        </tr>
    </table></form>
    <p class="parrafoNormal">&nbsp;</p>
    <p align="center">REGISTRATE!!!!</p></td></tr></table>
        <!-- ### FIN DE CONTENIDO ### -->
</td>
  </tr>
</table>

<p class="parrafoCreditos">© RED X.</p>

</body>
</html>