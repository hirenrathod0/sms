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

mysql_select_db($database_cn, $cn);
 $query_Recordset199 = "SELECT * FROM follow where pid='".$_GET['pid']."'";

$Recordset199 = mysql_query($query_Recordset199, $cn) or die(mysql_error());
@$row_Recordset199 = mysql_fetch_assoc($Recordset199);
 $totalRows_Recordset199 = mysql_num_rows($Recordset199);

?>

<table class="table table-striped table-bordered table-hover" >
  <tr align="center">
    <td><a href="admit.php?pid=<?php echo $_GET['pid']; ?>" class="btn-warning btn ">Admit</a></td>
    <td><a href="givepre.php?pid=<?php echo  $_GET['pid']; ?>" class=" btn-info btn">Prescription</a></td>
    <td><a href="labreport.php?pid=<?php echo  $_GET['pid']; ?>" class="btn-dark-blue btn">Lab Reports</a></td>
    <td><a href="pexamination-1.php?pid=<?php echo  $_GET['pid']; ?>" class=" btn-danger btn">Examination</a></td>
    <td><a href="dressing.php?pid=<?php echo  $_GET['pid']; ?>" class="btn-success btn ">Dressing</a></td>
    <td><a href="xray.php?pid=<?php echo  $_GET['pid']; ?>" class="btn-warning btn">X-ray</a></td>
    <td><a href="medpatients.php?pid=<?php echo  $_GET['pid']; ?>" class="btn btn-info ">Medication</a></td>
    <td><a href="surgery_dtl.php?pid=<?php echo $_GET['pid']; ?>" class="btn-warning btn"><i class="fa fa-paperclip">Surgery</i></a></td>
    
    
    
    <?php if($totalRows_Recordset199>0){ ?>
    <td><a class="btn-success btn" href="view_history.php?pid=<?php echo $_GET['pid']; ?>" style="height:auto;width:auto"> View History</a></td>
      <td>
	    <?php }?>
    
  </tr>
</table>

