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
include("connection.php");
$pname = $_POST["pname"];
$type = $_POST["type"];
$tname = $_POST["tname"];
$mark=0;

if($pname=="" || $tname=="")
{echo"Enter all the values";
exit();
}
else
{
echo"PUBLICATION: $pname<br/>";
if($type == "newspaper")
echo"TYPE: $type";
else
echo"TYPE: $type";
echo"<br/>$type Name: $tname<br/><form action='create.php' method='post'><br/>FREQUENCY:";

if($type == "newspaper")
{
echo"<select name='frequency'><option>Daily</option><option>Weekly</option></select><br/>NOOF ISSUES:<input type='text' name='issues'/>";
}
elseif($type == "magazine")
{
echo"<select name='frequency'><option>Weekly</option><option>Monthly</option><option>Yearly</option></select><br/>NOOF ISSUES:<input type='text' name='issues'/>";
}
echo"<br/>RATE:<input type='text' name='rate'/><input type='hidden' name='pname' value=\"".$pname."\"/><input type='hidden' name='type' value=\"".$type."\"/><input type='hidden' name='tname' value=\"".$tname."\"/><br/><input type='submit' value='submit'/></form>";
}
?>
</div>
</body>
</html>