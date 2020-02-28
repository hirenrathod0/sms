<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_Username']))
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "userauth")) {
  $insertSQL = sprintf("INSERT INTO userlogin (uid, username, password, type) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['type'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "userlist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doct Connect</title>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="css/plugins/messenger/messenger.css" rel="stylesheet">
<link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
<link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="css/plugins/morris/morris.css" rel="stylesheet">
<link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
<link href="css/plugins/datatables/datatables.css" rel="stylesheet">
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
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1>User/Employee  <small>Authentication</small> </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Home</a> </li>
            <li class="active">Authentication</li>
       	 </ol>		
        </div>	
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4>Add User/Employee  Authentication</h4>
                </div>
				
                <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
				
				
				
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" action="<?php echo $editFormAction; ?>" role="form" name="userauth">
                    <div class="form-group">
                      <label for="exampleInputEmail1">User Name</label>
                      <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="Password">
                    </div>
					
				<input type="hidden" name="id" value=" <?php echo  $_GET['id'] ?> "  />
				<input type="hidden" name="type" value=" <?php echo $_GET['type'] ?> "/>
					
					<button type="submit" class="btn btn-default">Submit</button>
                    <input type="hidden" name="MM_insert" value="userauth">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
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

    <!-- THEME SCRIPTS -->
    <script src="js/flex.js"></script>
    <script src="js/demo/dashboard-demo.js"></script>
</html>
