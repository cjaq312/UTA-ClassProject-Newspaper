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
$initial = $_POST["initial"];
$last = $_POST["last"];
$address = $_POST["address"];
$mark=0;

if($initial=="" || $last=="" || $address=="")
{echo"Enter all the values";
exit();
}

$s1=mysql_query("select * from customer");
if(mysql_num_rows($s1)!=0)
{
while($check=mysql_fetch_array($s1))
{
if($check['initial'] == $initial && $check['last'] == $last && $check['address'] == $address)
{
$mark=1;
$cid=$check['cid'];
echo"Customer information already exist in the database<br/>";
break;
}
}
if($mark==0)
{
$r1="insert into customer(initial,last,address) values(\"".$initial."\",\"".$last."\",\"".$address."\")";
mysql_query("$r1");
$s2=mysql_query("select * from customer");
while($check=mysql_fetch_array($s2))
{
if($check['initial'] == $initial && $check['last'] == $last && $check['address'] == $address)
{
//$mark=1;
$cid=$check['cid'];
}

}
}
}
elseif(mysql_num_rows($s1)==0)
{
$r1="insert into customer(initial,last,address) values(\"".$initial."\",\"".$last."\",\"".$address."\")";
mysql_query("$r1");
$s2=mysql_query("select * from customer");
while($check=mysql_fetch_array($s2))
{
if($check['initial'] == $initial && $check['last'] == $last && $check['address'] == $address)
{
//$mark=1;
$cid=$check['cid'];
}

}
}
echo"<FORM ACTION='selection.php' method='post'>CUSTOMER INFO:<BR/>CUSTOMER ID:";
ECHO $cid;
echo"<BR/>INITIAL:";
ECHO $initial;
echo"<BR/>LAST:";
ECHO $last;
echo"<BR/>ADDRESS:";
ECHO $address;
$publication="select distinct(p_name) as p_name from publication";
$r2=mysql_query($publication);
echo"<br/>PUBLICATIONS AVAILABLE IN DATABASE:<select name='publication'>";
while($r3=mysql_fetch_array($r2))
{
echo"<option>".$r3[p_name]."</option>";
}
echo"</select><BR/>TYPE:<select name='type'><option>newspaper</option><option>magazine</option></select><br/>";
echo"<input type='hidden' name='initial' value=\"".$initial."\"/><input type='hidden' name='last' value=\"".$last."\"/><input type='hidden' name='cid' value=\"".$cid."\"/><input type='hidden' name='address' value=\"".$address."\"/><br/><INPUT TYPE='SUBMIT'></form>";
?>



</div>
</body>
</html>