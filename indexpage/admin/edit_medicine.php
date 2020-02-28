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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "add-medicine")) {
  $updateSQL = sprintf("UPDATE medicine SET mtid=%s, name=%s, strength=%s, dosage=%s, manufcuturer=%s, genericname=%s, remarks=%s, extra=%s, mrp=%s, edate=%s, bno=%s, vat=%s, tax=%s, amt=%s WHERE mid=%s",
                       GetSQLValueString($_POST['mtid'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['strength'], "text"),
                       GetSQLValueString($_POST['dosage'], "text"),
                       GetSQLValueString($_POST['manufcaturer'], "text"),
                       GetSQLValueString($_POST['genericname'], "text"),
                       GetSQLValueString($_POST['remarks'], "text"),
                       GetSQLValueString($_POST['extra'], "text"),
                       GetSQLValueString($_POST['mrp'], "double"),
                       GetSQLValueString($_POST['edtae'], "date"),
                       GetSQLValueString($_POST['bno'], "text"),
                       GetSQLValueString($_POST['vat'], "double"),
                       GetSQLValueString($_POST['atax'], "double"),
                       GetSQLValueString($_POST['amt'], "double"),
                       GetSQLValueString($_GET['mid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "all_medicine.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['mid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['mid'] : addslashes($_GET['mid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM medicine WHERE mid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM medicinetype";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Home</a> </li>
            <li class="active">User</li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <div class="row">
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h5>Add Medicine</h5>
                </div>
                <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" action="<?php echo $editFormAction; ?>" role="form" name="add-medicine">
                    <table align="center" class="table table-responsive table-condensed table-bordered">
					<tr valign="baseline">
                      <td nowrap align="left"><strong>Select Form:</strong></td>
                      <td><select class="form-control" name="mtid" required>
                        <option value="value" <?php if (!(strcmp("value", $row_Recordset1['mtid']))) {echo "selected=\"selected\"";} ?>>----Select----</option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset2['name']?>"<?php if (!(strcmp($row_Recordset2['name'], $row_Recordset1['mtid']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['name']?></option>
                        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
                       
                        </select>
                        </td>
                        
                <td nowrap align="left"><strong>Medicine Name:</strong></td>
                      <td><input name="name" type="text" class="form-control" id="mnm" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['name']; ?>" required placeholder="Enter Medicine Name" > </td>        
                        
                        
                        
                        
                    </tr>
                   
                     <tr valign="baseline">
                      <td nowrap align="left"><strong> Strength:</strong></td>
                      <td><input name="strength" type="text" class="form-control" id="st" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['strength']; ?>" required placeholder="Enter Strength" >
                      </td>
                    
                      <td nowrap align="left"><strong> Dosage:</strong></td>
                      <td><input name="dosage" type="text" class="form-control" id="dosage" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['dosage']; ?>" required placeholder="Enter Dosage" >
                      </td>
                    </tr>
					<tr valign="baseline">
                      <td nowrap align="left"><strong> Manufacturer:</strong></td>
                      <td><input name="manufcaturer" type="text" class="form-control" id="manu" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['manufcuturer']; ?>" required placeholder="Enter Manufacturer" >
                      </td>
                    
                      <td nowrap align="left"><strong>Genaric Name:</strong></td>
                      <td><input name="genericname" type="text" class="form-control" id="gnm"  onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['genericname']; ?>" placeholder="Enter Genaric Name" > </td>
                    </tr>
					
					<tr valign="baseline">
                      <td nowrap align="left"><strong> MRP :</strong></td>
                      <td><input name="mrp" type="text" class="form-control" id="manu" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['mrp']; ?>" required placeholder="Enter MRP Amount" >
                      </td>
                    
                      <td nowrap align="left"><strong> Expiry Date:</strong></td>
                      <td><input name="edtae" type="date" class="form-control" id="gnm"  onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['edate']; ?>" placeholder="Enter Date" > </td>
                    </tr>
					
					<tr valign="baseline">
                      <td nowrap align="left"><strong> Batch No:</strong></td>
                      <td><input name="bno" type="text" class="form-control" id="manu" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['bno']; ?>" required placeholder="Enter Batch No" >
                      </td>
                    
                      <td nowrap align="left"><strong> VAT:</strong></td>
                      <td><input name="vat" type="text" class="form-control" id="gnm"  onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['vat']; ?>" placeholder="Enter VAT Amount" > </td>
                    </tr>
					
					<tr valign="baseline">
                      <td nowrap align="left"><strong> Additional TAX :</strong></td>
                      <td><input name="atax" type="text" class="form-control" id="manu" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['tax']; ?>" required placeholder="Enter Manufacturer" >
                      </td>
                    
                      <td nowrap align="left"><strong> Amount :</strong></td>
                      <td><input name="amt" type="text" class="form-control" id="gnm"  onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['amt']; ?>" placeholder="Enter Amount " > </td>
                    </tr>
				    	<tr valign="baseline">
                      <td nowrap align="left"><strong>Remarks:</strong></td>
                      <td><textarea name="remarks" onblur="makeupper(this.id);"  id="rm" class="form-control" placeholder="Remarks(If Any)" cols="30" rows="3" ><?php echo $row_Recordset1['remarks']; ?></textarea> </td>
                   
                      <td nowrap align="left"><strong>Extra Details:</strong></td>
                      <td><input name="extra" type="text" class="form-control" id="ex" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['extra']; ?>" placeholder="Extra Details"  > </td>
                    </tr>
					
                    
                     <tr valign="baseline" >
                      <td  align="center"  colspan="4"><button type="submit" class="btn btn-default">Submit</button></td>
                    </tr>
                  
				  
				  </table>
                    <input type="hidden" name="MM_insert" value="add-medicine">
                    <input type="hidden" name="MM_update" value="add-medicine">
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
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>

