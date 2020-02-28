<?php require_once('../Connections/cn.php'); ?><?php
require_once('../Connections/cn_vihar.php');
date_default_timezone_set('Asia/Calcutta');
$weekday = date('l'); 
mysql_select_db($database_cn, $cn);
 $query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '2' AND dday='$weekday' ");
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
		
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="30"  />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Running Queue-Doct Connect</title>
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
	<script>
var myVar=setInterval(function(){myTimer()},1000);

function myTimer() {
    var d = new Date();
	var x=null;
	
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();

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
          <h1> Current Queue Of Dr Samir Patel  </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Queue Data  </li>
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
                  <h4 style="float:left">    </h4>
				  
                </div>
               
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
				
	<?php $d=date("h:i A");  ?>
				<table class="table-green table-responsive table-green table-condensed table-bordered table">
				<thead>
				<tr>
					
					<td> Approximate Time </td>
					<td> Patient Name </td>
					<td> City/Village </td>
					<td> Mode Of Booking </td> 
					<td> Booking/Appointment Time </td>
				</tr>
				</thead>
                <?php 
				
mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT booking.pid,booking.bid,patient.fname,patient.mname,patient.lname,patient.pid,patient.city FROM booking inner join patient WHERE date(bdt) = CURDATE() and status='ACTIVE' and docid='2' limit 1";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
$bid=$row_Recordset2['bid'];

				 while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));
$s=date('g:i A', strtotime($date));
$n= date('d-m-Y');
mysql_select_db($database_cn, $cn);
 $query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='2'";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);



echo "<tr>";                                                                                                                                                                                                                                                     
if($totalRows_getctime==1){

echo "<td class='alert alert-success'> <strong> ".$d. "</td>";
echo "<td class='alert alert-success'> <strong>".$row_getctime['pname']. "</td>";
echo "<td class='alert alert-success'> <strong>".$row_getctime['pvillage']. "</td>";
echo "<td class='alert alert-success'> <strong>"."APPOINTMENT". "</td>";
echo "<td class='alert alert-success'> <strong>".$row_getctime['timeofapp']. "</td> ";
$d= date('h:i A', strtotime($d . ' + 15 minute'));
}
else
{
mysql_select_db($database_cn, $cn);
 $query_Recordset3 = "SELECT booking.pid,booking.bdt,
patient.fname,patient.mname,patient.lname,patient.pid,patient.city FROM booking inner join patient WHERE date(bdt) = CURDATE() and status='ACTIVE' and docid='2'  and booking.bid='$bid' and booking.pid=patient.pid ";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);


echo "<td>  ".$d . "</td> " ;
echo "<td>".$row_Recordset3['fname']."  ".$row_Recordset3['mname']."  ".$row_Recordset3['lname']. "</td>";
echo "<td>".$row_Recordset3['city']. "</td>";
echo "<td>". "WALK - IN ". "</td>";
echo "<td>".$row_Recordset3['bdt']. "</td>";
$bid=$bid+1;
$d= date('h:i A', strtotime($d . ' + 15 minute'));
 }
 echo "</tr>";
$t1=$date;

} ?> 
                
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


