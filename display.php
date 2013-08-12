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
if($initial == $check['initial'] && $last == $check['last'] && $address == $check['address'])
{
$mark=1;
$cid=$check['cid'];
echo"Match Found";
echo"<br/>";
break;
}
}
}
elseif(mysql_num_rows($s1)==0)
echo"There are no customers info in the database.";
/////////----------------------------------------------
if($mark==0)
{
echo"Match not found";
die();
}

if($mark==1)
{
$s1="select s_sid from subscription where s_cid=".$cid;

$r1=mysql_query($s1);

while($get=mysql_fetch_array($r1))
{
$sid[]=$get['s_sid'];
}
}
$size = sizeof($sid);
if($size != 0)
{
$s2=mysql_query("select * from newspaper order by n_sid ASC");
$s3=mysql_query("select * from magazine order by m_sid ASC");
echo"<table border=1><tr><td>SID</td><td>Publication</td><td>Name</td><td>Type</td><td>Frequency</td><td>Issue</td><td>Rate</td><td>Start Date</td><td>End Date</td><td>Noof Months</td><td>Total Cost</td></tr>";
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
for($j=0;$j<$size2;$j++)
{
if($sid[$i] == $n_sid[$j])
{
$relate['type'][$cid][$sid[$i]]=1;
$relate['rate'][$cid][$sid[$i]]=$n_rate[$j];
$relate['frequency'][$cid][$sid[$i]]=$n_frequency[$j];
$relate['issue'][$cid][$sid[$i]]=$noof_days[$j];
$relate['name'][$cid][$sid[$i]]=$n_name[$j];
$relate['pname'][$cid][$sid[$i]]=$n_pname[$j];

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
$relate['type'][$cid][$sid[$i]]=2;
$relate['rate'][$cid][$sid[$i]]=$m_rate[$j];
$relate['frequency'][$cid][$sid[$i]]=$m_frequency[$j];
$relate['issue'][$cid][$sid[$i]]=$issues[$j];
$relate['name'][$cid][$sid[$i]]=$m_name[$j];
$relate['pname'][$cid][$sid[$i]]=$m_pname[$j];

//echo"<tr><td>".$m_sid[$j]."</td><td>".$m_pname[$j]."</td><td>".$m_name[$j]."</td><td>Magazine</td><td>".$m_frequency[$j]."</td><td>".$issues[$j]."</td><td>".$m_rate[$j]."</td></tr>";
}
}
}
}

for($i=0;$i<$size;$i++)
{
if($relate['frequency'][$cid][$sid[$i]]=='Daily')
{
$add=$relate['issue'][$cid][$sid[$i]];
}
elseif($relate['frequency'][$cid][$sid[$i]]=='Weekly')
{
$add=$relate['issue'][$cid][$sid[$i]] * 7;
}
elseif($relate['frequency'][$cid][$sid[$i]]=='Monthly')
{
$add=$relate['issue'][$cid][$sid[$i]] * 30;
}
elseif($relate['frequency'][$cid][$sid[$i]]=='Quaterly')
{
$add=$relate['issue'][$cid][$sid[$i]] * 90;
}
$query1="update subscription set end_date = ADDDATE(start_date, INTERVAL " .$add. " DAY) where s_sid='".$sid[$i]."' and s_cid='".$cid."'";
mysql_query($query1);
$query2="select end_date,start_date from subscription where s_sid='".$sid[$i]."' and s_cid='".$cid."'";
$s3=mysql_query($query2);
while($check=mysql_fetch_array($s3))
{
$query3="select DATEDIFF('".$check['end_date']."','".$check['start_date']."') as diff";
$s4=mysql_query($query3);
while($check1=mysql_fetch_array($s4))
{
$month=$check1['diff']/30;
if($relate['frequency'][$cid][$sid[$i]]=='Daily')
{
$cost=$relate['rate'][$cid][$sid[$i]] * $relate['issue'][$cid][$sid[$i]];
}
elseif($relate['frequency'][$cid][$sid[$i]]=='Weekly')
{
$cost=$relate['rate'][$cid][$sid[$i]] * $relate['issue'][$cid][$sid[$i]];
}
elseif($relate['frequency'][$cid][$sid[$i]]=='Monthly')
{
$cost=$relate['rate'][$cid][$sid[$i]] * $relate['issue'][$cid][$sid[$i]];
}
elseif($relate['frequency'][$cid][$sid[$i]]=='Quaterly')
{
$cost=$relate['rate'][$cid][$sid[$i]] * $relate['issue'][$cid][$sid[$i]];
}
$final="update subscription set total_cost = ".$cost." where s_sid=".$sid[$i]." and s_cid=".$cid;
$final1="update subscription set noof_months = ".$month." where s_sid=".$sid[$i]." and s_cid=".$cid;
mysql_query($final);
mysql_query($final1);
}
}
}
$play="select * from customer where cid='".$cid."'";
$display=mysql_query($play);
while($qdisplay=mysql_fetch_array($display))
{
echo"<B>Customer ID:</B>".$qdisplay['cid']."<br/><B>Initial:</B>".$qdisplay['initial']."<br/><B>Last:</B>".$qdisplay['cid']."<br/><B>Address:</B>".$qdisplay['address'];
}
echo"<br/><br/><b>Current Subscriptions:<b/>";
for($i=0;$i<$size;$i++)
{
$play="select * from subscription where s_sid='".$sid[$i]."' and s_cid='".$cid."' and total_cost != 0";
$display=mysql_query($play);
while($qdisplay=mysql_fetch_array($display))
{
if($relate['type'][$cid][$sid[$i]]==2)
echo"<tr><td>".$sid[$i]."</td><td>".$relate['pname'][$cid][$sid[$i]]."</td><td>".$relate['name'][$cid][$sid[$i]]."</td><td>Magazine</td><td>".$relate['frequency'][$cid][$sid[$i]]."</td><td>".$relate['issue'][$cid][$sid[$i]]."</td><td>".$relate['rate'][$cid][$sid[$i]]."</td><td>".$qdisplay['start_date']."</td><td>".$qdisplay['end_date']."</td><td>".$qdisplay['noof_months']."</td><td>".$qdisplay['total_cost']."</td></tr>";
elseif($relate['type'][$cid][$sid[$i]]==1)
echo"<tr><td>".$sid[$i]."</td><td>".$relate['pname'][$cid][$sid[$i]]."</td><td>".$relate['name'][$cid][$sid[$i]]."</td><td>Newspaper</td><td>".$relate['frequency'][$cid][$sid[$i]]."</td><td>".$relate['issue'][$cid][$sid[$i]]."</td><td>".$relate['rate'][$cid][$sid[$i]]."</td><td>".$qdisplay['start_date']."</td><td>".$qdisplay['end_date']."</td><td>".$qdisplay['noof_months']."</td><td>".$qdisplay['total_cost']."</td></tr>";
}
}
echo"</table><br/>";
}
?>

</div>
</body>
</html>