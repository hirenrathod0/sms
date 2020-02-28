<?php require_once('../Connections/cn.php'); ?>
<?php
$pid=$_GET['pid'];
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
echo $query_Recordset1 = sprintf("SELECT * FROM fitness WHERE pid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$ll=$row_Recordset1['pid'];
//$pd=$_GET['pid'];
mysql_select_db($database_cn, $cn);
echo $query_Recordset11= sprintf("SELECT * FROM patient WHERE pid ='$ll' ");
$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);




  /*?>$n= $_GET["pid"]."_".date("Ymd");
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$n.doc");<?php */

echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";



//echo "<table border='1' bordercolor='#000000' width='100%' border='solid'>
//             
//
//
//  <tr>
//    <td><strong> PATIENT NAME</strong>      :".$row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11['lname']."</td>
//	 <td><strong>DATE & TIME</strong>  :".date("d/m/Y h:i:s")."</td>
//  </tr>
//  <tr>
//   	<td> <strong>GENDER</strong>          :".$row_Recordset11['gender']."</td>
//   <td><strong>AGE  </strong>  		   :".$bt."</td>
//  </tr>
//  <tr>
//    <td> <strong>CITY    </strong>       :".$row_Recordset2['city']."</td>
//   <TD>  <strong>REFERED BY</strong>       :".$row_Recordset2['fullname']."</td>
//  </tr>
//</table>";


echo "<table align='center' style='margin-top:200px;'>";
echo "<p align='center'> FITNESS CERTIFICATE</p>";
echo "<tr>";
echo "<td>";

echo "<p>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       This is to certify that ".$row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11['lname']." with Reference No ". $_GET['pid']." aged ".$row_Recordset11['bdate']." years. Residing at ".$row_Recordset11['city']."  was examined by me  on ".$row_Recordset1['sur_dt']."  </p> ";

echo "<br>";
echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          He is Physically as well as mentally fit</p>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<br>";echo "<br>";echo "<br>";echo "<br>";

                        
echo "<br>";
echo "Date : ".date("d/m/Y").""; 
echo "</tr>";
echo "</td>";
echo "</table>";



echo "</div>";
echo "</body>";
echo "</html>";

	
?>
