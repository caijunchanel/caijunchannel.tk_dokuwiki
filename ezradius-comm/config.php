<?php
$configVars=parse_ini_file("config/config.ini", TRUE);

//administrator user of this web apps 
$appUser=$configVars['administrator']['username'];
//the password
$appPasswd=$configVars['administrator']['password'];

$freeradiusVersion = $configVars['freeradius']['version']; //for freeradius version 1.1.3 and below, use "1.1.3", otherwise use "1.1.4"

if ($freeradiusVersion=="1.1.3") {
	$userPassword="User-Password";
} else {                         //using freeRADIUS 1.1.4 and above
	$userPassword="MD5-Password";
}

//company settings
$companyName=$configVars['company']['name'];
$companyAddr=$configVars['company']['address'];
$currSymbol=$configVars['currency']['symbol'];
$currShow=$configVars['currency']['show'];

?>