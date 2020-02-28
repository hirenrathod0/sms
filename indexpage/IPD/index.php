<?php 
require_once('../Connections/cn.php');

session_start();
if(!isset($_SESSION['MM_Nurse']))
{
	header("location:login.php");
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
$n=date("Y-m-d");
mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM patient where date(dtofadd)='$n' order by pid desc ";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">



<meta name="author" content="">
<title>Dashboard-Doct Connect</title>
<script src="../admin/js/jquery-2.1.1.min.js"></script>
<script src="js/plugins/popupoverlay/logout.js"></script>
<link rel="stylesheet" type="text/css" href="css/plugins/datatables/datatables.css">
<link rel="stylesheet" type="text/css" href="css/plugins/bootstrap/css/bootstrap.min.css">
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<script src="js/plugins/pace/pace.js"></script>
<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- PAGE LEVEL PLUGIN STYLES -->
<link href="css/plugins/messenger/messenger.css" rel="stylesheet">
<link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
<link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="css/plugins/morris/morris.css" rel="stylesheet">
<link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
<!-- THEME STYLES - Include these on every page. -->
<link href="css/style.css" rel="stylesheet">
<link href="css/plugins.css" rel="stylesheet">
<script language="javascript">
$(document).on("click", ".open-AddBookDialog1", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("preview.php", {recordID:eval(g)}, function (data) {
                    $("#dta1").html(data);
                });
	$(_self.attr('href')).modal('show');
});
</script>
</head>
<body>
<div id="wrapper">
  <?php include("header.php")?>
  <?php include("sidebar.php")?>
  <div id="page-wrapper">
    <div class="page-content">
      <!-- begin PAGE TITLE AREA -->
      <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
      <div class="row">
        <div class="col-lg-12">
          <div class="page-title">
           
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Dashboard / Today Patients</li>
            </ol>
          </div>
        </div>
		
		
		
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- end PAGE TITLE AREA -->
      <!-- begin DASHBOARD CIRCLE TILES -->
      
      <!-- end DASHBOARD CIRCLE TILES -->
    </div>
    <!-- /.row -->
     <?php
mysql_select_db($database_cn, $cn);
$query_Recordset21="SELECT * FROM `p_medicine` join `patient` on `patient`.`pid`=`p_medicine`.`pid` WHERE (`created_time` > DATE_SUB(date(now()), INTERVAL 1 DAY)) and `patient`.`gender`='Female' ORDER BY id desc";
//echo $query_Recordset21 = "SELECT * FROM `p_medicine` WHERE (`created_time` > DATE_SUB(now(), INTERVAL 1 DAY)) ORDER BY id desc";
//exit;

$Recordset21 = mysql_query($query_Recordset21, $cn) or die(mysql_error());
$row_Recordset21 = mysql_fetch_assoc($Recordset21);
$totalRows_Recordset21= mysql_num_rows($Recordset21);
?>
  
  <div class="col-lg-12">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient Details </h4>
                </div>
                <div class="portlet-widgets"></div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset2>0) {  ?>

				  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed">
                    <thead>
                      <tr>
                        <td>Id</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                      <td>Age </td>
                        <td>City</td>
                        <td>Gender</td>
						<td> Date </td>
						<td>Status</td>
					    <td>Action </td>
                      </tr>
                    </thead>
					 <tbody>
                    <?php $i=1; do { 
					$vv=$row_Recordset2['pid'];


mysql_select_db($database_cn, $cn);
$query_rs_admit = "SELECT status FROM patient_admit where pid='$vv'";
$rs_admit = mysql_query($query_rs_admit, $cn) or die(mysql_error());
$row_rs_admit = mysql_fetch_assoc($rs_admit);
$totalRows_rs_admit = mysql_num_rows($rs_admit);
					
					
					
					if($row_rs_admit['status']=="admit")
					{
					?>
					
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_Recordset2['fname']; ?></td>
						<td><?php echo $row_Recordset2['lname']; ?></td>
                      <td><?php echo $row_Recordset2['bdate']; ?></td>
                        <td><?php echo $row_Recordset2['city']; ?></td>
                        <td><?php echo $row_Recordset2['gender']; ?></td>
						
						<td><?php echo date("d/m/Y",strtotime($row_Recordset2['dtofadd'])); ?></td>
						
						<td><?php echo $row_rs_admit['status']; ?></td>
						
                        <td>
                        	<a href="btndtl.php?pid=<?php echo $row_Recordset2['pid']; ?>" class="btn btn-info"> Reports </a>
                      
						<a href="discharge.php?pid=<?php echo $row_Recordset2['pid']; ?>" class="btn btn-success"><i class="fa fa-hospital-o">Discharge</i></a>
						
						</td>
                        
                      </tr>
                      <?php $i++;}} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
				    </tbody>
                  </table>
                  <?php } else {  ?>
                  <label class="alert-danger">
                  
                  NO DATA FOUND
                  </label>
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
<!-- /#page-wrapper -->
<!-- end MAIN PAGE CONTENT -->
</div>
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-body" id="dta1"> </div>
</div>
<!-- /#wrapper -->
<!-- GLOBAL SCRIPTS -->
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<!-- Logout Notification Box -->
<!-- /#logout -->
<!-- Logout Notification jQuery -->

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
