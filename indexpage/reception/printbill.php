<?php require_once('../Connections/cn.php'); ?>
<?php

//header("location:index.php");

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

$maxRows_bill = 10;
$pageNum_bill = 0;
if (isset($_GET['pageNum_bill'])) {
  $pageNum_bill = $_GET['pageNum_bill'];
}
$startRow_bill = $pageNum_bill * $maxRows_bill;

$colname_bill = "-1";
if (isset($_GET['bid'])) {
  $colname_bill = $_GET['bid'];	
}
mysql_select_db($database_cn, $cn);
$query_bill = sprintf("SELECT * FROM billhistry WHERE bid = %s ", GetSQLValueString($colname_bill, "int"));
$query_limit_bill = sprintf("%s LIMIT %d, %d", $query_bill, $startRow_bill, $maxRows_bill);
$bill = mysql_query($query_limit_bill, $cn) or die(mysql_error());
$row_bill = mysql_fetch_assoc($bill);

if (isset($_GET['totalRows_bill'])) {
  $totalRows_bill = $_GET['totalRows_bill'];
} else {
  $all_bill = mysql_query($query_bill);
  $totalRows_bill = mysql_num_rows($all_bill);
}
$totalPages_bill = ceil($totalRows_bill/$maxRows_bill)-1;

$colname_patient = "-1";

  $colname_patient = $row_bill['pid'];

mysql_select_db($database_cn, $cn);
$query_patient = sprintf("SELECT * FROM patient WHERE pid = %s", GetSQLValueString($colname_patient, "int"));
$patient = mysql_query($query_patient, $cn) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);
$totalRows_patient = mysql_num_rows($patient);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Export Sample</title>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/tableExport.js"></script>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/jquery.base64.js"></script>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/html2canvas.js"></script>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/jspdf/jspdf.js"></script>
<script type="text/javascript" src="kayalshri-tableExport.jquery.plugin-a891806/jspdf/libs/base64.js"></script>
<script type="text/javascript">
function export_name()

{
	
    $('#customers').tableExport({type:'pdf',escape:'false'});
}

/*$(document).ready(function(e) {
  
   export_name();
  
});*/
</script>
<style type="text/css">

.body{
		padding:15px;
	}
 
</style>





<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
		var printButton1= document.getElementById("pp");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
		 printButton1.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
		 printButton1.style.visibility = 'visible';
    }
	 function pp1() {
        //Get the print button and put it into a variable
        var pn = document.getElementById("pp");
        //Set the print button visibility to 'hidden' 
        
        //Print the page content
       window.location="showadmitp1.php";
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        pn.style.visibility = 'visible';
    }
</script>
</head>
<body onload="chk(this.value);" style="max-height:450px;max-width:450px;" >
<?php 

function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'ZERO',
        1                   => 'ONE',
        2                   => 'TWO',
        3                   => 'THREE',
        4                   => 'FOUR',
        5                   => 'FIVE',
        6                   => 'SIX',
        7                   => 'SEVEN',
        8                   => 'EIGHT',
        9                   => 'NINE',
        10                  => 'TEN',
        11                  => 'ELEVEN',
        12                  => 'TWELVE',
        13                  => 'THIRTEEN',
        14                  => 'FOURTEEN',
        15                  => 'FIFTEEN',
        16                  => 'SIXTEEN',
        17                  => 'SEVENTEEN',
        18                  => 'EIGHTTEEN',
        19                  => 'NINETEEN',
        20                  => 'TWENTY',
        30                  => 'THIRTY',
        40                  => 'FOURTY',
        50                  => 'FIFTY',
        60                  => 'SIXTY',
        70                  => 'SEVENTY',
        80                  => 'EIGHTY',
        90                  => 'NINETY',
        100                 => 'HUNDRED',
        1000                => 'THOUSAND',
        1000000             => 'MILLION',
        1000000000          => 'BILLION',
        1000000000000       => 'TRILLION',
        1000000000000000    => 'QUADRILLION',
        1000000000000000000 => 'QUINTILLION'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

 

?>

<?php
	header("location:bill_print.php?pid=".$_GET['pid']);

?>

</body>
</html>

