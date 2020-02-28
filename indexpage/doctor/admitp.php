<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = funct ion_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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



$maxRows_patient = 10;
$pageNum_patient = 0;
if (isset($_GET['pageNum_patient'])) {
  $pageNum_patient = $_GET['pageNum_patient'];
}
$startRow_patient = $pageNum_patient * $maxRows_patient;

$colname_patient = "-1";
if (isset($_GET['pid'])) {
  $colname_patient = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_patient = sprintf("SELECT * FROM patient WHERE pid = %s", GetSQLValueString($colname_patient, "int"));
$query_limit_patient = sprintf("%s LIMIT %d, %d", $query_patient, $startRow_patient, $maxRows_patient);
$patient = mysql_query($query_limit_patient, $cn) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);

if (isset($_GET['totalRows_patient'])) {
  $totalRows_patient = $_GET['totalRows_patient'];
} else {
  $all_patient = mysql_query($query_patient);
  $totalRows_patient = mysql_num_rows($all_patient);
}
$totalPages_patient = ceil($totalRows_patient/$maxRows_patient)-1;

mysql_select_db($database_cn, $cn);
$query_dctr = "SELECT * FROM `user` WHERE type = 'DOCTOR'";
$dctr = mysql_query($query_dctr, $cn) or die(mysql_error());
$row_dctr = mysql_fetch_assoc($dctr);
$totalRows_dctr = mysql_num_rows($dctr);

 $bed=$_GET['id'] ; 
 $pid=$_GET['pid'];
 $room=$_GET['rooms'];
 
  $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm")) {
	
  $insertSQL = sprintf("INSERT INTO patient_admit (bedno,fname,mname,lname,pid,gender,drname,rtype) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString($bed, "text"),
					   GetSQLValueString($_POST['fname'], "text"),
					   GetSQLValueString($_POST['mname'], "text"),
					   GetSQLValueString($_POST['lname'], "text"),
					   GetSQLValueString($pid, "text"),
					   GetSQLValueString($_POST['gender'], "text"),
					   GetSQLValueString($_POST['dctr'], "text"),
					   GetSQLValueString($room, "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "allpatients.php";
  header(sprintf("Location: %s", $insertGoTo));
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admit Patient-Doct Connect</title>
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
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script language="javascript">
$(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailpatients.php", {recordID:eval(g)}, function (data) {
                    $("#dta").html(data);
                });
	$(_self.attr('href')).modal('show');
});
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
          <h1> Patient Admit </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Patients Admit </li>
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
                  <h4 style="float:left"> Patient Admit </h4>
                </div>
                <div class="portlet-widgets">  </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" align="center">
                <form action="<?php echo $editFormAction; ?>" method="POST" name="frm" >
                  <table border="1" class="table-bordered table-condensed table-green table-hover table-responsive">
                     <?php do { ?> <tr>
                      <td>Patient Id</td><td><?php echo $row_patient['pid']; ?></td></tr>
                     <tr><td>First Name</td>
                     <td><?php echo $row_patient['fname']; ?> <input type="hidden" name="fname" value="<?php echo $row_patient['fname']; ?>" /></td></tr>
                      <tr><td>Middle Name</td>
                      <td><?php echo $row_patient['mname']; ?><input type="hidden" name="mname" value="<?php echo $row_patient['mname']; ?>" /></td></tr>
                     <tr><td>Last Name</td>
                     <td><?php echo $row_patient['lname']; ?><input type="hidden" name="lname" value="<?php echo $row_patient['lname']; ?>" /></td></tr>
                      <tr> <td>B'Date</td> <td><?php echo $row_patient['bdate']; ?></td></tr>
                      <tr> <td>City</td><td><?php echo $row_patient['city']; ?></td></tr>
                      <tr> <td>Contact no1</td> <td><?php echo $row_patient['contactno1']; ?></td></tr>
                       <tr><td>Contact no2</td> <td><?php echo $row_patient['contactno2']; ?></td></tr>
                      <tr> <td>Email Id</td><td><?php echo $row_patient['emailid']; ?></td></tr>
                       <tr><td>Gender</td> <td><?php echo $row_patient['gender']; ?><input type="hidden" name="gender" value="<?php echo $row_patient['gender']; ?>" /></td></tr>
                       <tr><td>Room Type</td><td><?php echo $_GET['rooms']; ?></td></tr>
                    <tr><td>Select Doctor</td><td><select name="dctr">
                    <option>Selct Doctor</option>
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
                    </select></td></tr>
                    <tr><td colspan="2"><div align="center"><input type="submit" class="btn btn-success" /></div></td></tr>
                    </tr>
                 
                       
                      <?php } while ($row_patient = mysql_fetch_assoc($patient)); ?>
                  </table>
                  <input type="hidden" name="MM_insert" value="frm" />
                  </form>
                </div>
              
              </div>
            </div>
            <!-- /.portlet -->
          </div>
         
        </div>
        <!-- /.row (nested) -->
       
 
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  
  <div class="modal-body" id="dta">
   
  </div>
 
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
mysql_free_result($patient);

mysql_free_result($dctr);


?>
