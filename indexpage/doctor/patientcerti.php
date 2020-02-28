<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
$pid=$_GET['pid'];
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM patient WHERE pid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$bt=$row_Recordset1['bdate'];
session_start();
$query_Recordset2 = sprintf("SELECT * FROM user WHERE uid = ".$_SESSION['MM_DOCTOR']."");
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
header("Content-type: application/vnd.ms-word");
$n=$row_Recordset1['fname']."  ".date("d/m/Y");
header("Content-Disposition: attachment;Filename=$n.doc");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<div style='margin-top:125px;' align='center'>";
echo("<br> ");
echo "<table border='1' bordercolor='#000000' width='100%' >
  <tr>
    <td><strong> PATIENT NAME</strong>      :".$row_Recordset1['fname']." ".$row_Recordset1['mname']." ".$row_Recordset1['lname']."</td>
	 <td><strong>DATE & TIME</strong>  :".date("d/m/Y h:i:s")."</td>
  </tr>
  <tr>
   	<td> <strong>GENDER</strong>          :".$row_Recordset1['gender']."</td>
   <td><strong>AGE  </strong>  		   :".$bt."</td>
  </tr>
  <tr>
    <td> <strong>CITY    </strong>       :".$row_Recordset2['city']."</td>
   <TD>  <strong>REFERED BY</strong>       :".$row_Recordset2['fullname']."</td>
  </tr>
</table>";
echo '</div>';
echo("<p align='left'>  <b> Respected Sir, </b> </p> ");
echo("<br>");
echo("<p align='right'>  <b> Thanking You. </b> </p> ");
echo "</body>";
echo "</html>";
mysql_free_result($Recordset1);
?>