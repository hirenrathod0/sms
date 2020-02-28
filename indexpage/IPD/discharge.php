<?php 
require_once('../Connections/cn.php');
$tt=$_GET['pid'];

date_default_timezone_set("Asia/Kolkata");

$qt=mysql_query("select bedno,dofadmit,rtype from patient_admit where pid='$tt'");
$qtt=mysql_fetch_assoc($qt);
$aa=$qtt['bedno'];
$bb=$qtt['dofadmit'];
$cc=$qtt['rtype'];
$hh=date('d-m-Y h:i:s');
$qe=mysql_query("insert into bed_dtl(pid,bedid,admit_date,dis_date,rtype) values('$tt','$aa','$bb','$hh','$cc')");

$qq="UPDATE `patient_admit` SET`status`='Discharge',dofadmit='$bb',`dofdischarge`='$hh',`bedno`='0',`rtype`='None' WHERE pid='$tt'";
if(mysql_query($qq))
{
echo '<meta http-equiv="refresh" content="0; url=madmit.php">';
exit;
}
?>

