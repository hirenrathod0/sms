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

$maxRows_admitpicu = 10;
$pageNum_admitpicu = 0;
if (isset($_GET['pageNum_admitpicu'])) {
  $pageNum_admitpicu = $_GET['pageNum_admitpicu'];
}
$startRow_admitpicu = $pageNum_admitpicu * $maxRows_admitpicu;

mysql_select_db($database_cn, $cn);
 $query_admitpicu = "SELECT * FROM patient_admit WHERE rtype = 'FEMALE WARD'";
$query_limit_admitpicu = sprintf("%s LIMIT %d, %d", $query_admitpicu, $startRow_admitpicu, $maxRows_admitpicu);
$admitpicu = mysql_query($query_limit_admitpicu, $cn) or die(mysql_error());
$row_admitpicu = mysql_fetch_assoc($admitpicu);

if (isset($_GET['totalRows_admitpicu'])) {
  $totalRows_admitpicu = $_GET['totalRows_admitpicu'];
} else {
  $all_admitpicu = mysql_query($query_admitpicu);
  $totalRows_admitpicu = mysql_num_rows($all_admitpicu);
}
$totalPages_admitpicu = ceil($totalRows_admitpicu/$maxRows_admitpicu)-1;


mysql_select_db($database_cn, $cn);
 $query_admitpicu1 = "SELECT * FROM patient_admit WHERE rtype = 'MALE WARD'";
$admitpicu1 = mysql_query($query_admitpicu1, $cn) or die(mysql_error());
$row_admitpicu1 = mysql_fetch_assoc($admitpicu1);
$totalRows_admitpicu1 = mysql_num_rows($admitpicu1);





mysql_select_db($database_cn, $cn);
 $query_admitpspe = "SELECT * FROM patient_admit WHERE rtype = 'SPECIAL'";
$admitpspe = mysql_query($query_admitpspe, $cn) or die(mysql_error());
$row_admitpspe = mysql_fetch_assoc($admitpspe);
$totalRows_admitpspe = mysql_num_rows($admitpspe);

