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



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doct Connect</title>
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
$(document).on("click", ".open-AddBookDialog1", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailcertificate.php", {recordID:eval(g)}, function (data) {
                    $("#dta1").html(data);
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
          <h1> All Patients </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage Patients </li>
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
                  <h4 style="float:left"> Patient Details </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php
				 mysql_select_db($database_cn, $cn);
				$ll=$_GET['pid'];
$qq= "SELECT * FROM patient_admit where pid='$ll'";
$qq1= mysql_query($qq) or die(mysql_error());
$qq2 = mysql_fetch_assoc($qq1);
$qq4=$qq2['pid'];

$aa= "SELECT * FROM patient where pid='$qq4'";
$aa1= mysql_query($aa) or die(mysql_error());
$aa2 = mysql_fetch_assoc($aa1);

$bb= "SELECT * FROM sur_dtl where pid='$qq4'";
$bb1= mysql_query($bb) or die(mysql_error());
$bb2 = mysql_fetch_assoc($bb1);
//$totalRows_Recordset1 = mysql_num_rows($Recordset1); 
				 ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <tbody>
                      <tr>
                        <th>Pid</th>
                        <td><?php echo $qq2['pid']; ?></td>
                        <th>Name </th>
                        <td><?php echo $qq2['fname'].' '.$qq2['mname'].' '.$qq2['lname']; ?></td>
                      </tr>
                      <tr>
                        <th>Age</th>
                        <td><?php echo $aa2['bdate']; ?></td>
                        <th>City</th>
                        <td><?php echo $aa2['city']; ?></td>
                      </tr>
                      <tr>
                        <th>Contact No</th>
                        <td><?php echo $aa2['contactno1']; ?></td>
                        <th>Gender</th>
                        <td><?php echo $qq2['gender']; ?></td>
                      </tr>
                      <tr>
                        <th>Date Of Add</th>
                        <td><?php echo $aa2['dtofadd']; ?></td>
                        <th>Blood Group</th>
                        <td><?php echo $aa2['bgroup']; ?></td>
                      </tr>
                      <tr>
                        <th>Surgery Name</th>
                        <td><?php echo $bb2['pid']; ?></td>
                        <td></td>
                        <td><?php //echo $qq2['pid']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Lab Reports </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <?php 
 $cc= "SELECT * FROM doc_lab_report where pid='$ll'";
//exit;
$cc1= mysql_query($cc) or die(mysql_error());
$cc2 = mysql_fetch_assoc($cc1);
			  
			  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>Report Name</td>
                        <td>Reading </td>
                        <td>Date</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $cc2['sel_rep_name']; ?></td>
                        <td><?php echo $cc2['reading']; ?></td>
                        <td><?php echo $cc2['created_date']; ?></td>
                      </tr>
                      <?php } while ($cc2 = mysql_fetch_assoc($cc1)); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> X-ray Details </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <?php $dd= "SELECT * FROM xray_dtl where pid='$ll'";
$dd1= mysql_query($dd) or die(mysql_error());
$dd2 = mysql_fetch_assoc($dd1);	  
			  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>X-Ray Name</td>
                        <td>Date</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $dd2['xname']; ?></td>
                        <td><?php echo $dd2['date']; ?></td>
                      </tr>
                      <?php } while ($dd2 = mysql_fetch_assoc($dd1)); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <div class="col-lg-12">
        <div class="row"> 
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Dressing Reports </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <?php 
 $ee= "SELECT * FROM dressing where pid='$ll'";
//exit;
$ee1= mysql_query($ee) or die(mysql_error());
$ee2 = mysql_fetch_assoc($ee1);  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>Remarks</td>
                        <td>Date</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $ee2['remarks']; ?></td>
                        <td><?php echo $ee2['date']; ?></td>
                      </tr>
                      <?php } while ($ee2 = mysql_fetch_assoc($ee1)); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> RBS Reports </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <?php 
 $ff= "SELECT * FROM rbs_chart where pid='$ll'";
$ff1= mysql_query($ff) or die(mysql_error());
$ff2 = mysql_fetch_assoc($ff1);
			  
			  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>Date</td>
                        <td>FBS </td>
                        <td>Pre_lanch</td>
                        <td>Lab_pp2bs</td>
                        <td>Inward_pp2bs</td>
                        <td>Pre_dinner</td>
                        <td>Post_dinner</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $ff2['date']; ?></td>
                        <td><?php echo $ff2['fbs']; ?></td>
                        <td><?php echo $ff2['pre_lanch']; ?></td>
                        <td><?php echo $ff2['lab_pp2bs'];?></td>
                        <td><?php echo $ff2['inward_pp2bs'];?></td>
                        <td><?php echo $ff2['pre_dinner'];?></td>
                        <td><?php echo $ff2['post_dinner'];?></td>
                      </tr>
                      <?php } while ($ff2 = mysql_fetch_assoc($ff1)); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
     
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Check Test Reports </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <?php 
 $zz= "SELECT * FROM nurse_order where pid='$ll'";
