<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_Recordset1 = "-1";
if (isset($_GET['Doctor'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['Doctor'] : addslashes($_GET['Doctor']);
}
mysql_select_db($database_cn, $cn);
 echo $query_Recordset1 = sprintf("SELECT * FROM `user` WHERE type = 'Doctor'", $colname_Recordset1);
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
<script language="javascript" type="text/javascript">
function check(item)
{

window.location='settime.php?did='+item;

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
      <h1> Appointment </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
        <li class="active">Select Doctor</li>
      </ol>
    </div>
  </div>
  
             
                <?php do { ?>
				
				<div class="col-lg-4">
    <div class="portlet portlet-default">
      <div class="portlet-heading">
        <div class="portlet-title">
          
        </div>
        <div class="portlet-widgets">
          <ul id="myPortletTab" class="list-inline tabbed-portlets">
           
           
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="portlet-body">
        <div id="myPortletTabContent" class="tab-content">
          <div class="tab-pane fade in active" id="tab1">
            <div class="table-responsive dashboard-demo-table">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                
                </thead>
               
                  <tbody>
                    <tr>
                      <td ><input align="middle" name="rb1" type="radio" value="<?php echo $row_Recordset1['uid']; ?>" onclick="check(this.value)" />
                        &nbsp;&nbsp;<strong><?php echo $row_Recordset1['fullname']; ?></strong></td>
                     
                    </tr>
                  </tbody>
                 
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
                 
                  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
              
           
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
