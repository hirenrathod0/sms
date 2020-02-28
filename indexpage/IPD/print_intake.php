<?php require_once('../Connections/cn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$ii=$_GET['pid'];
$dt1=$_GET['dt1'];
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM intake_output where pid=$ii and date='$dt1'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$aa=$row_Recordset1['pid'];


mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM patient where pid='$ii'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Doct Connect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
<meta name="author" content="Muhammad Usman">
<!-- The styles -->
<link id="bs-css" href="../nurse_female/css/bootstrap-cerulean.min.css" rel="stylesheet">
<link href="../nurse_female/css/charisma-app.css" rel="stylesheet">
<link href='../nurse_female/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
<link href='../nurse_female/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
<link href='../nurse_female/bower_components/chosen/chosen.min.css' rel='stylesheet'>
<link href='../nurse_female/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
<link href='../nurse_female/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
<link href='../nurse_female/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
<link href='../nurse_female/css/jquery.noty.css' rel='stylesheet'>
<link href='../nurse_female/css/noty_theme_default.css' rel='stylesheet'>
<link href='../nurse_female/css/elfinder.min.css' rel='stylesheet'>
<link href='../nurse_female/css/elfinder.theme.css' rel='stylesheet'>
<link href='../nurse_female/css/jquery.iphone.toggle.css' rel='stylesheet'>
<link href='../nurse_female/css/uploadify.css' rel='stylesheet'>
<link href='../nurse_female/css/animate.min.css' rel='stylesheet'>
<!-- jQuery -->
<script src="../nurse_female/bower_components/jquery/jquery.min.js"></script>
<!-- The fav icon -->
<link rel="shortcut icon" href="../nurse_female/img/favicon.ico">
</head>
<body style="margin-top:30px;">
<!-- topbar starts -->
<table border="1" align="center"  width="100%">
  <tr>
    <td colspan="15" style="text-align:center;">CHOVIS GAM SACHCHIDANAND MEDICAL & RESEARCH CENTER,SANCHALIT</td>
  </tr>
  <tr>
    <td width="150"><img src="../images/vihar logo.png" width="150px" height="100px" /></td>
    <td colspan="15" ><div style="text-align:center;font-size:34px;" ><b > SHRADDHA HOSPITAL</b></div>
      <div style="text-align:left;font-size:10px;">
      &nbsp;&nbsp;&nbsp;&nbsp;    The Excellent English Medium School Complex,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Campus: <br>
      &nbsp;&nbsp;&nbsp;&nbsp; At.VAHERA-388 540,Borsad,Dist.Anand(Guj.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      
      
      Borsad-Singlav Road, Borsad, Dist. Anand <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      Ph.(02696)223333, 329409 <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      E-mail : hospitalshrddha@yahoo.com.sg, hospitalshraddha@gmail.com <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date : <?php echo $dt1;?></b></td>
    </div>
  </tr>
  <tr>
    <td align="center" colspan="15"><b>INTAKE & OUTPUT RECORD</b> </td>
  </tr>
  <tr>
    <td colspan="2">Name: <?php echo $row_Recordset2['fname'].' '. $row_Recordset2['mname'].' '. $row_Recordset2['lname']; ?> </td>
    <td colspan="3">Age:<?php echo $row_Recordset2['bdate']; ?></td>
    <td colspan="2">Sex:<?php echo $row_Recordset2['gender']; ?></td>
    <td colspan="3">Ward</td>
    <td>Bed</td>
    <td colspan="2">M.R.D.No</td>
  </tr>
  <tr>
    <td colspan="15" align="center">DRAW A LINE ACROSS THE FROM AT RECORD</td>
  </tr>
  <tr>
    <td colspan="6" align="center">INTAKE</td>
    <td colspan="7" align="center">OUTPUT</td>
  </tr>
  <tr>
    <th>Time</th>
    <th>I.V or S.C Infiusion</th>
    <th>Time </th>
    <th>By Rectum In CC </th>
    <th>Time</th>
    <th>By Month In CC</th>
    <th>Time</th>
    <th>Urin in CC</th>
    <th>Time</th>
    <th>Stomach Contact in CC</th>
	<th>Drain Output</th>
	<th>R.T Aspiration</th>
  </tr>
  <tbody>
    <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['time']; ?></td>
      <td><?php echo $row_Recordset1['iv']; ?></td>
      <td><?php echo $row_Recordset1['itime']; ?></td>
      <td><?php echo $row_Recordset1['icc']; ?></td>
      <td><?php echo $row_Recordset1['timeintake']; ?></td>
      <td><?php echo $row_Recordset1['mothcc']; ?></td>
      <td><?php echo $row_Recordset1['otime']; ?></td>
      <td><?php echo $row_Recordset1['cc']; ?></td>
      <td><?php echo $row_Recordset1['otime1']; ?></td>
      <td><?php echo $row_Recordset1['contactcc']; ?></td>
	  <td><?php echo $row_Recordset1['do']; ?></td>
	  <td><?php echo $row_Recordset1['rt']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_array($Recordset1)); ?>
  </tbody>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
