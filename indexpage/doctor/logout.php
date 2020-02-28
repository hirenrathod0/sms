<?php
// *** Logout the current user.
if (!isset($_SESSION)) {
  session_start();
}
$pp=$_SESSION['nm'];
 require_once('../Connections/cn.php'); 

mysql_select_db($database_cn, $cn);
$query_Recordset1 = "select start_dt from login_history where username='$pp' order by id desc limit 0,1";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



 $kp1=$row_Recordset1['start_dt'];
  date_default_timezone_set("Asia/Calcutta");
  
$nm= date('Y-m-d H:i:s');

echo $qq="update login_history set status='logout',end_dt='$nm' where start_dt='$kp1'";
//exit;
$qq1=mysql_query($qq); 


$logoutGoTo = "login.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_DOCTOR'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
unset($_SESSION['MM_DOCTOR']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>