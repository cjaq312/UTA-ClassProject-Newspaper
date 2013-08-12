
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
$loser1=0;
$loser2=0;
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
echo"Match Found";
echo"<br/>Customer ID:".$cid;
break;
}
}
}
elseif(mysql_num_rows($s1)==0)
echo"There are no customers info in the database.";

if($mark==0)
echo"Match not found";

if($mark==1)
{
$s1="select s_sid from subscription where s_cid=".$cid." and total_cost !=0";

//$count=mysql_num_rows($s1);
$r1=mysql_query($s1);

while($get=mysql_fetch_array($r1))
{
$sid[]=$get['s_sid'];
}

$s2=mysql_query("select * from newspaper order by n_sid ASC");
$s3=mysql_query("select * from magazine order by m_sid ASC");
echo"<form action='unsubscribed.php' method='post'><table border=1><tr><td>SID</td><td>Publication</td><td>Name</td><td>Type</td><td>Frequency</td><td>Issue</td><td>Rate</td></tr>";
$size2=mysql_num_rows($s2);
$size3=mysql_num_rows($s3);
while($check1=mysql_fetch_array($s2))
{
$n_sid[] = $check1['n_sid'];
$n_pname[] = $check1['n_pname'];
$n_name[] = $check1['n_name'];
$n_frequency[] = $check1['n_frequency'];
$noof_days[] = $check1['noof_days'];
$n_rate[] = $check1['rate'];
}
for($i=0;$i<sizeof($sid);$i++)
{
for($j=0;$j<sizeof($n_sid);$j++)
{
if($sid[$i] == $n_sid[$j])
{
echo"<tr><td><input type='checkbox' name='unsub[]' value='".$n_sid[$j]."'/>".$n_sid[$j]."</td><td>".$n_pname[$j]."</td><td>".$n_name[$j]."</td><td>Newspaper</td><td>".$n_frequency[$j]."</td><td>".$noof_days[$j]."</td><td>".$n_rate[$j]."</td></tr>";
}
}
}
while($check2=mysql_fetch_array($s3))
{
$m_sid[] = $check2['m_sid'];
$m_pname[] = $check2['m_pname'];
$m_name[] = $check2['m_name'];
$m_frequency[] = $check2['m_frequency'];
$issues[] = $check2['issue'];
$m_rate[] = $check2['rate'];
}
//echo sizeof($m_sid);
if(sizeof($m_sid) != 0)
{
for($i=0;$i<sizeof($sid);$i++)
{
for($j=0;$j<sizeof($m_sid);$j++)
{
if($sid[$i] == $m_sid[$j])
{
echo"<tr><td><input type='checkbox' name='unsub[]' value='".$m_sid[$j]."'/>".$m_sid[$j]."</td><td>".$m_pname[$j]."</td><td>".$m_name[$j]."</td><td>Magazine</td><td>".$m_frequency[$j]."</td><td>".$issues[$j]."</td><td>".$m_rate[$j]."</td></tr>";
}
}
}
}
echo"</table><br/><input type='hidden' name='cid' value='".$cid."'><input type='submit' value='unsubscribe'/></form>";

}
?>


</div>
</body>
</html>
