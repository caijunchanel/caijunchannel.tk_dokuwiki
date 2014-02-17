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

if (!isset($_REQUEST["username"])||$_REQUEST["username"]=='') {
	//not valid input
	header(sprintf("Location: %s", "acct-username-input-all.php"));
}

$user_rsTotAcctUser = "0";
if (isset($_REQUEST["username"])) {
  $user_rsTotAcctUser = $_REQUEST["username"];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsTotAcctUser = "SELECT SUM(AcctSessionTime), COUNT(RadAcctId), SUM(AcctInputOctets), SUM(AcctOutputOctets) FROM radacct WHERE ";
$query_rsTotAcctUser = sprintf("%s UserName=%s", $query_rsTotAcctUser, GetSQLValueString($user_rsTotAcctUser, "text"));

//echo $query_rsTotAcctUser."<br>";

$rsTotAcctUser = mysql_query($query_rsTotAcctUser, $cnRadius) or die(mysql_error());
$row_rsTotAcctUser = mysql_fetch_assoc($rsTotAcctUser);
$totalRows_rsTotAcctUser = mysql_num_rows($rsTotAcctUser);

$user2_rsAcctUser = "0";
if (isset($_REQUEST['username'])) {
  $user2_rsAcctUser = $_REQUEST['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);

$query_rsAcctUser = sprintf("SELECT radacct.RadAcctId, radacct.UserName, radacct.FramedIPAddress, radacct.AcctStartTime, radacct.AcctStopTime, radacct.AcctSessionTime, radacct.AcctInputOctets, radacct.AcctOutputOctets, radacct.AcctTerminateCause, radacct.NASIPAddress FROM radacct WHERE UserName=%s", GetSQLValueString($user2_rsAcctUser, "text"));

$query_limit_rsAcctUser = $query_rsAcctUser;
$rsAcctUser = mysql_query($query_limit_rsAcctUser, $cnRadius) or die(mysql_error());
$row_rsAcctUser = mysql_fetch_assoc($rsAcctUser);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>All accountings for user</title>
</head>

<body onload="javascript:window.print()">
<div align="center"><b><?php echo $companyName;?></b></div><br />
<div align="center"><b><?php echo $companyAddr;?></b></div><br />
<p>Accountings summary for : <b><?php echo $_REQUEST['username']; ?></b></p>
<table border="1">
<thead>
  <tr>
    <td>UserName</td>
    <td>Total Time</td>
    <td>Total Session</td>
    <td>Upload </td>
    <td>Download </td>
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $_REQUEST['username'];?></td>
      <td><?php echo humanTime($row_rsTotAcctUser['SUM(AcctSessionTime)']); ?></td>
      <td><?php echo $row_rsTotAcctUser['COUNT(RadAcctId)']; ?></td>
      <td><?php echo $row_rsTotAcctUser['SUM(AcctInputOctets)']; ?></td>
      <td><?php echo $row_rsTotAcctUser['SUM(AcctOutputOctets)']; ?></td>
    </tr>
    <?php } while ($row_rsTotAcctUser = mysql_fetch_assoc($rsTotAcctUser)); ?>
	</tbody>
</table>
<p>&nbsp;<strong> Accounting Details:</strong>
<table border="1">
<thead>
  <tr>
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
</body>
</html>
