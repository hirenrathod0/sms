<?php require_once('../Connections/cn_vihar.php'); 
$i=$_GET['l'];
$p=$_GET['pid'];
  $updateSQL = "delete from doc_lab_report WHERE pid='$i' AND sel_rep_name='$p'";
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());
  $updateGoTo = "running_queue.php";
  header(sprintf("Location: %s", $updateGoTo));
?>
