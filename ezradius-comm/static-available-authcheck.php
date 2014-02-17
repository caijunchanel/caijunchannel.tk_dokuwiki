<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1">
  <tr>
    <td width="23%"><strong>Attribute</strong></td>
    <td width="7%"><strong>Type</strong></td>
    <td width="70%"><strong>Comment</strong></td>
  </tr>
  <tr>
    <td>NAS-IP-Address</td>
    <td>IPaddr</td>
    <td>IP address of Chilli (set by the         radiusnasip or radiuslisten option). If neither radiuslisten nor         nasipaddress are set NAS-IP-Address is set to &quot;0.0.0.0&quot;.</td>
  </tr>
  <tr>
    <td>Service-Type</td>
    <td>Integer</td>
    <td>Set to Login (1) for normal authentication         requests.  For RFC 2882 style configuration management Access-Request         messages to the radius server this is set to         ChilliSpot-Authorize-Only  (0x38df0001). The Access-Accept message         from the radius server for configuration management messages must also be         set to ChilliSpot-Authorize-Only  (0x38df0001).</td>
  </tr>
  <tr>
    <td>Framed-IP-Address</td>
    <td>IPaddr</td>
    <td>IP address of the user.</td>
  </tr>
  <tr>
    <td>State</td>
    <td>String</td>
    <td>Sent to chilli in Access-Accept or         Access-Challenge. Used transparently in subsequent     Access-Request.</td>
  </tr>
  <tr>
    <td>Called-Station-ID</td>
    <td>String</td>
    <td>Set to the radiuscalled command line         option or the MAC address of ChilliSpot if not present</td>
  </tr>
  <tr>
    <td>Calling-Station-ID</td>
    <td>String</td>
    <td>MAC address of client</td>
  </tr>
  <tr>
    <td>NAS-ID</td>
    <td>String</td>
    <td>Set to radiusnasid option if       present.</td>
  </tr>
  <tr>
    <td>Acct-Session-ID</td>
    <td>String</td>
    <td>Unique ID to link Access-Request and         Accounting-Request messages.</td>
  </tr>
  <tr>
    <td>NAS-Port-Type</td>
    <td>Integer</td>
    <td>19=Wireless-IEEE-802.11</td>
  </tr>
  <tr>
    <td>Message-Authenticator</td>
    <td>String</td>
    <td>Is always included in Access-Request. If         present in Access-Accept, Access-Challenge or Access-reject chilli will         validate that the Message-Authenticator is correct.</td>
  </tr>
  <tr>
    <td>WISPr-Location-ID</td>
    <td>String</td>
    <td>Location ID is set to the radiuslocationid         option if present. Should be in the format:         isocc=&lt;ISO_Country_Code&gt;,         cc=&lt;E.164_Country_Code&gt;,ac=&lt;E.164_Area_Code&gt;,network=&lt;ssid/ZONE&gt;</td>
  </tr>
  <tr>
    <td>WISPr-Location-Name</td>
    <td>String</td>
    <td>Location Name is set to the         radiuslocationname option if present. Should be in the format:         &lt;HOTSPOT_OPERATOR_NAME&gt;,&lt;LOCATION&gt;</td>
  </tr>
  <tr>
    <td>WISPr-Logoff-URL</td>
    <td>String</td>
    <td>Chilli includes this attribute in         Access-Request messages in order to notify the operator of the log off URL         to use for logging off clients. Defaults to         &quot;http://192.168.182.1:3990/logoff&quot;.</td>
  </tr>
</table>
</body>
</html>
