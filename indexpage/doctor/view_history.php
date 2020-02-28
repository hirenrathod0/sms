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
          <h1> All Patients
           <?php include('button.php'); ?> </h1>
          
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
                  <h4 style="float:left"> Patient Details 
                  
                 
                  </h4>
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

 $aa= "SELECT * FROM patient where pid='$ll'";

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
                        <th>New Case No</th>
                        <td><?php echo $aa2['pid']; ?></td>
                        <th>Name </th>
                        <td><?php echo $aa2['fname'].' '.$qq2['mname'].' '.$qq2['lname']; ?></td>
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
                        <td><?php
	 $sdate=strftime('%d-%m-%Y',strtotime($aa2['dtofadd']));				
					 echo $sdate; ?></td>
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
 $cc= "SELECT * FROM follow where pid='".$_GET['pid']."'";
//exit;
$cc1= mysql_query($cc) or die(mysql_error());
$cc2 = mysql_fetch_assoc($cc1);
			  
			  ?>
                <div class="portlet-body">
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>OPD Case No</td>
                        <td>Date</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $cc2['id']; ?></td>
                        <td><?php 
						 $sdate1=strftime('%d-%m-%Y',strtotime($aa2['dtofadd']));echo $sdate1; ?></td>
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
