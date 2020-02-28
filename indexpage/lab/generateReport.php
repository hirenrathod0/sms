<?php require_once('../Connections/cn.php'); ?>
<?php 
mysql_select_db($database_cn, $cn);
$report_names = explode(",",$_GET["repName"]); 

if(isset($_GET['submit']))
{
	for($t=0;$t<count($_GET['results']);$t++)
	{
		 $h[]=$_GET['results'][$t];
	}
	$ll=$_GET["repName"];
	$jj=strpos($ll,',');
    $bb=explode(',',$_GET['repName']);
	foreach($bb as $_GET['repName'])
	{
	count($vv[]=$_GET['repName']);
	}
	$xx=$_GET['pid'];
	for($k=0;$k<count($vv);$k++)
	{
	 $insert="update doc_lab_report set reading='".$h[$k]."' where sel_rep_name='".$vv[$k]."' and pid='".$xx."'";
	mysql_query($insert);	
	}
echo '<meta http-equiv="refresh" content="0; url=reportPDF.php?pid='.$xx.'">';
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="600"  />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report-Doct Connect</title>
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
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
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
          <h1> Generate Report </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class=""> Queue Data </li>
            <li class="active"> Generate Report </li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <div class="row"> 
      <div class="col-lg-10" style="padding-left:20%;">
        <div class="row"> 
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Report Data </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                <form name="genReport" method="get" action="">
                  <?php //reportPDF.php 	
				foreach($report_names as $report_name){
				$sel_query = "SELECT rc.price,rd.investigation,rd.normalvalue FROM rep_cat as rc JOIN reportdata as rd ON rd.cid = rc.rid WHERE name='".$report_name."'";
$Recordset1 = mysql_query($sel_query, $cn) or die(mysql_error());  
$emptyTable = mysql_num_rows($Recordset1);	
?>
                  <label><?php echo $report_name;?></label>
                  <input type="hidden" name="repName[]" value="<?php echo $report_name; ?>">
                  <table class="table-green table-responsive table-green table-condensed table-bordered table">
                    <thead>
                      <tr>
                        <td> Inventigation </td>
                        <td> Results </td>
                        <td> Normal Value </td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  if($emptyTable >0 ){
					while($report_data = mysql_fetch_assoc($Recordset1)){ ?>
                      <tr>
                        <td><?php  echo $report_data["investigation"]; ?></td>
                        <td><input type="text" name="results[]" id="results" onblur="makeupper(this.id);"></td>
                        <td><?php  echo ($report_data["normalvalue"] != "") ?$report_data["normalvalue"] : "-"; ?></td>
                      </tr>
                      <?php  }  } else { ?>
                      <tr>
                        <td colspan="4">No Data Found</td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                  <?php } ?>
                  <input type="hidden" name="pid" value="<?php echo $_GET["pid"]; ?>"/>
                  <input type="hidden" name="repName" value="<?php echo $_GET["repName"]; ?>"/>
                  <input type="submit" value="Generate" class="btn btn-green" name="submit">
                  </div>
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
<script src="js/plugins/bootstrap/bootstrap.min.js"></script> 
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script> 
<script src="js/plugins/popupoverlay/defaults.js"></script> 
<script src="js/plugins/popupoverlay/logout.js"></script> 
<script src="js/plugins/hisrc/hisrc.js"></script> 
<script src="js/plugins/messenger/messenger.min.js"></script> 
<script src="js/plugins/messenger/messenger-theme-flat.js"></script> 
<script src="js/plugins/daterangepicker/moment.js"></script> 
<script src="js/plugins/daterangepicker/daterangepicker.js"></script> 
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script> 
<script src="js/plugins/morris/morris.js"></script> 
<script src="js/plugins/flot/jquery.flot.js"></script> 
<script src="js/plugins/flot/jquery.flot.resize.js"></script> 
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script> 
<script src="js/plugins/moment/moment.min.js"></script> 
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> 
<script src="js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script> 
<script src="js/demo/map-demo-data.js"></script> 
<script src="js/plugins/easypiechart/jquery.easypiechart.min.js"></script> 
<script src="js/plugins/datatables/jquery.dataTables.js"></script> 
<script src="js/plugins/datatables/datatables-bs3.js"></script> 
<script src="js/flex.js"></script> 
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
