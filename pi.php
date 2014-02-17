<?php
	echo "<form action="" method='post'>";
	echo "数字口令:<input name='text' value='确定'>";
	echo "<input type='submit' name='sub' value='确定'>";
	echo "</form>";
	define ("PI",3.1415926);
	function Encrypt($str)
	{
		return $str=$str+PI;
	}
	function Decrypt($str){
		return $str=$str-PI;
	}
	if($_POST[sub]){
		echo "加密口令".Encrypt($_POST[text])."<br>";
		$_SESSION[pwd]=Encrypt($_POST[text]);


?>
<a href='pi.php?pwd=1'>解密口令</a>
<?php
}
	if(isset($_GET[pwd])){
		echo "解密口令".Decrypt($_SESSION[pwd]);
}
?>
