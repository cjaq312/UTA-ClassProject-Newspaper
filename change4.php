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

$sid=$_POST["sid"];
$type=$_POST["type"];
$rate=$_POST["rate"];
if($type=='newspaper')
{
$u1="update newspaper set rate = ".$rate." where n_sid=".$sid;
mysql_query($u1);
}
elseif($type=='magazine')
{
$u1="update magazine set rate = ".$rate." where m_sid=".$sid;
mysql_query($u1);
}
echo"Successfully updated";
$query1="select * from newspaper where n_sid=".$sid;
$query2="select * from magazine where m_sid=".$sid;

$q1=mysql_query($query1);
$q2=mysql_query($query2);

if($type=='newspaper')
{
while($r1=mysql_fetch_array($q1))
{echo"<br/>SID:".$r1['n_sid'];
echo"<br/>Publication Name:".$r1['n_pname'];
echo"<br/>Name:".$r1['n_name'];
echo"<br/>Type:Newspaper";
echo"<br/>Noof Issues:".$r1['noof_days'];
echo"<br/>Frequency:".$r1['n_frequency'];
echo"<br/>Rate:".$r1['rate'];
}
}
elseif($type=='magazine')
{
while($r2=mysql_fetch_array($q2))
{echo"<br/>SID:".$r2['m_sid'];
echo"<br/>Publication Name:".$r2['m_pname'];
echo"<br/>Name:".$r2['m_name'];
echo"<br/>Type:Magazine";
echo"<br/>Noof Issues:".$r2['issue'];
echo"<br/>Frequency:".$r2['m_frequency'];
echo"<br/>Rate:".$r2['rate'];
}
}
echo"";
?>

</div>
</body>
</html>