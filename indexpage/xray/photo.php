<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_xray']))
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$tt=$_GET['pid'];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	$bb=$_FILES['photo']['name'];
	//$nn=implode(',',$bb);
	$nm = count($_FILES['photo']['tmp_name']);
	$hh=$_GET['pid'];
	for($i=0;$i<$nm;$i++)
	{
		
		$bb1=$_FILES['photo']['name'][$i];
 move_uploaded_file($_FILES['photo']['tmp_name'][$i],'xray/'.$_FILES['photo']['name'][$i]);
	

  $insertSQL = sprintf("insert into xray_photo (photo,xid)values('$bb1','$hh')");
//exit;
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
	}
  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
	<script>
	function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
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
              <h1> Upload X-ray of Patient </h1>
              <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                <li class="active"> Upload X-ray of Patient </li>
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
          <div class="col-lg-8">
            <div class="row"> 
              <!-- Basic Form Example -->
              <div class="col-lg-12">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> Upload X-ray of Patient</h4>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form method="POST" name="form1" action="<?php echo $editFormAction; ?>" id="f1" enctype="multipart/form-data">
                        <table align="center" class="table-responsive table-condensed table-bordered table ">
                          <tr valign="baseline">
                            <td nowrap align="right"><strong> Category Name:</strong></td>
                            <td><input type="file" name="photo[]" value="" size="32" required  id="fname" multiple="multiple"></td>
                          </tr>
                          <tr valign="baseline">
                            <td colspan="2" align="center"><input type="submit" value="Submit" class="btn btn-green "></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1">
                      </form>
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
