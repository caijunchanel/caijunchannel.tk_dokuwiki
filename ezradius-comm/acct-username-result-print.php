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

$user_rsTotAcctUser = "0";
if (isset($_REQUEST["username"])) {
  $user_rsTotAcctUser = $_REQUEST["username"];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsTotAcctUser = "SELECT SUM(AcctSessionTime), COUNT(RadAcctId), SUM(AcctInputOctets), SUM(AcctOutputOctets) FROM radacct WHERE ";
if (($_REQUEST['startDate']<>'') && ($_REQUEST['endDate']<>'')) {
	if ($_REQUEST['startDate']==$_REQUEST['endDate']) {
		$query_rsTotAcctUser=$query_rsTotAcctUser."DATE(AcctStartTime)='".$_REQUEST['startDate']."' AND ";
	} else {
		$query_rsTotAcctUser=$query_rsTotAcctUser."(AcctStartTime between '".$_REQUEST['startDate']."' AND '".$_REQUEST['endDate']."') AND ";
	}
}
$query_rsTotAcctUser = sprintf("%s UserName=%s", $query_rsTotAcctUser, GetSQLValueString($user_rsTotAcctUser, "text"));

//echo $query_rsTotAcctUser."<br>";

$rsTotAcctUser = mysql_query($query_rsTotAcctUser, $cnRadius) or die(mysql_error());
$row_rsTotAcctUser = mysql_fetch_assoc($rsTotAcctUser);
$totalRows_rsTotAcctUser = mysql_num_rows($rsTotAcctUser);

$maxRows_rsAcctUser = 25;
$pageNum_rsAcctUser = 0;
if (isset($_REQUEST['pageNum_rsAcctUser'])) {
  $pageNum_rsAcctUser = $_REQUEST['pageNum_rsAcctUser'];
}
$startRow_rsAcctUser = $pageNum_rsAcctUser * $maxRows_rsAcctUser;

$user2_rsAcctUser = "0";
if (isset($_REQUEST['username'])) {
  $user2_rsAcctUser = $_REQUEST['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);

$query_rsAcctUser = sprintf("SELECT radacct.RadAcctId, radacct.UserName, radacct.FramedIPAddress, radacct.AcctStartTime, radacct.AcctStopTime, radacct.AcctSessionTime, radacct.AcctInputOctets, radacct.AcctOutputOctets, radacct.AcctTerminateCause, radacct.NASIPAddress FROM radacct WHERE UserName=%s", GetSQLValueString($user2_rsAcctUser, "text"));

if (($_REQUEST['startDate']<>'') && ($_REQUEST['endDate']<>'')) {
	if ($_REQUEST['startDate']==$_REQUEST['endDate']) {
		$query_rsAcctUser=$query_rsAcctUser." AND DATE(AcctStartTime)='".$_REQUEST['startDate']."'";
	} else {
		$query_rsAcctUser=$query_rsAcctUser." AND (AcctStartTime BETWEEN '".$_REQUEST['startDate']."' AND '".$_REQUEST['endDate']."')";
	}
}
//echo $query_rsAcctUser."<br>";
//$query_limit_rsAcctUser = sprintf("%s LIMIT %d, %d", $query_rsAcctUser, $startRow_rsAcctUser, $maxRows_rsAcctUser);
$query_limit_rsAcctUser = $query_rsAcctUser;
$rsAcctUser = mysql_query($query_limit_rsAcctUser, $cnRadius) or die(mysql_error());
$row_rsAcctUser = mysql_fetch_assoc($rsAcctUser);

if (isset($_REQUEST['totalRows_rsAcctUser'])) {
  $totalRows_rsAcctUser = $_REQUEST['totalRows_rsAcctUser'];
} else {
  $all_rsAcctUser = mysql_query($query_rsAcctUser);
  $totalRows_rsAcctUser = mysql_num_rows($all_rsAcctUser);
}
$totalPages_rsAcctUser = ceil($totalRows_rsAcctUser/$maxRows_rsAcctUser)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>User's all accountings</title>
</head>

<body onload="javascript:window.print()">
<div align="center"><b><?php echo $companyName;?></b></div><br />
<div align="center"><b><?php echo $companyAddr;?></b></div><br />
<p>Accountings summary for : <b><?php echo $_REQUEST['username']; ?></b>
<?php
if (isset($_REQUEST['startDate'])&&isset($_REQUEST['endDate'])) {
?>
between <b><?php echo $_REQUEST['startDate']; ?></b> and <b><?php echo $_REQUEST['endDate']; ?></b></p>
<?php
}
?>
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
