<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Labkom HotSpot</title>
<style type="text/css">
<!--
body {
	background: #666666;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	/*padding: 0;*/
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	/*padding-top: 30px;
  	margin: auto;
  	width: 50%;*/
}

/* Tips for Elastic layouts 
1. Since the elastic layouts overall sizing is based on the user's default fonts size, they are more unpredictable. Used correctly, they are also more accessible for those that need larger fonts size since the line length remains proportionate.
2. Sizing of divs in this layout are based on the 100% font size in the body element. If you decrease the text size overall by using a font-size: 80% on the body element or the #container, remember that the entire layout will downsize proportionately. You may want to increase the widths of the various divs to compensate for this.
3. If font sizing is changed in differing amounts on each div instead of on the overall design (ie: #sidebar1 is given a 70% font size and #mainContent is given an 85% font size), this will proportionately change each of the divs overall size. You may want to adjust based on your final font sizing.
*/
.oneColElsCtrHdr #container {
	width: 46em;  /* this width will create a container that will fit in an 800px browser window if text is left at browser default font sizes */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.oneColElsCtrHdr #header { 
	background: #DDDDDD; 
	padding: 0 10px 0 20px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
} 
.oneColElsCtrHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.oneColElsCtrHdr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
	background: #FFFFFF;
}
.oneColElsCtrHdr #footer { 
	padding: 0 10px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#DDDDDD;
} 
.oneColElsCtrHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
-->
</style></head>

<body class="oneColElsCtrHdr">

<div id="container">
  <div id="header">
    <h1><img src="logo.jpg" alt="Labkom HotSpot" width="100%" height="87" /></h1>
  <!-- end #header --></div>
  <div id="mainContent">
    <table width="100%" border="0" align="center">
      <tr>
        <td width="21%"><div align="center"><img src="psd1541.jpg" alt="" width="128" height="128" /></div></td>
        <td width="79%"><a href="http://192.168.182.1:3990/prelogin">Click here to login</a></td>
      </tr>
    </table>
    <!-- end #mainContent -->
  </div>
  <div id="footer">
    <p>&nbsp;</p>
    <p><strong>Note:</strong>
    </p>
    <ul>
      <li>Use your <strong>SIA ID</strong> and <strong>Password</strong> to login</li>
      <li>Please Enable Java-Script and Pop-Up for this site</li>
      <li>Keep this window open to logout.</li>
      <li>This site is under development, so please be patient, contact <a href="mailto:achmad.zaenuri@gmail.com">me</a> for more info.</li>
    </ul>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
