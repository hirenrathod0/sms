<?php 
require_once('../Connections/cn_vihar.php');
$tt=$_GET['pid'];

date_default_timezone_set("Asia/Kolkata");

$qt=mysql_query("select * from lab_bill where pid='$tt'");
//exit;
$qtt=mysql_fetch_assoc($qt);

//$qe=mysql_query("insert into bed_dtl(pid,bedid,admit_date,dis_date,rtype) values('$tt','$aa','$bb','$hh','$cc')");

$qq="UPDATE `lab_bill` SET`status`='Paid' WHERE pid='$tt'";
//exit;
if(mysql_query($qq))
{
echo '<meta http-equiv="refresh" content="0; url=hh.php">';
exit;
}
?>
