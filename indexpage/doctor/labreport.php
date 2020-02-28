<?php require_once('../Connections/cn.php'); ?>
<?php
session_start();
if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM rep_cat";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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

if(isset($_POST['submit'])){
	
	$pp=implode(',',$_POST['chk']);
	$data = explode(',',$pp);
	$n=	count($data);
			
		$ss=$_SESSION['MM_DOCTOR'];
		for($i=0;$i<$n;$i++)
		{
			 $q="INSERT INTO `doc_lab_report`(`pid`,`sel_rep_name`,`docid`,`status`) VALUES ('".$_GET['pid']."','".$data[$i]."','$ss','y')";
			
				mysql_query($q);
					
		}
	
		
	echo '<meta http-equiv="refresh" content="0; url=labreport.php?pid='.$_GET['pid'].'">';
	exit;
}
if(isset($_POST["submit1"])){
	$insertSQL = sprintf("update doc_lab_report set remark=%s where pid='".$_GET['pid']."' AND date(created_date)='".date("Y-m-d")."'",
                       GetSQLValueString($_POST['remark_txt'], "text"));

  	mysql_select_db($database_cn, $cn);
  	$Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
	header("location:allpatients.php");                                                                                                                                            
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reports-Vihar Hospital</title>
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
        <h1> <?php 
mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='".$_GET['pid']."'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h); 
 echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?> </h1>
        <?php include('button.php');?>
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
                <h4 style="float:left"> Lab Report </h4>
              </div>
              <div class="portlet-widgets"> </div>
              <div class="clearfix"></div>
            </div>
            <div id="basicFormExample" class="panel-collapse collapse in">
              <div class="portlet-body">
                <?php if($totalRows_Recordset1>0) {  ?>
                <table class="table table-striped table-bordered table-hover table-green">
                  <thead>
                    <tr>
                      <td> Report Name </td>
                      <td> Select Relevant </td>
                    </tr>
                  </thead>
                  <tbody><form name="aa" action="" method="post" >
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_Recordset1['name']; ?>&nbsp; </td>
                        <td><input type="checkbox" name="chk[]" class="checkbox-col" value="<?php echo $row_Recordset1['name']; ?>" />
                        </td>
                      </tr>
                      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                  </tbody>
                </table>
                <?php } else {  ?>
                <label class="alert-danger"> NO DATA FOUND </label>
                <?php } ?>
              <input type="submit" value="Insert" name="submit" class="btn btn-blue" />  
                
                </form>
              </div>
            </div>
          </div>
          <!-- /.portlet -->
        </div>
      </div>
      <!-- /.row (nested) -->
    </div>
    <div class="col-lg-6">
      <div class="row">
        <!-- Basic Form Example -->
        <div class="col-lg-12">
          <div class="portlet portlet-default">
            <div class="portlet-heading">
              <div class="portlet-title">
                <h4 style="float:left"> Remarks </h4>
              </div>
              <div class="portlet-widgets"> </div>
              <div class="clearfix"></div>
            </div>
            <div id="basicFormExample" class="panel-collapse collapse in">
              <div class="portlet-body">
                <form name="repNameForm" action="" method="post">
                  <table align="center" class="table-responsive table-condensed table-bordered table ">
                    <tbody>
                      <tr valign="baseline">
                        <td nowrap="" align="right"><strong> Remark(if any):</strong></td>
                        <td nowrap=""><textarea name="remark_txt" cols="40" rows="5"></textarea></td>
                      </tr>
                      <?php $query_Recordset2 = "SELECT * FROM doc_lab_report WHERE pid=".$_GET['pid']." AND date(created_date)='".date("Y-m-d")."'";
						$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
						$totalRows_Recordset2 = mysql_num_rows($Recordset2);
						//$row1 = mysql_fetch_assoc($Recordset2);
						//$date = date('Y-m-d',strtotime($row1['created_time']));
						// || strtotime($date) == strtotime(date('Y-m-d'))
		if($totalRows_Recordset2 !=0) {			
		?>
                      <tr>
                        <td colspan="2"><table id="example-table" class="table table-striped table-bordered table-hover table-green">
                            <thead>
                              <tr>
                                <td> Selected Report Name </td>
                                <td>&nbsp;</td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
						while($row = mysql_fetch_assoc($Recordset2)){ ?>
                              <tr>
                                <td><?php echo $row['sel_rep_name']; ?></td>
                                <td><button type="button" class="btn btn-danger" onclick="getp(<?php echo $row['rep_id'];?>,<?php echo $row['pid']; ?>); "><i class="fa fa-times"></i></button></td>
                                <?php  } ?>
                                <script>
						function  getp(rep_id,pid) {
							if( confirm('Are you sure you want to delete?')) {
						 		window.location='labreport.php?rep_id='+ rep_id + '&pid=' + pid;
							} else { 
								return false;
							}	 
						}
					</script>
                            </tbody>
                          </table>
                          <?php  } ?></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap="" align="center" colspan="2"><input type="submit" value="Submit" class="btn btn-green" name="submit1"></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta"> </div>
        </div>
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
<br>
<?php echo $totalRows_Recordset1 ?> Records Total
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
