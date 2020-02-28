<?php require_once('../Connections/cn.php'); ?>
<?php 
session_start();
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

//$editFormAction = $_SERVER['PHP_SELF'];
//if (isset($_SERVER['QUERY_STRING'])) {
  //$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
//}


	$insertSQL = sprintf("INSERT INTO doc_lab_report (pid,sel_rep_name,docid) VALUES (%s,%s,%s)",
                       GetSQLValueString($_GET['pid'], "int"),
					   GetSQLValueString($_GET['repName'], "text"),
					   GetSQLValueString($_SESSION["MM_DOCTOR"], "int"));

  	mysql_select_db($database_cn, $cn);
  	$Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
	$insertGoTo = "labreport.php?pid=".$_GET['pid'];
   	header(sprintf("Location: %s", $insertGoTo));
  

?>

