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
$pi=$_GET['pid'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$pi=$_GET['pid'];
	$dt=date('d-m-Y');
  $insertSQL = sprintf("INSERT INTO intake_output (pid,`time`, iv, itime, icc, timeintake, mothcc, otime, cc, otime1, contactcc,do,rt,date) VALUES ('$pi',%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,'$dt')",
                       GetSQLValueString($_POST['time'], "text"),
                       GetSQLValueString($_POST['iv'], "text"),
                       GetSQLValueString($_POST['itime'], "text"),
                       GetSQLValueString($_POST['icc'], "text"),
                       GetSQLValueString($_POST['timeintake'], "text"),
                       GetSQLValueString($_POST['monthcc'], "text"),
                       GetSQLValueString($_POST['otime'], "text"),
                       GetSQLValueString($_POST['cc'], "text"),
                       GetSQLValueString($_POST['otime1'], "text"),
                       GetSQLValueString($_POST['contact_cc'], "text"),
					   GetSQLValueString($_POST['do'], "text"),
                       GetSQLValueString($_POST['rt'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "intake.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
if(isset($_POST['submit1']))
{
 $dt=$_POST['dt1'];
 
 
 mysql_select_db($database_cn, $cn);
  $query_Recordset1 = "SELECT * FROM intake_output where pid='$pi' and date='$dt'";
//exit;
 $Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
 $row_Recordset1 = mysql_fetch_assoc($Recordset1);
 $totalRows_Recordset1 = mysql_num_rows($Recordset1);
}else
{
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM intake_output where pid='$ii'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"  />
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
          <h1> <?php mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='$pi'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h);?>

 <?php echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?> </h1>
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
                  <h4 style="float:left"> New INTAKE & OUPUT RECORD  </h4>
                </div>
                <!--<div class="portlet-widgets"> <a href="allpatients.php"  class="pull-right btn-orange btn "> All Check Test </a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" name="form1" action="<?php echo $editFormAction; ?>" id="f1">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                    <tr valign="baseline">
                   <td nowrap colspan="2" align="center"> 
                   <b style="font-size:18px">
                    INTAKE</b>
                    </td>
                    <td nowrap colspan="2" align="center"> 
                    <b style="font-size:18px">OUTPUT</b>
                    </td>
                    </tr>
                    
                      <tr valign="baseline">
                        <td nowrap ><strong>Time:</strong></td>
                        <td><input type="text" name="time" value="" size="30"  class="form-control" onblur="makeupper(this.id);" ></td>
                         <td nowrap ><strong>Time:</strong></td>
                        <td><input type="text" name="otime" value="" size="30"  class="form-control" onblur="makeupper(this.id);" ></td>
                      </tr>
                      
                      
                      <tr valign="baseline">
                        <td nowrap ><strong>I.V or S.C.Infiusion:</strong></td>
                        <td><input type="text" name="iv" value="" size="30" class="form-control" onblur="makeupper(this.id);"></td>
                        <td nowrap ><strong>Urin in CC:</strong></td>
                        <td><input type="text" name="cc" value="" size="30"  class="form-control" onblur="makeupper(this.id);"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap ><strong>Time:</strong></td>
                        <td><input type="text" name="itime" onblur="makeupper(this.id);" value="" size="30" class="form-control" id="lname"></td>
                        <td nowrap ><strong>Time:</strong></td>
                        <td><input type="text" name="otime1" onblur="makeupper(this.id);" value="" size="30" class="form-control" id="bdate">
                        </td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap ><strong>By Rectum In CC:</strong></td>
                        <td><input type="text" name="icc" onblur="makeupper(this.id);" value="" size="30"  class="form-control" id="city"></td>
                        <td nowrap ><strong>Stomach Contact in CC:</strong></td>
                        <td><input type="text" name="contact_cc" onblur="makeupper(this.id);" size="30"  class="form-control" ></td>
                      </tr>
                      
                      <tr valign="baseline">
                       <td nowrap ><strong>Time:</strong></td>
                        <td><input type="text" name="timeintake" onblur="makeupper(this.id);" size="30"  class="form-control"></td>
                        <td nowrap ><strong>Drain Output:</strong></td>
                        <td><input type="text" name="do" onblur="makeupper(this.id);" size="30"  class="form-control"></td>
                        
                      </tr>
                      
                      
                      
                       <tr valign="baseline">
                       <td nowrap ><strong>By Month in CC:</strong></td>
                        <td><input type="text" name="monthcc" onblur="makeupper(this.id);" size="30"  class="form-control"></td>
                          <td nowrap ><strong>R.T Aspiration:</strong></td>
                        <td><input type="text" name="rt" onblur="makeupper(this.id);" size="30"  class="form-control"></td>
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
                  <h4 style="float:left"> All INTAKE & OUPUT RECORD
  </h4>
  <form action="" method="post" style="padding-top:5px;padding-bottom:5px">
                
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Enter Date : &nbsp;&nbsp;&nbsp;
                  <input type="date" name="dt1" placeholder="dd-mm-yy" />
                  &nbsp;&nbsp;&nbsp;
                  <input type="submit" name="submit1" />
                  <?php if(isset($_POST['dt1']))
	   {
		   $tt=$_POST['dt1'];
		   ?>
                  <a href="print_intake.php?dt1=<?php echo $_POST['dt1'];?>&amp;pid=<?php echo $_GET['pid'];?>" class="btn btn-purple pull-right">Print</a>
                  <?php }?>
                </form>
  
  <div class="pull-right" style="padding-left:950px;">
 
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
                 
                 	<td colspan="7" align="center"><b style="font-size:14px">INTAKE</b></td>
                 	<td colspan="8" align="center"><b style="font-size:14px">OUTPUT</b></td>
                 </tr>
                 
                 
                 
                 
                    <tr>
                    
                     <th>Id</th>
                     <th>Date</th>
                      <th>Time</th>
					  <th>I.V or S.C Infiusion</th>
					  <th>Time </th>
					  <th>By Rectum In CC </th>
					  <th>Time</th>
					  <th>By Month In CC</th>
					  <th>Time</th>
					  <th>Urin in CC</th>
					  <th>Time</th>
                      <th>Stomach Contact in CC</th>
					  <th>Drain Output</th>
					  <th>R.T Aspiration</th>
					  <th>Delete</th>
                    </tr>
					</thead>
					<tbody>
                    <?php do { ?>
                      <tr>
                       
                        <td><?php echo $row_Recordset1['id']; ?></td>
                        <td><?php echo $row_Recordset1['date']; ?></td>
                        
						<td><?php echo $row_Recordset1['time']; ?></td>
						<td><?php echo $row_Recordset1['iv']; ?></td>
                        <td><?php echo $row_Recordset1['itime']; ?></td>
						<td><?php echo $row_Recordset1['icc']; ?></td>
                        <td><?php echo $row_Recordset1['timeintake']; ?></td>
						<td><?php echo $row_Recordset1['mothcc']; ?></td>
                        <td><?php echo $row_Recordset1['otime']; ?></td>
						<td><?php echo $row_Recordset1['cc']; ?></td>
                        <td><?php echo $row_Recordset1['otime1']; ?></td>
                        <td><?php echo $row_Recordset1['contactcc']; ?></td>
						
						
						<td><?php echo $row_Recordset1['do']; ?></td>
						<td><?php echo $row_Recordset1['rt']; ?></td>
						
						 
						  <td><a href="del_intake.php?id=<?php echo $row_Recordset1['id']; ?>&amp;pid=<?php echo $row_Recordset1['pid']; ?>" class="btn-red btn"> <i class="fa fa-power-off"> Delete </i> </a> </td>
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

<?php
mysql_free_result($Recordset1);
?>
