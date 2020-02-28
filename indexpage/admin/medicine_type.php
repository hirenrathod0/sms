<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
/* get list start*/
mysql_select_db($database_cn, $cn);
$query_getlist = "SELECT * FROM medicinetype ORDER BY mtid DESC";
$getlist = mysql_query($query_getlist, $cn) or die(mysql_error());
$row_getlist = mysql_fetch_assoc($getlist);
$totalRows_getlist = mysql_num_rows($getlist);
/* end */

/* edit start*/
$colname_getedit = "-1";
if (isset($_GET['eid'])) {
  $colname_getedit = (get_magic_quotes_gpc()) ? $_GET['eid'] : addslashes($_GET['eid']);
}
mysql_select_db($database_cn, $cn);
$query_getedit = sprintf("SELECT * FROM medicinetype WHERE mtid = %s", $colname_getedit);
$getedit = mysql_query($query_getedit, $cn) or die(mysql_error());
$row_getedit = mysql_fetch_assoc($getedit);
$totalRows_getedit = mysql_num_rows($getedit);
/* end */
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
if ((isset($_GET['did'])) && ($_GET['did'] != "")) {
  $deleteSQL = sprintf("DELETE FROM medicinetype WHERE mtid=%s",
                       GetSQLValueString($_GET['did'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "medicine_type.php?msg=d";

  header(sprintf("Location: %s", $deleteGoTo));
}
/* end */
$editFormAction = $_SERVER['PHP_SELF'];
/*insert start */

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fcat")) {

  if($_POST['editid']){
  $gg=$_POST['editid'];
    $insertSQL = sprintf("update medicinetype set name=%s where mtid='$gg'",
                       GetSQLValueString($_POST['name'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "medicine_type.php?msg=e";
   header(sprintf("Location: %s", $insertGoTo));
  }
  else
  {
 
   $insertSQL = sprintf("INSERT INTO medicinetype (name) VALUES (%s)",
                       GetSQLValueString($_POST['name'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "medicine_type.php?msg=s";
   header(sprintf("Location: %s", $insertGoTo));
  
  
  }

 /* insert end*/


  
}
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
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<script type="text/javascript" language="javascript" >
	function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
	}
	function  getc(id)
	{
	
if( confirm('Are you sure you want to delete?'))
{

 window.location='medicine_type.php?did='+id;
    

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
         <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active">Medicine Form</li>
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
      <div class="col-lg-6">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h5>Create Medicine Form</h5>
                </div>
				<div class="pull-right">
					<a href="import.php" class="btn btn-danger">Import</a>
				</div>
				<div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form role="form" name="fcat" action="<?php echo $editFormAction; ?>" method="POST">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                      <div class="form-group">
                        <tr valign="baseline">
                          <td nowrap align="left"><label for="exampleInputEmail1">Medicine Form</label></td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Medicine Name " onblur="makeupper(this.id);" required name="name" value="<?php echo $row_getedit['name']; ?>"></td>
                      </div>
                      <input type="hidden" value="<?php echo $row_getedit['mtid']; ?>" name="editid" />
                      </tr>
                      
                      <tr valign="baseline">
                        <td nowrap colspan="2" align="center"><button type="submit"  class="btn btn-default">Save</button></td>
                      </tr>
                    </table>
                    <?php if(isset($_GET['msg'])){ 
					$hh=$_GET['msg'];
					?>
                    <?php if($hh=="s"){ ?>
                    <label class="alert alert-success" >Created Successfully </label>
                    <?php } ?>
                    <?php if($hh=="d"){ ?>
                    <label class="alert alert-success" >Deleted Successfully </label>
                    <?php } ?>
                    <?php if($hh=="e"){ ?>
                    <label class="alert alert-success" >Updated Successfully </label>
                    <?php } ?>
                    <?php }?>
                    <input type="hidden" name="MM_insert" value="fcat">
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
      </div>
      
      <!-- Bordered Responsive Table -->
      
      <div class="col-lg-6">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h5>Medicine Form List</h5>
            </div>
            <div class="portlet-widgets"> 
            <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample1"><i class="fa fa-chevron-down"></i></a> 
            
            </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample1" class="panel-collapse collapse in">
            <div class="portlet-body">
              <div class="table-responsive">
                <?php if($totalRows_getlist>0){ ?>
                <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Medicine Form</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $k=0; do { ?>
                      <tr>
                        <td ><?php echo $k=$k+1; ?></td>
                        <td><?php echo $row_getlist['name']; ?></td>
                        <td><a href="medicine_type.php?eid=<?php echo $row_getlist['mtid']; ?>" class="btn btn-info"><i class="fa fa-edit"> </i></a>
                          <button  type="button" class="btn btn-danger"	 onclick="getc(<?php echo $row_getlist['mtid']; ?>)" ><i class="fa fa-times"></i></button></td>
                      </tr>
                      <?php } while ($row_getlist = mysql_fetch_assoc($getlist)); ?>
                  </tbody>
                </table>
                <?php }else{ ?>
                <label class="alert alert-info"> NO DATA FOUND </label>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet --> 
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

<!-- THEME SCRIPTS --> 
<script src="js/flex.js"></script> 
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
<?php
mysql_free_result($getlist);

mysql_free_result($getedit);
?>
