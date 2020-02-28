<?php require_once('../Connections/cn.php'); ?>
<?php
$pid=$_GET['pid'];
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM disch_sum WHERE id = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$pp=$row_Recordset1['pid'];
//$pp=$_GET['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset11= "SELECT * FROM patient WHERE pid ='$pp'";
$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);

$jj=$row_Recordset11['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset12= "SELECT * FROM patient_admit WHERE pid ='$jj'";
$Recordset12 = mysql_query($query_Recordset12, $cn) or die(mysql_error());
$row_Recordset12 = mysql_fetch_assoc($Recordset12);
$totalRows_Recordset12 = mysql_num_rows($Recordset12);

//$zz=$_GET['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset15= "SELECT * FROM bed_dtl WHERE pid ='$jj'";
$Recordset15 = mysql_query($query_Recordset15, $cn) or die(mysql_error());
$row_Recordset15 = mysql_fetch_assoc($Recordset15);
$totalRows_Recordset15 = mysql_num_rows($Recordset15);

  /*?>$n= $_GET["pid"]."_".date("Ymd");
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$n.doc");<?php */
?>
<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<body>
<table  class="body" id="customers" border="1" align="center" style="border:solid;" width="100%">
  <tr>
    <td colspan="4" style="text-align:center;">CHOVIS GAM SACHCHIDANAND MEDICAL & RESEARCH CENTER,SANCHALIT</td>
  </tr>
  <tr>
    <td width="119"><img src="img/vihar logo.png" width="150px" height="100px" /></td>
    <td colspan="3" ><div style="text-align:center;font-size:32px;" ><b > SHRADDHA HOSPITAL</b></div>
      <div style="text-align:left;font-size:10px;">
      &nbsp;&nbsp;&nbsp;&nbsp;    The Excellent English Medium School Complex,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Campus: <br>
      &nbsp;&nbsp;&nbsp;&nbsp; At.VAHERA-388 540,Borsad,Dist.Anand(Guj.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      
      
      Borsad-Singlav Road, Borsad, Dist. Anand <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      Ph.(02696)223333, 329409 <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      E-mail : hospitalshrddha@yahoo.com.sg, hospitalshraddha@gmail.com </td>
      </div>
  </tr>
</table>
<table id="customers" border="1" align="center"  width="100%"  style="border:none">
  <tr style="border:none">
    
    <td align="center" style="border:none;font-size:20px;"><b><u>DISCHARGED SUMMARY
 </b></u><br>Category: General
</td>
    </tr>
</table>
<table align="center" width="100%" border="1px">
 
<tr><td align="right" colspan="4"> Date : <?php echo date("d/m/Y");?></td></tr>
 <tr style="font-size:18px;font-family:'Times New Roman', Times, serif;">
    <td>Name </td><td><?php echo $row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11[ 'lname'] ;?> </td>
    <td>
      Hospital No. </td><td> </td></tr>
      <tr>
      <td>Age</td>
      <td><?php echo $row_Recordset11['bdate'];?></td>
      <td>Admission No. </td>
      <td><?php echo $row_Recordset11['pid'];?></td>
      </tr>
      <tr>
      <td>Address </td>
      <td><?php echo $row_Recordset11['adds'];?></td>
      <td>M.L.C. No. </td>
      <td><?php  ?></td>
      </tr>
      <tr>
      <td></td>
      <td></td>
      <td>Ward </td>
      <td><?php echo $row_Recordset15['rtype'].'-'.$row_Recordset15['bedid'];?></td>
      </tr>
      <tr>
      <td></td>
      <td></td>
      <td>Date of Admission </td>
      <td><?php echo $row_Recordset12['dofadmit'];?></td>
      </tr>
      <tr>
      <td></td>
      <td></td>
      <td>Date Of Surgery </td>
      <td><?php echo $row_Recordset1['dt_surgery']; ?></td>
      </tr>
      <tr>
      <td>Blood Group</td>
      <td></td>
      <td>Date of Discharged </td>
      <td><?php echo $row_Recordset1['dis_date']; ?></td>
      </tr>
      </table>
      <br>
<label><b><u>Consultants </u></b></label>
      <?php echo $row_Recordset1['dr_name']; ?>
      <br><br>
      <br>
<label><b><u>Speciality </u></b></label>
      <?php echo $row_Recordset1['speciality']; ?><br><br><br>
<label><b><u>Diagnosis</u></b></label>
      <?php echo $row_Recordset1['diagnosis']; ?><br>

<br>
<label><b><u>BRIEF HISTORY, PERTINENT PHYSICAL  DATA :
</u></b></label><?php echo $row_Recordset1['history_dtl']; ?>
<br>
<br><br>
<label><b><u>PAST HISTORY :
</u></b></label><?php echo $row_Recordset1['past_history']; ?>
<br><br><br>
<label><b><u>ON EXAMINATION :
</u></b></label><?php echo $row_Recordset1['exam_dt']; ?>
<br><br><br>
<label><b><u>TREATMENT SUMMARY :
</u></b></label><?php echo $row_Recordset1['treat_smr']; ?>
<br><br><br>
<label><b><u>HOSPITAL STAY :
</u></b></label><?php echo $row_Recordset1['hospital_stay']; ?>
<br><br><br>
<label><b><u>CONDITION ON DISCHARGED :</u></b></label><?php echo $row_Recordset1['condi_dis']; ?>
<br><br><br>
<label><b><u>ADVICE ON DISCHARGED :
</u></b></label><?php echo $row_Recordset1['advi_dis']; ?>
<br><br><br>
<label><b><u>DIET :
</u></b></label><?php echo $row_Recordset1['diet']; ?><br><br><br>
<label><b><u>MEDICATIONS :
</u></b></label><?php echo $row_Recordset1['medication']; ?>
<br><br><br>
<label><b><u>DISCHARGE INSTRUCTIONS AND FOLLOW UP :
</u></b></label><?php echo $row_Recordset1['dis_instuct']; ?>
<br><br><br>
<label><b><u>PLAN :
</u></b></label><?php echo $row_Recordset1['plan']; ?>
<br><br><br>
<label><b> DOCTOR'S SIGNATURE :</b></label>-----------------------------
<br><br><br>
<p>I HAVE UNDERSTOOD THE INSTRUCTIONS GIVEN ABOUT THE MEDICATION DOSAGE AND POST-DISCHARGE CARE.
</p>

<p  align="right">  --------------------------------------------<br>
                                                                                            (PATIENT/RELATIVE SIGNATURE)
</p>
<p>IN CASE OF EMERGENCY IF SEVERE PAIN NAUSEA, VOMITING OCCURS CONTACT-  02696-223333
</p>
<p align="center">END OF REPORTS
</p>
</div>
</body>
</html>
