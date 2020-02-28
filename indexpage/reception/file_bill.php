<?php require_once('../Connections/cn.php'); 
$q="UPDATE billhistry SET status='DONE' WHERE pid=".$_GET['pid'];
mysql_query($q);
$pid=$_GET['pid'];

$tot=$_GET['tt7'];
$per=$_GET['per'];
$ntot=$_GET['tt8'];
$gtot=$_GET['ft'];
$ld=$_GET['ft1'];
$nt=$_GET['tt10'];
$um=$_GET['user_nm'];

$oo="INSERT INTO `billhistry1`(pid,tot,per,ntot,gtot,ld,nt,um) VALUES ('$pid','$tot','$per','$ntot','$gtot','$ld','$nt','$um')";
if(mysql_query($oo))
{

//echo '<meta http-equiv="refresh" content="0; url=file_bill.php">';
//exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 $pid=$_GET['pid'];
 $dt=date('d-m-Y');
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm1")) {
  $insertSQL = sprintf("INSERT INTO final_bill (pid, unm, dt) VALUES ('$pid',%s, '$dt')",
                       
                       GetSQLValueString($_POST['user_nm'], "text")
                      );

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "file_bill.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
 $query_Recordset1 = sprintf("SELECT * FROM bed_dtl WHERE id = %s", $colname_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$pp=$row_Recordset1['pid'];
//$pp=$_GET['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset11= "SELECT * FROM patient WHERE pid ='$pid'";

$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);

$jj=$row_Recordset11['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset12= "SELECT * FROM patient_admit WHERE pid ='$jj'";
$Recordset12 = mysql_query($query_Recordset12, $cn) or die(mysql_error());
$row_Recordset12 = mysql_fetch_assoc($Recordset12);
$totalRows_Recordset12 = mysql_num_rows($Recordset12);



//$zz=$_GET['pid'];
mysql_select_db($database_cn, $cn);
 $query_Recordset152= "SELECT * FROM patient_admit WHERE pid ='$pid'";

$Recordset152 = mysql_query($query_Recordset152, $cn) or die(mysql_error());
$row_Recordset152 = mysql_fetch_assoc($Recordset152);
$totalRows_Recordset152 = mysql_num_rows($Recordset152);

 $date1=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofadmit']));
  $date2=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofdischarge']));
 $diff = abs(strtotime($date1) - strtotime($date2));
  $total_days = floor($diff /  (60*60*24)) + 1;


  $date5=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofdischarge']));

  $date6=strftime('%d-%m-%Y',strtotime($row_Recordset152['tran_date']));
  $diff1 = abs(strtotime($date5) - strtotime($date6));
   $total_days2 = floor($diff1 /  (60*60*24)) + 1;
  /*?>$n= $_GET["pid"]."_".date("Ymd");
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$n.doc");<?php */
?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "ins")) {$tt='IPD';
  $insertSQL = sprintf("INSERT INTO bill(total,pid,type,status) VALUES (%s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['total'], ""),
					   GetSQLValueString($_POST['pid'], "int"),
					   GetSQLValueString($tt,"text" ),
					   GetSQLValueString("PENDING", "text")
                      );
//exit;
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $P=$_GET['pid'];
  $insertGoTo = "instbill.php?pid=".$P;
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm")) {
	$t=$_POST['price'];
 $insertSQL = sprintf("INSERT INTO tempbill (name, price,pid,numofd,total) VALUES (%s,%s,%s,%s,%s)",
                       GetSQLValueString($_GET['name'], "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($_POST['txtdays'], "text"),
					   GetSQLValueString($_POST['txtdays']*$_POST['price'], "text"));


  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm2")) {
	$t=$_POST['price'];
    $insertSQL = sprintf("INSERT INTO tempbill (name,price,pid,numofd,total) VALUES (%s,%s,%s,%s,%s)",
                       GetSQLValueString($_GET['name'], "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($_POST['txtdays'], "text"),
					   GetSQLValueString($_POST['txtdays']*$_POST['price'], "text")
					 );
//exit;
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
}

mysql_select_db($database_cn, $cn);
$p=$_GET['pid'];

$query_Recordset1 = "SELECT * FROM tempbill where pid='$p' ";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_fee = "SELECT * FROM fee";
$fee = mysql_query($query_fee, $cn) or die(mysql_error());
$row_fee = mysql_fetch_assoc($fee);
$totalRows_fee = mysql_num_rows($fee);

$colname_price = "-1";
if (isset($_GET['name'])) 
{
  $c = $_GET['name'];


mysql_select_db($database_cn, $cn);
$query_price = sprintf("SELECT * FROM fee WHERE name ='$c' ");
$price = mysql_query($query_price, $cn) or die(mysql_error());
$row_price = mysql_fetch_assoc($price);
$totalRows_price = mysql_num_rows($price);
}

mysql_select_db($database_cn, $cn);
$query_fee1 = "SELECT * FROM ipd_chg";
$fee1 = mysql_query($query_fee1, $cn) or die(mysql_error());
$row_fee1 = mysql_fetch_assoc($fee1);
$totalRows_fee1 = mysql_num_rows($fee1);


mysql_select_db($database_cn, $cn);
$query_Recordset3 = "SELECT * FROM patient_admit where pid='$p'";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);



$colname_price1 = "-1";	
if (isset($_GET['name'])) 
{
  $c1 = $_GET['name'];


mysql_select_db($database_cn, $cn);
$query_price1 = sprintf("SELECT * FROM ipd_chg WHERE name ='$c1' ");
$price1 = mysql_query($query_price1, $cn) or die(mysql_error());
$row_price1 = mysql_fetch_assoc($price1);
$totalRows_price1 = mysql_num_rows($price1);
}
 mysql_select_db($database_cn, $cn);
  $query_Recordset152= "SELECT chg,dofadmit,dofdischarge,tran_date FROM patient_admit WHERE pid ='$pid'";

$Recordset152 = mysql_query($query_Recordset152, $cn) or die(mysql_error());
$row_Recordset152 = mysql_fetch_assoc($Recordset152);
$totalRows_Recordset152 = mysql_num_rows($Recordset152);

  $date5=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofdischarge']));
//$n=date('Y-m-d');
  $date6=strftime('%d-%m-%Y',strtotime($row_Recordset152['tran_date']));
  $diff1 = abs(strtotime($date5) - strtotime($date6));
   $total_days2 = floor($diff1 /  (60*60*24)) + 1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
.body {
	padding: 15px;
}
</style>
<script language="javascript" type="text/javascript">
function chk()
{
window.print();
return false;
}
</script>
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
        window.location="showadmitp1.php";
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        pn.style.visibility = 'visible';
    }
