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


 if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
$updateSQL = sprintf("UPDATE patient SET fname=%s, mname=%s, lname=%s, bdate=%s, city=%s, contactno1=%s, emailid=%s, gender=%s, bgroup=%s,`state`=%s, pincode=%s, adds=%s, remark=%s, type=%s,case_fee=%s WHERE pid=%s",

	   GetSQLValueString($_POST['fname'], "text"),
       GetSQLValueString($_POST['mname'], "text"),
       GetSQLValueString($_POST['lname'], "text"),
       GetSQLValueString($_POST['bdate'], "text"),
       GetSQLValueString($_POST['city'], "text"),
       GetSQLValueString($_POST['contactno1'], "text"),
       GetSQLValueString($_POST['emailid'], "text"),
       GetSQLValueString($_POST['gender'], "text"),
       GetSQLValueString($_POST['bgp'], "text"),
       GetSQLValueString($_POST['pincode'], "text"),
       GetSQLValueString($_POST['height'], "text"),
       GetSQLValueString($_POST['weight'], "text"),
       GetSQLValueString($_POST['adds'], "text"),
       GetSQLValueString($_POST['remark'], "text"),
	   GetSQLValueString($_POST['type'], "text"), 
	   GetSQLValueString($_POST['case_fee'], "text"),
       GetSQLValueString($_GET['id'], "int"));
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());
  $updateGoTo = "allpatients.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM patient WHERE pid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Doct Connect</title>
	<link href="css/plugins/pace/pace.css" rel="stylesheet">
	<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/plugins/messenger/messenger.css" rel="stylesheet">
	<link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
	<link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
	<link href="css/plugins/morris/morris.css" rel="stylesheet">
	<link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
	<link href="css/plugins/datatables/datatables.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/plugins.css" rel="stylesheet">
	<link href="css/demo.css" rel="stylesheet">
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
	<script src="js/plugins/popupoverlay/defaults.js"></script>
	<script>
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
                <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                <li class="active"> Edit Patient Details </li>
              </ol>
            </div>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> Edit Patient Details </h4>
                    </div>
                    <div class="portlet-widgets"> <a href="allpatients.php"  class="pull-right btn-orange btn"> All Patients </a> </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                        <table align="center " class="table-responsive table-condensed table-bordered table ">
                          <tr valign="baseline">
                            <td nowrap><strong>Type:</strong></td>
                            <td><input type="text" name="type" value="<?php echo $row_Recordset1['type']; ?>" size="30" class="form-control"  /></td>
                            <td nowrap><strong>Case Fee:</strong></td>
                            <td><input type="text" name="case_fee" value="<?php echo $row_Recordset1['case_fee']; ?>" size="30" class="form-control"  /></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap><strong>First Name:</strong></td>
                            <td><input type="text" name="fname" value="<?php echo $row_Recordset1['fname']; ?>" size="30"  class="form-control" onblur="makeupper(this.id);" id="fname"></td>
                            <td nowrap><strong>Middle Name:</strong></td>
                            <td><input type="text" name="mname" value="<?php echo $row_Recordset1['mname']; ?>" size="30" class="form-control" id="mname" onblur="makeupper(this.id);"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap><strong>Last Name:</strong></td>
                            <td><input type="text" name="lname" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['lname']; ?>" size="30" placeholder="Enter Last Name" required class="form-control" id="lname"></td>
                            <td nowrap><strong>Age:</strong></td>
                            <td><input type="text" name="bdate" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['bdate']; ?>" size="30" placeholder="Enter Age" class="form-control" id="dd">
                          </tr>
                          <tr valign="baseline">
                            <td nowrap><strong>City:</strong></td>
                            <td><input type="text" name="city" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['city']; ?>" size="30" placeholder="Enter City" required class="form-control" id="city"></td>
                            <td nowrap ><strong>State:</strong></td>
                            <td><input type="text" name="state" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['state']; ?>" size="30" placeholder="Enter State"  class="form-control" id="state" ></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Pin Code:</strong></td>
                            <td><input type="number" name="pincode" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['pincode']; ?>" size="30" placeholder="Enter Pin Code"   class="form-control" id="pincode"></td>
                            <td nowrap><strong>Address:</strong></td>
                            <td><textarea name="adds" id="adds" onblur="makeupper(this.id);"  size="30" placeholder="Enter Address"  class="form-control" cols="28" rows="3"><?php echo $row_Recordset1['adds']; ?></textarea></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap><strong>Primary Contact No :</strong></td>
                            <td><input type="number" name="contactno1" value="<?php echo $row_Recordset1['contactno1']; ?>" size="30" placeholder=" Primary Contact No"  class="form-control" id="contactno1"></td>
                            <td nowrap><strong>Email Id (If Any):</strong></td>
                            <td><input type="email" name="emailid" id="emailid" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['emailid']; ?>" size="30" placeholder="Enter E-Mail Id  "  class="form-control"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap><strong>Gender:</strong></td>
                            <td valign="baseline"><table>
                                <tr>
                                <td><input type="radio" name="gender" value="MALE" <?php if (!(strcmp($row_Recordset1['gender'],"MALE"))) {echo "CHECKED";} ?>>
                                    Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                <td><input type="radio" name="gender" value="FEMALE" <?php if (!(strcmp($row_Recordset1['gender'],"FEMALE"))) {echo "CHECKED";} ?>>
                                    Female</td>
                              </tr>
                              </table></td>
                            <td nowrap ><strong>Blood Group:</strong></td>
                            <td><select name="bgp" id="bgp1"  >
                                <option value="<?php echo "A+";?>" <?php if( $row_Recordset1['bgroup']=='A+'){ echo "selected"; }?>>
                              <?php  echo "A+"; ?>
                              </option>
                                <option value="<?php echo "A-";?>" <?php if( $row_Recordset1['bgroup']=='A-'){ echo "selected"; }?>>
                              <?php  echo "A-"; ?>
                              </option>
                                <option value="<?php echo "B+";?>" <?php if( $row_Recordset1['bgroup']=='B+'){ echo "selected"; }?>>
                              <?php  echo "B+"; ?>
                              </option>
                                <option value="<?php echo "B-";?>" <?php if( $row_Recordset1['bgroup']=='B-'){ echo "selected"; }?>>
                              <?php  echo "B-"; ?>
                              </option>
                                <option value="<?php echo "O+";?>" <?php if( $row_Recordset1['bgroup']=='O+'){ echo "selected"; }?>>
                              <?php  echo "O+";?>
                              </option>
                                <option value="<?php echo "O-";?>" <?php if( $row_Recordset1['bgroup']=='O-'){ echo "selected"; }?>>
                              <?php  echo "O-";?>
                              </option>
                                <option value="<?php echo "AB+";?>" <?php if( $row_Recordset1['bgroup']=='AB+'){ echo "selected"; }?>>
                              <?php  echo "AB+"; ?>
                              </option>
                                <option value="<?php echo "AB-";?>" <?php if( $row_Recordset1['bgroup']=='AB-'){ echo "selected"; }?>>
                              <?php  echo "AB-"; ?>
                              </option>
                                <option value="<?php echo "Misc";?>" <?php if( $row_Recordset1['bgroup']=='Misc'){ echo "selected";} ?>>
                              <?php  echo "Misc"; ?>
                              </option>
                              </select></td>
                          </tr>
                          <tr valign="baseline" >
                            <td nowrap colspan="2"><strong>Reason To Visit Hospital:</strong></td>
                            <td colspan="2"><textarea name="remark" id="remark" onblur="makeupper(this.id);" value="" cols="40" rows="3" placeholder="Enter Reason To Visit Hospital "  class="form-control"><?php echo $row_Recordset1['remark']; ?></textarea></td>
                          </tr>
                          <tr valign="baseline">
                            <td colspan="4" align="center"><input type="submit" value="Update record" class="btn btn-green "></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form1">
                        <input type="hidden" name="pid" value="<?php echo $row_Recordset1['pid']; ?>">
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
