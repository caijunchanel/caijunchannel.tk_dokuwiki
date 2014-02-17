<?php
//human readable time format
function humanTime($seconds) {
	if ($seconds<=60) {
		return "00:00:".sprintf("%02d",$seconds);
	}
	
	$hour=floor($seconds/3600);
	$seconds -=($hour*3600);
	$minute=floor($seconds/60);
	$seconds -=($minute*60);
	
	return sprintf("%d:%02d:%02d", $hour, $minute, $seconds);
}

?>