
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

//-----------Function for extracting data from files and transfering them to database--------
function general($filename,$attrib,$row)
{

//----------To assign the contents in file to a variable as a string-------------
$f=file_get_contents("$filename");
$s=$f;

//----------Pattern search to exclude (' and , and space) and return only the values in text------------
$lines = preg_split('/[\'|\,|\s]+/', $s);

//----------In department file as the initial valu is with out any (') it contradicts with my search pattern so i hav ebegun the search from 0--------
$k=0;
if($filename=="sid.txt")
{
for($i=0;$i<=$row;$i++)
{
for($j=0;$j<=$attrib;$j++)
{
$a[$i][$j]=$lines[$k+$j];
$sum=$k+$j;
}
$k=$sum+1;
}
return($a);
}
//---------------For the rest of the text files that support my search pattern-------------------
else
{
for($i=1;$i<=$row;$i++)
{
for($j=1;$j<=$attrib;$j++)
{
$a[$i][$j]=$lines[$k+$j];
$sum=$k+$j;
}
$k=$sum;
}
return($a);
}
}
//--------To convert date in to format that MYSQL supports------------

/*if($j==4 && $filename=="DEPARTMENT.txt" || $j==5 && $filename=="EMPLOYEE.txt")
{

//--------Pattern search to explode date format in text file at (-) and retrieve the data needed------------

$date = preg_split('/[\-|\s]+/', $a[$i][$j]);
if($date[1]=="JAN")
$date[1]=1;
elseif($date[1]=="FEB")
$date[1]=2;
elseif($date[1]=="MAR")
$date[1]=3;
elseif($date[1]=="APR")
$date[1]=4;
elseif($date[1]=="MAY")
$date[1]=5;
elseif($date[1]=="JUN")
$date[1]=6;
elseif($date[1]=="JUL")
$date[1]=7;
elseif($date[1]=="AUG")
$date[1]=8;
elseif($date[1]=="SEP")
$date[1]=9;
elseif($date[1]=="OCT")
$date[1]=10;
elseif($date[1]=="NOV")
$date[1]=11;
elseif($date[1]=="DEC")
$date[1]=12;

$a[$i][$j]="$date[2]-$date[1]-$date[0]";
}
}
$k=$sum;
}
return($a);
}
}
*/
//--------------------defining parameters for the retrieval of data from text files---------
$filename="customer.txt";
$col=3;
$row=7;
$v=general("$filename","$col","$row");

$filename="magazine.txt";
$col=6;
$row=8;
$z=general("$filename","$col","$row");

$filename="newspaper.txt";
$col=6;
$row=10;
$t=general("$filename","$col","$row");

$filename="publication.txt";
$col=3;
$row=9;
$x=general("$filename","$col","$row");

$filename="sid.txt";
$col=0;
$row=18;
$y=general("$filename","$col","$row");

include("connection.php");
/*
//----------working condition
//,drop foreign key employee_ibfk_1,drop key super_ssn
mysql_query("alter table employee drop foreign key employee_ibfk_2,drop key dno");
mysql_query("alter table employee change Super_ssn Super_ssn char(9) null default null");
//mysql_query("alter table employee drop foreign key employee_ibfk_2,drop key dno");
for($u=1;$u<=61;$u++)
{
//---To insert null values in super_ssn and then updating it----------
$r="insert into employee(Fname,Minit,Lname,Ssn,Bdate,Address,Sex,Salary,Dno) values(\"".$t[$u][1]."\",\"".$t[$u][2]."\",\"".$t[$u][3]."\",\"".$t[$u][4]."\",\"".$t[$u][5]."\",\"".$t[$u][6].",".$t[$u][7].",".$t[$u][8].",".$t[$u][9]."\",\"".$t[$u][10]."\",\"".$t[$u][11]."\",\"".$t[$u][13]."\")";
$h="update employee set Super_ssn =".$t[$u][12]." where Ssn=\"".$t[$u][4]."\"";

mysql_query("$h");
mysql_query("$r");
}*/
for($u=1;$u<=7;$u++)
{
$r="insert into customer(initial,last,address) values(\"".$v[$u][1]."\",\"".$v[$u][2]."\",\"".$v[$u][3]."\")";

mysql_query("$r");
}

for($u=1;$u<=9;$u++)
{
$r="insert into publication values(\"".$x[$u][1]."\",\"".$x[$u][2]."\",\"".$x[$u][3]."\")";
mysql_query("$r");
}

for($u=0;$u<=18;$u++)
{
$r="insert into subscribed values(\"".$y[$u][0]."\")";
mysql_query("$r");
}

//mysql_query("alter table employee add foreign key(Dno) references department(Dnumber)");
for($u=1;$u<=8;$u++)
{
$r="insert into magazine values(\"".$z[$u][1]."\",\"".$z[$u][2]."\",\"".$z[$u][3]."\",\"".$z[$u][4]."\",\"".$z[$u][6]."\",\"".$z[$u][5]."\")";
mysql_query("$r");
}
for($u=1;$u<=10;$u++)
{
$r="insert into newspaper values(\"".$t[$u][1]."\",\"".$t[$u][5]."\",\"".$t[$u][4]."\",\"".$t[$u][3]."\",\"".$t[$u][2]."\",\"".$t[$u][6]."\")";
mysql_query("$r");
}
/*
mysql_query("alter table newspaper add foreign key(n_sid) references subscribed(sid)");

mysql_query("alter table magazine add foreign key(m_sid) references subscribed(sid)");

mysql_query("alter table newspaper add foreign key(n_pname,n_frequency) references publication(p_name,frequency)");

mysql_query("alter table magazine add foreign key(m_pname,m_frequency) references publication(p_name,frequency)");
*/
echo "Datas have been sucessfully uploaded in to the database";

?>



</div>
</body>
</html>