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


echo "<p align='center'>CHOVIS GAM SACHCHIDANAND MEDICAL & RESEARCH CENTRE SANCHALIT</p>";
echo "<p style='font-weight:bolder' align='center'>SHRADDHA HOSPITAL</p>";						
echo "<p align='center'>Borsad-Anand Road, At: Vahera, Tal. Borsad, Dist. Anand,</p> ";

echo "<p align='center'>Ph No. 02696 223333</p>";

echo "<table align='center' style='margin-top:100px;'>";

echo "<p align='right'> Date : ".date("d/m/Y")." </p>"; 

echo "<p align='center'><b>UNFIT CERTIFICATE</b></p>";
echo "<tr>";
echo "<td>";

echo "<p>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      This is to certify that ".$row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11['lname']." aged ".$bt." years ".$row_Recordset1['gender']." Residing at: ".$row_Recordset2['city']."  was examined by me on 02/04/12.  </p> ";

echo "<br>";
echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          She was physically  unfit  from 02/04/2012 to 13/04/2012.</p>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<br>";echo "<br>";echo "<br>";echo "<br>";

echo "<p align='right'>Chief   Medical Officer.";
echo "<br>";
echo "C.G.S.M & R CENTER SANCHALIT";
echo "<br>";
echo "SHRADDHA HOSPITAL </p>";                        
echo "<br>";

echo "</tr>";
echo "</td>";
echo "</table>";



echo "</div>";
echo "</body>";
echo "</html>";

	
?>
