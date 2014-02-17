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

$colname_rsAcct = "-1";
if (isset($_GET['id'])) {
  $colname_rsAcct = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsAcct = sprintf("SELECT * FROM radacct WHERE RadAcctId = %s", GetSQLValueString($colname_rsAcct, "int"));
$rsAcct = mysql_query($query_rsAcct, $cnRadius) or die(mysql_error());
$row_rsAcct = mysql_fetch_assoc($rsAcct);
$totalRows_rsAcct = mysql_num_rows($rsAcct);

mysql_select_db($database_cnRadius, $cnRadius);
$query_rsGroup = sprintf("SELECT * FROM usergroup WHERE UserName = %s", GetSQLValueString($row_rsAcct['UserName'], "text"));
$rsGroup = mysql_query($query_rsGroup, $cnRadius) or die(mysql_error());
$row_rsGroup = mysql_fetch_assoc($rsGroup);
$totalRows_rsGroup = mysql_num_rows($rsGroup);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Accounting data</title>
</head>

<body onload="javascript:window.print()">
<div align="center"><b><?php echo $companyName;?></b></div><br />
<div align="center"><b><?php echo $companyAddr;?></b></div><br />
<table width="100%" border="0">
  <tr>
    <td width="16%"><strong>Username</strong></td>
    <td width="2%"><strong>:</strong></td>
    <td width="82%"><?php echo $row_rsAcct['UserName']; ?></td>
  </tr>
  <tr>
    <td><strong>Realm</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['Realm']; ?></td>
  </tr>
  <tr>
    <td><strong>Package</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsGroup['GroupName']; ?></td>
  </tr>
  <tr>
    <td><strong>IP Address</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['FramedIPAddress']; ?></td>
  </tr>
  <tr>
    <td><strong>Start Time</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['AcctStartTime']; ?></td>
  </tr>
  <tr>
    <td><strong>Stop Time</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['AcctStopTime']; ?></td>
  </tr>
  <tr>
    <td><strong>Total Time</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo humanTime($row_rsAcct['AcctSessionTime']); ?></td>
  </tr>
  <tr>
    <td><strong>Upload</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['AcctInputOctets']; ?> bytes </td>
  </tr>
  <tr>
    <td><strong>Download</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['AcctOutputOctets']; ?> bytes </td>
  </tr>
  <tr>
    <td><strong>Termination </strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $row_rsAcct['AcctTerminateCause']; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsAcct);

mysql_free_result($rsGroup);
?>
