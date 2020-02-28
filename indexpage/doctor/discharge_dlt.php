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
$ll=$_GET['pid'];
$kk="select * from bed_dtl where pid='$ll'";
$kk1=mysql_query($kk);
$kk2=mysql_fetch_assoc($kk1);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm1")) {
  $insertSQL = sprintf("INSERT INTO disch_sum (pid, dis_date, dt_surgery, dr_name, speciality, diagnosis, history_dtl, past_history, exam_dt, treat_smr, hospital_stay, condi_dis, advi_dis, diet, medication, dis_instuct, plan) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pid'], "int"),
                       GetSQLValueString($_POST['dis_date'], "text"),
                       GetSQLValueString($_POST['dt_surgery'], "text"),
                       GetSQLValueString($_POST['dr_name'], "text"),
                       GetSQLValueString($_POST['speciality'], "text"),
                       GetSQLValueString($_POST['diagnosis'], "text"),
                       GetSQLValueString($_POST['history_dtl'], "text"),
                       GetSQLValueString($_POST['past_history'], "text"),
                       GetSQLValueString($_POST['exam_dt'], "text"),
                       GetSQLValueString($_POST['treat_smr'], "text"),
                       GetSQLValueString($_POST['hospital_stay'], "text"),
                       GetSQLValueString($_POST['condi_dis'], "text"),
                       GetSQLValueString($_POST['advi_dis'], "text"),
                       GetSQLValueString($_POST['diet'], "text"),
                       GetSQLValueString($_POST['medication'], "text"),
                       GetSQLValueString($_POST['dis_instuct'], "text"),
                       GetSQLValueString($_POST['observation'], "text"));

  mysql_select_db($database_cn, $cn);
		if(mysql_query($insertSQL))
		{
		$ii=mysql_insert_id();  
		header('location:temp_d1.php?pid='.$ii);
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
        <div class="page-title"> </div>
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
                  <h4 style="float:left"> Discharge Summary </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form name="frm1" action="<?php echo $editFormAction; ?>" method="POST">
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
                        <td><?php echo $row_Recordset1['fname']; ?>&nbsp; </td>
                        <td><?php echo $row_Recordset1['lname']; ?>&nbsp; </td>
                        <td><?php echo $row_Recordset1['bdate'];?></td>
                        <td><?php echo $row_Recordset1['city']; ?>&nbsp; </td>
                        <td><?php echo $row_Recordset1['gender']; ?>&nbsp; </td>
                      </tr>
                    </table>
                    <table  class="table table-striped table-bordered table-hover table-green">
                      <tr>
                        <td class="col-lg-12" colspan="3"><div class="col-lg-6" align="center">Discharged Date &nbsp;&nbsp;&nbsp;
                            <input type="text" name="dis_date" class="input-sm" value="<?php echo $kk2['dis_date'];?>" required readonly>
                          </div>
                          &nbsp;&nbsp;&nbsp;
                          <div class="col-lg-5" align="center"> Surgery Date&nbsp;&nbsp;&nbsp;
                            <input type="date" name="dt_surgery"  required class="input-sm">
                          </div></td>
                      </tr>
                      <tr>
                        <td class="col-lg-4"><textarea name="dr_name" class="form-control" placeholder="Consultants"></textarea></td>
                        <td class="col-lg-4"><textarea name="speciality" class="form-control" placeholder="Speciality"></textarea></td>
                        <td class="col-lg-4"><textarea name="history_dtl" class="form-control" placeholder="Brief History, Pertinent Physical Data"></textarea></td>
                      </tr>
                      <tr>
                        <td><textarea name="past_history" class="form-control" placeholder="Past History"></textarea></td>
                        <td><textarea name="exam_dt" class="form-control" placeholder="On Examination"></textarea></td>
                        <td><textarea name="treat_smr" class="form-control" placeholder="Treatment Summary"></textarea></td>
                      </tr>
                      <tr>
                        <td><textarea name="diagnosis" class="form-control"  placeholder="Diagnosis"></textarea></td>
                        <td><textarea name="hospital_stay" class="form-control" placeholder="Hospital Stay"></textarea></td>
                        <td><textarea name="condi_dis" class="form-control" placeholder="Condition On Discharged"></textarea></td>
                      </tr>
                      <tr>
                        <td><textarea name="advi_dis" class="form-control" placeholder="Advice On Discharged"></textarea></td>
                        <td><textarea name="diet" class="form-control" placeholder="Diet "></textarea></td>
                        <td><textarea name="medication" class="form-control" placeholder="Medications"></textarea></td>
                      </tr>
                      <tr>
                        <td><textarea name="dis_instuct" class="form-control" placeholder="Discharge Instructions And Follow Up"></textarea></td>
                      
                    
                        <td><textarea name="observation" class="form-control" placeholder="Plan"></textarea></td><td><div align="center">
                            <input type="submit" name="submit1" class="btn-blue btn " align="middle" />
                            <input type="reset" class="btn-red btn " align="middle" />
                          </div></td>
                      </tr>
                     
                    </table>
                    <input type="hidden" name="MM_insert" value="frm1">
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