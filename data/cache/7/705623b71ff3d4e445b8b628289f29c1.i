a:34:{i:0;a:3:{i:0;s:14:"document_start";i:1;a:0:{}i:2;i:0;}i:1;a:3:{i:0;s:6:"header";i:1;a:3:{i:0;s:18:"dl、dt、dd标签";i:1;i:1;i:2;i:1;}i:2;i:1;}i:2;a:3:{i:0;s:12:"section_open";i:1;a:1:{i:0;i:1;}i:2;i:1;}i:3;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:1;}i:4;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:34:"dd、dt标签是是列表用的。";}i:2;i:34;}i:5;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:68;}i:6;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:68;}i:7;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:160:"我们平时常用的是<ul>< li>标签，不过dd、dt标签也蛮不错，特别是发布程序的时候功能模块列表什么的可以使用它来排版。";}i:2;i:70;}i:8;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:230;}i:9;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:230;}i:10;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:281:"<dl></dl><dt>< /dt><dd>< /dd>
< dl></dl>用来创建一个普通的列表,<dt>< /dt>用来创建列表中的上层项目，<dd></dd>用来创建列表中最下层项目，<dt>< /dt>和<dd></dd>都必须放在<dl></dl>标志对之间。看一下下边的例子您就会 明白了：";}i:2;i:232;}i:11;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:513;}i:12;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:513;}i:13;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:24:"创建一个普通列表";}i:2;i:515;}i:14;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:539;}i:15;a:3:{i:0;s:4:"code";i:1;a:3:{i:0;s:173:"
<dl> 
<dt>中国城市</dt> 
<dd>北京 </dd> 
<dd>上海 </dd> 
<dd>广州 </dd> 
<dt>美国城市</dt> 
<dd>华盛顿 </dd> 
<dd>芝加哥 </dd> 
<dd>纽约 </dd> 
</dl>
";i:1;N;i:2;N;}i:2;i:546;}i:16;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:546;}i:17;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:18:"实现效果如下";}i:2;i:729;}i:18;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:747;}i:19;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:747;}i:20;a:3:{i:0;s:13:"internalmedia";i:1;a:7:{i:0;s:30:":xhtml:about-dl-dt-dd-code.png";i:1;s:24:"dl、dt、dd标签演示";i:2;N;i:3;N;i:4;N;i:5;s:5:"cache";i:6;s:6:"nolink";}i:2;i:749;}i:21;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:815;}i:22;a:3:{i:0;s:13:"section_close";i:1;a:0:{}i:2;i:817;}i:23;a:3:{i:0;s:6:"header";i:1;a:3:{i:0;s:24:"dl、dt、dd表格实例";i:1;i:1;i:2;i:817;}i:2;i:817;}i:24;a:3:{i:0;s:12:"section_open";i:1;a:1:{i:0;i:1;}i:2;i:817;}i:25;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:817;}i:26;a:3:{i:0;s:5:"cdata";i:1;a:1:{i:0;s:6:"演示";}i:2;i:857;}i:27;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:863;}i:28;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:863;}i:29;a:3:{i:0;s:13:"externalmedia";i:1;a:7:{i:0;s:34:"http://i48.tinypic.com/2jadces.jpg";i:1;s:30:"dl、dt、dd表格实例演示";i:2;N;i:3;N;i:4;N;i:5;s:5:"cache";i:6;s:7:"details";}i:2;i:865;}i:30;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:934;}i:31;a:3:{i:0;s:4:"code";i:1;a:3:{i:0;s:2578:"
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>dl dt dd表格</title>

<style>
dl,dt,dd{
	margin:0;
	background:#fff;
	font-size:12px;
	}
dl{
	margin:0 auto;
	width:50%;
	border:1px solid #ccc;
	border-bottom:none;
	}
dt{
	font-weight:800;
	background:#eee;
	color:#000;
	}
dt,dd{
	line-height:30px;
	padding:0 0 0 10px;
	border-bottom:1px solid #eee;
	height:30px;
	overflow:hidden
	}
dd{
	text-indent:3em;
	}
.fff{
	background:#fff
	}
dt span,dd span{
	display:block;
	float:right;
	font-size:14px;
	border-left:1px solid #eee;
	text-indent:0em;
	width:80px;
	text-align:center;
	}

</style>
</head>
<body>
<dl class=hb>
<dt><span>下载地址</span><span>更新时间</span>ks5u生物同步课课练（人教版必修一）</dt>
<dd class=fff><span>——</span><span>11.2</span>第一节 从生物圈到细胞生物圈到细生物圈到细生物圈到细生物圈到细生物圈到细生物圈到细生物圈到细</dd>
<dd><span>——</span><span>11.3</span>第二节 细胞的多样性和统一性</dd>
<dd class=fff><span>——</span><span>11.4</span>单元测评</dd>
<dd><span>——</span><span>11.5</span>欧美代议制的确立与发展</dd>
<dd class=fff><span>——</span><span>11.6</span>中国古代文化史</dd>
<dd><span>——</span><span>11.7</span>近代中国的政治、经济及思想解放的潮流</dd>
<dd class=fff><span>——</span><span>11.9</span>近代中国政治发展史</dd>
<dd><span>——</span><span>11.10</span>近代中国经济发展史</dd>
<dd class=fff><span>——</span><span>11.11</span>近代中国思想解放潮流</dd>
<dd><span>——</span><span>11.12</span>现代西方的政治、经济与科技文化</dd>
<dd class=fff><span>——</span><span>11.13</span>罗斯福新政与二战后的世界经济</dd>
<dd><span>——</span><span>11.14</span>二战后世界政治格局的演变</dd>
<dd class=fff><span>——</span><span>11.16</span>19世纪以来的世界文学艺术与科技</dd> 
<dd><span>——</span><span>11.17</span>现代中国的政治、经济及思想文化</dd>
<dd class=fff><span>——</span><span>11.18</span>现代中国政治发展史 </dd>
<dd><span>——</span><span>11.19</span>现代中国物质文明发展史（中国近现代社会生活的变迁、科技等）</dd>
<dd class=fff><span>——</span><span>11.30</span>古希腊罗马的政治制度</dd></dl>
</body>
</html>
";i:1;s:11:"html4strict";i:2;N;}i:2;i:941;}i:32;a:3:{i:0;s:13:"section_close";i:1;a:0:{}i:2;i:3532;}i:33;a:3:{i:0;s:12:"document_end";i:1;a:0:{}i:2;i:3532;}}