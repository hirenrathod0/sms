<?php
mysql_connect('localhost','root','');
mysql_select_db('doc_connect');
$nm=$_GET['bhid'];
$query1="SELECT `bhid`, `pid`,`price` FROM `billhistry` WHERE bhid=$nm";
$res=mysql_query($query1);
$row=mysql_fetch_assoc($res);
echo $days=$_GET['days'];
echo $total=$row['price']*$days;
echo  $query="UPDATE `billhistry` SET `numofd`=$days,`ttl`=$total WHERE bhid=$nm";
mysql_query($query);
header("location:editbill.php?pid=".$row[pid]);
?>

