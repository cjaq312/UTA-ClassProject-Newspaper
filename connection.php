<html><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 1166px;
	margin-bottom: 648px;
	background-image: url(depths-of-solitude-wallpapers_2314_1024.jpg);
}
#Layer1 {
	position:absolute;
	width:639px;
	height:464px;
	z-index:1;
	left: 267px;
	top: 127px;
}
body,td,th {
	font-family: Book Antiqua;
}
-->
</style>
<body>
<div id="Layer1">

<?php
$c=mysql_connect("localhost","root","");
if(!$c)
die("Error:".mysql_error());
$dbase=mysql_select_db("project2",$c);
if(!$dbase)
die("No database created:".mysql_error());
?>


</div>
</body>
</html>