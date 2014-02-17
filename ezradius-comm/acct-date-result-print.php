<?php
require_once('auth.php');
?>
<?php require_once('Connections/cnRadius.php'); ?>
<?php
require_once('library/function.php');

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_cnRadius, $cnRadius);

if ($_REQUEST['endDate']!=$_REQUEST['startDate']) {
	$query_rsAcctUser = sprintf("SELECT radacct.RadAcctId, radacct.UserName, radacct.FramedIPAddress, radacct.AcctStartTime, radacct.AcctStopTime, radacct.AcctSessionTime, radacct.AcctInputOctets, radacct.AcctOutputOctets, radacct.AcctTerminateCause, radacct.NASIPAddress FROM radacct WHERE AcctStartTime BETWEEN %s AND %s", GetSQLValueString($_REQUEST['startDate'], "date"), GetSQLValueString($_REQUEST['endDate'], "date"));
} else {
	$query_rsAcctUser = sprintf("SELECT radacct.RadAcctId, radacct.UserName, radacct.FramedIPAddress, radacct.AcctStartTime, radacct.AcctStopTime, radacct.AcctSessionTime, radacct.AcctInputOctets, radacct.AcctOutputOctets, radacct.AcctTerminateCause, radacct.NASIPAddress FROM radacct WHERE DATE(AcctStartTime)=DATE(%s)", GetSQLValueString($_REQUEST['startDate'], "date"));
}

$query_limit_rsAcctUser = $query_rsAcctUser;
$rsAcctUser = mysql_query($query_limit_rsAcctUser, $cnRadius) or die(mysql_error());
$row_rsAcctUser = mysql_fetch_assoc($rsAcctUser);
$totalRows_rsAcctUser = mysql_num_rows($rsAcctUser);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Accounting by Date</title>
</head>

<body onload="javascript:window.print()">
<div align="center"><b><?php echo $companyName;?></b></div><br />
<div align="center"><b><?php echo $companyAddr;?></b></div><br />
<?php
	if ($totalRows_rsAcctUser>0) {
	?>
	<p>&nbsp;<strong>Accountings between <b><?php echo $_REQUEST['startDate']; ?></b> and <b><?php echo $_REQUEST['endDate']; ?> </b>:</strong>
	<table border="1">
<thead>
  <tr>
	<td>Username</td>
    <td>IP Address</td>
    <td>Start Time</td>
    <td>Stop Time</td>
    <td>Time</td>
    <td>Upload</td>
    <td>Download</td>
    <td>Termination</td>
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr>
	  <td><?php echo $row_rsAcctUser['UserName']; ?></td>
      <td><?php echo $row_rsAcctUser['FramedIPAddress']; ?></td>
      <td><?php echo $row_rsAcctUser['AcctStartTime']; ?></td>
      <td><?php echo $row_rsAcctUser['AcctStopTime']; ?></td>
      <td><?php echo humanTime($row_rsAcctUser['AcctSessionTime']); ?></td>
      <td><?php echo $row_rsAcctUser['AcctInputOctets']; ?></td>
      <td><?php echo $row_rsAcctUser['AcctOutputOctets']; ?></td>
      <td><?php echo $row_rsAcctUser['AcctTerminateCause']; ?></td>
    </tr>
    <?php } while ($row_rsAcctUser = mysql_fetch_assoc($rsAcctUser)); ?>
	</tbody>
</table>
<?php
} else {
	echo "No Data";
}
?>
</body>
</html>