</script>
</head>
<body onload="chk(this.value);" style="max-height:550px;max-width:1150px;">
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
<form>
  <table width="600" height="302" >
    <tr>
      <td><div align="center"><strong>HOSPITAL</strong></div></td>
    </tr>
    <tr>
      <td><hr/></td>
    </tr>
    <tr>
      <td height="227"><div style="margin:-10px 10px -10px 10px">
          <table width="795" height="223" >
            <tr>
              <td colspan="4"><div align="center"><strong>Bill Detail Sheet</strong>:</div></td>
            </tr>
            <tr>
              <td width="128"><strong>OPD No</strong></td>
              <td width="252">: <?php echo $pid; ?></td>
              <td width="80"><strong>Date</strong></td>
              <td width="246">: <?php echo date("d/m/Y");?></td>
            </tr>
            <tr>
              <td rowspan="2"><strong>Patient Name</strong></td>
              <td rowspan="2">: <?php echo $row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11[ 'lname'] ;?>, <?php echo $row_Recordset11['adds'];?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Bill No</strong></td>
              <td>: <?php echo $pid; ?></td>
              <td width="44">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Age/Sex:</strong></td>
              <td>: <?php echo $row_Recordset11['bdate'];?> /<?php echo $row_Recordset11['gender'];?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong>I.P.D No </strong></td>
              <td> : <?php echo $row_Recordset12['aid']; ?></td>
            </tr>
            <tr>
              <td><strong>D.O.A</strong></td>
              <?php 
        $uu=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofadmit']));
        ?>
              <td>: <?php echo $uu;?></td>
              <td><strong>D.O.D</strong></td>
              <td>: <?php echo $uu=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofdischarge']));?></td>
            </tr>
            <tr>
              <td height="21"><strong>Consultant Dr.</strong></td>
              <td>:
                <?php
			$ff=$row_Recordset12['drname'];
			mysql_select_db($database_cn, $cn);
 $query_Recordset151= "SELECT * FROM user WHERE uid ='$ff'";

