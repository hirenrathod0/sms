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

if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
session_start();
$did=$_SESSION['MM_DOCTOR'];
$id=$_GET['id'];
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM patient where pid='$id'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_con_pat = "SELECT * FROM con_patient_detail where pid='$id'";
$con_pat = mysql_query($query_con_pat, $cn) or die(mysql_error());
$row_con_pat = mysql_fetch_assoc($con_pat);
$totalRows_con_pat = mysql_num_rows($con_pat);

if(isset($_GET['fm']))
{
	$f=$_GET['fm'];
$file = ("../documents/medication/$f");
$filetype=filetype($file);
$filename=basename($file);
header ("Content-Type: $filetype");
header ("Content-Length: ".filesize($file));
header ("Content-Disposition: attachment; filename=".$filename);
readfile($file);

}
if(isset($_GET['fp']))
{
	$f=$_GET['fp'];
$file = ("../documents/prescription/$f");
$filetype=filetype($file);
$filename=basename($file);
header ("Content-Type: $filetype");
header ("Content-Length: ".filesize($file));
header ("Content-Disposition: attachment; filename=".$filename);
readfile($file);

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Patient Details-Doct Connect</title>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- PAGE LEVEL PLUGIN STYLES -->
<script src="js/plugins/popupoverlay/logout.js"></script> 
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
<script src="js/plugins/popupoverlay/logout.js"></script> 
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script language="javascript" type="text/javascript">

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
          <h1> ALL DETAILS OF <?php echo $row_Recordset1['fname']."  ".$row_Recordset1['mname']."  ".$row_Recordset1['lname'] ; ?> </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Detail Data </li>
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
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient Basic Details </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset1>0) {  ?>
                  <table class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>Patient Id</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td> Age </td>
                        <td>City</td>
                        <td>Gender</td>
                        <td>Height</td>
                        <td>Weight</td>
                        
                        <td> Blood Group </td>
                       
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                        <tr>
                          <td><?php echo $row_Recordset1['pid']; ?>&nbsp; </td>
                          <td><?php echo $row_Recordset1['fname']; ?>&nbsp; </td>
                          <td><?php echo $row_Recordset1['lname']; ?>&nbsp; </td>
                          <td><?php 

echo $row_Recordset1['bdate']; //put date in the dd-mm-yyyy format
?></td>
                          <td><?php echo $row_Recordset1['city']; ?>&nbsp; </td>
                          <td><?php echo $row_Recordset1['gender']; ?>&nbsp; </td>
                          <td><?php echo $row_Recordset1['height']; ?></td>
                          <td><?php echo $row_Recordset1['weight']; ?></td>
                          <td><?php echo $row_Recordset1['bgroup']; ?></td>
                          
                          
                          
                          
                          
                          
                          
                          
                          
                        </tr>
                        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                    </tbody>
                  </table>
                  <?php } else {  ?>
                  <label class="alert-danger"> NO DATA FOUND </label>
                  <?php } ?>
                </div>
              </div>
              
              
              
              
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_con_pat>0) {  ?>
                  <table class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>BMI</td>
                        <td>BP</td>
                        <td>Diabetes</td>
                        <td>Temperature </td>
                        <td>Pulse</td>
                        <td>Upload PDF</td>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                        <tr>
                          
                          <td><?php echo $row_con_pat['bmi']; ?> </td>
                         
                          <td><?php echo $row_con_pat['bp']; ?></td>
                          <td><?php echo $row_con_pat['diabetes']; ?> </td>
                          <td><?php echo $row_con_pat['temperature']; ?> </td>
                          <td><?php echo $row_con_pat['pulse']; ?></td>
                          
                        
                          <?php
                     
                        mysql_select_db($database_cn, $cn);
 $query_Recordset11 = "SELECT * FROM con_photo where pid='$id'";

$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);?>




