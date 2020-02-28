<?php require_once('../Connections/cn.php'); ?>
<?php

 date_default_timezone_set("Asia/Kolkata");
	
// $n1=date(('d'),strtotime("-1 days"));
//$n=date("Y-m-".$n1);
$n=date("Y-m-d");
mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM patient where date(dtofadd)='$n' order by pid desc ";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

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
<style>
.pagination {

width: 166px;
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
          <h1> All Patients <span style="padding-left:72%"> </span> </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage Patients </li>
          </ol>
        </div>
      </div>
  
    </div>
 
 
    <div class="row"> 
      <div class="col-lg-7">
        <div class="row"> 
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient Details </h4>
                </div>
                <div class="portlet-widgets"> <a href="patient.php"  class="pull-right btn-orange btn"> Add New Patients </a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset2>0) {  ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed"  >
                    <thead>
                      <tr>
                        <td>#</td>
                        <td>Case No</td>
                        <td>Patient Name</td>
                        <td width="5%">City</td>
                        <td>Date </td>
                        <td>Action </td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; do { ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row_Recordset2['pid']; ?></td>
                          <td><?php echo $row_Recordset2['fname'].' '.$row_Recordset2['lname']; ?></td>
                          <td><?php echo $row_Recordset2['city']; ?></td>
                          <td><?php echo date("d/m/Y",strtotime($row_Recordset2['dtofadd'])); ?></td>
                          <td><a data-id='<?php echo $row_Recordset2['pid']; ?>'  title="Add this item" class="open-AddBookDialog btn btn-success" href="#myModal" style="height:auto;width:auto"><i class="fa fa-paperclip">Details</i></a> <a href="booking.php?pid=<?php echo $row_Recordset2['pid']; ?>" class="btn btn-warning"><i class="fa fa-lemon-o">Booking</i></a>
 <?php /*?><a href="del_pat.php?pid=<?php echo $row_Recordset2['pid']; ?>" class="btn btn-danger"><i class="fa fa-times"> Delete</i></a><?php */?></td>
                        </tr>
                        <?php $i++;} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
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
      <div class="col-lg-5">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> To Be Admitted Patients </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                 <?php
mysql_select_db($database_cn, $cn);
$query_Recordset3 = "SELECT * FROM alert_admit";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);?>
                  <?php if($totalRows_Recordset3>0) {  ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed">
                    <thead>
                      <tr>
                        <td>Id</td>
                        <td>Patients Name</td>
                        <td>Action </td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; do {?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td>
						  <?php $nk=$row_Recordset3['pid'];
mysql_select_db($database_cn, $cn);
$query_Recordset4 = "SELECT pid,fname,lname FROM patient WHERE pid = '$nk' ";
$Recordset4 = mysql_query($query_Recordset4, $cn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);?>
						  <?php echo $row_Recordset4['fname'].' '. $row_Recordset4['lname']; ?></td>
                         

<td>                            <a href="admit.php?pid=<?php echo $row_Recordset4['pid']; ?>" class="btn btn-info"><i class="fa fa-hospital-o">Admit</i></a> <a href="doneadmit.php?pid=<?php echo $row_Recordset4['pid']; ?>" class="btn btn-danger"><i class="fa fa-hospital-o">Done </i></a></td>
                        </tr>
                      <?php $i++;} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
						 
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
      
      <div class="row">
<?php mysql_select_db($database_cn, $cn);
$query_rs_dispt = "SELECT * FROM patient_admit WHERE status='Discharge' and s1='0'  ";
$rs_dispt = mysql_query($query_rs_dispt, $cn) or die(mysql_error());
$row_rs_dispt = mysql_fetch_assoc($rs_dispt);
$totalRows_rs_dispt = mysql_num_rows($rs_dispt);
?>
      <div class="col-lg-4">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> To Be Discharge Patients </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_rs_dispt>0) {  ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed">
                    <thead>
                      <tr>
                        <td>Id</td>
                        <td>Patients Name</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; do { ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row_rs_dispt['fname'].' '.$row_rs_dispt['lname']; ?></td>
                          <td><?php $xx=$totalRows_Recordset2['pid'];
 $ss=mysql_query("select * from patient_admit where pid='$xx' and s1='0'");
$ss1=mysql_fetch_assoc($ss);						


   // if($ss1<0){?>
                            <a href="printbill.php?pid=<?php echo $row_rs_dispt['pid']; ?>" class="btn btn-info"><i class="fa fa-paperclip">Generate Bill</i></a></td>
                        </tr>
                        <?php $i++;} while ($row_rs_dispt = mysql_fetch_assoc($rs_dispt)); ?>
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
        <!-- /.row (nested) --> 
        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta"> </div>
        </div>
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
