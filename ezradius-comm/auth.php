<?php
require_once('config.php');

function pesanTolak() {
echo ('<p align="center"><strong>Authorization needed!</strong></p>
<p align="center">You do not have access to this page.');
}

if (!isset($_SERVER["PHP_AUTH_USER"])) {
	header('WWW-Authenticate: Basic realm="ezRADIUS"');
	header('HTTP/1.0 401 Unauthorized');
	pesanTolak();
	exit();
} else if (isset($_SERVER["PHP_AUTH_USER"])) {
	if (($_SERVER["PHP_AUTH_USER"]!=$appUser) || ($_SERVER["PHP_AUTH_PW"]!=$appPasswd)) {
		header('WWW-Authenticate: Basic realm="ezRADIUS"');
		header('HTTP/1.0 401 Unauthorized');
		pesanTolak();
		exit();
	}
}
?>
