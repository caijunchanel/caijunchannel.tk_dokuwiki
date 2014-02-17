<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conStatus = "localhost"; //host where MySQL for RADIUS server reside
$database_conStatus = "radius"; //the database name
$username_conStatus = "freeradius"; //the username that have full access to database name(radius)
$password_conStatus = "freeradius"; //the password
$conStatus = mysql_pconnect($hostname_conStatus, $username_conStatus, $password_conStatus) or trigger_error(mysql_error(),E_USER_ERROR); 
?>