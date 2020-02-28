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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$tt=$_GET['pid'];
  $insertSQL = sprintf("INSERT INTO sur_dtl (pid,sur_name, remarks) VALUES ('$tt',%s, %s)",
                       GetSQLValueString($_POST['sname'], "text"),
                       GetSQLValueString($_POST['remarks'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "surgery_dtl.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM sur_dtl WHERE pid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Category-Doct Connect</title>
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
              <h1> <?php 
mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='".$_GET['pid']."'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h); 
 echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?></h1>
              <?php include('button.php'); ?>
            </div>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        <!-- /.row --> 
        <!-- end PAGE TITLE ROW --> 
        <!-- begin MAIN PAGE ROW -->
        <div class="row"> 
          <!-- begin LEFT COLUMN -->
          <div class="col-lg-6">
            <div class="row"> 
              <!-- Basic Form Example -->
              <div class="col-lg-12">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> Add New Surgery Details </h4>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form method="POST" name="form1" action="<?php echo $editFormAction; ?>" id="f1">
                        <table align="center" class="table-responsive table-condensed table-bordered table ">
                          <tr valign="baseline">
                            <td nowrap align="right"><strong> Surgery Name:</strong></td>
                            <td><input type="text" name="sname" value="" size="32" placeholder="Enter Surgery Name " required class="form-control" ></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><strong>Remarks:</strong></td>
                            <td><textarea name="remarks" value=""  placeholder="Enter Remarks" required class="form-control" ></textarea></td>
                          </tr>
                          <tr valign="baseline">
                            <td colspan="2" align="center"><input type="submit" value="Submit" class="btn btn-green "></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
                      </form>
                      <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
                <!-- /.portlet --> 
              </div>
            </div>
            <!-- /.row (nested) --> 
          </div>
          <div class="col-lg-6">
            <div class="row"> 
              <!-- Basic Form Example -->
              <div class="col-lg-12">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> Show Data </h4>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <?php 
	
	if($totalRows_Recordset1 >0) {  ?>
                      <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                        <thead>
                          <tr>
                            <td>Surgery Name</td>
                            <td>Remarks</td>
                            <td>Date</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php do { ?>
                          <tr>
                            <td><?php echo $row_Recordset1['sur_name']; ?></td>
                            <td><?php echo $row_Recordset1['remarks']; ?></td>
                            <td><?php echo $row_Recordset1['date']; ?></td>
                            <td><a href="delsur.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $row_Recordset1['pid'];?>" class="btn-red btn"> <i class="fa fa-power-off"> Delete </i> </a></td>
                          </tr>
                          <?php } while ($row_Recordset1 = mysql_fetch_array($Recordset1)); ?>
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
          </div>
        </div>
      </div>
    </div>
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
mysql_free_result($Recordset1);
?>