$Recordset151 = mysql_query($query_Recordset151, $cn) or die(mysql_error());
$row_Recordset151 = mysql_fetch_assoc($Recordset151);
$totalRows_Recordset151 = mysql_num_rows($Recordset151);

			echo $row_Recordset151['fullname'];
			 ?></td>
              <td><strong>Bed No.</strong></td>
              <td>: <?php 
			  $pid=$_GET['pid'];
			  mysql_select_db($database_cn, $cn);
 $query_Recordset159= "SELECT * FROM `bed_dtl` where pid='$pid'";

$Recordset159 = mysql_query($query_Recordset159, $cn) or die(mysql_error());
$row_Recordset159 = mysql_fetch_assoc($Recordset159);
$totalRows_Recordset159 = mysql_num_rows($Recordset159);

			  echo $row_Recordset159['rtype'].'-'.$row_Recordset159['bedid'];?></td>
              <td><strong>Days</strong></td>
              <td width="17">: <?php echo $total_days; ?></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr>
      <td><hr/></td>
    </tr>
    <tr>
      <td><table width="835" height="32">
          <tr>
            <td width="163"><strong>Sr No.</strong></td>
            <td width="272"><strong>Charges Name</strong></td>
            <td width="245"><strong>Procedure Doctor</strong></td>
            <td width="135"><strong>Amount</strong></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><hr/></td>
    </tr>
    
      <td><table width="850">
          <?php  
mysql_select_db($database_cn, $cn);
$query_Recordset33 = "SELECT * FROM `billhistry` WHERE pid='$pid' and name='Ward'";
$Recordset33 = mysql_query($query_Recordset33, $cn) or die(mysql_error());
$row_Recordset33 = mysql_fetch_assoc($Recordset33);
$totalRows_Recordset33 = mysql_num_rows($Recordset33);
?>
          <tr>
            <td width="29"><?php $tt=1;$tt1=0; do{ 
 $tt1=$tt1+$row_Recordset33['price']; }while($row_Recordset33 = mysql_fetch_assoc($Recordset33)); echo $tt;?></td>
            <td width="138"></td>
            <td width="263"><?php echo "WARD CHARGES -".$row_Recordset159['rtype'];
		$mm=$row_Recordset159['rtype'];	
			
			?></td>
            <td width="262">&nbsp;</td>
           <td width="134"><?php
	if($row_Recordset152['tran_date']!='')
	{		  
			   
	 $qq=mysql_query("SELECT * FROM `ipd_chg` where name like '%$mm%'");
	 $qq1=mysql_fetch_assoc($qq);
	 
	$tt7=$row_Recordset152['chg'];
	$qr=($total_days2 * $qq1['price'] )+ $tt7  ;
	
	echo $qr;
	}else
	{
		$qq=mysql_query("SELECT * FROM `ipd_chg` where name like '%$mm%'");
	 $qq1=mysql_fetch_assoc($qq);
	 
	//$tt7=$row_Recordset152['chg'];
	$qr=($total_days * $qq1['price'] )  ;
	
	echo $qr;
	}
	
	 		  ?></td>
          </tr>
        </table>
        <table width="850">
          <tr>
            <td width="30"><?php echo 2; ?></td>
            <td width="136"></td>
            <td width="265"><?php echo "DOCTOR CHARGES"?></td>
            <td width="267">&nbsp;</td>
            <td width="128"><?php 
	 $qq5=mysql_query("SELECT * FROM `ipd_chg` where name='Doctor'");
	 $qq11=mysql_fetch_assoc($qq5);
	$qr1=$qq11['price']*$total_days;
	 echo $qr1;
	 		  ?></td>
          </tr>
        </table>
        <?php  
	  mysql_select_db($database_cn, $cn);
