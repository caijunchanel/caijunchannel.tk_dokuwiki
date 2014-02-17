<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conStatus = "10.31.12.107";
$database_conStatus = "radius";
$username_conStatus = "freeradius";
$password_conStatus = "freeradius";
$conStatus = mysql_pconnect($hostname_conStatus, $username_conStatus, $password_conStatus) or trigger_error(mysql_error(),E_USER_ERROR); 
?>