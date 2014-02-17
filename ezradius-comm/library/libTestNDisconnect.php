<?php
//contains function to test user connectivity and to force logout user

//function to test user connectivity
function test_user_connectivity($user, $password, $radiusserver, $radiusport, $nasportnumber, $nassecret) {
	//test user connectivity using radtest command
	$command = "radtest $user $password $radiusserver:$radiusport $nasportnumber $nassecret";
	$result = `$command`;
	
	$output="<b>Command</b>: $command<br /><b>Output:</b><br />".nl2br($result);
	return $output;
}

//function to force disconnect user
function disconnect_user ($theUser, $nasaddr, $coaport, $sharedsecret) {
	//disconnect user using radclient
	$command = "echo \"User-Name=$theUser\"|radclient -x $nasaddr:$coaport disconnect $sharedsecret";
	$result=`$command`;
	
	$output="<b>Command</b>: $command<br /><b>Output:</b><br />".nl2br($result)."<br />";
	return $output;
}
?>

