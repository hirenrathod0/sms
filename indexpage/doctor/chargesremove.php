<?php


mysql_connect('localhost','root','');
mysql_select_db('vihar');

$nm=$_GET['id'];
echo $query1="SELECT `bhid`, `pid` FROM `billhistry` WHERE bhid=$nm";
$res=mysql_query($query1);
$row=mysql_fetch_assoc($res);
echo $query="DELETE FROM `billhistry` WHERE  bhid=$nm";
mysql_query($query);
header("location:editbill.php?pid=".$row[pid]);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
