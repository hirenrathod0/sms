<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
/* delete */
if ((isset($_GET['cid'])) && ($_GET['cid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM certificate WHERE id=%s",
                       GetSQLValueString($_GET['cid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "certificate.php";

  header(sprintf("Location: %s", $deleteGoTo));
}
/* end */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "usercat")) {
  $insertSQL = sprintf("INSERT INTO certificate (name) VALUES (%s)",
                       GetSQLValueString($_POST['cat'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "certificate.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_GET['remove'])) && ($_GET['remove'] != "")) {
  $deleteSQL = sprintf("DELETE FROM certificate WHERE id=%s",
                       GetSQLValueString($_GET['remove'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "usercat.php";
 
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_cn, $cn);
$query_usercat_list_rs = "SELECT * FROM certificate ORDER BY id DESC";
$usercat_list_rs = mysql_query($query_usercat_list_rs, $cn) or die(mysql_error());
$row_usercat_list_rs = mysql_fetch_assoc($usercat_list_rs);
$totalRows_usercat_list_rs = mysql_num_rows($usercat_list_rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Certificate- Doct Connect</title>
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
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<script type="text/javascript" language="javascript" >
   function makeupper(obj){
	var f=document.getElementById(obj).value;
	document.getElementById(obj).value=f.toUpperCase();}
	function  getc(id)
	{
        if( confirm('Are you sure you want to delete?'))
        {
			window.location='certificate.php?cid='+id;
		}
		else
		{
			return false;
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
          <h1>Certificate <small>Add/Manage</small> </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Home</a> </li>
            <li class="active">Certificate</li>
          </ol>
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
                  <h4>Add/Manage Certificate</h4>
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
                          <td><label for="exampleInputEmail1">Certificate Name</label></td>
                          <td><input type="text" class="form-control" name="cat" required="required" onblur="makeupper(this.id);" id="exampleInputEmail1"  placeholder="Certificate Name "></td>
                        </tr>
                      </div>
                      <tr>
                        <td align="center" colspan="2"><button type="submit" class="btn btn-default">Submit</button></td>
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
      <form name="listcat" >
        <div class="col-lg-6">
          <div class="portlet portlet-default">
            <div class="portlet-heading">
              <div class="portlet-title">
                <h4>View Certificate</h4>
              </div>
              <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample1"><i class="fa fa-chevron-down"></i></a> </div>
              <div class="clearfix"></div>
            </div>
            <div id="basicFormExample1" class="panel-collapse collapse in">
              <div class="portlet-body">
                <div class="table-responsive">
                  <?php if($totalRows_usercat_list_rs>0) { ?>
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; do { ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row_usercat_list_rs['name']; ?></td>
                          <td><a class="btn btn-orange" href="editcertificate.php?id=<?php echo $row_usercat_list_rs['id']; ?>"><i class="fa fa-edit"> </i></a>&nbsp;&nbsp;<a class="btn btn-danger" onclick="getc(<?php echo $row_usercat_list_rs['id']; ?>);"><i class="fa fa-times"> </i></a></td>
                        </tr>
                        <?php $i++; } while ($row_usercat_list_rs = mysql_fetch_assoc($usercat_list_rs)); ?>
                  </table>
                  </tbody>
                  </table>
                  <?php } else { ?>
                  <label class="label label-warning">No Certificate Available.</label>
                  <?php } ?>
                </div>
              </div>
            </div>
            </tbody>
            <!-- /.portlet --> 
          </div>
          </tbody>
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
mysql_free_result($usercat_list_rs);
?>
