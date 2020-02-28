<?php require_once('../Connections/cn.php'); ?>
<?php
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
$u=$_GET['pid'];
if ((isset($_GET['dpmid'])) && ($_GET['dpmid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM patient_medicine WHERE pmid=%s",
                       GetSQLValueString($_GET['dpmid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());
  $u=$_GET['pid'];
  $deleteGoTo = "givepre.php?pid=".$u;
 
  header(sprintf("Location: %s", $deleteGoTo));
}

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "f1")) {

	$qty = ($_POST['dosageM'] + $_POST['dosageA'] +$_POST['dosageE'] +$_POST['dosageN']) * $_GET['nn'];
  $insertSQL = sprintf("INSERT INTO patient_medicine (mid, strength, dosageM, dosageA, dosageE, dosageN, dosage,pid,qty) VALUES (%s, %s, %s, %s, %s, %s, %s,%s,%s)",
                       GetSQLValueString($_POST['medicine'], "int"),
                       GetSQLValueString($_POST['strength'], "text"),
                       GetSQLValueString($_POST['dosageM'], "int"),
                       GetSQLValueString($_POST['dosageA'], "int"),
                       GetSQLValueString($_POST['dosageE'], "int"),
                       GetSQLValueString($_POST['dosageN'], "int"),
                       GetSQLValueString($_POST['dosage'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($qty, "text")
					   					   
					   );

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "givepre.php?pid=".$u."&nd=".$_GET['nn'];
 
  header(sprintf("Location: %s", $insertGoTo));
}

if(!isset($_SESSION['MM_Username']))
{
header('login.php');
}
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

$maxRows_patient = 10;
$pageNum_patient = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Prescription- Doct Connect</title>
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
          <h1>Edit Priscription </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Home</a> </li>
            <li class="active">User</li>
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
                  <h4>Edit Priscription</h4>
                </div>
                <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" action="" role="form" name="adduser" enctype="multipart/form-data" >
                    <table align="center" class="table-responsive table-condensed table-bordered table">
					 <tr valign="baseline">
                      <td nowrap align="left"><strong> Select Medicine Form:</strong></td>
                      <td><select class="form-control" name="type">
                          <?php
  while($row=mysql_fetch_assoc($rr1))
  {
?>
                          <option value="<?php echo $row['mtid']?>" <?php if($res['mtid']==$row['mtid']){ echo "selected";}  ?>><?php echo $row['name']?></option>
					
		<?php } ?>
                       
                        </select>
                      </td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="left"><strong>Medicine Name:</strong></td>
                      <td><input type="text" class="form-control" value="<?php echo $res['name']; ?>" name="medicinename" onblur="makeupper(this.id);" id="mnm" required placeholder="Enter Medicine Name"></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="left"><strong>Strength:</strong></td>
                      <td><input type="text" name="strength" class="form-control" value="<?php echo $res['strength']; ?>" onblur="makeupper(this.id);" id="strength1" required placeholder="Enter Strength"></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="left"><strong> Dosage</strong></td>
                      <td><input type="text" name="dosage" class="form-control" value="<?php echo $res['dosage']; ?>" onblur="makeupper(this.id);" id="dosage1" required placeholder="Enter Dosage">
                      </td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="left"><strong>Manufacture:</strong></td>
                      <td><input type="text" name="manuf" class="form-control" value="<?php echo $res['manufcuturer']; ?>" onblur="makeupper(this.id);" id="manuf1" required placeholder="Enter Manufacture">
                      </td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="left"><strong> Generic name:</strong></td>
                      <td><input type="text"  name="genericname" value="<?php echo $res['genericname']; ?>" onblur="makeupper(this.id);" id="city" class="form-control" id="generic" required placeholder="Enter  Generic Name">
                      </td>
                    </tr>
					<tr valign="baseline">
                      <td nowrap align="left"><strong> Remarks:</strong></td>
                      <td><textarea name="remarks" onblur="makeupper(this.id);"  id="rm" class="form-control" placeholder="Enter Remarks" cols="15" rows="5" > <?php echo $res['remarks']; ?></textarea>
                      </td>
                    </tr>                    
                    <tr valign="baseline">
                      <td nowrap align="left"><strong> Extra:</strong></td>
                      <td><input type="text" name="extra"  class="form-control" value="<?php echo $res['extra']; ?>" onblur="makeupper(this.id);" id="ex"  id="exampleInputEmail1" placeholder="Enter Extra">
                      </td>
                    </tr>
                    
                   
                    <tr valign="baseline" rowspan="2">
                      <td  align="center" colspan="2" ><button type="submit" name="edit" class="btn btn-default">Edit</button></td>
                    </tr>
                    <input type="hidden" name="MM_insert" value="adduser">
                  </form>
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
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>

