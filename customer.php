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
echo"Customer information already exist in the database with customer id --> $cid";
break;
}
}
if($mark==0)
{
$r1="insert into customer(initial,last,address) values(\"".$initial."\",\"".$last."\",\"".$address."\")";
echo "Welcome To The World Of Newspapers And Magazines!!! ";
mysql_query("$r1");
}
}
elseif(mysql_num_rows($s1)==0)
{
$r1="insert into customer(initial,last,address) values(\"".$initial."\",\"".$last."\",\"".$address."\")";
echo "Welcome To The World Of Newspapers And Magazines!!! ";
mysql_query("$r1");
}
?>



</div>
</body>
</html>