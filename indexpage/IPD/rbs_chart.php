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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 $ii=$_GET['pid'];
 
 
 if(isset($_POST['submit1']))
{
	$dt=$_POST['dt1'];
 mysql_select_db($database_cn, $cn);
 $query_Recordset1 = "SELECT * FROM  rbs_chart where pid='$ii' and date='$dt'";
 $Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
 $row_Recordset1 = mysql_fetch_assoc($Recordset1);
 $totalRows_Recordset1 = mysql_num_rows($Recordset1);
}else
{

mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM rbs_chart where pid='$ii'";

$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
}



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO rbs_chart (pid,`date`, fbs, pre_lanch, lab_pp2bs, inward_pp2bs, pre_dinner, post_dinner) VALUES ('$ii',%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['date'], "text"),
                       GetSQLValueString($_POST['fbs'], "text"),
                       GetSQLValueString($_POST['pre_lunch'], "text"),
                       GetSQLValueString($_POST['lab_pp2bs'], "text"),
                       GetSQLValueString($_POST['inward_pp2bs'], "text"),
                       GetSQLValueString($_POST['pre_dinner'], "text"),
                       GetSQLValueString($_POST['post_dinner'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "rbs_chart.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
</script></head>
<body >
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <?php
		  
mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='$ii'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h); 
		  ?>
          <h1> 
          <?php echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?>
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
      <div class="col-lg-12">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> New RBS CHART </h4>
                </div>
                <!--<div class="portlet-widgets"> <a href="allpatients.php"  class="pull-right btn-orange btn "> All Check Test </a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" name="form1" action="<?php echo $editFormAction; ?>" id="f1">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                      <tr valign="baseline">
                        <td nowrap ><strong>Date:</strong></td>
                        <td><input type="text" name="date" value="" size="30"  class="form-control" onblur="makeupper(this.id);" ></td>
                        <td nowrap ><strong>FBS:</strong></td>
                        <td><input type="text" name="fbs" value="" size="30"  class="form-control" onblur="makeupper(this.id);"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap ><strong>PRE.LUNCH:</strong></td>
                        <td><input type="text" name="pre_lunch" value="" size="30" class="form-control" onblur="makeupper(this.id);"></td>
                        <td nowrap ><strong>INWARD PP2BS:</strong></td>
                        <td><input type="text" name="inward_pp2bs" value="" size="30"  class="form-control" onblur="makeupper(this.id);"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap ><strong>Lab.PP2BS:</strong></td>
                        <td><input type="text" name="lab_pp2bs" onblur="makeupper(this.id);" value="" size="30" class="form-control"></td>
                        <td nowrap ><strong>PRE.DINNER:</strong></td>
                        <td><input type="text" name="pre_dinner" onblur="makeupper(this.id);" value="" size="30" class="form-control" id="bdate">
                        </td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap ><strong>POST DINNER:</strong></td>
                        <td><input type="text" name="post_dinner" onblur="makeupper(this.id);" value="" size="30"  class="form-control" id="city"></td>
                       
                      </tr>
                      
                      
                      
                      <tr valign="baseline">
                        <td colspan="4" align="center"><input type="submit" value="Submit" class="btn btn-green" name="submit"></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1">
                  </form>
                  <p>&nbsp;</p>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
        </div>
        <!-- /.row (nested) -->
      </div>
	  
	  
	  <div class="col-lg-12">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> All RBS CHART  </h4>
                  
                  
                  <form action="" method="post" style="padding-top:5px;padding-bottom:5px">
                
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Enter Date : &nbsp;&nbsp;&nbsp;
                  <input type="date" name="dt1" />
                  &nbsp;&nbsp;&nbsp;
                  <input type="submit" name="submit1" />
                  <?php if(isset($_POST['dt1']))
	 			  {
		   $tt=$_POST['dt1'];
		   ?>
                  <a href="print_rbs.php?dt1=<?php echo $_POST['dt1'];?>&amp;pid=<?php echo $_GET['pid'];?>" class="btn btn-purple pull-right">Print</a>
                  <?php }?>
                </form>
				  <div class="pull-right" style="padding-left:850px;">
  
  </div>
                </div>
                
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
				
<?php
					if($totalRows_Recordset1 >0) {  ?>
                  <table id="example-table" class="table table-striped
                  table-bordered table-hover table-green">
                    <thead>
					
                 
                    <tr>
                     <th>Id</th>
                      <th>DATE</th>
					  <th>FBS</th>
					  <th>PRE.LUNCH</th>
					  <th>INWARD PP2BS </th>
					  <th>LAB.PP2BS</th>
					  <th>PRE.DINNER</th>
					  <th>POST DINNER</th>
					  
					  <th>Delete</th>
                    </tr>
					</thead>
					<tbody>
                    <?php do { ?>
                      <tr>
                       
                        <td><?php echo $row_Recordset1['id']; ?></td>
						<td><?php echo $row_Recordset1['date']; ?></td>
						<td><?php echo $row_Recordset1['fbs']; ?></td>
                        <td><?php echo $row_Recordset1['pre_lanch']; ?></td>
						<td><?php echo $row_Recordset1['lab_pp2bs']; ?></td>
		 <td><?php echo $row_Recordset1['inward_pp2bs']; ?></td>
         <td><?php echo $row_Recordset1['pre_dinner']; ?></td>
         <td><?php echo $row_Recordset1['post_dinner']; ?></td>
         
         
         
         
         
					    <td><a href="del_rbschart.php?id=<?php echo $row_Recordset1['id']; ?>&amp;pid=<?php echo $row_Recordset1['pid']; ?>" class="btn-red btn"> <i class="fa fa-power-off"> Delete </i> </a> </td>
					</tr>
                  
                  
            
                  
                      <?php } while ($row_Recordset1 = mysql_fetch_array($Recordset1)); ?>
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

