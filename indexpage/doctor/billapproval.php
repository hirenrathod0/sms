<?php
$id=$_GET['id'];
mysql_connect('localhost','root','');
mysql_select_db('vihar');
$query="UPDATE `bill` SET  `status`='approval' WHERE id=".$id;
mysql_query($query);
$query="UPDATE `billhistry` SET `status`= 'approval' WHERE  bid=".$id;
mysql_query($query);
header('location:index.php');
?>

