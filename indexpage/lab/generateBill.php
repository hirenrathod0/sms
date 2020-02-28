<?php require_once('../Connections/cn.php'); ?>
<?php 
mysql_select_db($database_cn, $cn);
$report_names = explode(",",$_GET["repName"]); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="600"  />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bill-Doct Connect</title>
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
<script type="text/javascript">
function get_discount(dc) {
	if(dc == ""){
		document.getElementById("total_d").innerHTML ="-"; 
		document.getElementById("td_txt").value = "";
		 
	} else {
		var tt=document.getElementById("total").value;
		var total_dis = document.getElementById("total").value-(eval(tt)*eval(dc))/100;
		document.getElementById("total_d").innerHTML = total_dis;
		document.getElementById("td_txt").value = total_dis; 
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
          <h1> Generate Bill   </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class=""> Queue Data  </li>
			<li class="active"> Generate Bill </li>
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
                  <h4 style="float:left">  Report Data  </h4>
				</div>
               <div class="clearfix"></div>
               </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
				<form name="genebill" method="post" action="billPDF.php">
								<table  class="table-green table-responsive table-green table-condensed table-bordered table">
					<thead>
						<tr>
							<td> No. </td>
							<td> Report Name </td>
							<td> Price </td>
 						</tr>      
					</thead>
					<tbody>
				<?php  	$i = 0;$total=0;  foreach($report_names as $report_name){
									$sel_query = "SELECT price FROM rep_cat WHERE name='".$report_name."'";
									$Recordset1 = mysql_query($sel_query, $cn) or die(mysql_error());  
									while($bill_data = mysql_fetch_assoc($Recordset1)){ 
								?>
										<tr>
											<td><?php  echo ++$i; ?></td>
											<td width="50%"><?php  echo $report_name; ?></td>
											<td><?php  echo $bill_data['price']; ?></td>
										</tr>
						<?php  $total += $bill_data['price']; }   ?>
				<?php } ?>	
				<tr><td colspan="2" align="right"><label>Total :</label></td>
							<td ><label><input type="text" value="<?php echo $total; ?>" id="total"/></label></td></tr> 
				<tr><td colspan="2" align="right"><label>Discount(if any) :</label></td>
					<td ><input type="text" name="discount" id="discount" style="width:50px;" onblur="get_discount(this.value);"><label>%</label></td>
				</tr>
				
				<tr><td colspan="2" align="right" ><label>Total with Discount :</label></td>
					<td><label id="total_d">-</label>
					<input id="td_txt" type="hidden" name="total_dis" value=""/>
					</td>
				</tr>			
				</tbody>
                </table>
				<input type="hidden" name="pid" value="<?php echo $_GET["pid"]; ?>"/>
				<input type="hidden" name="repName" value="<?php echo $_GET["repName"]; ?>"/>
				<input type="submit" value="Generate" class="btn btn-green"></div></form>
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

