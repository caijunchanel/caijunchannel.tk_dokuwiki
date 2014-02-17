<?php
require_once('auth.php');
?>
<?php require_once('Connections/cnRadius.php'); ?>
<?php require_once('ffdb.inc.php'); ?>
<?php
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

if ((isset($_GET['groupname'])) && ($_GET['groupname'] != "") && (isset($_GET['groupname']))) {
  $deleteSQL = sprintf("DELETE FROM radgroupcheck WHERE GroupName=%s",
                       GetSQLValueString($_GET['groupname'], "text"));

  mysql_select_db($database_cnRadius, $cnRadius);
  $Result1 = mysql_query($deleteSQL, $cnRadius) or die(mysql_error());
  
  //delete from radgroupreply
  $deleteSQL = sprintf("DELETE FROM radgroupreply WHERE GroupName=%s",
                       GetSQLValueString($_GET['groupname'], "text"));

  mysql_select_db($database_cnRadius, $cnRadius);
  $Result1 = mysql_query($deleteSQL, $cnRadius) or die(mysql_error());
  
  //delete from usergroup
  $deleteSQL = sprintf("DELETE FROM usergroup WHERE GroupName=%s",
                       GetSQLValueString($_GET['groupname'], "text"));

  mysql_select_db($database_cnRadius, $cnRadius);
  $Result1 = mysql_query($deleteSQL, $cnRadius) or die(mysql_error());
  
  	//delete price
  	$db = new FFDB();
	$db->open('price'); 
	$db->removebykey($_GET['groupname']);
	$db->cleanup();
	$db->close();

  $deleteGoTo = "list-allgroup.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
