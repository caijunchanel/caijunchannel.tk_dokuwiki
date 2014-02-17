<?php require_once('auth.php'); ?>
<?php
require_once('ffdb.inc.php');

//delete radius attribute if exists
if (isset($_GET['id'])) {
	$db = new FFDB();
	$db->open('attribute');
	if ($db->exists($_GET['id'])) 
		$db->removebykey($_GET['id']);
	$db->cleanup();
	$db->close();
}

header ("Location: list-radius-attribute.php");
?>