<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cn = "localhost";
$database_cn = "doc_connect";
$username_cn = "root";
$password_cn = "";
$cn = mysql_pconnect($hostname_cn, $username_cn, $password_cn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>