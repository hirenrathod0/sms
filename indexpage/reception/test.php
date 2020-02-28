<?php require_once('../Connections/cn.php'); ?>
<?php
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM `user` WHERE type = 'doctor'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>uid</td>
    <td>fullname</td>
    <td>gender</td>
    <td>birthdate</td>
    <td>address</td>
    <td>city</td>
    <td>contact</td>
    <td>email</td>
    <td>type</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['uid']; ?></td>
      <td><?php echo $row_Recordset1['fullname']; ?></td>
      <td><?php echo $row_Recordset1['gender']; ?></td>
      <td><?php echo $row_Recordset1['birthdate']; ?></td>
      <td><?php echo $row_Recordset1['address']; ?></td>
      <td><?php echo $row_Recordset1['city']; ?></td>
      <td><?php echo $row_Recordset1['contact']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['type']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