$query_Recordset99 = "SELECT * FROM `doc_rep` WHERE pid='$pid'";
$Recordset99 = mysql_query($query_Recordset99, $cn) or die(mysql_error());
//$row_Recordset99 = mysql_fetch_assoc($Recordset99);
$totalRows_Recordset99 = mysql_num_rows($Recordset99); 
	$vv=3;$rr=0;  if($totalRows_Recordset99 > 0)
	  {
	  
	  ?>
        <table width="850">
          <tr>
            <?php  while($row_Recordset99 = mysql_fetch_assoc($Recordset99)){	?>
            <td width="167"><?php echo $vv;?></td>
            <td width="315">VISITING DOCTOR CHARGE</td>
            <td width="220"><?php echo $row_Recordset99['dnm']; ?></td>
            <td width="128"><?php echo $row_Recordset99['chg']; ?></td>
            <?php 
		$rr=$rr+$row_Recordset99['chg'];
		
		$vv++; } ?>
          </tr>
        </table>
        <?php }?>
        <table width="850">
          <tr>
            <td colspan="4"></td>
          </tr>
          <?php $r_c=$vv;  $zz=0;
$qq=mysql_query("SELECT * FROM `billhistry` WHERE pid='".$_GET['pid']."' and name!='Ward' and name!='NURSE' group by ttl order by ttl desc limit 0,1");
//$qq1=mysql_fetch_assoc($qq);
@$kk=$$qq1['ttl'];			
			
mysql_select_db($database_cn, $cn);
 $query_Recordset36 = "SELECT * FROM `billhistry` WHERE pid='$pid' and name!='Ward' and name!='NURSE' and ttl='$kk'";
//exit;
$Recordset36 = mysql_query($query_Recordset36, $cn) or die(mysql_error());
$row_Recordset36 = mysql_fetch_assoc($Recordset36);
$totalRows_Recordset36 = mysql_num_rows($Recordset36); 
		  ?>
          <?php  while($row_Recordset36 = mysql_fetch_assoc($Recordset36)){?>
          <tr>
            <td width="169"><?php echo $r_c ?></td>
            <td width="264"><?php echo $row_Recordset36['name']; ?></td>
            <td width="270">&nbsp;</td>
            <td width="127"><?php echo $row_Recordset36['total'];
		      $zz=$zz+$row_Recordset36['total'];
		   ?></td>
            <?php $r_c++; }?>
          </tr>
        </table>
        <table width="850">
          <?php 
		 
mysql_select_db($database_cn, $cn);
$query_Recordset34 = "SELECT * FROM `doc_lab_report` WHERE pid='$pid' and s1='Pedding'";
$Recordset34 = mysql_query($query_Recordset34, $cn) or die(mysql_error());
//$row_Recordset34 = mysql_fetch_assoc($Recordset34);
$totalRows_Recordset34 = mysql_num_rows($Recordset34); 
		  ?>
          <tr>
            <?php  $l_c1=$r_c;$yy5=0; while($row_Recordset34 = mysql_fetch_assoc($Recordset34)){?>
          <tr>
            <td width="170"><?php echo $l_c1; ?></td>
            <td width="264"><?php echo $row_Recordset34['sel_rep_name']; ?></td>
            <td width="269">&nbsp;</td>
            <td width="127"><?php 
		  $ii=$row_Recordset34['sel_rep_name'];
		    mysql_select_db($database_cn, $cn);
 $query_Recordset35 = "SELECT * FROM `rep_cat` WHERE name='$ii'";
$Recordset35 = mysql_query($query_Recordset35, $cn) or die(mysql_error());
$row_Recordset35 = mysql_fetch_assoc($Recordset35);
$totalRows_Recordset35 = mysql_num_rows($Recordset35); 
		  
		  echo $row_Recordset35['price'];
		  $yy5=$yy5+$row_Recordset35['price'];  ?></td>
            <?php  $l_c1++;}?>
          </tr>
        </table>
        <table width="850">
          <?php 
