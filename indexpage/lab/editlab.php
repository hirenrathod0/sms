<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_LAB']))
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE reportdata SET cid=%s, cname=%s, price=%s WHERE rid=%s",
                       GetSQLValueString($_POST['cid'], "int"),
                       GetSQLValueString($_POST['cname'], "text"),
                       GetSQLValueString($_POST['price'], "int"),
                       GetSQLValueString($_POST['rid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "labreport.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php require_once('../Connections/cn_vihar.php'); 
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM rep_cat";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
$colname_Recordset2 = "-1";
if (isset($_GET['rid'])) {
  $colname_Recordset2 = (get_magic_quotes_gpc()) ? $_GET['rid'] : addslashes($_GET['rid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset2 = sprintf("SELECT * FROM reportdata WHERE rid = %s", $colname_Recordset2);
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
              <h1> Add New Lab Report </h1>
              <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                <li class="active"> Lab Report </li>
              </ol>
            </div>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        <div class="row"> 
          <!-- begin LEFT COLUMN -->
          <div class="col-lg-6">
            <div class="row"> 
              <!-- Basic Form Example -->
              <div class="col-lg-12">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> New Lab Report </h4>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                     <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
                        <table align="center" class="table-responsive table-condensed table-bordered table">
                          <tr valign="baseline">
                            <td nowrap align="right">Category :</td>
                            <td><select name="cid">
                                <?php 
do {  
?>                         <option value="<?php echo $row_Recordset1['rid']?>" <?php if ((strcmp($row_Recordset1['rid'], $row_Recordset2['cid']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['name']?></option>
                                <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
                              </select></td>
                          <tr>
                          <tr valign="baseline">
                            <td>Report Name </td>
                            <td><input type="text" name="cname" value="<?php echo $row_Recordset2['cname']; ?>" size="32" placeholder="Enter Report Name " required class="form-control" onblur="makeupper(this.id);" id="fname"></td>
                          </tr>
                          <tr valign="baseline">
                            <td> Report Price </td>
                            <td><input type="number" name="price" value="<?php echo $row_Recordset2['price']; ?>" size="32" placeholder="Enter Report Price" required class="form-control" onblur="makeupper(this.id);" id="fname"></td>
                          </tr>
                          <tr valign="baseline">
                            <td colspan="2" align="center"><input type="submit" value="Submit"class="btn btn-green"></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form2">
                        <input type="hidden" name="rid" value="<?php echo $row_Recordset2['rid']; ?>">
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
mysql_free_result($Recordset2);
?>
