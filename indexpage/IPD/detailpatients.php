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
} ?>
<?php
if(!isset($_SESSION['MM_Nurse']))
{
header('login.php');
} ?>
<?php
$ii=$_GET['pid'];
$kk=$_GET['mid'];
$uu=$_GET['id'];
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM p_medicine where pid='$ii' and mid='$kk' and id='$uu'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset2 = $_GET['id'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset2 = sprintf("SELECT * FROM morning WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset3 = $_GET['id'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset3 = sprintf("SELECT * FROM afternoon WHERE id = %s", GetSQLValueString($colname_Recordset3, "int"));
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$colname_Recordset4 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset4 = $_GET['id'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset4 = sprintf("SELECT * FROM evening WHERE id = %s", GetSQLValueString($colname_Recordset4, "int"));
$Recordset4 = mysql_query($query_Recordset4, $cn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$colname_Recordset5 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset5 = $_GET['id'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset5 = sprintf("SELECT * FROM night WHERE id = %s", GetSQLValueString($colname_Recordset5, "int"));
$Recordset5 = mysql_query($query_Recordset5, $cn) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

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
<script language="javascript">
$(document).on("click", ".open-AddBookDialog1", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailcertificate.php", {recordID:eval(g)}, function (data) {
                    $("#dta1").html(data);
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
          <div class="col-lg-8">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Medicine Details </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div id="basicFormExample" class="panel-collapse collapse in">
                  <div class="portlet-body">
                    <table  align="center"  class="table-hover table-responsive table-condensed table-bordered " style="width:100%">
                      <tr>
                        <td> Medicine</td>
                        <td><input type="text" name="" value="<?php 
						$nm=$row_Recordset1['mid'];						
						mysql_select_db($database_cn, $cn);
$query_Recordset21 = "SELECT name FROM medicine where mid='$nm'";
$Recordset21 = mysql_query($query_Recordset21, $cn) or die(mysql_error());
$row_Recordset21 = mysql_fetch_assoc($Recordset21);
$totalRows_Recordset21 = mysql_num_rows($Recordset21);
echo $row_Recordset21['name'];?>" readonly="readonly" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>No of Days</td>
                        <td><input type="text" value="<?php echo $row_Recordset1['noofdays']; ?>" class="form-control"  id="noofdays"   name="noofdays" readonly="readonly" /></td>
                      </tr>
                      <tr>
                      <tr>
                        <td>Dosage</td>
                        <td><table>
                            <?php 
									$io=$row_Recordset1['dosage'];
									 $tt=explode("-",$io);
									?>
                            <?php if($tt[0]!=""){?>
                            <tr align="center">
                              <form name='f1' method="get" action="ans1.php">
                                <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
                                <input type="hidden" name="mid" value="<?php echo $row_Recordset1['mid']; ?>" />
                                <input type="hidden" name="pid" value="<?php echo $row_Recordset1['pid']; ?>" />
                                <td class="alert alert-info">Morning</td>
                                <td><input type="number" onchange="" class="form-control txt" id="dosageM" value="<?php echo $tt[0];?>" name="dosageM"/ readonly="readonly"></td>
                                <td><input type="submit" value="Ok" name="ok1" class="btn btn-danger"/></td>
                                <td class="alert alert-success"><?php echo $row_Recordset2['status']; ?></td>
                              </form>
                            </tr>
                            <?php }?>
                            <?php if($tt[1]!="0"){?>
                            <tr>
                              <form name='f2' method="get" action="ans2.php">
                                <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>"  />
                                <input type="hidden" name="mid" value="<?php echo $row_Recordset1['mid']; ?>" />
                                <input type="hidden" name="pid" value="<?php echo $row_Recordset1['pid']; ?>" />
                                <td  class="alert alert-info">After Noon</td>
                                <td><input type="number" class="form-control txt" id="dosageA"  value="<?php echo $tt[1];?>" name="dosageA"readonly="readonly" />
                                <td><input type="submit" value="Ok"  class="btn btn-danger" name="ok2"/></td>
                                <td class="alert alert-success"><?php echo $row_Recordset3['status']; ?></td>
                              </form>
                            </tr>
                            <?php }?>
                            <?php if($tt[2]!="0"){?>
                              <tr>
                            
                              <form name='f3' method="get" action="ans3.php">
                            
                            <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
                            <input type="hidden" name="mid" value="<?php echo $row_Recordset1['mid']; ?>" />
                            <input type="hidden" name="pid" value="<?php echo $row_Recordset1['pid']; ?>" />
                            <td class="alert alert-info">Evening</td>
                            <td><input type="number" class="form-control txt" id="dosageE"value="<?php echo $tt[2];?>" name="dosageE" readonly="readonly"/>
                            <td><input type="submit" value="Ok" class="btn btn-danger" name="ok3"/></td>
                            <td class="alert alert-success"><?php echo $row_Recordset4['status']; ?></td>
                              </tr>
                            
                            <?php }?>
                            <?php if($tt[3]!="0"){?>
                            <tr align="center" >
                              <form name='f4' method="get" action="ans4.php">
                            
                            <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>"  />
                            <input type="hidden" name="mid" value="<?php echo $row_Recordset1['mid']; ?>" />
                            <input type="hidden" name="pid" value="<?php echo $row_Recordset1['pid']; ?>" />
                            
                              <td  class="alert alert-info">Night</td>
                              <td><input type="number" class="form-control txt" id="dosageN" value="<?php echo $tt[3];?>" name="dosageN" readonly="readonly" /></td>
                              <td><input type="submit" value="Ok" class="btn btn-danger" name="ok4"/></td>
                              <td class="alert alert-success"><?php echo $row_Recordset4['status']; ?></td>
                                </form>
                            </tr>
                            <?php }?>
                          </table></td>
                      </tr>
                      <tr>
                        <td>Quantity</td>
                        <td><input name="quantity" type="text" id="quantity" style="color:#F00" value="<?php echo $row_Recordset1['quantity']; ?>"  readonly="readonly" class="form-control" /></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Button to trigger modal --> 

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
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
