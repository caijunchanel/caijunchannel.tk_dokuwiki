<?php
require_once('auth.php');
?>
<?php require_once('Connections/cnRadius.php'); ?>
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

$colname_rsUser = "-1";
if (isset($_GET['username'])) {
  $colname_rsUser = $_GET['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsUser = sprintf("SELECT * FROM radcheck WHERE UserName = %s AND Attribute LIKE '%%-Password'", GetSQLValueString($colname_rsUser, "text"));
$rsUser = mysql_query($query_rsUser, $cnRadius) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);

$colname_rsRadcheckUser = "-1";
if (isset($_GET['username'])) {
  $colname_rsRadcheckUser = $_GET['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsRadcheckUser = sprintf("SELECT * FROM radcheck WHERE UserName = %s AND Attribute not like '%%-Password'", GetSQLValueString($colname_rsRadcheckUser, "text"));
$rsRadcheckUser = mysql_query($query_rsRadcheckUser, $cnRadius) or die(mysql_error());
$row_rsRadcheckUser = mysql_fetch_assoc($rsRadcheckUser);
$totalRows_rsRadcheckUser = mysql_num_rows($rsRadcheckUser);

$colname_rsRadreplyUser = "-1";
if (isset($_GET['username'])) {
  $colname_rsRadreplyUser = $_GET['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsRadreplyUser = sprintf("SELECT * FROM radreply WHERE UserName = %s", GetSQLValueString($colname_rsRadreplyUser, "text"));
$rsRadreplyUser = mysql_query($query_rsRadreplyUser, $cnRadius) or die(mysql_error());
$row_rsRadreplyUser = mysql_fetch_assoc($rsRadreplyUser);
$totalRows_rsRadreplyUser = mysql_num_rows($rsRadreplyUser);

$colname_rsUserGroup = "-1";
if (isset($_GET['username'])) {
  $colname_rsUserGroup = $_GET['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsUserGroup = sprintf("SELECT * FROM usergroup WHERE UserName = %s", GetSQLValueString($colname_rsUserGroup, "text"));
$rsUserGroup = mysql_query($query_rsUserGroup, $cnRadius) or die(mysql_error());
$row_rsUserGroup = mysql_fetch_assoc($rsUserGroup);
$totalRows_rsUserGroup = mysql_num_rows($rsUserGroup);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>User detail</title>
</head>

<body onload="javascript:window.print()">
<div align="center"><b><?php echo $companyName;?></b></div><br />
<div align="center"><b><?php echo $companyAddr;?></b></div><br />
<?php if ($totalRows_rsUser > 0) { // Show if recordset not empty ?>
	<fieldset><legend><strong>Username : </strong><strong><?php echo $_GET['username'];?> </strong></legend>
      <table width="100%" border="0">
        <tr>
          <td><strong>Password</strong></td>
        <td>:</td>
        <td><strong><?php echo $row_rsUser['Value']; ?></strong></td>
      </tr>
        <tr>
          <td><strong>Package</strong></td>
          <td>:</td>
          <td><?php if ($totalRows_rsUserGroup > 0) { // Show if recordset not empty ?>
              <strong><?php echo $row_rsUserGroup['GroupName']; ?></strong>
              <?php } // Show if recordset not empty ?>
            <?php if ($totalRows_rsUserGroup == 0) { // Show if recordset empty ?>
              Not mapped to a package
              <?php } // Show if recordset empty ?>          </td>
        </tr>
      </table>
      <p><strong>RADCheck Attribute</strong></p>
      <?php if ($totalRows_rsRadcheckUser == 0) { // Show if recordset empty ?>
        <p>No data</p>
        <?php } // Show if recordset empty ?>
      <?php if ($totalRows_rsRadcheckUser > 0) { // Show if recordset not empty ?>
        <table width="100%" border="1">
		<thead>
          <tr>
            <td>Attribute</td>
            <td>Op</td>
            <td>Value</td>
          </tr>
		  </thead>
  			<tbody>
          <?php do { ?>
            <tr>
              <td><?php echo $row_rsRadcheckUser['Attribute']; ?></td>
              <td><?php echo $row_rsRadcheckUser['op']; ?></td>
              <td><?php echo $row_rsRadcheckUser['Value']; ?></td>
            </tr>
            <?php } while ($row_rsRadcheckUser = mysql_fetch_assoc($rsRadcheckUser)); ?>
			</tbody>
        </table>
        <?php } // Show if recordset not empty ?>
      <p><strong>RADReply Attribute </strong></p>
      <?php if ($totalRows_rsRadreplyUser == 0) { // Show if recordset empty ?>
        <p>No data</p>
        <?php } // Show if recordset empty ?>
      <?php if ($totalRows_rsRadreplyUser > 0) { // Show if recordset not empty ?>
        <table width="100%" border="1">
		<thead>
          <tr>
            <td>Attribute</td>
            <td>Op</td>
            <td>Value</td>
          </tr>
		  </thead>
  		<tbody>
          <?php do { ?>
            <tr>
              <td><?php echo $row_rsRadreplyUser['Attribute']; ?></td>
              <td><?php echo $row_rsRadreplyUser['op']; ?></td>
              <td><?php echo $row_rsRadreplyUser['Value']; ?></td>
            </tr>
            <?php } while ($row_rsRadreplyUser = mysql_fetch_assoc($rsRadreplyUser)); ?>
			</tbody>
        </table>
        <?php } // Show if recordset not empty ?>
		</fieldset>
		<?php
			if ($totalRows_rsUserGroup > 0) {
		?>
		<fieldset><legend><b>Package: <strong><?php echo $row_rsUserGroup['GroupName']; ?></strong></b></legend>
		<?php
			//limitation by group/package
			mysql_select_db($database_cnRadius, $cnRadius);
			$query_rsGroupCheck = sprintf("SELECT * FROM radgroupcheck WHERE GroupName = %s",GetSQLValueString($row_rsUserGroup['GroupName'], "text"));
			$rsGroupCheck = mysql_query($query_rsGroupCheck, $cnRadius) or die(mysql_error());
			$row_rsGroupCheck = mysql_fetch_assoc($rsGroupCheck);
			$totalRows_rsGroupCheck = mysql_num_rows($rsGroupCheck);

			mysql_select_db($database_cnRadius, $cnRadius);
			$query_rsGroupReply = sprintf("SELECT * FROM radgroupreply WHERE GroupName = %s", GetSQLValueString($row_rsUserGroup['GroupName'], "text"));
			$rsGroupReply = mysql_query($query_rsGroupReply, $cnRadius) or die(mysql_error());
			$row_rsGroupReply = mysql_fetch_assoc($rsGroupReply);
			$totalRows_rsGroupReply = mysql_num_rows($rsGroupReply);
		?>
		<?php if (($totalRows_rsGroupCheck == 0) && ($totalRows_rsGroupReply== 0)) { // Show if recordset empty ?>
        <p>Invalid input: Specified package does not exists! </p>
        <?php } // Show if recordset empty ?>
    <?php if (($totalRows_rsGroupCheck >0) || ($totalRows_rsGroupReply>0)) { // Show if recordset not empty ?>
      
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
		</fieldset>
		<?php
			};
		?>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsUser == 0) { // Show if recordset empty ?>
        Invalid input: Specified user does not  exist!
        <?php } // Show if recordset empty ?>
</body>
</html>
