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

$tt=$_GET['pid'];
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT dtofadd,id FROM follow where pid='$tt'";

$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$ss=$row_Recordset1['id'];


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "usercat")) {
  $insertSQL = sprintf("INSERT INTO follow_day (fid,pid,add_date,days) VALUES (%s,%s,%s,%s)",
                 GetSQLValueString($_POST['fid'], "text"),
				 GetSQLValueString($_POST['pid'], "text"),
				 GetSQLValueString($_POST['add_date'], "text"),
				 GetSQLValueString($_POST['day'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "followp.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM follow_day where pid='$tt'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doctor - Doct Connect</title>
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
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-5">
        <div class="page-title">
          <h1>Follow Up </h1>
          <?php include("button.php"); ?>
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
                  <h4>Add Follow Up Days</h4>
                </div>
                <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" action="<?php echo $editFormAction; ?>" role="form" name="usercat">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                      <div class="form-group">
                        <tr>
                          <td><label for="exampleInputEmail1">Enter Day After They Came :</label></td>
                          <td><input type="text" class="form-control" name="day" required="required" placeholder="Enter Day.."></td>
                        </tr>
                        <input  type="hidden" value="<?php echo $row_Recordset1['dtofadd']; ?>"	name="add_date" />
                        <input  type="hidden" value="<?php echo $_GET['pid']; ?>"	name="pid" />
                        <input  type="hidden" value="<?php echo $row_Recordset1['id']; ?>"	name="fid" />
                      </div>
                      <tr>
                        <td align="center" colspan="2"><button type="submit"  name="submit" class="btn btn-default">Submit</button></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="usercat">
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
      </div>
      
      <!-- Condensed Responsive Table -->
      <form name="listcat" >
        <div class="col-lg-6">
          <div class="portlet portlet-default">
            <div class="portlet-heading">
              <div class="portlet-title">
                <h4>List Follow up </h4>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="portlet-body">
              <div class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <td>#</td>
                      <td>Entry Date</td>
                      <td>Follow Up Days </td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; do { ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php 
	$sdate=strftime('%d-%m-%Y',strtotime($row_Recordset2['add_date']));
		echo $sdate;
			
							 ?></td>
                        <td><?php echo $yy=$row_Recordset2['days']; ?></td>
                        <td></td>
                      </tr>
                      <?php $i++; } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                </table>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.portlet --> 
        </div>
      </form>
      <!-- /.col-lg-6 --> 
      
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
<?php

$cn=mysqli_connect("localhost","root","","doc_connect");


if(isset($_POST['submit']))
{
	$cc=$yy-1;
	$Today=$sdate;
	$vb=Date('d-m-Y', strtotime("+$cc days"));



	$r="insert into 				follow_count(fid,add_date,day,noday)values('$ss','$sdate','$yy','$vb')";
	@mysqli_query($cn,$r); 
}

?>
