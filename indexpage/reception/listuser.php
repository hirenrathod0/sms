<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_RECEPTION']))
{
header('login.php');
}
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

if ((isset($_GET['removeid'])) && ($_GET['removeid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM user WHERE uid=%s",
                       GetSQLValueString($_GET['removeid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "listuser.php";
  
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_userlisting_rs = 10;
$pageNum_userlisting_rs = 0;
if (isset($_GET['pageNum_userlisting_rs'])) {
  $pageNum_userlisting_rs = $_GET['pageNum_userlisting_rs'];
}
$startRow_userlisting_rs = $pageNum_userlisting_rs * $maxRows_userlisting_rs;

mysql_select_db($database_cn, $cn);
$query_userlisting_rs = "SELECT * FROM `user` ORDER BY uid DESC";
$query_limit_userlisting_rs = sprintf("%s LIMIT %d, %d", $query_userlisting_rs, $startRow_userlisting_rs, $maxRows_userlisting_rs);
$userlisting_rs = mysql_query($query_limit_userlisting_rs, $cn) or die(mysql_error());
$row_userlisting_rs = mysql_fetch_assoc($userlisting_rs);

if (isset($_GET['totalRows_userlisting_rs'])) {
  $totalRows_userlisting_rs = $_GET['totalRows_userlisting_rs'];
} else {
  $all_userlisting_rs = mysql_query($query_userlisting_rs);
  $totalRows_userlisting_rs = mysql_num_rows($all_userlisting_rs);
}
$totalPages_userlisting_rs = ceil($totalRows_userlisting_rs/$maxRows_userlisting_rs)-1;


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doct Connect</title>
<link href="admin/css/plugins/pace/pace.css" rel="stylesheet">
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
<script src="js/jquery-2.1.1.min.js"></script>
   <script src="js/flex.js"></script>
    <script src="js/demo/advanced-tables-demo.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
    <script src="js/plugins/datatables/datatables-bs3.js"></script>

  
</head>

<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>User/Emploee
                                <small>Listing</small>                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>                                </li>
                                <li class="active">User/Employee</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->

                <!-- begin ADVANCED TABLES ROW -->
                <div class="row">

                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Listing Employee/User</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
								<form name="listinguser" method="post" action="">
                                  
                                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                      <tr>
                                      <td>No.</td>
                                      <td>fullname</td>
                                      <td>img</td>
                                      <td>type</td>
									  <td>Action</td>
                                    </tr>
                                        </thead>
                                        <tbody>
                                          
									  <?php $i=1; do { ?>
                                      <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row_userlisting_rs['fullname']; ?></td>
                                        <td><img src="../userpic/<?php echo $row_userlisting_rs['img']; ?>" width="200px" height="100px" /></td>
                                        <td><?php echo $row_userlisting_rs['type']; ?></td>
										<td>
										<a href="viewuser.php?id=<?php echo $row_userlisting_rs['uid']; ?>" class="btn btn-success btn-square"><i class="fa fa-eye"> View</i></a>
										
										
										<a href="userlist.php?removeid=<?php echo $row_userlisting_rs['uid']; ?>" class="btn btn-red btn-square"><i class="fa fa-remove"> Remove</i></a>
							
							<?php mysql_select_db($database_cn, $cn);
							$n=$row_userlisting_rs['uid'];
$query_Recordset1 = "SELECT * FROM userlogin WHERE uid =$n ";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
if($totalRows_Recordset1>0) {

?>
<label class="btn btn-xs btn-purple"> Already Authenticated </label>
<?php } else { ?>							
							<a href="userauth.php?id=<?php echo $row_userlisting_rs['uid']; ?>&type=<?php echo $row_userlisting_rs['type']; ?>" class="btn btn-success btn-warning"><i class="fa fa-user">  Auth</i></a>
										<?php } ?>
										</td>
                                      </tr>
                                      <?php $i++; } while ($row_userlisting_rs = mysql_fetch_assoc($userlisting_rs)); ?>
                                 
										  
										  
                                        </tbody>
                                  </table>
								  
								 </form>
                              </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.page-content -->

</div>
		
		  <script src="../../ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="js/plugins/popupoverlay/defaults.js"></script>
    <!-- Logout Notification jQuery -->
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
mysql_free_result($userlisting_rs);

mysql_free_result($Recordset1);
?>
