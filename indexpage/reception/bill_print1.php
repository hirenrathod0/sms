<?php require_once('../Connections/cn.php');
$q="UPDATE patient_admit SET s1=1 WHERE  pid=".$_GET['pid'];
mysql_query($q);
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
					   GetSQLValueString($_POST['txtdays']*$_POST['price'], "text"));
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
$date6=strftime('%d-%m-%Y',strtotime($row_Recordset152['tran_date']));
$diff1 = abs(strtotime($date5) - strtotime($date6));
$total_days2 = floor($diff1 /  (60*60*24)) + 1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Patient-Doct Connect</title>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- PAGE LEVEL PLUGIN STYLES -->
<link href="css/plugins/messenger/messenger.css" rel="stylesheet">
<link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
<link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="css/plugins/morris/morris.css" rel="stylesheet">
<link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
<link href="css/plugins/datatables/datatables.css" rel="stylesheet">
<!-- THEME STYLES - Include these on every page. -->
<link href="css/style.css" rel="stylesheet">
<link href="css/plugins.css" rel="stylesheet">
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script language="javascript">
$(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailpatients.php", {recordID:eval(g)}, function (data) {
                    $("#dta").html(data);
                });
	$(_self.attr('href')).modal('show');
});
</script>
<script>
function myFunction(id) {
	//var cc=$("#trttl").val(eval(id));
	//var f=$("#gtt1").val();
	var t=$("#tt5").val();
  var x=eval(t);
$("#tt7").val(x);
	var p=$("#per").val();

var x1=(eval(p)*eval(x))/100;
$("#tt8").val(x1);


var x2=eval(x)+eval(x1);
$("#ft").val(x2)

var ff=$("#ft1").val();
}
</script>
<script>
function myFunction1(id1) {
	var f1=$("#ft").val();
	var t1=$("#ft1").val();
  var x5=eval(f1)-eval(t1);
$("#tt10").val(x5);
}
</script>
<script type="text/javascript" language="javascript">

function n(name,pid)
{
	var string_url = "bill_print.php?name="+name+"&pid="+pid;
	window.location = string_url;
}
</script>
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-title">
        <h1> All Patients </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
          <li class="active"> Manage Patients </li>
        </ol>
      </div>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <?php /*?>
  <?php include('genbillipd.php');?>
  <?php */?>
  <!-- /.row --> 
  <!-- end PAGE TITLE ROW --> 
  <!-- begin MAIN PAGE ROW -->
  <?php /*?> <form method="POST" action="<?php echo $editFormAction; ?>" name="frm1"><?php */?>
  <table width="600" height="302"  >
    <tr>
      <td><div align="center"><strong>SHRADDHA HOSPITAL</strong></div></td>
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
              <td width="252">:<?php echo $pid; ?></td>
              <td width="80"><strong>Date</strong></td>
              <td width="246">:<?php echo date("d/m/Y");?></td>
            </tr>
            <tr>
              <td rowspan="2"><strong>Patient Name</strong></td>
              <td rowspan="2">:<?php echo $row_Recordset11['fname']." ".$row_Recordset11['mname']." ".$row_Recordset11[ 'lname'] ;?>,<?php echo $row_Recordset11['adds'];?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Bill No</strong></td>
              <td>:<?php echo $pid; ?></td>
              <td width="44">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Age/Sex:</strong></td>
              <td>:<?php echo $row_Recordset11['bdate'];?>/<?php echo $row_Recordset11['gender'];?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong>I.P.D No</strong></td>
              <td><?php echo $row_Recordset12['aid']; ?></td>
            </tr>
            <tr>
              <td><strong>D.O.A</strong></td>
              <?php 
       // $uu=strftime('%d-%m-%Y %H:%I:%S',strtotime($row_Recordset15['admit_date']));
	   $uu=strftime('%d-%m-%Y',strtotime($row_Recordset152['dofadmit']));
        ?>
              <td>:<?php echo $uu;?></td>
              <td><strong>D.O.D</strong></td>
              <td>:<?php echo $uu1=strftime('%d-%m-%Y ',strtotime($row_Recordset152['dofdischarge']));?></td>
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
              <td>:
                <?php $pid=$_GET['pid'];
			  mysql_select_db($database_cn, $cn);
 $query_Recordset159= "SELECT * FROM `bed_dtl` where pid='$pid'";

$Recordset159 = mysql_query($query_Recordset159, $cn) or die(mysql_error());
$row_Recordset159 = mysql_fetch_assoc($Recordset159);
$totalRows_Recordset159 = mysql_num_rows($Recordset159);

			  echo $row_Recordset159['rtype'].'-'.$row_Recordset159['bedid'];?></td>
              <td><strong>Days</strong></td>
              <td width="17">:<?php echo $total_days; ?></td>
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
            <td width="163"><strong>Sr No	. </strong></td>
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
        <?php  
	  mysql_select_db($database_cn, $cn);
