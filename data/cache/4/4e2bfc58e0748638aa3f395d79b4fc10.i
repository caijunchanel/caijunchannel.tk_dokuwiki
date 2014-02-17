a:29:{i:0;a:3:{i:0;s:14:"document_start";i:1;a:0:{}i:2;i:0;}i:1;a:3:{i:0;s:6:"header";i:1;a:3:{i:0;s:27:"PHP常用功能函数实例";i:1;i:2;i:2;i:1;}i:2;i:1;}i:2;a:3:{i:0;s:12:"section_open";i:1;a:1:{i:0;i:2;}i:2;i:1;}i:3;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:1;}i:4;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:24:"展示PHP的配置信息";}i:2;i:39;}i:5;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:63;}i:6;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:26:"  
  echo phpinfo();
  
  ";}i:2;i:63;}i:7;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:63;}i:8;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:18:"打印系统时间";}i:2;i:99;}i:9;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:117;}i:10;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:27:"  echo date('Y-m-s H:i:s');";}i:2;i:117;}i:11;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:117;}i:12;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:31:"修改php.ini设置系统时间";}i:2;i:149;}i:13;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:180;}i:14;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:150:" 修改php.ini文件中的设置,找到[date]下的"date.timezone="选项，
 将该项修改成"date.timezone=Asia/shanghai",再重启Apache服务。";}i:2;i:180;}i:15;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:180;}i:16;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:48:"打印当前执行的PHP文件路径和文件名";}i:2;i:337;}i:17;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:385;}i:18;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:17:" echo __FILE__;
 ";}i:2;i:385;}i:19;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:385;}i:20;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:30:"单引号和双引号的区别";}i:2;i:408;}i:21;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:438;}i:22;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:119:" 最大的区别是，双引号中包含的变量会自动转换为实际数值， 单引号则按普通字符输出。";}i:2;i:438;}i:23;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:438;}i:24;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:28:"动态输出Javascript代码";}i:2;i:562;}i:25;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:590;}i:26;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:150:" 使用<<<mark.....mark;
<?php
$str=<<<mark
<script language="javascript" type="text/javacript">
       alert("欢迎");
</script>
mark;
echo $str;
?>";}i:2;i:590;}i:27;a:3:{i:0;s:13:"section_close";i:1;a:0:{}i:2;i:761;}i:28;a:3:{i:0;s:12:"document_end";i:1;a:0:{}i:2;i:761;}}