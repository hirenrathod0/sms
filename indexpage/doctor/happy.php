<?php require_once('../Connections/cn.php'); ?>
<?php
$pid=$_GET['pid'];
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM certi WHERE id = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset11 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset11 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
$pid=$_GET['pid'];
mysql_select_db($database_cn, $cn);
$query_Recordset11= sprintf("SELECT * FROM patient WHERE pid = %s", $colname_Recordset11);
$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);
$d= strtotime($row_Recordset11['bdate']);
$t=date("Y",$d);
$c=date("Y");
$bt=$c-$t;
session_start();
$query_Recordset2 = sprintf("SELECT * FROM user WHERE uid = ".$_SESSION['MM_DOCTOR']."");
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body style="font-size:12px;">
(G.P.V)Y-5152-1.50.000-8-2010
<p align='center'>FORM NO.4 <br>
  (See rule 7) <br>
  MIEDICAL CERTIFICATION OF CAUSE OF DEATH <br>
  (Hospital in-patients, Not to be Used for still births) <br>
  To be sent To Registrar alongwith Form No.2(Death Report) <br>
</p>
Name of the Hospital Doct Connect <br>
I hereby Certify that the person whose particulars are given below died in the hospital in Ward No._______________on ____________at____________ A.M/P.M
<table border='1' bordercolor='#000000' width='100%' border='solid' style="font-size:12px;">

<tr>
  <td colspan='5'><strong>NAME OF DECEASED : </strong><?php echo $row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11['lname'] ;?></td>
  <td><strong> For use of statistical office</strong></td>
</tr>

<tr>
  <td align="center"> SEX </td>
  <td colspan='4' style="padding-left:400px;">Age At Death</td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td>If 1 year or more,age in years</td>
  <td>If less than 1 year age in months</td>
  <td>If less than 1 month, age in Days</td>
  <td>If less than 1 one day,age in hours.</td>
  <td rowspan="12"></td>
</tr>
<tr>
  <td> 1. Male <br>
    2.Female </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td colspan='4' style="padding-left:250px;border:none;" >CAUSE OF DEATH<br>
    <br>
    <br></td>
  <td rowspan='8'>Interval between Antecedent condition and death(Approx.)</td>
</tr>
<tr>
  <td colspan='2' style="border:none;">I<br>
    Immediate cause </td>
  <td colspan='2' style="border:none;">(a)_______________________________</td>
</tr>
<tr>
  <td colspan='2' style="border:none;"> &nbsp;&nbsp;&nbsp;State the diseases,injury of complication which caused death,not the mode of dying such as heart failure,asthenia,etc. </td>
  <td colspan='2' style="border:none;">Due to(or as a consequences of )</td>
</tr>
<tr>
  <td colspan='2' style="border:none;">
    Antecedent cause</td>
  <td colspan='2' style="border:none;">(b)_______________________________</td>
</tr>
<tr>
  <td colspan='2' style="border:none;">&nbsp;&nbsp;&nbsp; Morbid Conditions,if any,giving rise to the above cause,stating underlying conditions </td>
  <td colspan='2' style="border:none;">Due to(or as a consequences of )</td>
</tr>
<tr>
  <td colspan='2' style="border:none;">II<br>
    Other significant conditions contributing to the death but not related to the disease or condition causing it. </td>
  <td colspan='2' style="border:none;">(c)_______________________________</td>
</tr>
  </table>
Manner of Death(please tick Mark)&nbsp;&nbsp;&nbsp; How did the injury occur?<br />
1.Natural &nbsp;&nbsp; 2.Accident &nbsp;&nbsp; 3.Suicide &nbsp;&nbsp;4.Homicide &nbsp;&nbsp;5.Pending investigation
<hr />
If deceased was a female, was the death associated with pregnancy? &nbsp;&nbsp;&nbsp; 1.Yes &nbsp;&nbsp;&nbsp;2.No
<br />
If Yes, was there a delivery?&nbsp;&nbsp;&nbsp; 1. Yes&nbsp;&nbsp;&nbsp; 2.No
<hr />
<p align="right">Name and Signature of the Medical Attendant certifying the cause of death 
<br />
Date of verification____________________________________________</p>
------------------------------------------------------------------------------------------------------------------------------------------------------------------<p align="center">(To be detached and handed over to the relative of the deceased)</p> 
Certified that Shri/Smt./Kum.________________________________________________________________________________S/W/D of Shri
_________________________R/O______________________________________________________________was admitted to this hospital on ___________________________________________and expired on________________.
<br />
<br />
<p align="right">Doctor______________________________
<br />(Medical Superintendent& Name of Hospital) </p>
  
</body>
</html>