$query_Recordset99 = "SELECT * FROM `doc_rep` WHERE pid='$pid'";
$Recordset99 = mysql_query($query_Recordset99, $cn) or die(mysql_error());
//$row_Recordset99 = mysql_fetch_assoc($Recordset99);
$totalRows_Recordset99 = mysql_num_rows($Recordset99); 
	$vv=2;$rr=0;  if($totalRows_Recordset99 > 0)
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
    
      <td>
    
    <table width="805">
        <tr>
      
        <td>
      
      <table width="780">
        <tr>
          <td width="260" rowspan="8">&nbsp;</td>
          <td width="399"><div align="right">Total Amount</div></td>
          <td width="105"><div align="right">
              <?php
                mysql_select_db($database_cn, $cn);
$query_Recordset388 = "SELECT * FROM `billhistry1` WHERE pid='$pid'";

$Recordset388 = mysql_query($query_Recordset388, $cn) or die(mysql_error());
$row_Recordset388 = mysql_fetch_assoc($Recordset388);
$totalRows_Recordset388 = mysql_num_rows($Recordset388); 

?>
              <?php  echo $row_Recordset388['tot'];
				   
				   
				   ?>
            </div></td>
        </tr>
        <tr>
          <td height="24"><div align="right">Nuring Charge @ <?php echo $row_Recordset388['per'];?>%&nbsp;</div></td>
          <td><div align="right">
              <?php //echo $tot=round(($total*15)/100); ?>
              <?php echo $row_Recordset388['ntot'];?></div></td>
          </div>
        
          </td>
        
          </tr>
        
        <tr>
          <td height="9" colspan="2"><hr/></td>
        </tr>
        <tr>
          <td><div align="right">Gross Total</div></td>
          <td><div align="right"> <?php echo $row_Recordset388['gtot'];?> </div></td>
        </tr>
        <tr>
          <td><div align="right">Less Deposit </div></td>
          <td><div align="right">
              <?php /*?><?php echo $row_Recordset381['depo_amt'];
						 
						 $ll=$ll+$row_Recordset381['depo_amt'];
						  ?><?php */?>
              <?php echo $row_Recordset388['ld']; ?> </div></td>
        </tr>
        <!--<tr>
                      <td><div align="right">
                          <div align="right">Less Deposit
                            <input type="text" name="dt2" placeholder="Date and rep No">
                          </div>
                        </div></td>
                      <td><div align="right">
                          <input type="text" name="amt2" />
                        </div></td>
                    </tr>-->
        <tr>
          <td colspan="2"><hr/></td>
        </tr>
        <tr>
          <td colspan="3"><hr/></td>
        </tr>
        <tr>
          <td colspan="3"><div align="right" style="padding:10px;margin:10px;border:solid;width:350px;float:right">
              <table width="315" height="28">
                <tr>
                  <td width="177">Net Total Bill Amount</td>
                  <td width="114"><div align="right"><strong> <?php echo $row_Recordset388['nt']; ?> </strong></div></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td colspan="3"><table width="782">
              <tr>
                <td width="508"><strong>USER NAME : <?php echo $row_Recordset388['um']; ?> </strong></td>
              </tr>
            </table></td>
        </tr>
      </table>
        </td>
      
        </tr>
      
    </table>
      </td>
    
      </tr>
    
  </table >
  </form>
</div>
</div>
</div>
<!-- Button to trigger modal --> 
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script> 
<script src="js/plugins/bootstrap/bootstrap.min.js"></script> 
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script> 
<script src="js/plugins/popupoverlay/defaults.js"></script> 
<script src="js/plugins/popupoverlay/logout.js"></script> 
<!-- HISRC Retina Images --> 
<script src="js/plugins/hisrc/hisrc.js"></script> 
<!-- PAGE LEVEL PLUGIN SCRIPTS --> 
<!-- HubSpot Messenger --> 
<script src="js/plugins/messenger/messenger.min.js"></script> 
<script src="js/plugins/messenger/messenger-theme-flat.js"></script> 
<!-- Date Range Picker --> 
<script src="js/plugins/daterangepicker/moment.js"></script> 
<script src="js/plugins/daterangepicker/daterangepicker.js"></script> 
<!-- Morris Charts --> 
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script> 
<script src="js/plugins/morris/morris.js"></script> 
<!-- Flot Charts --> 
<script src="js/plugins/flot/jquery.flot.js"></script> 
<script src="js/plugins/flot/jquery.flot.resize.js"></script> 
<!-- Sparkline Charts --> 
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script> 
<!-- Moment.js --> 
<script src="js/plugins/moment/moment.min.js"></script> 
<!-- jQuery Vector Map --> 
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> 
<script src="js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script> 
<script src="js/demo/map-demo-data.js"></script> 
<!-- Easy Pie Chart --> 
<script src="js/plugins/easypiechart/jquery.easypiechart.min.js"></script> 
<!-- DataTables --> 
<script src="js/plugins/datatables/jquery.dataTables.js"></script> 
<script src="js/plugins/datatables/datatables-bs3.js"></script> 
<!-- THEME SCRIPTS --> 
<script src="js/flex.js"></script> 
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
