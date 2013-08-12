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
$r1=mysql_query("select * from customer");
$r2=mysql_query("select * from newspaper");
$r3=mysql_query("select * from magazine");

$r4=mysql_query("select * from subscribed");


echo "<Center><u><h1>DATAS IN DATABASE PROJECT-2</h1></u></center><br/><h3>Customer Info</h3><br/><table border=2><tr><th>Customer ID</th><th>Initial</th><th>Last Name</th><th>Address</th></tr>";
while($c1=mysql_fetch_array($r1))
{
echo "<tr><td>".$c1['cid']."</td><td>".$c1['initial']."</td><td>".$c1['last']."</td><td>".$c1['address']."</td></tr>";
}
echo "</table><br/><br/>";
echo "<h3>Newspaper</h3><br/><table border=2><tr><th>Newspaper ID</th><th>Publication Name</th><th>Newspaper Name</th><th>Number Of Days</th><th>Frequency</th><th>Rate</th></tr>";
while($c2=mysql_fetch_array($r2))
{
echo "<tr><td>".$c2['n_sid']."</td><td>".$c2['n_pname']."</td><td>".$c2['n_name']."</td><td>".$c2['noof_days']."</td><td>".$c2['n_frequency']."</td><td>".$c2['rate']."</td></tr>";
}
echo "</table><br/><br/>";
echo "<h3>Magazine</h3><br/><table border=2><tr><th>Magazine ID</th><th>Publication Name</th><th>Magazine Name</th><th>Number Of Issues</th><th>Frequency</th><th>Rate</th></tr>";
while($c3=mysql_fetch_array($r3))
{
echo "<tr><td>".$c3['m_sid']."</td><td>".$c3['m_pname']."</td><td>".$c3['m_name']."</td><td>".$c3['issue']."</td><td>".$c3['m_frequency']."</td><td>".$c3['rate']."</td></tr>";
}
echo "</table><br/><br/>";
echo "<h3>Subscription</h3><br/><table  border=2><tr><th>Subscription ID</th></tr>";
while($c4=mysql_fetch_array($r4))
{
echo "<tr><td>".$c4['sid']."</td></tr>";
}
echo "</table><br/><br/>";

$r5=mysql_query("select * from subscription");
if(mysql_num_rows($r5)==0)
die();

echo "<h3>Subscription Details</h3><br/><table border=2><tr><th>Subscription ID</th><th>Customer ID</th><th>Start Date</th><th>End Date</th><th>NUmber Of Months</th><th>Total Cost</th></tr>";
while($c5=mysql_fetch_array($r5))
{
echo "<tr><td>".$c5['s_sid']."</td><td>".$c5['s_cid']."</td><td>".$c5['start_date']."</td><td>".$c5['end_date']."</td><td>".$c5['noof_months']."</td><td>".$c5['total_cost']."</td></tr>";
}
echo "</table><br/><br/>";

?>

</div>
</body>
</html>