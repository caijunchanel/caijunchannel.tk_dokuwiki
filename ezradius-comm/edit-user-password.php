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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	//check if cleartext password
	if ($_POST["chkCleartext"]=="checked") {
		if ($freeradiusVersion=="1.1.3") {
			$updateSQL = sprintf("UPDATE radcheck SET UserName=%s, Attribute=%s, op=%s, `Value`=%s WHERE id=%s",
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString("User-Password", "text"),
                       GetSQLValueString($_POST['op'], "text"),
                       GetSQLValueString($_POST['Value'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
		} else { //freeradius 1.1.3 and above
			$updateSQL = sprintf("UPDATE radcheck SET UserName=%s, Attribute=%s, op=%s, `Value`=%s WHERE id=%s",
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString("Cleartext-Password", "text"),
                       GetSQLValueString($_POST['op'], "text"),
                       GetSQLValueString($_POST['Value'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
		}
	} else { //encrypted (not cleartext) password
		if ($freeradiusVersion=="1.1.3") {
			$updateSQL = sprintf("UPDATE radcheck SET UserName=%s, Attribute=%s, op=%s, `Value`=md5(%s) WHERE id=%s",
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString("User-Password", "text"),
                       GetSQLValueString($_POST['op'], "text"),
                       GetSQLValueString($_POST['Value'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
		} else {
			$updateSQL = sprintf("UPDATE radcheck SET UserName=%s, Attribute=%s, op=%s, `Value`=md5(%s) WHERE id=%s",
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString("MD5-Password", "text"),
                       GetSQLValueString($_POST['op'], "text"),
                       GetSQLValueString($_POST['Value'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
		}
	}
  

  mysql_select_db($database_cnRadius, $cnRadius);
  $Result1 = mysql_query($updateSQL, $cnRadius) or die(mysql_error());

  $updateGoTo = "user-detail.php?username=" . $row_rsUpdatePasswd['UserName'] . "";

  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }

  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsUpdatePasswd = "-1";
if (isset($_GET['username'])) {
  $colname_rsUpdatePasswd = $_GET['username'];
}
mysql_select_db($database_cnRadius, $cnRadius);
$query_rsUpdatePasswd = sprintf("SELECT * FROM radcheck WHERE UserName = %s and attribute like '%%-Password'", GetSQLValueString($colname_rsUpdatePasswd, "text"));
$rsUpdatePasswd = mysql_query($query_rsUpdatePasswd, $cnRadius) or die(mysql_error());
$row_rsUpdatePasswd = mysql_fetch_assoc($rsUpdatePasswd);
$totalRows_rsUpdatePasswd = mysql_num_rows($rsUpdatePasswd);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tmp1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit user password</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
	background-color: #666666;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: small;
}
.oneColFixCtrHdr #container {
	width: 840px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.oneColFixCtrHdr #header {
	padding: 0 10px 0 20px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
	background-color: #DDDDDD;
	background-image: url(images/new_back.bmp);
	background-repeat: repeat;
}
.oneColFixCtrHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.oneColFixCtrHdr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
	background: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: small;
}
.oneColFixCtrHdr #footer {
	padding: 0 10px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#DDDDDD;
}
.oneColFixCtrHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
-->
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:547px;
	top:8px;
	width:297px;
	height:127px;
	z-index:1;
}
.style1 {font-size: x-small}
#Layer1 {
	position:absolute;
	left:730px;
	top:28px;
	width:97px;
	height:34px;
	z-index:1;
}
-->
</style>
<link rel="shortcut icon" href="images/favicon.ico" >
<link rel="icon" href="images/animated_favicon1.gif" type="image/gif" >
</head>

<body class="oneColFixCtrHdr">
<div id="container">
  <div id="header">
    <table width="100%" border="0">
      <tr>
        <td><a href="http://ezradius.sourceforge.net"><img src="images/ezradius2.png" alt="ezRADIUS Logo" width="216" height="69" border="0" title="ezRADIUS Project at Sourceforge.net" /></a></td>
      </tr>
      <tr>
        <td><ul id="MenuBar1" class="MenuBarHorizontal">
          <li><a href="index.php">Home</a>              </li>
          <li><a href="#" class="MenuBarItemSubmenu">Manage</a>
            <ul>
              <li><a href="list-alluser.php" class="MenuBarItemSubmenu">List</a>
                  <ul>
                    <li><a href="list-alluser.php">All users</a></li>
                    <li><a href="list-allgroup.php">All packages</a></li>
                  </ul>
              </li>
              <li><a href="#" class="MenuBarItemSubmenu">Add</a>
                <ul>
                  <li><a href="add-newuser.php">New User</a></li>
                  <li><a href="add-newgroup.php">New Package</a></li>
                </ul>
                </li>
            </ul>
            </li>
          <li><a class="MenuBarItemSubmenu" href="#">Accounting</a>
              <ul>
                <li><a href="acct-last-closed-conns.php">Last closed conns.</a></li>
                <li><a href="acct-all.php">All Accounting</a> </li>
                <li><a href="acct-username-input-all.php">Per User</a></li>
				<li><a href="acct-date-input.php">Per Date</a></li>
				<li><a href="acct-username-input.php">Per User and Date</a></li>
              </ul>
          </li>
          <li><a href="#" class="MenuBarItemSubmenu">View</a>
            <ul>
              <li><a href="online-users.php">Online users</a></li>
              <li><a href="topusers.php">Top users</a></li>
            </ul>
            </li>
          <li><a href="#" class="MenuBarItemSubmenu">Tool</a>
              <ul>
                <li><a href="config-editor.php">Config editor</a></li>
				<li><a href="list-allnas.php">NAS table</a></li>
				<li><a href="list-radius-attribute.php">freeRADIUS attributes</a></li>
                <li><a href="test-user-connectivity.php">Test connectivity</a></li>
                <li><a href="disconnect-user.php">Force logout user</a></li>
              </ul>
          </li>
          <li><a href="about.php">About</a></li>
        </ul></td>
      </tr>
    </table>
  <!-- end #header --></div>
  <div id="mainContent">
    <!-- InstanceBeginEditable name="Main" -->
<p><a href="user-detail.php?username=<?php echo $_GET['username']; ?>">&lt;&lt;Back to user detail</a></p>

<fieldset>
<legend>Update Password</legend>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">UserName:</td>
      <td><?php echo htmlentities($row_rsUpdatePasswd['UserName'], ENT_COMPAT, 'utf-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="Value" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><label>
        <input name="chkCleartext" type="checkbox" id="chkCleartext" value="checked" />
        Cleartext password</label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update" /></td>
    </tr>
  </table>
  <input type="hidden" name="UserName" value="<?php echo htmlentities($row_rsUpdatePasswd['UserName'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="id" value="<?php echo htmlentities($row_rsUpdatePasswd['id'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="Attribute" value="<?php echo htmlentities($row_rsUpdatePasswd['Attribute'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="op" value="<?php echo htmlentities($row_rsUpdatePasswd['op'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_rsUpdatePasswd['id']; ?>" />
</form>
</fieldset>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
    <!-- end #mainContent -->
  </div>
  <div id="footer">
    <table width="100%" border="0">
      <tr>
        <td><strong><a href="http://sourceforge.net/projects/ezradius">ezRADIUS v0.2.1comm</a></strong><span class="style1"> <br />
        </span></td>
        <td><div align="right"><a href="http://www.undip.ac.id"><img src="images/undip_warna_transparent.png" alt="Diponegoro University" name="undip" width="42" height="49" border="0" id="undip" title="Goto Diponegoro University" /></a>&nbsp;<a href="http://sourceforge.net/donate/index.php?group_id=221332"><img src="images/project-support.jpg" alt="Support project" name="Donate" width="88" height="32" border="0" id="Donate" title="Donate to this project" /></a></div></td>
      </tr>
    </table>
    <!-- end #footer -->
  </div>
<!-- end #container --></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsUpdatePasswd);
?>