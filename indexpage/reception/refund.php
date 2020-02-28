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
  $insertSQL = sprintf("update refund_dtl set amount=%s , date=%s where pid=%s and catename=%s ",
                       
                       GetSQLValueString($_POST['amount'], "double"),
                       GetSQLValueString($_POST['ddate'], "text"),
					   GetSQLValueString($_GET['pid'], "int"),
                       GetSQLValueString($_POST['catename'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
}
$dd=$_GET['pid'];
mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM refund_dtl where pid='$dd'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Patient-Doct Connect</title>
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
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">	
        <div class="page-title">
          <h1> Extra Income </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Add New Income </li>
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
                  <h4 style="float:left"> New Refund </h4>
				  
                </div>
              
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" name="form1" action="<?php echo $editFormAction; ?>" id="f1">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                      <tr valign="baseline">
                       
                        <td nowrap ><strong>Refund Type:</strong></td>
                        <td>
                        <select name="catename" class="form-control">
                          <option value="" <?php if (!(strcmp("", $row_Recordset2['catename']))) {echo "selected=\"selected\"";} ?>>----Select-----</option>
                          <option value="" <?php if (!(strcmp("", $row_Recordset2['catename']))) {echo "selected=\"selected\"";} ?>>Lab </option>
                          <option value="" <?php if (!(strcmp("", $row_Recordset2['catename']))) {echo "selected=\"selected\"";} ?>>X-Ray </option>
                          <option value="" <?php if (!(strcmp("", $row_Recordset2['catename']))) {echo "selected=\"selected\"";} ?>>OPD </option>
                          <option value="" <?php if (!(strcmp("", $row_Recordset2['catename']))) {echo "selected=\"selected\"";} ?>>IPD </option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_Recordset2['catename']?>"<?php if (!(strcmp($row_Recordset2['catename'], $row_Recordset2['catename']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['catename']?></option>
                          <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
                        </select>
                        </td>
                         </tr>
                         <tr valign="baseline">
                        <td nowrap ><strong>Deposit Amount:</strong></td>
                        <td><input type="text" name="depo_amount" value="<?php echo $row_Recordset2['depo_amt']; ?>" class="form-control" readonly="readonly"></td>
                        </tr>
					   <tr valign="baseline">
                        <td nowrap ><strong>Amount:</strong></td>
                        <td><input type="text" name="amount" value="" size="30" class="form-control"></td>
                        </tr>
                    
                       <tr valign="baseline">
                        <td nowrap ><strong>Date:</strong></td>
                        <td><input type="text" name="ddate" value="" size="30" class="form-control" placeholder="dd-mm-yy"></td>
                        </tr>
                     
                      
                      
        
                      
  
                      <tr valign="baseline">
                        
                        <td colspan="4" align="center"><input type="submit" value="Submit" class="btn btn-green " name="submit"></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                     </form>
                  <p>&nbsp;</p>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div> <div class="col-lg-6">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient Details </h4>
                </div>
                
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset2>0) {  ?>

				  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed"   >
                    <thead>
                      <tr>
                        <td>Id</td>
                        <td>Date</td>
                        <td>Refund Type</td>
                        <td>Patient Id</td>
                        <td>Amount</td>
                       </tr>
                    </thead>
					 <tbody>
                    <?php $i=1; do {  ?>
                     <tr>
					 <td><?php echo $i; ?> </td>
                     <td><?php echo $row_Recordset2['date']; ?></td>
                     <td><?php echo $row_Recordset2['catename']; ?></td>
					 <td><?php echo $row_Recordset2['pid']; ?></td>
                    <td><?php echo $row_Recordset2['amount']; ?></td>
                    </tr>
                      <?php $i++;} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
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

mysql_free_result($Recordset1);
?>
