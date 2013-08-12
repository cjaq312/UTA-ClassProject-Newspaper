
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
echo"<FORM ACTION='change2.php' method='post'>";
$publication="select distinct(p_name) as p_name from publication";
$r2=mysql_query($publication);
echo"<br/>PUBLICATIONS AVAILABLE IN DATABASE:<select name='publication'>";
while($r3=mysql_fetch_array($r2))
{
echo"<option>".$r3[p_name]."</option>";
}
echo"</select><BR/>TYPE:<select name='type'><option>newspaper</option><option>magazine</option></select><br/>";
echo"<br/><INPUT TYPE='SUBMIT'></form></body></html>";
?>

</div>
</body>
</html>

