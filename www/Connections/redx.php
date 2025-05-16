<?php
//Remover o comentar si estas usando una version de PHP <= 7
require_once 'mysql_legacy_support.php';

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_redx = "localhost";
$database_redx = "aldom_com_redx";
$username_redx = "root";
$password_redx = "";
$redx = mysql_pconnect($hostname_redx, $username_redx, $password_redx) or trigger_error(mysql_error(),E_USER_ERROR); 