<td>
                      <?php if($totalRows_Recordset11>0)
					  { do{?>
      <table class="table" style="border:none">
      
     <tr><td><a href="download1.php?filename=<?php echo $row_Recordset11['pdfname']; ?>" class="btn-link"><?php echo $row_Recordset11['pdfname'];?> </a></td></tr>
     </table>
     <?php }while($row_Recordset11 = mysql_fetch_assoc($Recordset11));?>
                       <?php }else{
						   
	echo '<p class="alert alert-danger">No File Upload..</p>';					   
					   }?>
                        </td>


                        
                        
                        
                        
                        
                        </tr>
                        <?php } while($row_con_pat = mysql_fetch_assoc($con_pat)); ?>
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
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          <?php /*?><div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient Medicine Certificate & Prescription History</h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active" ><a href="#medicinehistory" role="tab" data-toggle="tab" >Medicine History</a></li>
                    <li><a href="#prescriptionhistory" role="tab" data-toggle="tab">Prescription History</a></li>
                    <li><a href="#certificatehistory" role="tab" data-toggle="tab">Certificate History</a></li>
                  </ul>
                  
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane active" id="medicinehistory">
                      <div class="row">
                        <div class="col-lg-12"> 
                          <table  class="table table-striped table-bordered table-hover table-green">
                            <thead>
                              <tr>
                                <td>Date</td>
                                <td>View  & Download</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <?php 
					   	$q="select * from p_med_attach where pid='$id' and did='$did' ";
					
					   	$r=mysql_query($q);
					
						while($a=mysql_fetch_assoc($r))
						{
						?>
                                  <td><?php 
  $timestamp = strtotime($a['ctime']);
								  echo date('j-F-Y h:m a', $timestamp); ?></td>
                                <td>
                              
                              
                               <a href="../documents/medication/1_20140724.pdf"><img src="icons/file_pdf.ico"></a> &nbsp;&nbsp;
                               <a href="detailpatients.php?fm=<?php echo $a['path'] ?>"><img src="icons/box_download.ico"></a>
                                  
                                </td>
                              </tr>
                              <?php } ?>
                          </table>
                        </div>
                        
                      </div>
                    </div>
                    <div class="tab-pane" id="prescriptionhistory">
                    	<div class="row">
                        	<div class="col-lg-12">
                            <table  class="table table-striped table-bordered table-hover table-green">
                            <thead>
                              <tr>
                                <td>Date</td>
                                <td>View  & Download</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <?php 
					   	$q="select * from p_pre_attach where pid='$id' and did='$did' ";
					
					   	$r=mysql_query($q);
					
						while($a=mysql_fetch_assoc($r))
						{
						?>
                                <td><?php   $timestamp = strtotime($a['ctime']);
								  echo date('j-F-Y', $timestamp); ?></td>
                                <td>
                                 
                               <a href="../documents/prescription/1_20140724.pdf"><img src="icons/file_pdf.ico"></a> &nbsp;&nbsp;
                               <a href="detailpatients.php?fp=<?php echo $a['path'] ?>"><img src="icons/box_download.ico"></a>
                                  
                             
                                </td>
                              </tr>
                              <?php } ?>
                          </table>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane" id="certificatehistory">
                    	<div class="row">
                        	<div class="col-lg-12">
                            <table  class="table table-striped table-bordered table-hover table-green">
                            <thead>
                              <tr>
                                <td>Date</td>
                                <td>View  & Download</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <?php 
					   	$q="select * from p_pre_attach where pid='$id' and did='$did' ";
					
					   	$r=mysql_query($q);
					
						while($a=mysql_fetch_assoc($r))
						{
						?>
                                <td><?php   $timestamp = strtotime($a['ctime']);
								  echo date('j-F-Y', $timestamp); ?></td>
                                <td>
                                 
                               <a href="../documents/prescription/1_20140724.pdf"><img src="icons/file_pdf.ico"></a> &nbsp;&nbsp;
                               <a href="detailpatients.php?fp=<?php echo $a['path'] ?>"><img src="icons/box_download.ico"></a>
                                  
                             
                                </td>
                              </tr>
                              <?php } ?>
                          </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div><?php */?>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal --> 
        
      </div>
    </div>
  </div>
</div>
<!-- Button to trigger modal --> 

<script src="js/plugins/bootstrap/bootstrap.min.js"></script> 
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script> 
<script src="js/plugins/popupoverlay/defaults.js"></script> 

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

mysql_free_result($con_pat);
?>