//exit;
$zz1= mysql_query($zz) or die(mysql_error());
$zz2 = mysql_fetch_assoc($zz1);
			  
			  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>BP</th>
                        <th>Pluse </th>
                        <th>Temp </th>
                        <th>Respisation</th>
                        <th>I/O Chart</th>
                        <th>Time</th>
                        <th>U/O Chart</th>
                        <th>SPO2</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $zz2['date'];  ?></td>
                        <td><?php echo $zz2['time']; ?></td>
                        <td><?php echo $zz2['bp']; ?></td>
                        <td><?php echo $zz2['pluse']; ?></td>
                        <td><?php echo $zz2['temp']; ?></td>
                        <td><?php echo $zz2['respisation']; ?></td>
                        <td><?php echo $zz2['iochart']; ?></td>
                        <td><?php echo $zz2['time1']; ?></td>
                        <td><?php echo $zz2['uochat']; ?></td>
                        <td><?php echo $zz2['dochart']; ?></td>
                      </tr>
                      <?php } while ($zz2 = mysql_fetch_assoc($zz1)); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">INTAKE & OUTPUT Test Reports </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <?php $qq= "SELECT * FROM intake_output where pid='$ll'";
$qq1= mysql_query($qq) or die(mysql_error());
$qq2 = mysql_fetch_assoc($qq1);
			  
			  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td colspan="8" align="center"><b style="font-size:14px">INTAKE</b></td>
                        <td colspan="5" align="center"><b style="font-size:14px">OUTPUT</b></td>
                      </tr>
                      <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>I.V or S.C Infiusion</th>
                        <th>Time </th>
                        <th>By Rectum In CC </th>
                        <th>Time</th>
                        <th>By Month In CC</th>
                        <th>Time</th>
                        <th>Urin in CC</th>
                        <th>Time</th>
                        <th>Stomach Contact in CC</th>
                        <th>Drain Output</th>
                        <th>R.T Aspiration</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $qq2['date']; ?></td>
                        <td><?php echo $qq2['time']; ?></td>
                        <td><?php echo $qq2['iv']; ?></td>
                        <td><?php echo $qq2['itime']; ?></td>
                        <td><?php echo $qq2['icc']; ?></td>
                        <td><?php echo $qq2['timeintake']; ?></td>
                        <td><?php echo $qq2['mothcc']; ?></td>
                        <td><?php echo $qq2['otime']; ?></td>
                        <td><?php echo $qq2['cc']; ?></td>
                        <td><?php echo $qq2['otime1']; ?></td>
                        <td><?php echo $qq2['contactcc']; ?></td>
                        <td><?php echo $qq2['do']; ?></td>
                        <td><?php echo $qq2['rt']; ?></td>
                      </tr>
                      <?php } while ($qq2 = mysql_fetch_assoc($qq1)); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/plugins/bootstrap/bootstrap.min.js"></script> 
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script> 
<script src="js/plugins/popupoverlay/defaults.js"></script> 
<script src="js/plugins/popupoverlay/logout.js"></script> 
<script src="js/plugins/hisrc/hisrc.js"></script> 
<script src="js/plugins/messenger/messenger.min.js"></script> 
<script src="js/plugins/messenger/messenger-theme-flat.js"></script> 
<script src="js/plugins/daterangepicker/moment.js"></script> 
<script src="js/plugins/daterangepicker/daterangepicker.js"></script> 
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script> 
<script src="js/plugins/morris/morris.js"></script> 
<script src="js/plugins/flot/jquery.flot.js"></script> 
<script src="js/plugins/flot/jquery.flot.resize.js"></script> 
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script> 
<script src="js/plugins/moment/moment.min.js"></script> 
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> 
<script src="js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script> 
<script src="js/demo/map-demo-data.js"></script> 
<script src="js/plugins/easypiechart/jquery.easypiechart.min.js"></script> 
<script src="js/plugins/datatables/jquery.dataTables.js"></script> 
<script src="js/plugins/datatables/datatables-bs3.js"></script> 
<script src="js/flex.js"></script> 
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
