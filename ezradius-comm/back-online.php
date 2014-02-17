<?php require_once('Connections/cnRadius.php'); ?>
<?php require_once('config.php'); ?>
<?php
// load the error handling module
require_once('error_handler.php');
// make sure the user's browser doesn't cache the result
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

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
$query_rsUserOnline = "SELECT UserName, AcctInputOctets, AcctOutputOctets, AcctStartTime, AcctSessionTime, FramedIPAddress, RadAcctId FROM radacct WHERE (AcctStopTime is NULL)";
$query_limit_rsUserOnline=$query_rsUserOnline;
$rsUserOnline = mysql_query($query_limit_rsUserOnline, $cnRadius) or die(mysql_error());
$row_rsUserOnline = mysql_fetch_assoc($rsUserOnline);

$totalRows_rsUserOnline = mysql_num_rows($rsUserOnline);

if ($totalRows_rsUserOnline > 0) { // Show if recordset not empty ?>
        <p>Users online:  <strong><?php echo $totalRows_rsUserOnline ?></strong> users</p>
        <table border="1" class="mytable">
		<thead class="mythead">
          <tr>
            <td>ID</td>
            <td>UserName</td>
			<td>Package</td>
            <td>IP Address</td>
            <td>Start Time</td>
            <td>Session Time</td>
            <td>Uploads</td>
            <td>Downloads</td>
            <td>&nbsp;</td>
          </tr>
		  </thead>
  		<tbody class="mytbody">
          <?php do { ?>
            <tr>
              <th><?php echo $row_rsUserOnline['RadAcctId']; ?></th>
              <th><a href="user-detail.php?username=<?php echo $row_rsUserOnline['UserName']; ?>"><?php echo $row_rsUserOnline['UserName']; ?></a></th>
			  <td>
			  <?php
			  	$query_rsGroupName = "SELECT GroupName FROM usergroup WHERE UserName='".$row_rsUserOnline['UserName']."'";
				$query_limit_rsGroupName=$query_rsGroupName;
				$rsGroupName = mysql_query($query_limit_rsGroupName, $cnRadius) or die(mysql_error());
				$row_rsGroupName = mysql_fetch_assoc($rsGroupName);

				$totalRows_rsGroupName = mysql_num_rows($rsGroupName);
				
				if ($totalRows_rsGroupName>0) {
					echo '<a href="group-detail.php?groupname='.$row_rsGroupName['GroupName'].'">'.$row_rsGroupName['GroupName'].'</a>';
				} else {
					echo 'None';
				}
				mysql_free_result($rsGroupName);
			  ?>
			  </td>
              <td><?php echo $row_rsUserOnline['FramedIPAddress']; ?></td>
              <td><?php echo $row_rsUserOnline['AcctStartTime']; ?></td>
              <td><?php echo humanTime($row_rsUserOnline['AcctSessionTime']); ?></td>
              <td><?php echo $row_rsUserOnline['AcctInputOctets']; ?></td>
              <td><?php echo $row_rsUserOnline['AcctOutputOctets']; ?></td>
              <td><a href="disconnect-user.php?theUser=<?php echo $row_rsUserOnline['UserName']; ?>&amp;nasaddr=127.0.0.1&amp;nassecret=<?php echo $configVars['others']['defnassecret']; ?>&amp;coaport=3779">Logoff</a> </td>
            </tr>
            <?php } while ($row_rsUserOnline = mysql_fetch_assoc($rsUserOnline)); ?>
		  </tbody>
      </table>
		<br />  
        <?php } // Show if recordset not empty 
		mysql_free_result($rsUserOnline);
		?>
<?php if ($totalRows_rsUserOnline == 0) { // Show if recordset empty ?>
      <p>No one is online.</p>
<?php } // Show if recordset empty ?>
