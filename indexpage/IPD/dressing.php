<?php require_once('../Connections/cn.php'); ?>
<?php
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
$u=$_GET['pid'];

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "f1")) {
	if(isset($_GET["pmid"]) && $_GET["pmid"] !="") { 
	$qty = ($_POST['dosageM'] + $_POST['dosageA'] +$_POST['dosageE'] +$_POST['dosageN']) * $_GET['nn'];
  $insertSQL = sprintf("UPDATE patient_medicine as pm,medicine SET pm.strength= '".$_POST['strength']."',pm.dosageM =".$_POST['dosageM'].",pm.dosageA =".$_POST['dosageA'].",pm.dosageE = ".$_POST['dosageE'].",pm.dosageN =".$_POST['dosageN'].",pm.dosage='".$_POST['dosage']."',pm.qty=".$qty.", medicine.strength='".$_POST['strength']."',medicine.dosage='".$_POST['dosage']."' WHERE pm.pmid=".$_GET["pmid"]." AND medicine.mid=".$_GET["id"]);
	}else {
  $qty = ($_POST['dosageM'] + $_POST['dosageA'] +$_POST['dosageE'] +$_POST['dosageN']) * $_GET['nn'];
  $insertSQL = sprintf("INSERT INTO patient_medicine (mid, strength, dosageM, dosageA, dosageE, dosageN, dosage,pid,qty) VALUES (%s, %s, %s, %s, %s, %s, %s,%s,%s)",
                       GetSQLValueString($_POST['medicine'], "int"),
                       GetSQLValueString($_POST['strength'], "text"),
                       GetSQLValueString($_POST['dosageM'], "int"),
                       GetSQLValueString($_POST['dosageA'], "int"),
                       GetSQLValueString($_POST['dosageE'], "int"),
                       GetSQLValueString($_POST['dosageN'], "int"),
                       GetSQLValueString($_POST['dosage'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($qty, "text")
					   					   
					   );
	
  
	}
	mysql_select_db($database_cn, $cn);
  	$Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
  	$insertGoTo = "givepre.php?pid=".$u."&nd=".$_GET['nn'];
 
  header(sprintf("Location: %s", $insertGoTo));
}

if(!isset($_SESSION['MM_Username']))
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
if(isset($_POST['add_days']))
{
$pp=$_POST['remark'];
$rr=$_GET['pid'];
 $qp="INSERT INTO dressing(pid, remarks) VALUES ('$rr','$pp')";
 
 if(mysql_query($qp))
 {
 header('location:allpatients.php');
 }
}

$maxRows_patient = 10;
$pageNum_patient = 0;
if (isset($_GET['pageNum_patient'])) {
  $pageNum_patient = $_GET['pageNum_patient'];
}
$startRow_patient = $pageNum_patient * $maxRows_patient;

$colname_patient = "-1";
if (isset($_GET['pid'])) {
  $colname_patient = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_patient = sprintf("SELECT * FROM patient WHERE pid = %s", GetSQLValueString($colname_patient, "int"));
$query_limit_patient = sprintf("%s LIMIT %d, %d", $query_patient, $startRow_patient, $maxRows_patient);
$patient = mysql_query($query_limit_patient, $cn) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);

if (isset($_GET['totalRows_patient'])) {
  $totalRows_patient = $_GET['totalRows_patient'];
} else {
  $all_patient = mysql_query($query_patient);
  $totalRows_patient = mysql_num_rows($all_patient);
}
$totalPages_patient = ceil($totalRows_patient/$maxRows_patient)-1;

mysql_select_db($database_cn, $cn);
$query_getkist = "SELECT * FROM medicine";
$getkist = mysql_query($query_getkist, $cn) or die(mysql_error());
$row_getkist = mysql_fetch_assoc($getkist);
$totalRows_getkist = mysql_num_rows($getkist);

mysql_select_db($database_cn, $cn);
$query_des = "SELECT * FROM dressing where pid=".$_GET['pid'];
$des = mysql_query($query_des, $cn) or die(mysql_error());
$row_des = mysql_fetch_assoc($des);
$totalRows_des = mysql_num_rows($des);

$colname_getmlist = "-1";
if (isset($_GET['id'])) {
  $colname_getmlist =  $_GET['id'] ;
}
mysql_select_db($database_cn, $cn);
if(isset($_GET["pmid"]) && $_GET["pmid"]!= "") {
$query_getmlist =sprintf( "SELECT pm.*,medicine.*,medicinetype.name as mtype FROM patient_medicine as pm JOIN medicine ON medicine.mid=pm.mid JOIN medicinetype ON medicinetype.mtid=medicine.mtid WHERE pm.pmid=".$_GET["pmid"]);

}

else {
$query_getmlist = "SELECT medicine.mid, medicine.mtid, medicine.name, medicine.strength, medicine.dosage, medicine.manufcuturer, medicine.genericname, medicine.extra, medicine.remarks, medicinetype.name as mtype FROM medicine JOIN medicinetype ON medicine.mtid=medicinetype.mtid where medicine.mid='$colname_getmlist'";
}
$getmlist = mysql_query($query_getmlist, $cn) or die(mysql_error());
$row_getmlist = mysql_fetch_assoc($getmlist);
$totalRows_getmlist = mysql_num_rows($getmlist);

$colname_getmedicine = "-1";
if (isset($_GET['pid'])) {
  $colname_getmedicine =  $_GET['pid'] ;
}
$d=date('Y-m-d');
mysql_select_db($database_cn, $cn);

$query_getmedicine = sprintf("SELECT  medicine.mid,medicine.name,patient_medicine.pmid,patient_medicine.strength, patient_medicine.dosage,patient_medicine.dosageM,patient_medicine.dosageA,patient_medicine.dosageE,patient_medicine.dosageN,patient_medicine.qty,patient_medicine.dateofpm,patient_medicine.pmid,patient_medicine.mid from medicine INNER JOIN patient_medicine ON medicine.mid=patient_medicine.mid where patient_medicine.pid='$colname_getmedicine' AND date(patient_medicine.dateofpm)='$d'");

$getmedicine = mysql_query($query_getmedicine, $cn) or die(mysql_error());
$row_getmedicine = mysql_fetch_assoc($getmedicine);
$totalRows_getmedicine = mysql_num_rows($getmedicine);

$query = "SELECT mid FROM patient_medicine WHERE date(dateofpm)='".date("Y-m-d")."'";
$record = mysql_query($query,$cn);


while($name = mysql_fetch_array($record)){
$selected_medicine[] = $name["mid"];
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prescription-Doct Connect</title>
<link href="../reception/css/plugins/pace/pace.css" rel="stylesheet">
<link href="../reception/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="../reception/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="../reception/css/plugins/messenger/messenger.css" rel="stylesheet">
<link href="../reception/css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
<link href="../reception/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="../reception/css/plugins/morris/morris.css" rel="stylesheet">
<link href="../reception/css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
<link href="../reception/css/plugins/datatables/datatables.css" rel="stylesheet">
<!-- THEME STYLES - Include these on every page. -->
<link href="../reception/css/style.css" rel="stylesheet">
<link href="../reception/css/plugins.css" rel="stylesheet">
<link href="../reception/css/demo.css" rel="stylesheet">
<link rel="stylesheet" href="../chosen_v1.1.0/chosen.css">
<script src="../reception/js/jquery-2.1.1.min.js"></script>
<script src="../reception/js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="../reception/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../reception/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="../reception/js/plugins/popupoverlay/defaults.js"></script>
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<script src="../reception/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="../reception/js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="../reception/js/flex.js"></script>
<script src="../reception/js/demo/advanced-tables-demo.js"></script>
<script src="../reception/new/throttle-debounce-min.js"></script>
<script src="../reception/new/extensions.js"></script>
<script language="javascript">

/*$(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	//var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
//var g=_self.data('id');//pmid
//$("#themeid").val(_self.data('kb'));
//var f=_self.data('kb');//pid
  // $.get("editpmedicine.php", {pmid:eval(g)}, function (data) {
              //      $("#dta").html(data);
             //   });
	//$(_self.attr('href')).modal('show');
//});

</script>
<script type="text/javascript">

function dn(id,pid,nfd)
{

	if(nfd==0){
		window.location='givepre.php?pid='+pid+'&msg=error';	
	}
	else {
		window.location='givepre.php?id='+id+'&pid='+pid+'&nn='+nfd;
	}
}
function  getc(id,pid)
	{
	
	
if( confirm('Are you sure you want to delete?'))
{

 window.location='givepre.php?dpmid='+id+'&pid='+pid;
    

}
else
{
return false;
}

	
	
	}

</script>
<style>
.gett
{
position:absolute;
	top:10%;
	left:50%;
	
}

</style>
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> <?php 
mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='".$_GET['pid']."'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h); 
 echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?></h1>
          <?php include('button.php');?>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    
    <!-- /.row -->
    <!-- end PAGE TITLE ROW -->
    <!-- begin MAIN PAGE ROW -->
    <div class="row">
      <div class="col-lg-12">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left">Special Room</h4>
            </div>
            <div class="portlet-widgets"> </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <div class="portlet-body">
              <table style="overflow:auto;width:100%" class="table-bordered table-condensed table-green table-hover table-responsive table">
			 
                <tr>
                  <th>Case No</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>City</th>
                  <th>Contactno</th>             
                  <th>Gender</th>
                  <th>Blood Group</th>
                </tr>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_patient['pid']; ?></td>
                    <td><?php echo $row_patient['fname'].' '. $row_patient['mname'].' '.$row_patient['lname']; ?></td>
                    <td><?php echo $row_patient['bdate']; ?></td>
                    <td><?php echo $row_patient['city']; ?></td>
                    <td><?php echo $row_patient['contactno1']; ?></td>
                   
                   
                    <td><?php echo $row_patient['gender']; ?></td>
                    <td><?php echo $row_patient['bgroup']; ?></td>
                  </tr>
                  <?php } while ($row_patient = mysql_fetch_assoc($patient)); ?>
              </table>
              <div>
                <div id="basicFormExample" class="panel-collapse collapse in">
                  <div class="portlet-body"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet -->
      </div>
      <div class="col-lg-6">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left">Dressing Details</h4>
            </div>
            <div class="portlet-widgets"> </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <div class="portlet-body">
              <div>
                <div id="basicFormExample" class="panel-collapse collapse in">
                  <div class="portlet-body"> 
				   <form name="ff" method="post" action="">
				  <table>
				  <tr><td>Enter Remarks : </td><td>
				  <textarea name="remark" cols="40" required ></textarea>
				  
				  </td><td>&nbsp;
				  <button type="submit" class="btn btn-success" name="add_days">Add</button></td></tr>
				  
				  </table>
				  </form>
				  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet -->
      </div>
      
      
      <div class="col-lg-6">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left">Special Room</h4>
            </div>
            <div class="portlet-widgets"> </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <div class="portlet-body">
              <table style="overflow:auto;width:100%" class="table-bordered table-condensed table-green table-hover table-responsive table">
			 
                <tr>
                  <th>Case No</th>
                  <th>Dressing Remark</th>
                 
                </tr>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_des['pid']; ?></td>
                   
                    <td><?php echo $row_des['remarks'];?></td>
                    
                  </tr>
                  <?php } while ($row_des = mysql_fetch_assoc($des)); ?>
              </table>
              <div>
                <div id="basicFormExample" class="panel-collapse collapse in">
                  <div class="portlet-body"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet -->
      </div>
      
      
      <!-- ICU END -->
    </div>
   
  </div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-body" id="dta" > </div>
</div>
<!--end hover data -->
<script src="../reception/js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="../reception/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="../reception/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../reception/js/plugins/popupoverlay/defaults.js"></script>
<script src="../reception/js/plugins/popupoverlay/logout.js"></script>
<!-- HISRC Retina Images -->
<script src="../reception/js/plugins/hisrc/hisrc.js"></script>
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<!-- HubSpot Messenger -->
<script src="../reception/js/plugins/messenger/messenger.min.js"></script>
<script src="../reception/js/plugins/messenger/messenger-theme-flat.js"></script>
<!-- Date Range Picker -->
<script src="../reception/js/plugins/daterangepicker/moment.js"></script>
<script src="../reception/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Morris Charts -->
<script src="../reception/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="../reception/js/plugins/morris/morris.js"></script>
<!-- Flot Charts -->
<script src="../reception/js/plugins/flot/jquery.flot.js"></script>
<script src="../reception/js/plugins/flot/jquery.flot.resize.js"></script>
<!-- Sparkline Charts -->
<script src="../reception/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- Moment.js -->
<script src="../reception/js/plugins/moment/moment.min.js"></script>
<!-- jQuery Vector Map -->
<script src="../reception/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../reception/js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<script src="../reception/js/demo/map-demo-data.js"></script>
<!-- Easy Pie Chart -->
<script src="../reception/js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
<!-- DataTables -->
<script src="../reception/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="../reception/js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="../reception/js/flex.js"></script>
<script src="../reception/js/demo/dashboard-demo.js"></script>
<script src="../chosen_v1.1.0/chosen.jquery.js"></script>
<script src="../chosen_v1.1.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
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
</body>
</html>
<?php
mysql_free_result($getkist);
mysql_free_result($patient);
mysql_free_result($des);
mysql_free_result($getmlist);
mysql_free_result($getmedicine);
?>
