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

if(!isset($_SESSION['MM_RECEPTION']))
{
	
header('login.php');
}
 date_default_timezone_set("Asia/Kolkata");
	
 //$n1=date(('d'),strtotime("-1 days"));
 
 //$n=date("Y-m-".$n1);
 $n=date('Y-m-d');
mysql_select_db($database_cn, $cn);
 $query_Recordset4 = "SELECT * FROM xray_bill where date(date)='$n' and status='Done'";
//exit;
$Recordset4 = mysql_query($query_Recordset4, $cn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);




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
   $.get("detail_xray.php", {recordID:eval(g)}, function (data) {
                    $("#dta").html(data);
                });
	$(_self.attr('href')).modal('show');
});
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
          <h1> Current Running Patients </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage X-Ray</li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- end PAGE TITLE ROW -->
    <!-- begin MAIN PAGE ROW -->
    <div class="row">
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> X-Ray Details </h4>
                </div>
                <div class="portlet-widgets"><!-- <a href="xray.php"  class="pull-right btn-orange btn "   > Add New Data</a>--> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset4>0) {  ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Pid</th>
                        <th>Full Name</th>
                        <th>Date</th>
                        <th>City</th>
                        <th>Gender</th>
                        <th>X-ray Name</th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
					 $i=1;  do{
						  $pp=$row_Recordset4['id'];

						  
						  mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM xray_dtl where date(date)='$n' group by pid";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

					  
						 $bb=$row_Recordset2['pid'];
						 $mm=$row_Recordset4['pid'];
						  mysql_select_db($database_cn, $cn);
$query_rs_pdtl = "SELECT patient.fname, patient.mname, patient.lname, patient.city, patient.gender  FROM patient where pid='$mm'";
$rs_pdtl = mysql_query($query_rs_pdtl, $cn) or die(mysql_error());
$row_rs_pdtl = mysql_fetch_assoc($rs_pdtl);
$totalRows_rs_pdtl = mysql_num_rows($rs_pdtl); ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row_Recordset4['pid']; ?></td>
                          <td><?php echo $row_rs_pdtl['fname'].' '.$row_rs_pdtl['mname'].' '.$row_rs_pdtl['lname']; ?></td>
                          <td><?php echo date('d/m/Y',strtotime($row_Recordset4['date'])); ?></td>
                          <td><?php echo $row_rs_pdtl['city']; ?></td>
                          <td><?php echo $row_rs_pdtl['gender']; ?></td>
                          <td><?php
 mysql_select_db($database_cn, $cn);
$query_Recordset21 = "SELECT * FROM xray_dtl where pid='$pp'";
$Recordset21 = mysql_query($query_Recordset21, $cn) or die(mysql_error());
$row_Recordset21 = mysql_fetch_assoc($Recordset21);
$totalRows_Recordset21 = mysql_num_rows($Recordset21);
do{   echo $row_Recordset21['xname'].' , '; 
}while($row_Recordset21 = mysql_fetch_assoc($Recordset21));?></td>
                          <td>
						  <a data-id='<?php echo $bb; ?>'  title="Add this item" class="open-AddBookDialog btn btn-success" href="#myModal" style="height:auto;width:auto"><i class="fa fa-paperclip">Details</i></a>
						   <?php /*?><a href="edit_xray.php?pid=<?php echo $row_Recordset2['pid']; ?>" class="btn btn-info"><i class="fa fa-hospital-o">&nbsp;&nbsp;Edit</i></a> 
						   <a href="del_xray.php?pid=<?php echo $row_Recordset2['pid']; ?>" class="btn btn-danger"><i class="fa fa-times"> Delete</i></a> <?php */?>
						    <a href="photo.php?pid=<?php echo $row_Recordset4['id']; ?>" class="btn btn-primary"><i class="fa fa-hospital-o">&nbsp;&nbsp;Upload X-ray</i></a> </td>
                        </tr>
                        <?php $i++;
						
					  }while($row_Recordset4 = mysql_fetch_assoc($Recordset4));?>
                    </tbody>
                  </table>
                  <?php } else {  ?>
                  <label class="alert-danger"> NO DATA FOUND </label>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
        </div>
        <!-- /.row (nested) -->
        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Button to trigger modal -->
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

