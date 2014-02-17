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

$colname_rsGroupCheck = "-1";
if (isset($_GET['groupname'])) {
  $colname_rsGroupCheck = $_GET['groupname'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsGroupCheck = sprintf("SELECT * FROM radgroupcheck WHERE GroupName = %s", GetSQLValueString($colname_rsGroupCheck, "text"));
$rsGroupCheck = mysql_query($query_rsGroupCheck, $cnRadius) or die(mysql_error());
$row_rsGroupCheck = mysql_fetch_assoc($rsGroupCheck);
$totalRows_rsGroupCheck = mysql_num_rows($rsGroupCheck);

$colname_rsGroupReply = "-1";
if (isset($_GET['groupname'])) {
  $colname_rsGroupReply = $_GET['groupname'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsGroupReply = sprintf("SELECT * FROM radgroupreply WHERE GroupName = %s", GetSQLValueString($colname_rsGroupReply, "text"));
$rsGroupReply = mysql_query($query_rsGroupReply, $cnRadius) or die(mysql_error());
$row_rsGroupReply = mysql_fetch_assoc($rsGroupReply);
$totalRows_rsGroupReply = mysql_num_rows($rsGroupReply);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Package detail</title>
</head>

<body onload="javascript:window.print()">
<div align="center"><b><?php echo $companyName;?></b></div><br />
<div align="center"><b><?php echo $companyAddr;?></b></div><br />
<?php if (($totalRows_rsGroupCheck == 0) && ($totalRows_rsGroupReply== 0)) { // Show if recordset empty ?>
        <p>Invalid input: Specified package does not exists! </p>
        <?php } // Show if recordset empty ?>
    <?php if (($totalRows_rsGroupCheck >0) || ($totalRows_rsGroupReply>0)) { // Show if recordset not empty ?>
      <p><strong>Package name : <?php echo $_GET['groupname']; ?></strong></p>
	  <?php
	  if ($currShow==1) {
	  ?>
      	<p><strong>Price : 
		<?php
		$db = new FFDB();
		$db->open('price');
		$rec=$db->getbykey($_GET['groupname']);
		echo $currSymbol." ".$rec['price'];
		$db->close;
		?>
		</strong></p>
	  <?php
	  }
	  ?>
      <p><strong>RadGroupCheck</strong></p>
      <?php if ($totalRows_rsGroupCheck == 0) { // Show if recordset empty ?>
        <p>No Data</p>
        <?php } // Show if recordset empty ?>
      <?php if ($totalRows_rsGroupCheck > 0) { // Show if recordset not empty ?>
        <table border="1">
		<thead>
          <tr>
            <td>id</td>
            <td>Attribute</td>
            <td>op</td>
            <td>Value</td>
          </tr>
		  </thead>
		  <tbody>
          <?php do { ?>
            <tr>
              <th><?php echo $row_rsGroupCheck['id']; ?></th>
              <td><?php echo $row_rsGroupCheck['Attribute']; ?></td>
              <td><?php echo $row_rsGroupCheck['op']; ?></td>
              <td><?php echo $row_rsGroupCheck['Value']; ?></td>
            </tr>
            <?php } while ($row_rsGroupCheck = mysql_fetch_assoc($rsGroupCheck)); ?>
			</tbody>
        </table>
        <?php } // Show if recordset not empty ?>
      <p><strong>RadGroupReply</strong></p>
      <?php if ($totalRows_rsGroupReply == 0) { // Show if recordset empty ?>
        <p>No Data</p>
        <?php } // Show if recordset empty ?>
      <?php if ($totalRows_rsGroupReply > 0) { // Show if recordset not empty ?>
        <table border="1">
		<thead>
          <tr>
            <td>id</td>
            <td>Attribute</td>
            <td>op</td>
            <td>Value</td>
          </tr>
		  </thead>
		  <tbody>
          <?php do { ?>
            <tr>
              <th><?php echo $row_rsGroupReply['id']; ?></th>
              <td><?php echo $row_rsGroupReply['Attribute']; ?></td>
              <td><?php echo $row_rsGroupReply['op']; ?></td>
              <td><?php echo $row_rsGroupReply['Value']; ?></td>
            </tr>
            <?php } while ($row_rsGroupReply = mysql_fetch_assoc($rsGroupReply)); ?>
			</tbody>
        </table>
        <?php } // Show if recordset not empty ?>
      <?php } // Show if recordset not empty ?>
</body>
</html>
