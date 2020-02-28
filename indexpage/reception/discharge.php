<?php 
require_once('../Connections/cn_vihar.php');
$tt=$_GET['pid'];

 $qq="UPDATE `patient` SET`status`='Discharge' WHERE pid='$tt'";
//exit;
if(mysql_query($qq))
{

echo '<meta http-equiv="refresh" content="0; url=index.php">';
exit;
}
?>

