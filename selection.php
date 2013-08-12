
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
$cid = $_POST["cid"];
$initial = $_POST["initial"];
$last = $_POST["last"];
$address = $_POST["address"];
$type = $_POST["type"];
$publication = $_POST["publication"]; 

echo"<form action='confirmation.php' method='post'><h3><center><u>".$publication." Publication</u></center></h3>";
$r1="select * from publication where p_name=\"".$publication."\" and type=\"".$type."\"";
$s1=mysql_query($r1);
if(mysql_num_rows($s1) == 0)
{
echo"This publication doesnt have the type ".$type." you have selected, please make another selection,Thank you!";
}
else
{
if($type=='newspaper')///newspaper begins here
{
$r2="select distinct(n_name) as n_name from newspaper where n_pname=\"".$publication."\"";
$s2=mysql_query($r2);
while($check=mysql_fetch_array($s2))
{
$new[]=$check['n_name'];
}
echo"<table border='1'>";
echo"<tr><td>SID</td><td>Frequency</td><td>NooF Days</td><td>Rate</td></tr>";
for($i=0;$i<sizeof($new);$i++)
{
echo"<tr><td colspan='4'><b>".$new[$i]."</b></td></tr>";
$r1="select * from ".$type." where n_pname =\"".$publication."\" and n_name =\"".$new[$i]."\"";
$s1=mysql_query($r1);
while($check1=mysql_fetch_array($s1))
{
echo"<tr><td><input type='radio' name='selection' value='".$check1['n_sid']."'/>".$check1['n_sid']."</td><td>".$check1['n_frequency']."</td><td>".$check1['noof_days']."</td><td>".$check1['rate']."</td></tr>";
}
}
echo"</table>";
}
elseif($type=='magazine')////////magazine begins here
{
$r2="select distinct(m_name) as m_name from magazine where m_pname=\"".$publication."\"";
$s2=mysql_query($r2);
while($check=mysql_fetch_array($s2))
{
$new[]=$check['m_name'];
}
echo"<table border='1'>";
echo"<tr><td>SID</td><td>Frequency</td><td>NooF Issues</td><td>Rate</td></tr>";
for($i=0;$i<sizeof($new);$i++)
{
echo"<tr><td colspan='4'><b>".$new[$i]."</b></td></tr>";
$r1="select * from ".$type." where m_pname =\"".$publication."\" and m_name =\"".$new[$i]."\"";
$s1=mysql_query($r1);
while($check1=mysql_fetch_array($s1))
{
echo"<tr><td><input type='radio' name='selection' value='".$check1['m_sid']."'/>".$check1['m_sid']."</td><td>".$check1['m_frequency']."</td><td>".$check1['issue']."</td><td>".$check1['rate']."</td></tr>";
}
}
echo"</table>";
}
echo"<input type='hidden' name='initial' value=\"".$initial."\"/><input type='hidden' name='last' value=\"".$last."\"/><input type='hidden' name='cid' value=\"".$cid."\"/><input type='hidden' name='address' value=\"".$address."\"/><input type='hidden' name='type' value=\"".$type."\"/><input type='hidden' name='publication' value=\"".$publication."\"/><br/><INPUT TYPE='SUBMIT'></form>";
}
?>


</div>
</body>
</html>