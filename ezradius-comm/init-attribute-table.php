<?php require_once('auth.php'); ?>
<?php require_once('ffdb.inc.php'); ?>
<?php
//delete old database if exists
$flatDB = new FFDB();
if ($flatDB->open('attribute')) {
	//already exists, delete it
	$flatDB->drop;
}

//database schema
$schema = array( 
      array("id", FFDB_INT_AUTOINC, "key"),
      array("display", FFDB_STRING), 
      array("value", FFDB_STRING),
      array("version", FFDB_STRING),
	  array("table", FFDB_STRING)
	  );
   
// Try and create it... 
if (!$flatDB->create("attribute", $schema))
{
	echo "Error creating database\n";
    exit(0);
}

//add predefined 'check' attribute
$record['display']='Auth-Type';
$record['value']='Auth-Type';
$record['version']='1.1.3';
$record['table']='check';
$flatDB->add($record);

$record['display']='Simultaneous-Use';
$record['value']='Simultaneous-Use';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Octets';
$record['value']='Max-Octets';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Daily-Octets';
$record['value']='Max-Daily-Octets';
$record['version']='1.1.4';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Weekly-Octets';
$record['value']='Max-Weekly-Octets';
$record['version']='1.1.4';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Monthly-Octets';
$record['value']='Max-Monthly-Octets';
$record['version']='1.1.4';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-All-Session';
$record['value']='Max-All-Session';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Daily-Session';
$record['value']='Max-Daily-Session';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Weekly-Session';
$record['value']='Max-Weekly-Session';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Max-Monthly-Session';
$record['value']='Max-Monthly-Session';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='NAS-IP-Address';
$record['value']='NAS-IP-Address';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Service-Type';
$record['value']='Service-Type';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Framed-IP-Address';
$record['value']='Framed-IP-Address';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='State';
$record['value']='State';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Called-Station-ID';
$record['value']='Called-Station-ID';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Calling-Station-ID';
$record['value']='Calling-Station-ID';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='NAS-ID';
$record['value']='NAS-ID';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Acct-Session-ID';
$record['value']='Acct-Session-ID';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='NAS-Port-Type';
$record['value']='NAS-Port-Type';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Message-Authenticator';
$record['value']='Message-Authenticator';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='WISPr-Location-ID';
$record['value']='WISPr-Location-ID';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='WISPr-Location-Name';
$record['value']='WISPr-Location-Name';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='WISPr-Logoff-URL';
$record['value']='WISPr-Logoff-URL';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

$record['display']='Expiration';
$record['value']='Expiration';
$record['version']='both';
$record['table']='check';
$flatDB->add($record);

//add predefined 'reply' attribute
$record['display']='Acct-Interim-Interval';
$record['value']='Acct-Interim-Interval';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Idle-Timeout';
$record['value']='Idle-Timeout';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Session-Timeout';
$record['value']='Session-Timeout';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Service-Type';
$record['value']='Service-Type';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Framed-IP-Address';
$record['value']='Framed-IP-Address';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Reply-Message';
$record['value']='Reply-Message';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='State';
$record['value']='State';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Class';
$record['value']='Class';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='Message-Authenticator';
$record['value']='Message-Authenticator';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='WISPr-Redirection-URL';
$record['value']='WISPr-Redirection-URL';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='WISPr-Bandwidth-Max-Up';
$record['value']='WISPr-Bandwidth-Max-Up';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='WISPr-Bandwidth-Max-Down';
$record['value']='WISPr-Bandwidth-Max-Down';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='WISPr-Session-Terminate-Time';
$record['value']='WISPr-Session-Terminate-Time';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='ChilliSpot-Max-Input-Octets';
$record['value']='ChilliSpot-Max-Input-Octets';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='ChilliSpot-Max-Output-Octets';
$record['value']='ChilliSpot-Max-Output-Octets';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='ChilliSpot-Max-Total-Octets';
$record['value']='ChilliSpot-Max-Total-Octets';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='ChilliSpot-UAM-Allowed';
$record['value']='ChilliSpot-UAM-Allowed';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

$record['display']='ChilliSpot-MAC-Allowed';
$record['value']='ChilliSpot-MAC-Allowed';
$record['version']='both';
$record['table']='reply';
$flatDB->add($record);

//done !!
$flatDB->close;

header("Location: list-radius-attribute.php");
?>
