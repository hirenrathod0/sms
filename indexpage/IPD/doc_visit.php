<?php require_once('../Connections/cn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
$pid=$_GET['pid'];	

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fcat")) {
  $hh1=date('d-m-Y');	
  $insertSQL = sprintf("INSERT INTO doc_rep (pid,dnm, chg,dt) VALUES ('$pid',%s, %s,'$hh1')",
                       GetSQLValueString($_POST['dnm'], "text"),
                       GetSQLValueString($_POST['chg'], "double"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "doc_visit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM doctor_chg";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_getlist = "SELECT * FROM doc_rep where pid='".$_GET['pid']."'";
$getlist = mysql_query($query_getlist, $cn) or die(mysql_error());
$row_getlist = mysql_fetch_assoc($getlist);
$totalRows_getlist = mysql_num_rows($getlist);
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
<script type="text/javascript">
		{
		  function chk(dd,pid)
	       {
				document.location="doc_visit.php?dd="+dd+"&pid="+pid;
	       }	
		}	
	</script>
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
          <h1>
            <?php 
		  mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='$pid'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h);
		  echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?>
          </h1>
          <?php include('button.php')?>
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
                  <h4>Doctor Form</h4>
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
                          <td nowrap align="left"><label for="exampleInputEmail1">Doctor Name</label></td>
                          <td><select class="form-control" id="dd" name="dnm" onchange="chk(this.value,<?php echo $_GET['pid']; ?>)" >
                              <option value="value">----Doctor Name----</option>
                              <?php
do {  
?>
                              <option value="<?php echo $row_Recordset1['dnm']?>" <?php if(isset($_GET['dd'])){ if($_GET['dd']==$row_Recordset1['dnm']){?> selected <?php } } ?>><?php echo $row_Recordset1['dnm']?></option>
                              <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>	
                            </select></td>
                      </div>
                      <div class="form-group">
                        <?php 
					   if(isset($_GET['dd']))
					   {
						   $h=$_GET['dd'];
					   mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM doctor_chg where dnm='$h'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

					   ?>
                        <tr valign="baseline">
                          <td nowrap align="left"><label for="exampleInputEmail1">Amount</label></td>
                          <td><input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Doctor Charges" onblur="makeupper(this.id);" required name="chg" value="<?php echo $row_Recordset2['chg']; ?>"  /></td>
                      </div>
                        </tr>
                      
                      <?php }?>
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
              <h4>Doctor Charges List</h4>
            </div>
            <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample1"><i class="fa fa-chevron-down"></i></a> </div>
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
                      <th>Doctor Name</th>
                      <th>Charges</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $k=0; do { ?>
                      <tr>
                        <td ><?php echo $k=$k+1; ?></td>
                        <td><?php echo $row_getlist['dnm']; ?></td>
                        <td><?php echo $row_getlist['chg']; ?></td>
                        <?php /*?><td><a href="edit_doc.php?id=<?php echo $row_getlist['id']; ?>" class="btn btn-info"><i class="fa fa-edit"> </i></a>
                         <a href="del_doc.php?id=<?php echo $row_getlist['id']; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
                      </tr><?php */?>
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
mysql_free_result($Recordset1);

mysql_free_result($getlist);
?>
