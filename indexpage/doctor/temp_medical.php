<?php require_once('../Connections/cn.php'); ?>
<?php
$pid=$_GET['pid'];
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM med_cer WHERE mid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$pp=$row_Recordset1['pid'];
//$pp=$_GET['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset11= sprintf("SELECT * FROM patient WHERE pid ='$pp'");
$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);




  /*?>$n= $_GET["pid"]."_".date("Ymd");
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$n.doc");<?php */
?>
<html>;
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<body>

<p align="center"><b><u>SHRADDHA HOSPITAL</u></b><br>
Borsad-Anand Road, Vaniyakrwa, At. Vehera - 388 540, Tal. Borsad, Dist. Anand<br>
Phone No. 02696-223333</p>
<p align="right">
Date : <?php echo date("d/m/Y");?></p>
<table align='center'>
<p align='center'><b><u> MEDICAL CERTIFICATE</b></u></p>
<tr>
<td>

<p>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that Mr/Mrs. <?php echo $row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11['lname'] ;?> is/was suffering From <?php echo $row_Recordset1['suf'];?>& he/she is/was under my treatment for the same & admitted in the hospital from date <?php echo date("d/m/y", strtotime($row_Recordset1['from_dt']));  ?> to date <?php echo date("d/m/y", strtotime($row_Recordset1['to_dt']));  ?> . He/She is advised for <?php echo $row_Recordset1['adays'];  ?> days.He/She is phiysically fit to resume duty from <?php echo date("d/m/y", strtotime($row_Recordset1['r_date']));  ?>  </p> 

</td>
</tr>
<tr>
<td>
<br><br><br>
<p align="right">
Chief Medical Officer
</p>
</tr>
</td>
</table>
</div>
</body>
</html>

	

