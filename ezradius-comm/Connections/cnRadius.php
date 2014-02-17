<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnRadius = "localhost"; #### MySQL server location that used by FreeRADIUS
$database_cnRadius = "radius"; #### Name of the sql database  used by FreeRADIUS
$username_cnRadius = "freeradius"; #### Username of the sql database
$password_cnRadius = "freeradius"; #### Password of the sql database
$cnRadius = mysql_pconnect($hostname_cnRadius, $username_cnRadius, $password_cnRadius) or trigger_error(mysql_error(),E_USER_ERROR); 
?>