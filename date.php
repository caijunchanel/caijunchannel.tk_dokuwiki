<?php
date_default_timezone_set("Asia/ShangHai");
$a=strotime("now");
$b=strotime("05 May 2010");
echo $a."\n";
echo "输出日期".date("Y-m-d H:i:s",$a)."<br><br>";
echo $b."\n";
echo "输出日期".date("Y-m-d H:i:s",$b)."<br><br>";
$c=ceil(($a-$b)/(3600*24));
echo "距离2010-5-5已过去".$c."天";
?>
