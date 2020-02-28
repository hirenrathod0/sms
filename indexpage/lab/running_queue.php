<?php require_once('../Connections/cn.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="600"  />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Running Queue- Doct Connect</title>
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
            <li class="active"> All Patients Report</li>
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
                  <h4 style="float:left">  Today's Running Queue  </h4>
				  
                </div>
               
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
				<table id="example-table" class="table-green table-responsive table-green table-condensed table-bordered table">
					<thead>
						<tr>
                        
							<td> Case No</td>
							<td> Patient Name </td>
							<td> Reports </td>
							<td> Remarks </td> 
							<td> &nbsp </td>
						</tr>      
					</thead>
					<tbody>
						<?php mysql_select_db($database_cn, $cn);
						//	$query_Recordset1 = "SELECT  doc_lab_report.pid,GROUP_CONCAT(doc_lab_report.sel_rep_name SEPARATOR','),doc_lab_report.remark,patient.fname,patient.mname,patient.lname FROM doc_lab_report JOIN patient ON patient.pid=doc_lab_report.pid WHERE date(doc_lab_report.created_date) ='".date("Y-m-d")."' GROUP BY doc_lab_report.pid";
//$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());

$query_Recordset1 = "SELECT  doc_lab_report.pid,GROUP_CONCAT(doc_lab_report.sel_rep_name SEPARATOR','),doc_lab_report.remark,patient.fname,patient.mname,patient.lname FROM doc_lab_report JOIN patient ON patient.pid=doc_lab_report.pid  GROUP BY doc_lab_report.pid";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
						while($row = mysql_fetch_assoc($Recordset1)) { ?> 
						<tr>
						<td width="5%"><?php echo $row["pid"]; ?></td>
							<td><?php echo $row["fname"]." ".$row["mname"][0]." ".$row["lname"]; ?></td>
							<td style="width:35%;"><?php echo $row["GROUP_CONCAT(doc_lab_report.sel_rep_name SEPARATOR',')"]; ?></td>
							<td style="width:20%;"><?php echo ($row["remark"] != "") ? $row["remark"] : "-"; ?></td>
							<td><a data-id="1" title="Generate Report" class="open-AddBookDialog btn btn-info" href="generateReport.php?pid=<?php echo $row["pid"]; ?>&repName=<?php echo $row["GROUP_CONCAT(doc_lab_report.sel_rep_name SEPARATOR',')"]; ?>" style="height:auto;width:auto"><i class="fa fa-paperclip"> Generate Report</i></a>
							
							<a data-id="1" title="Generate Bill" class="open-AddBookDialog btn btn-warning" href="generateBill.php?pid=<?php echo $row["pid"]; ?>&repName=<?php echo $row["GROUP_CONCAT(doc_lab_report.sel_rep_name SEPARATOR',')"]; ?>" style="height:auto;width:auto"><i class="fa fa-paperclip"> Generate Bill</i></a></td>
						</tr>
						<?php } ?>
					</tbody>
                </table>
                </div>
              </div>
			  <?php if(isset($_GET['msg'])){
			  			if($_GET['msg'] == "sreport"){ ?>
						<label class="alert alert-success" style="margin-left:15px;">PDF is created Successfully </label>
			  <?php }elseif($_GET['msg'] == "sbill"){ ?>
			  <label class="alert alert-success" style="margin-left:15px;">Bill is created Successfully </label>
		<?php	  } }?>
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


