<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_RECEPTION']))
{
header('login.php');
}
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

$bedno=$_GET['bedno'];
$rtype=$_GET['rtype'];
if($rtype=="SEMI-SPECIAL")
{
$rtype="DELUXE";
}
if($rtype=="ICU")
{
$rtype="FEMALE WARD";
}
if($rtype=="ICU1")
{
$rtype="MALE WARD";
}
mysql_select_db($database_cn, $cn);
  $query_getpatient = sprintf("SELECT * FROM patient_admit WHERE rtype ='$rtype' AND bedno='$bedno'");
//exit;
$Recordset1 = mysql_query($query_getpatient, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

        
echo '<table class="table table-responsive table-bordered table-hover">';
echo '<thead></thead>';
do{
	echo '<tr>';
	echo '<td>Name </td>';
	echo '<td>'.$row_Recordset1['fname'].'    '.$row_Recordset1['mname'].'   '.$row_Recordset1['lname'].'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Admited Date </td>';
	echo '<td>'.date('d-m-Y  |  g:i:a',strtotime($row_Recordset1['dofadmit'])).'</td>';
	echo '</tr>';
	}while($row_Recordset1 = mysql_fetch_assoc($Recordset1));
echo '</table>';
    
?>
