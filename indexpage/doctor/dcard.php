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

$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM patient WHERE pid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
if(isset($_POST['submit1']))
{
$pid=$_POST['pid'];
$dt=$_POST['date'];
$ot=$_POST['otdate'];
$ob=$_POST['observation'];
$sy=$_POST['symptoms'];
$bl=$_POST['blood'];
$st=$_POST['stool'];
$sp=$_POST['spec_invest'];
$bi=$_POST['biopsy'];
$op=$_POST['operation'];
$an=$_POST['anesthesia'];
$ur=$_POST['urine'];
$xr=$_POST['x_ray'];
$pd=$_POST['pro_diag'];
$fd=$_POST['final_diag'];
$tg=$_POST['treat_given'];
$ta=$_POST['treat_adv'];
$day=$_POST['day'];

 $query="INSERT INTO discharge_card(`id`, `pid`, `date`, `otdate`, `observation`, `symptoms`, `blood`, `stool`, `spec_invest`, `biopsy`, `operation`, `anesthesia`, `urine`, `x_ray`, `pro_diag`, `final_diag`, `treat_given`, `treat_adv`, `adv_af_day`) VALUES ('','$pid','$dt','$ot','$ob','$sy','$bl','$st','$sp','$bi','$op','$an','$ur','$xr','$pd','$fd','$tg','$ta','$day')";

if(mysql_query($query))
{
$ii=mysql_insert_id();  
header('location:temp_d.php?pid='.$ii);
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Patient-Doct Connect</title>

<link href="css/plugins/pace/pace.css" rel="stylesheet">
<script src="js/plugins/pace/pace.js"></script>

<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<!-- PAGE LEVEL PLUGIN STYLES -->
<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

<!-- THEME STYLES - Include these on every page. -->
<link href="css/style.css" rel="stylesheet">
<link href="css/plugins.css" rel="stylesheet">

<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> Enter Details For Discharge Certificate </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Enter Certificate Details </li>
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
                  <h4 style="float:left"> Certificate Details </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form name="frm1" action="" method="POST">
                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                      <thead>
                        <tr>
                          <td><strong>Patient Id</strong></td>
                          <td><strong>First Name</strong></td>
                          <td><strong>Last Name</strong></td>
                          <td><strong>Age </strong></td>
                          <td><strong>City</strong></td>
                          <td><strong>Gender</strong></td>
                        </tr>
                      </thead>
                      <tr>
                        <td><input type="hidden" name="pid" value="<?php echo $row_Recordset1['pid']; ?>" >
                          <?php echo $row_Recordset1['pid']; ?>&nbsp; </td>
                        <td><input type="hidden" name="fname" value="<?php echo $row_Recordset1['fname']; ?>" >
                          <?php echo $row_Recordset1['fname']; ?>&nbsp; </td>
                        <td><input type="hidden" name="lname" value="<?php echo $row_Recordset1['lname']; ?>" >
                          <?php echo $row_Recordset1['lname']; ?>&nbsp; </td>
                        <td><?php 

echo $row_Recordset1['bdate'];

?>
                          <input type="hidden" name="age" value="<?php echo $row_Recordset1['bdate']; ?>" ></td>
                        <td><input type="hidden" name="city" value="<?php echo $row_Recordset1['city']; ?>" >
                          <?php echo $row_Recordset1['city']; ?>&nbsp; </td>
                        <td><input type="hidden" name="gender" value="<?php echo $row_Recordset1['gender']; ?>" >
                          <?php echo $row_Recordset1['gender']; ?>&nbsp; </td>
                        
                      </tr>
                    </table>
                    <table  class="table table-striped table-bordered table-hover table-green">
                      <tr>
            <td><strong>Discharge Date: </strong></td>
            <td><input type="date" name="date" class="form-control" required></td> 
            <td><strong>O.T.Date: </strong></td>
            <td><input type="date" name="otdate" class="form-control" required></td>
                      </tr>
                      <tr>
             <td><strong>Observation: </strong></td>
             <td><textarea name="observation" class="form-control"></textarea></td>
             <td><strong>Symptoms: </strong></td>
             <td><input type="text" name="symptoms" class="form-control" ></td>
                      </tr>
                      <tr>
             <td><strong>Blood: </strong></td>
             <td><input type="text"  name="blood" class="form-control" ></td>       <td><strong>Stool: </strong></td>
             <td><input type="text"  name="stool" class="form-control" ></td>
                      </tr>
                      <tr>
               <td><strong>Specific Investigations: </strong></td>
               <td><input type="text"  name="spec_invest" class="form-control" ></td> 
               <td><strong>Biopsy: </strong></td>
               <td><input type="text"  name="biopsy" class="form-control" ></td>
                      </tr>
                      <tr>
    <td><strong>Operation: </strong></td>
    <td><input type="text" name="operation" class="form-control" ></td> 
    <td><strong>Anesthesia: </strong></td>
    <td><input type="text" name="anesthesia" class="form-control" ></td>
                      </tr>
                      <tr>
            <td><strong>Urine: </strong></td>
        	<td><input type="text"  name="urine" class="form-control" ></td> 
            <td><strong>X-Ray: </strong></td>
            <td><input type="text"  name="x_ray" class="form-control" ></td>
                      </tr>
                      <tr>
          <td><strong>Provisional Diagnosis: </strong></td>
          <td><input type="text" name="pro_diag" class="form-control" ></td>
          <td><strong>Final Diagnosis: </strong></td>
          <td><input type="text" name="final_diag" class="form-control" ></td>
                      </tr>
                      <tr>
          <td><strong>Treatment Given: </strong></td>
          <td><input type="date" name="treat_given" class="form-control" ></td> 
          <td><strong>Treatment Advised: </strong></td>
          <td><input type="text" name="treat_adv" class="form-control" ></td>
                      </tr>
                      <tr>
          <td colspan=""><strong>Advised For Follow Up After Days: </strong></td>
          <td colspan=""><input type="number" name="day" class="form-control" ></td> 
                      </tr>
                      <tr>
                        <td colspan="4"><div align="center">
                            <input type="submit" name="submit1" class="btn-blue btn " align="middle" />
                            <input type="reset" class="btn-red btn " align="middle" />
                          </div></td>
                      </tr>
                    </table>
                  
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal --> 
        
      </div>
    </div>
  </div>
</div>
<!-- /#wrapper --> 

<!-- GLOBAL SCRIPTS --> 

<!-- Logout Notification Box --> 

<!-- /#logout --> 
<!-- Logout Notification jQuery --> 
<script src="js/plugins/popupoverlay/logout.js"></script> 
<!-- HISRC Retina Images --> 
<script src="js/plugins/hisrc/hisrc.js"></script> 

<!-- PAGE LEVEL PLUGIN SCRIPTS --> 
<script src="js/plugins/summernote/summernote.min.js"></script> 

<!-- THEME SCRIPTS --> 
<script src="js/flex.js"></script> 
<script src="js/demo/wysiwyg-demo.js"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>