<?php require_once('auth.php'); ?>
<?php require_once('ffdb.inc.php'); ?>
<?php
//delete old database if exists
$flatDB = new FFDB();
if ($flatDB->open('price')) {
	//already exists, delete it
	$flatDB->drop;
}

//database schema
$schema = array( 
      array("package_id", FFDB_STRING, "key"), 
      array("price", FFDB_STRING)
	  );
   
// Try and create it... 
if (!$flatDB->create("price", $schema))
{
	echo "Error creating database\n";
    exit(0);
}
?>