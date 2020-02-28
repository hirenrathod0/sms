<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_RECEPTION']))
{
header('login.php');
}
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm")) {
  $insertSQL = sprintf("INSERT INTO booking (docid, pid, status) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['dctr'], "int"),
                       GetSQLValueString($_POST['hpid'], "int"),
					   GetSQLValueString('ACTIVE', "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

 $insertGoTo = "allbooking.php";
 
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cn, $cn);
$query_dctr = "SELECT * FROM `user` WHERE type = 'doctor'";
$dctr = mysql_query($query_dctr, $cn) or die(mysql_error());
$row_dctr = mysql_fetch_assoc($dctr);
$totalRows_dctr = mysql_num_rows($dctr);

$colname_totalvisit = "-1";
if (isset($_GET['pid'])) {
  $colname_totalvisit = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_totalvisit = sprintf("SELECT * FROM booking WHERE pid = %s", GetSQLValueString($colname_totalvisit, "int"));
$totalvisit = mysql_query($query_totalvisit, $cn) or die(mysql_error());
$row_totalvisit = mysql_fetch_assoc($totalvisit);
 $totalRows_totalvisit = mysql_num_rows($totalvisit);


mysql_select_db($database_cn, $cn);
$pid=$_GET['pid'];
$query_Recordset1 = "SELECT * FROM patient where pid='$pid'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
          <h1> Patient Detail </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage Patient Booking </li>
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
                  <h4 style="float:left"> Patient Details </h4>
                </div>
                <div class="portlet-widgets">  </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset1>0) {  ?>
                  <table id="example-table" style="width:auto" align="center" class="table table-striped table-bordered table-hover table-green">
                    <thead> </thead>
                    <tbody>
                     <?php do { ?>
                      <tr>
                        <td>Patient Id</td>  <td><?php echo $row_Recordset1['pid']; ?>&nbsp; </td>
                         </tr>
                        <tr> <td>First Name</td> <td><?php echo $row_Recordset1['fname']; ?>&nbsp; </td>
                          </tr>
                         <tr><td>Last Name</td> <td><?php echo $row_Recordset1['lname']; ?>&nbsp; </td>
                          </tr>
                    <tr>     <td> Age </td><td><?php echo($row_Recordset1['bdate']); //put date in the dd-mm-yyyy format
?>
  </td>
             </tr>
                     <tr>    <td>City</td>     <td><?php echo $row_Recordset1['city']; ?>&nbsp; </td> </tr>
                     <tr>    <td>Gender</td> <td><?php echo $row_Recordset1['gender']; ?>&nbsp; </td> </tr>
					  <tr>    <td>Blood Group</td> <td><?php echo $row_Recordset1['bgroup']; ?>&nbsp; </td> </tr>
                        
                      </tr>
                   
                     
                     <tr style="font-weight:bolder"><td>Total No.of Visit</td><td><?php echo $totalRows_totalvisit ?></td></tr>
                       <tr><td colspan="2"> <div class="portlet-body">
                <form action="<?php echo $editFormAction; ?>" name="frm" method="POST">
					<select name="dctr">
                    <option>Select Doctor</option>
					  <?php
do {  
?>
					  <option value="<?php echo $row_dctr['uid']?>"><?php echo $row_dctr['fullname']?></option>
					  <?php
} while ($row_dctr = mysql_fetch_assoc($dctr));
  $rows = mysql_num_rows($dctr);
  if($rows > 0) {
      mysql_data_seek($dctr, 0);
	  $row_dctr = mysql_fetch_assoc($dctr);
  }
?>
					 
                     </select>    
                     <input type="hidden" name="hpid" value="<?php echo $pid; ?>" />            
                <input  type="submit" class="btn btn-success"/>
                <input type="hidden" name="MM_insert" value="frm" />
                </form>
                </div></td></tr>
                        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                    </tbody>
                  </table>
                  <?php } else {  ?>
                  <label class="alert-danger"> NO DATA FOUND </label>
                  <?php } ?>
                </div>
              
              </div>
            </div>
            
            
            
            
            <!-- /.portlet -->
            
            
            
          
        <!-- /.row (nested) -->
       
 
<!-- Modal -->

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
mysql_free_result($dctr);

mysql_free_result($totalvisit);

mysql_free_result($Recordset1);
?>