mysql_select_db($database_cn, $cn);
$query_admitpsemi = "SELECT * FROM patient_admit WHERE rtype = 'DELUXE'";
$admitpsemi = mysql_query($query_admitpsemi, $cn) or die(mysql_error());
$row_admitpsemi = mysql_fetch_assoc($admitpsemi);
$totalRows_admitpsemi = mysql_num_rows($admitpsemi);
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
<script src="js/plugins/popupoverlay/logout.js"></script>
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
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active">Admited Patients </li>
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
                  <h5 style="float:left"> SPECIAL Room Patient Details </h5>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="overflow:scroll">
                  <?php   if($totalRows_admitpspe != 0){ ?>
                  <table border="1" class="table table-bordered table-condensed table-green table-hover table-responsive table-striped">
                    <tr class="table-green"> <th>Bedno</th>
                      <th> Name</th>
                      
                      <th>Case No</th>
                      <th>Gender</th>
                      <th>Doctor Name</th>
                      <th>Date Of Admit</th>
                      <th>Room Type</th>
                      
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_admitpspe['bedno']; ?></td>
                        <td><?php echo $row_admitpspe['fname'].' '.$row_admitpspe['mname'].' '.$row_admitpspe['lname']; ?></td>
                        <td><?php echo $row_admitpspe['pid']; ?></td>
                        <td><?php echo $row_admitpspe['gender']; ?></td>
                        <?php
						$n=$row_admitpspe['drname']; 
						 mysql_select_db($database_cn, $cn);
				$query_Recordset1 = "SELECT fullname FROM `user` WHERE `uid` = '$n' ";
				$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
				$row_Recordset1 = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1); ?>
                        <td><?php echo $row_Recordset1['fullname']; ?></td>
                        <td><?php echo date('d-m-y',strtotime($row_admitpspe['dofadmit'])); ?></td>
                        <td><?php echo $row_admitpspe['rtype']; ?></td>
                        <?php /*?><td><a href="genbillipd.php?pid=<?php echo $row_admitpspe['pid']; ?>" class="btn btn-info"><i class="fa fa-paperclip">Generate Bill</i></a> </td><?php */?>
                      </tr>
                      <?php } while ($row_admitpspe = mysql_fetch_assoc($admitpspe)); ?>
                  </table>
                  <?php }
				  else
				  {
					 ?>
                  <span class="alert-danger"> No Record Found </span>
                  <?php
					 }
				  ?>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
          <!-- START SEMI-SPECIAL ROOMS -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h5 style="float:left"> DELUXE Room Patient Details </h5>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="overflow:scroll">
                  <?php if($totalRows_admitpsemi != 0){?>
                  <table border="1" class="table table-bordered table-condensed table-green table-hover table-responsive table-striped">
                    <tr class="table-green"> <th>Bedno</th>
                      <th> Name</th>
                     
                      <th>Case No</th>
                      <th>Gender</th>
                      <th>Doctor Name</th>
                      <th>Date Of Admit</th>
                      <th>Room Type</th>
                      
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_admitpsemi['bedno']; ?></td>
                        <td><?php echo $row_admitpsemi['fname'].' '. $row_admitpsemi['mname'].' '. $row_admitpsemi['lname']; ?></td>
                        <td><?php echo $row_admitpsemi['pid']; ?></td>
                        <td><?php echo $row_admitpsemi['gender']; ?></td>
                        <?php
						$n=$row_admitpsemi['drname']; 
						 mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT fullname FROM `user` WHERE `uid` = '$n' ";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); ?>
                        <td><?php echo $row_Recordset1['fullname']; ?></td>
                        <td><?php echo date('d-m-y',strtotime($row_admitpsemi['dofadmit'])); ?></td>
                        <td><?php echo $row_admitpsemi['rtype']; ?></td>
                       <?php /*?> <td><a href="genbillipd.php?pid=<?php echo $row_admitpsemi['pid']; ?>" class="btn btn-info"><i class="fa fa-paperclip">Generate Bill</i></a> </td><?php */?>
                      </tr>
                      <?php } while ($row_admitpsemi = mysql_fetch_assoc($admitpsemi)); ?>
                  </table>
                  <?php }
				  else
				  {
					 ?>
                  <span class="alert-danger"> No Record Found </span>
                  <?php
					 }
				  ?>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
          <!-- END SEMI-SPECIAL ROOMS-->
          <!-- START SPECIAL ROOMS-->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h5 style="float:left">FEMALE WARD Room Patient Details </h5>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="overflow:scroll">
                  <?php if($totalRows_admitpicu != 0) { ?>
                  <table border="1" class="table table-bordered table-condensed table-green table-hover table-responsive table-striped">
                    <tr class="table-green"> <th>Bedno</th>
                      <th> Name</th>
                      
                      <th>Case No</th>
                      <th>Gender</th>
                      <th>Doctor Name</th>
                      <th>Date Of Admit</th>
                      <th>Room Type</th>
                      
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_admitpicu['bedno']; ?></td>
                        <td><?php echo $row_admitpicu['fname'].' '.$row_admitpicu['mname'].' '.$row_admitpicu['lname']; ?></td>
                        <td><?php echo $row_admitpicu['pid']; ?></td>
                        <td><?php echo $row_admitpicu['gender']; ?></td>
                        <?php
						$n=$row_admitpicu['drname']; 
						 mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT fullname FROM `user` WHERE `uid` = $n";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());	
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); ?>
                        <td><?php echo $row_Recordset1['fullname']; ?></td>
                        <td><?php echo date('d-m-y',strtotime($row_admitpicu['dofadmit'])); ?></td>
                        <td><?php echo $row_admitpicu['rtype']; ?></td>
                       <?php /*?> <td><a href="genbillipd.php?pid=<?php echo $row_admitpicu['pid']; ?>" class="btn btn-info"><i class="fa fa-paperclip">Generate Bill</i></a> </td><?php */?>
                      </tr>
                      <?php } while ($row_admitpicu = mysql_fetch_assoc($admitpicu)); ?>
                  </table>	
                  <?php }
				  else
				  {
					 ?>
                  <span class="alert-danger"> No Record Found </span>
                  <?php
					 }
				  ?>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
          <!-- END SPECIAL ROOMS-->
		  
		  <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h5 style="float:left">MALE WARD Room Patient Details </h5>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="overflow:scroll">
                  <?php if($totalRows_admitpicu1 != 0) { ?>
                  <table border="1" class="table table-bordered table-condensed table-green table-hover table-responsive table-striped">
                    <tr class="table-green"> <th>Bedno</th>
                      <th> Name</th>
                     
                      <th>Case No</th>
                      <th>Gender</th>
                      <th>Doctor Name</th>
                      <th>Date Of Admit</th>
                      <th>Room Type</th>
                      
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_admitpicu1['bedno']; ?></td>
                        <td><?php echo $row_admitpicu1['fname'].' '. $row_admitpicu1['mname'].' '.$row_admitpicu1['lname']; ?></td>
                        <td><?php echo $row_admitpicu1['pid']; ?></td>
                        <td><?php echo $row_admitpicu1['gender']; ?></td>
                        <?php
						$n=$row_admitpicu1['drname']; 
						 mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT fullname FROM `user` WHERE `uid` = $n";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); ?>
                        <td><?php echo $row_Recordset1['fullname']; ?></td>
                        <td><?php echo date('d-m-y',strtotime($row_admitpicu1['dofadmit'])); ?></td>
                        <td><?php echo $row_admitpicu1['rtype']; ?></td>
                       <?php /*?> <td><a href="genbillipd.php?pid=<?php echo $row_admitpicu1['pid']; ?>" class="btn btn-info"><i class="fa fa-paperclip">Generate Bill</i></a> </td><?php */?>
                      </tr>
                      <?php } while ($row_admitpicu1 = mysql_fetch_assoc($admitpicu1)); ?>
                  </table>
                  <?php }
				  else
				  {
					 ?>
                  <span class="alert-danger"> No Record Found </span>
                  <?php
					 }
				  ?>
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
<?php
mysql_free_result($admitpicu);

mysql_free_result($admitpspe);

mysql_free_result($admitpsemi);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
</body>
</html>
