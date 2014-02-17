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
    <td>Reply-Message</td>
    <td>String</td>
    <td>Reason of reject if present.</td>
  </tr>
  <tr>
    <td>State</td>
    <td>String</td>
    <td>Sent to chilli in Access-Accept or         Access-Challenge. Used transparently in subsequent     Access-Request.</td>
  </tr>
  <tr>
    <td>Class</td>
    <td>String</td>
    <td>Copied transparently by chilli from         Access-Accept to Accounting-Request.</td>
  </tr>
  <tr>
    <td>Session-Timeout</td>
    <td>Integer</td>
    <td>Logout once session timeout is reached         (seconds)</td>
  </tr>
  <tr>
    <td>Idle-Timeout</td>
    <td>Integer</td>
    <td>Logout once idle timeout is reached         (seconds)</td>
  </tr>
  <tr>
    <td>Message-Authenticator</td>
    <td>String</td>
    <td>Is always included in Access-Request. If         present in Access-Accept, Access-Challenge or Access-reject chilli will         validate that the Message-Authenticator is correct.</td>
  </tr>
  <tr>
    <td>Acct-Interim-Interval</td>
    <td>Integer</td>
    <td>If present in Access-Accept chilli will         generate interim accounting records with the specified interval         (seconds).</td>
  </tr>
  <tr>
    <td>WISPr-Redirection-URL</td>
    <td>String</td>
    <td>If present the client will be redirected         to this URL once authenticated. This URL should include a link to         WISPr-Logoff-URL in order to enable the client to log off.</td>
  </tr>
  <tr>
    <td>WISPr-Bandwidth-Max-Up</td>
    <td>Integer</td>
    <td>Maximum transmit rate (b/s). Limits the         bandwidth of the connection. Note that this attribute is specified in bits         per second.</td>
  </tr>
  <tr>
    <td>WISPr-Bandwidth-Max-Down</td>
    <td>Integer</td>
    <td>Maximum receive rate (b/s). Limits the         bandwidth of the connection. Note that this attribute is specified in bits         per second.</td>
  </tr>
  <tr>
    <td>WISPr-Session-Terminate-Time</td>
    <td>String</td>
    <td>The time when the user should be         disconnected in ISO 8601 format (YYYY-MM-DDThh:mm:ssTZD). If TZD is not         specified local time is assumed. For example a disconnect on 18 December         2001 at 7:00 PM UTC would be specified as     2001-12-18T19:00:00+00:00.</td>
  </tr>
  <tr>
    <td>ChilliSpot-Max-Input-Octets</td>
    <td>Integer</td>
    <td>Maximum number of octets the user is         allowed to transmit. After this limit has been reached the user will be         disconnected.</td>
  </tr>
  <tr>
    <td>ChilliSpot-Max-Output-Octets</td>
    <td>Integer</td>
    <td>Maximum number of octets the user is         allowed to receive. After this limit has been reached the user will be         disconnected.</td>
  </tr>
  <tr>
    <td>ChilliSpot-Max-Total-Octets</td>
    <td>Integer</td>
    <td>Maximum number of octets the user is         allowed to transfer (sum of octets transmitted and received). After this         limit has been reached the user will be disconnected.</td>
  </tr>
  <tr>
    <td>ChilliSpot-UAM-Allowed</td>
    <td>String</td>
    <td>When received from the radius server in an         RFC 2882 style configuration management message this attribute will         override the uamallowed command line option.</td>
  </tr>
  <tr>
    <td>ChilliSpot-MAC-Allowed</td>
    <td>String</td>
    <td>When received from the radius server in an         RFC 2882 style configuration management message this attribute will         override the macallowed command line option.</td>
  </tr>
</table>
</body>

</html>
