<?php
require_once('auth.php');
?>
<?php
if (isset($_POST['btnSave'])) {
	//write config.ini
	$configFile=fopen('config/config.ini','w');
	fwrite($configFile, "; Administrator settings\n");
	fwrite($configFile, "[administrator]\n");
	fwrite($configFile, "username=".$_POST['username']."\n");
	fwrite($configFile, "password=".$_POST['password']."\n\n");
	fwrite($configFile, "; FreeRADIUS settings\n");
	fwrite($configFile, "[freeradius]\n");
	fwrite($configFile, "version=".$_POST['version']."\n");
	fwrite($configFile, "; Other settings\n");
	fwrite($configFile, "[others]\n");
	fwrite($configFile, "defnassecret=".$_POST['defNasSecret']."\n");
	fwrite($configFile, "[company]\n");
	fwrite($configFile, "name=".$_POST['compName']."\n");
	fwrite($configFile, "address=".$_POST['compAddr']."\n");
	fwrite($configFile, "[currency]\n");
	fwrite($configFile, "symbol=".$_POST['currSymbol']."\n");
	fwrite($configFile, "show=".$_POST['currShow']."\n");
	fclose($configFile);
	
	//write database condiguration
	$configFile=fopen('Connections/database.ini','w');
	fwrite($configFile, "; MySQL Database configuration\n");
	fwrite($configFile, "[database]\n");
	fwrite($configFile, "host=".$_POST['mysqlHost']."\n");
	fwrite($configFile, "databasename=".$_POST['mysqlDatabase']."\n");
	fwrite($configFile, "username=".$_POST['mysqlUsername']."\n");
	fwrite($configFile, "password=".$_POST['mysqlPassword']."\n");
	fclose($configFile);
	
	$cnRadiusFile=fopen('Connections/cnRadius.php', 'w');
	fwrite($cnRadiusFile, "<?php\n# FileName=\"Connection_php_mysql.htm\"\n# Type=\"MYSQL\"\n# HTTP=\"true\"\n");
	fwrite($cnRadiusFile, "\$hostname_cnRadius = \"".$_POST['mysqlHost']."\"; #### MySQL server location that used by FreeRADIUS\n");
	fwrite($cnRadiusFile, "\$database_cnRadius = \"".$_POST['mysqlDatabase']."\"; #### Name of the sql database  used by FreeRADIUS\n");
	fwrite($cnRadiusFile, "\$username_cnRadius = \"".$_POST['mysqlUsername']."\"; #### Username of the sql database\n");
	fwrite($cnRadiusFile, "\$password_cnRadius = \"".$_POST['mysqlPassword']."\"; #### Password of the sql database\n");
	fwrite($cnRadiusFile, "\$cnRadius = mysql_pconnect(\$hostname_cnRadius, \$username_cnRadius, \$password_cnRadius) or trigger_error(mysql_error(),E_USER_ERROR); 
?>");
	fclose($cnRadiusFile);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tmp1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Configuration Editor</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
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
    <?php
	if (isset($_POST['btnSave'])) {
	?>
    <fieldset><legend>Result</legend>
    Configurations saved!
    </fieldset>
    <?php
	}
	?>
    <form id="form1" name="form1" method="post" action="config-editor.php">
    <fieldset>
    <legend>Administrator</legend>
    <?php
		//read configuration file
		$configVars=parse_ini_file("config/config.ini", TRUE);
	?>
    <table width="100%" border="0">
      <tr>
        <td width="123">Username</td>
        <td width="12">:</td>
        <td width="649"><span id="sprytextfield1">
        <input type="text" name="username" id="username" value="<?php echo $configVars['administrator']['username']; ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
      </tr>
      <tr>
        <td>Password</td>
        <td>:</td>
        <td><span id="sprytextfield2">
        <input type="text" name="password" id="password" value="<?php echo $configVars['administrator']['password']; ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
      </tr>
    </table>
    </fieldset>
    <fieldset>
    <legend>FreeRADIUS</legend>
    
    <table width="100%" border="0">
      <tr>
        <td width="16%">Version</td>
        <td width="2%">:</td>
        <td width="82%"><span id="spryselect1">
          <select name="version" id="version">
            <option value="1.1.3" <?php if ($configVars['freeradius']['version']=='1.1.3') echo 'selected'; ?>>1.1.3 and below</option>
            <option value="1.1.4" <?php if ($configVars['freeradius']['version']=='1.1.4') echo 'selected'; ?>>1.1.4 and above</option>
                    </select>
          <span class="selectInvalidMsg">Please select a valid item.</span>          <span class="selectRequiredMsg">Please select an item.</span></span></td>
      </tr>
    </table>
    </fieldset>
    <fieldset><legend>FreeRADIUS Database</legend>
    <?php
		//read configuration file
		$mysqlConfigVars=parse_ini_file("Connections/database.ini", TRUE);
	?>
    <table width="100%" border="0">
      <tr>
        <td width="16%">MySQL Host</td>
        <td width="2%">:</td>
        <td width="82%"><span id="sprytextfield3">
          <input type="text" name="mysqlHost" id="mysqlHost" value="<?php echo $mysqlConfigVars['database']['host']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>Database name</td>
        <td>:</td>
        <td><span id="sprytextfield4">
          <input type="text" name="mysqlDatabase" id="mysqlDatabase" value="<?php echo $mysqlConfigVars['database']['databasename']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>MySQL Username</td>
        <td>:</td>
        <td><span id="sprytextfield5">
          <input type="text" name="mysqlUsername" id="mysqlUsername" value="<?php echo $mysqlConfigVars['database']['username']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>MySQL Password</td>
        <td>:</td>
        <td><span id="sprytextfield6">
          <input type="text" name="mysqlPassword" id="mysqlPassword" value="<?php echo $mysqlConfigVars['database']['password']; ?>" />
          </span></td>
      </tr>
    </table>
    </fieldset>
	<fieldset><legend>Other settings</legend>
	<table width="100%">
	<tr>
	  <td>Default NAS secret </td>
	  <td>:</td>
	  <td><input name="defNasSecret" type="text" id="defNasSecret" value="<?php echo $configVars['others']['defnassecret']; ?>" /></td>
	  </tr>
	<tr>
	  <td width="16%">Company name </td>
	  <td width="2%">:</td>
	  <td width="82%"><input name="compName" type="text" size="60" value="<?php echo $configVars['company']['name']; ?>" /></td>
	  </tr>
	<tr>
	  <td>Address</td>
	  <td>:</td>
	  <td><textarea name="compAddr" cols="60" ><?php echo $configVars['company']['address']; ?></textarea></td></tr>
	<tr>
	  <td>Show currency </td>
	  <td>:</td>
	  <td><select name="currShow" id="currShow">
	    <option value="true" <?php if ($configVars['currency']['show']=='true') echo 'selected'; ?>>True</option>
	    <option value="false" <?php if ($configVars['currency']['show']=='false') echo 'selected'; ?>>False</option>
	    </select>	  </td>
	  </tr>
	<tr>
	  <td>Currency symbol </td>
	  <td>:</td>
	  <td><input name="currSymbol" type="text" id="currSymbol" value="<?php echo $configVars['currency']['symbol']; ?>" /></td>
	  </tr>
	</table>
	</fieldset>
    <input type="submit" name="btnSave" id="btnSave" value="Save" />
    </form>
    <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:3, maxChars:100});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"], minChars:4, maxChars:50});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
//-->
</script>
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