mysql_select_db($database_cn, $cn);
$query_Recordset36 = "SELECT * FROM `xray_dtl` WHERE pid='$pid'and s1='Pedding'";
$Recordset36 = mysql_query($query_Recordset36, $cn) or die(mysql_error());
//$row_Recordset36 = mysql_fetch_assoc($Recordset36);
$totalRows_Recordset36 = mysql_num_rows($Recordset36); 
		  ?>
          <tr>
            <?php $r_c1=$l_c1; $zz5=0; while($row_Recordset36 = mysql_fetch_assoc($Recordset36)){?>
          <tr>
            <td width="170"><?php echo $r_c1; ?></td>
            <td width="266"><?php echo $row_Recordset36['xname']; ?></td>
            <td width="267">&nbsp;</td>
            <td width="127"><?php
		  $ii1=$row_Recordset36['xname'];
		    mysql_select_db($database_cn, $cn);
 $query_Recordset37 = "SELECT * FROM `rep_cat_xray` WHERE name='$ii1'";
$Recordset37 = mysql_query($query_Recordset37, $cn) or die(mysql_error());
$row_Recordset37 = mysql_fetch_assoc($Recordset37);
$totalRows_Recordset37 = mysql_num_rows($Recordset37); 
		  
		  echo $row_Recordset37['price'];
		  $zz5=$zz5+$row_Recordset37['price'];
		   ?></td>
            <?php $r_c1++; }?>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><hr/></td>
    </tr>
    <tr>
      <td><table width="805">
          <tr>
            <td><table width="780">
                <tr>
                  <td width="260" rowspan="8">&nbsp;</td>
                  <td width="399"><div align="right">Total Amount</div></td>
                  <td width="105"><div align="right"><?php echo $_GET['tt7']; ?> </div></td>
                </tr>
                <tr>
                  <td height="24"><div align="right">Nuring Charge @ <?php echo $_GET['per'] ?>%</div></td>
                  <td><div align="right"><?php echo $_GET['tt8'] ?></div></td>
                </tr>
                <tr>
                  <td height="9" colspan="2"><hr/></td>
                </tr>
                <tr>
                  <td><div align="right">Gross Total</div></td>
                  <td><div align="right"><?php echo $_GET['ft']; ?></div></td>
                </tr>
                <tr>
                  <td><div align="right">Less Deposit </div></td>
                  <td><div align="right"> <?php echo $_GET['ft1']; ?> </div></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><hr/></td>
                </tr>
                <tr>
                  <td colspan="3"><div align="right" style="padding:10px;margin:10px;border:solid;width:350px;float:right">
                      <table width="315" height="28">
                        <tr>
                          <td width="177">Net Total Bill Amoint</td>
                          <td width="114"><div align="right"><strong><?php echo $_GET['tt10']; ?> </strong></div></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
                <tr>
                  <td colspan="3"><table width="782">
                      <tr>
                        <?php 
                          mysql_select_db($database_cn, $cn);
$query_Recordset81 = "SELECT * FROM `final_bill` WHERE pid='$pid'";
$Recordset81 = mysql_query($query_Recordset81, $cn) or die(mysql_error());
$row_Recordset81 = mysql_fetch_assoc($Recordset81);
$totalRows_Recordset81 = mysql_num_rows($Recordset81); ?>
                        <td width="508"><strong>USER NAME : <?php echo $_GET['user_nm']; ?> </strong></td>
                        <td width="262"><div align="right"><strong>For HOSPITAL</strong></div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="right"><strong>(Authorised Signatory)</strong></div></td>
                      </tr>
                      <tr> </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
</body>
</html>
