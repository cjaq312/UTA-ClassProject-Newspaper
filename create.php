<html><style type="text/css">
<!--
body,td,th {
	font-family: Book Antiqua;
}
body {
	background-image: url(depths-of-solitude-wallpapers_2314_1024.jpg);
	margin-left: 1px;
	margin-top: 1px;
	margin-right: 1166px;
	margin-bottom: 648px;
}
#Layer1 {
	position:absolute;
	width:713px;
	height:465px;
	z-index:1;
	left: 200;
	top: 130px;
}
-->
</style>
<body>
<div id="Layer1">
  <?php
include("connection.php");
$pname = $_POST["pname"];
$type = $_POST["type"];
$name = $_POST["tname"];
$frequency = $_POST['frequency'];
$issues = $_POST['issues'];
$rate = $_POST['rate'];
$mark=0;
if($issues=="" || $rate=="")
{
echo"Enter all the values";
exit();
}
else
{

if($type=="newspaper")
{
$news=mysql_query("select * from newspaper");
if(mysql_num_rows($news)==0)
$mark=1;
else
{
while($r1=mysql_fetch_array($news))
{
if($pname == $r1['n_pname'] && $name == $r1['n_name'] && $frequency == $r1['n_frequency'] && $issues == $r1['noof_days'])
echo"DATA WITH THE SAME PUBLICATION NAME,TYPE,NAME,NOOF DAYS AND RATE ALREADY EXISTS IN THE DATABASE PLEASE CHANGE THE NOOF DAYS SUBSCRIPTION VALUE";
else
{
$mark=1;
}
}
}
}
//news package ends here
if($type=="magazine")
{
$mag=mysql_query("select * from magazine");
if(mysql_num_rows($mag)==0)
$mark=1;
else
{
while($r2=mysql_fetch_array($mag))
{
if($pname==$r2['m_pname'] && $name==$r2['m_name'] && $frequency==$r2['m_frequency'] && $issues==$r2['issue'])
echo"DATA WITH THE SAME PUBLICATION NAME,TYPE,NAME,NOOF DAYS AND RATE ALREADY EXISTS IN THE DATABASE PLEASE CHANGE THE NOOF DAYS SUBSCRIPTION VALUE";
else
{
$mark=1;
}
}
}
}
//mag package ends here
if($mark==1)
{
$checker=mysql_query("select max(sid) as sid from subscribed");
if(mysql_num_rows($checker)==0)
$sid=1;
else
{
while($r3=mysql_fetch_array($checker))
{
$sid=$r3['sid'];
$sid++;
}
}
mysql_query("insert into subscribed values(\"".$sid."\")");
mysql_query("insert into publication values(\"".$pname."\",\"".$frequency."\",\"".$type."\")");
mysql_query("insert into ".$type." values(\"".$pname."\",\"".$name."\",\"".$issues."\",\"".$sid."\",\"".$frequency."\",\"".$rate."\")");
$t="insert into publication values(\"".$pname."\",\"".$frequency."\",\"".$type."\")";
echo "Publication information is added successfully";
}

}
?>
</div>
</body>
</html>