<?php require_once('Connections/conStatus.php'); ?>
<?php
// load the error handling module
require_once('error_handler.php');
// make sure the user's browser doesn't cache the result
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

$colname_rsStatus = "-1";
if (isset($_GET['username'])) {
  $colname_rsStatus = (get_magic_quotes_gpc()) ? $_GET['username'] : addslashes($_GET['username']);
}
mysql_select_db($database_conStatus, $conStatus);
$query_rsStatus = sprintf("SELECT * FROM radacct WHERE username = '%s' AND AcctStopTime is NULL", $colname_rsStatus);
$rsStatus = mysql_query($query_rsStatus, $conStatus) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);

if ($totalRows_rsStatus>0) {
	//tampilkan dalam bentuk tabel
	echo "<table border='1'><tr><td><b>Username</b></td><td>".$colname_rsStatus."</td></tr>".
	"<tr><td><b>Total time</b></td><td>".$row_rsStatus['AcctSessionTime']." s</td></tr>".
	"<tr><td><b>Upload</b></td><td>".$row_rsStatus['AcctInputOctets']." bytes</td></tr>".
	"<tr><td><b>Download</b></td><td>".$row_rsStatus['AcctOutputOctets']." bytes</td></tr>".
	"</table>";
} else {
	echo "No Data";
}

mysql_free_result($rsStatus);
?>