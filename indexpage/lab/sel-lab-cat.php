<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_LAB']))
{
header('login.php');
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM rep_cat";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Lab Report-Doct Connect</title>
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
              <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                <li class="active"> Lab Report Category </li>
              </ol>
            </div>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        <!-- /.row --> 
        <div class="row">
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4>Select Report Form   &nbsp;&nbsp;&nbsp;     /    &nbsp;&nbsp;&nbsp;&nbsp;   Total Report &nbsp; </h4>
                </div>
                <!--<div class="portlet-widgets"> <a href="view-report.php"   class="label label-success " style="margin-right:20px;">View All Report</a><a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <div class="row pricing-basic">
                    <?php /*?>  <?php do { ?>
								<div class="col-md-4">
									<ul class="plan plan1">
										<li style="text-align:left;height:30px;" >
								
										</li>
									</ul>
								</div>
								 <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?><?php */?>
                    <table id="example-table">
                      <thead>
                        <tr>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="col-lg-6"><?php  
								   
$query_Recordset12 = "SELECT * FROM rep_cat";
$Recordset12 = mysql_query($query_Recordset12, $cn) or die(mysql_error());
$row_Recordset12 = mysql_fetch_assoc($Recordset12);
 $totalRows_Recordset12 = mysql_num_rows($Recordset12);
								   
								   do { 
								   ?>
                            <ul class="plan" style="float:left;width:250px;margin-right:20px;">
                              <li style="text-align:justify;height:30px;"  >
                                <input type="radio" name="<?php echo $row_Recordset12['rid']; ?>" onclick="document.location='labreport.php?id=<?php echo $row_Recordset12['rid']; ?>'"/>
                                &nbsp;&nbsp;&nbsp;<b><font color="#000000"><?php echo $row_Recordset12['name']; ?></font></b> </li>
                            </ul>
                            <?php  }while($row_Recordset12= mysql_fetch_assoc($Recordset12));  mysql_free_result($Recordset12);?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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
