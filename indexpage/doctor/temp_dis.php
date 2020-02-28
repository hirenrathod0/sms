<?php require_once('../Connections/cn.php'); ?>
<?php
$pid=$_GET['pid'];
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM discharge_card WHERE id = %s", $colname_Recordset1);
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
<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<body>
<table  class="body" id="customers" border="1" align="center" style="border:solid;" width="100%">
  
  <tr>
   
    <td colspan="3" ><div style="text-align:center;font-size:32px;" ><b >  HOSPITAL</b></div>
      
  </tr>
</table>
<table id="customers" border="1" align="center"  width="100%"  style="border:none">
  <tr style="border:none">
    <td colspan="2">IPD No.</td>
    <td align="center" style="border:none;font-size:20px;"><b><u>DISCHARGE CARD</b></u></td>
    <td>OPD No.&nbsp;&nbsp;&nbsp;<?php echo $row_Recordset11['pid']; ?></td>
  </tr>
</table>
<p align="right"> Date : <?php echo date("d/m/Y");?></p>
<table align='center' style="border:none;" width="100%">
  <tr style="font-size:18px;font-family:'Times New Roman', Times, serif;">
    <td> Patient's Name: <?php echo $row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11[ 'lname'] ;?> <br>
      Age: <?php echo $row_Recordset11['bdate'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Sex: <?php echo $row_Recordset11['gender'];?> <br>
      Address:<?php echo $row_Recordset11['adds'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Contact No:<?php echo $row_Recordset11['contactno1'];?> <br>
      DOA&nbsp;&nbsp;<?php echo $row_Recordset11['dtofadd']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      DOO&nbsp;&nbsp;<?php echo $row_Recordset1['date']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      DOO&nbsp;&nbsp;<?php echo $row_Recordset1['otdate']; ?> <br>
      Symptoms:<?php echo $row_Recordset1['symptoms']; ?> Signs.<?php echo $row_Recordset1['observation']; ?> <br>
      <b>Investigations:</b> <br>
      <b>Blood:</b><?php echo $row_Recordset1['blood']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Urine:</b><?php echo $row_Recordset1['urine']; ?> <br>
      <b>Stool:</b><?php echo $row_Recordset1['stool']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Specific Investigations:</b><?php echo $row_Recordset1['spec_invest']; ?> <br>
      <b> Biopsy:</b> <?php echo $row_Recordset1['biopsy']; ?> <br>
      <b>Opertion</b> <?php echo $row_Recordset1['operation']; ?> <br>
      <b>Anesthesia:</b><?php echo $row_Recordset1['anesthesia']; ?> <br>
      <b>Provisional Diagnosis:</b><?php echo $row_Recordset1['pro_diag']; ?> <br>
      <b>Final Diagnosis:</b><?php echo $row_Recordset1['final_diag']; ?> <br>
      <b>Treatment Given:</b><?php echo $row_Recordset1['treat_given']; ?> <br>
      <b>Treatrment Advised:</b><?php echo $row_Recordset1['treat_adv']; ?> <br>
      <b>Advised For Follow Up After <?php echo $row_Recordset1['adv_af_day']; ?> Days.</b></td>
  </tr>
  <tr>
    <td><br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <img src="../images/1.png" >_____________ <br>
      <img src="../images/JH.png">
      <p align="right"> Chief Medical Officer </p>
  </tr>
    </td>
  
</table>
</div>
</body>
</html>
