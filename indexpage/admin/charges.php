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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("INSERT INTO ipd_chg(name,price) VALUES(%s,%s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['price'], "text")
                      
                      );

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "charges.php";
  
  header(sprintf("Location: %s", $updateGoTo));
}
mysql_select_db($database_cn, $cn);
$query_fee = "SELECT * FROM ipd_chg";

$fee = mysql_query($query_fee, $cn) or die(mysql_error());
$row_fee = mysql_fetch_assoc($fee);

  $all_fee = mysql_query($query_fee);
  $totalRows_fee = mysql_num_rows($fee);



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
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/flex.js"></script>
	<script src="js/demo/advanced-tables-demo.js"></script>
	<script src="js/plugins/datatables/jquery.dataTables.js"></script>
	<script src="js/plugins/datatables/datatables-bs3.js"></script>
	<script type="text/javascript" language="javascript" >
	 
	 function makeupper(obj)
	{
	
	
var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
	}
	
	function  getc(id)
	{
	
if( confirm('are you sure you want to delete?'))
{

 window.location='charges.php?did='+id;
    

}
else
{
return false;
}
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
              <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                <li class="active">IPD Charges</li>
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
              <div class="col-lg-6">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h5>Charges Detail</h5>
                    </div>
                    <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#inlineFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="inlineFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body" style="overflow:scroll">
                      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                        <table align="center" class="table table-striped table-hover table-responsive">
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Name:</td>
                            <td><input class="form-control" type="text" name="name" placeholder="ENTER NAME OF CHARGE" value="" size="32" id="name" onblur="makeupper(this.id);"  /></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Price:</td>
                            <td><input type="number" class="form-control" name="price" value="" placeholder="ENTER PRICE" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td align="center"><input type="submit" value="Insert" class="btn btn-success" /></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form1" />
                      </form>
                      <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
                <!-- /.portlet --> 
              </div>
              <div class="col-lg-6">
                <div class="row"> 
                  <!-- Basic Form Example -->
                  <div class="col-lg-12">
                    <div class="portlet portlet-default">
                      <div class="portlet-heading">
                        <div class="portlet-title">
                          <h5 style="float:left">IPD Charges Details </h5>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div id="basicFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body" style="overflow:scroll">
                          <?php if($totalRows_fee>0) {  ?>
                          <table id="example-table" class=" table table-striped table-bordered table-hover table-green">
                            <thead>
                              <tr>
                                <td>Id</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Action</td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php do { ?>
                                <tr>
                                <td><?php echo $row_fee['id']; ?></td>
                                <td><?php echo $row_fee['name']; ?></td>
                                <td><?php echo $row_fee['price']; ?></td>
                                <td><a href="deletefee1.php?id=<?php echo $row_fee['id']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-times"></i></a></td>
                              </tr>
                                <?php } while ($row_fee = mysql_fetch_assoc($fee)); ?>
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
            <!-- /.row (nested) --> 
          </div>
        </div>
        <div class="row"> 
          
          <!-- Bordered Responsive Table --> 
          
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

    <!-- THEME SCRIPTS --> 
    <script src="js/flex.js"></script> 
    <script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
