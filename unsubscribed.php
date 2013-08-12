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
if(isset($_POST["unsub"]))
$a=100;
else
{
echo "Bamm!!!!!Enter some unsubscription value ";
die();
}
$sid=$_POST["unsub"];
$cid=$_POST["cid"];

if($sid != 0)
{
for($i=0;$i<sizeof($sid);$i++)
{
$unsub="delete from subscription where s_sid='".$sid[$i]."' and s_cid='".$cid."'";
mysql_query($unsub);
}
echo"sucessfully unsubscribed,thank you";
}
?>

</div>
</body>
</html>