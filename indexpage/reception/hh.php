<?php require_once('../Connections/cn.php'); ?>
<?php



$pid=$_GET['pid'];
$td=$_GET['total_dis'];
$d=$_GET['discount'];
$a=$td+$d;
$q = "INSERT INTO lab_bill (pid,amount,discount) VALUES ('$pid','$a','$d')";

mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($q, $cn) or die(mysql_error());
  
  
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM lab_bill WHERE id = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM patient where pid='$pid'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$q="UPDATE doc_lab_report SET s1='Paid' WHERE pid='$pid'";
mysql_query($q);

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
<script language="javascript" type="text/javascript">
function chk()
{
window.print();
return false;
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
<table  class="body" id="customers" border="1" style="padding:5px;border:solid" cellspacing="-1"  align="center">
  <tr>
    <td  colspan="2"><div style="text-align:center" ><strong>_________ Doct Connect__________</strong></div></td>
  </tr>
  <tr>
    <td >Bill NO:-<?php echo $row_Recordset1['id']; ?></td>
    <td>Date:- <?php echo date('d/m/y',strtotime($row_Recordset1['adate']));?></td>
  </tr>
   
  <?php $total=0; ?>
    <tr style="alignment-adjust:central">
     
      <td> Total Amount </td>
	  
	  <td>   <?php echo $a; ?> </td> 
	  </tr>
	    <tr style="alignment-adjust:central">  
      <td> Advance Paid </td> <td>  <?php  echo $d; ?> </td> 
	  </tr>
	  
	  <tr style="alignment-adjust:central">
	  <td> Remaining Amount  </td> <td> <?php  echo $td; ?> 
	  </td>
    </tr>
    <?php  $total = $d; ?>
  
  <!-- </td>
        </tr>
      </table> -->
  </td>
  
  </tr>
  
  <tr >
    <td colspan="2"> Recived with thanks from <strong>
      <?php echo $row_Recordset2['fname']; ?>
      <?php '  '; echo $row_Recordset2['mname']?>
      <?php '  '; echo $row_Recordset2['lname'] ?>
      </strong> <br/>
      Rs <strong><?php echo $td; ?></strong> The Sum Of Rs <strong><?php echo convert_number_to_words($td); ?></strong> </td>
  </tr>
  <tr>
    <td colspan="2" align="right"><br />
      For Doct Connect </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
