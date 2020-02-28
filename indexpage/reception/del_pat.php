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

if ((isset($_GET['pid'])) && ($_GET['pid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM patient WHERE pid=%s",
                       GetSQLValueString($_GET['pid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());
  
  $deleteSQL2 = sprintf("DELETE FROM booking WHERE pid=%s",
                       GetSQLValueString($_GET['pid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result2 = mysql_query($deleteSQL2, $cn) or die(mysql_error());
  
  
  $deleteSQL3 = sprintf("DELETE FROM patient_admit WHERE pid=%s",
                       GetSQLValueString($_GET['pid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result3 = mysql_query($deleteSQL3, $cn) or die(mysql_error());
  
  
  

  $deleteGoTo = "allpatients.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
