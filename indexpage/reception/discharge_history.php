<?php require_once('../Connections/cn.php'); ?>
<?php date_default_timezone_set("Asia/Kolkata");
mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM patient_admit WHERE status = 'Discharge' order by dofdischarge desc ";
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
	var g=_self.data('id');
   $.get("detailpatient.php", {recordID:eval(g)}, function (data) {
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
          <h1> All Patients </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage Patients </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Discharge Patients Details </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>

              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset2>0) {  ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green table-condensed">
                    <thead>
                      <tr>
                        <td>#</td>
                        <td>Case No</td>
                        <td>First Name</td>
                        <td>City</td>
                        <td>Discharge Date </td>
                        <td>Action </td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; do {
					$cc=$row_Recordset2['pid'];
mysql_select_db($database_cn, $cn);
$query_Recordset3 = "SELECT * FROM patient where pid='$cc'";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3); ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td width="5%"><?php echo $row_Recordset2['aid']; ?></td>
                          <td width="35%"><?php echo $row_Recordset2['fname'].' '.$row_Recordset2['mname'].' '.$row_Recordset2['lname']; ?></td>
                          <td width="15%"><?php echo $row_Recordset3['city']; ?></td>
                          <td width="15%"><?php echo date("d/m/Y",strtotime($row_Recordset2['dofadmit'])); ?></td>
                          <td>
<?php $qq="select status from billhistry where pid='".$row_Recordset2['pid']."' and status!='PENDING'";	   
	   $q4=mysql_query($qq);
	   $qq1=mysql_num_rows($q4);   
	   if($qq1==0)   {?>
	   <a href="printbill.php?pid=<?php echo  $row_Recordset3['pid']; ?>" class="btn-info btn">Generate Bill</a>
	<?php }else { echo "<p class='alret alert-success'>Bill Genrated..</p>";?> <?php }?> <a href="bill_print1.php?pid=<?php echo  $row_Recordset3['pid']; ?>" class="btn-success btn ">View</a></td> </tr>
     <?php $i++;} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
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
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta"> </div>
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
