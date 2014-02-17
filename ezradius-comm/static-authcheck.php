<?php
require_once('auth.php');
require_once('ffdb.inc.php');

//this file contain all  reply (user and group) attributes that freeRadius knows
?>
<select name="Attribute">
<?php
//load attribute from flat-file database
$db = new FFDB();
$db->open('attribute');

$record=$db->getall();

foreach ($record as $rowset){
	if (($rowset['table']=='check')||($rowset['table']=='all')) {
		if (($freeradiusVersion=='1.1.4')&&(($rowset['version']=='1.1.4')||($rowset['version']=='both'))) {
			echo '<option value="'.$rowset['value'].'">'.$rowset['display'].'</option>'.chr(13);
		}
		
		if (($freeradiusVersion=='1.1.3')&&(($rowset['version']=='1.1.3')||($rowset['version']=='both'))) {
			echo '<option value="'.$rowset['value'].'">'.$rowset['display'].'</option>'.chr(13);
		}
	}
}

echo '</select>';

$db->close;
?>