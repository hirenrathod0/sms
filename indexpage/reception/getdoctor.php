<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_getdoctor = "-1";
if (isset($_GET['did'])) {
  $colname_getdoctor = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_getdoctor = sprintf("SELECT * FROM `user` WHERE uid = '%s' and type='Doctor'", $colname_getdoctor);
$getdoctor = mysql_query($query_getdoctor, $cn) or die(mysql_error());
$row_getdoctor = mysql_fetch_assoc($getdoctor);
$totalRows_getdoctor = mysql_num_rows($getdoctor);
echo $row_getdoctor['fullname'];
?>