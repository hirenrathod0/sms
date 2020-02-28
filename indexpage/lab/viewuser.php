<?php require_once('../Connections/cn.php'); ?>
<?php 
if(!isset($_SESSION['MM_LAB'])){
	header('login.php');
}
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updateuser")) {
  $updateSQL = sprintf("UPDATE user SET fullname=%s, gender=%s, birthdate=%s, address=%s, city=%s, contact=%s, email=%s, type=%s WHERE uid=%s",
                       GetSQLValueString($_POST['fullname'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['birthdate'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['contact'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "viewuser.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE userlogin SET  password=%s WHERE uid=%s",
                     
                       GetSQLValueString($_POST['password'], "text"),
                        GetSQLValueString($_POST['uid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "viewuser.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_GET['removeuserauth'])) && ($_GET['removeuserauth'] != "")) {
  $deleteSQL = sprintf("DELETE FROM userlogin WHERE uid=%s",
                       GetSQLValueString($_GET['removeuserauth'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "viewuser.php";
 
  header(sprintf("Location: %s", $deleteGoTo));
}



$colname_useroverview_rs = "-1";
if (isset($_GET['id'])) {
  $colname_useroverview_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cn, $cn);
$query_useroverview_rs = sprintf("SELECT * FROM user WHERE uid = %s", $colname_useroverview_rs);
$useroverview_rs = mysql_query($query_useroverview_rs, $cn) or die(mysql_error());
$row_useroverview_rs = mysql_fetch_assoc($useroverview_rs);
$totalRows_useroverview_rs = mysql_num_rows($useroverview_rs);



mysql_select_db($database_cn, $cn);
$query_select_usercat_list_rs = "SELECT * FROM usercategory";
$select_usercat_list_rs = mysql_query($query_select_usercat_list_rs, $cn) or die(mysql_error());
$row_select_usercat_list_rs = mysql_fetch_assoc($select_usercat_list_rs);
$totalRows_select_usercat_list_rs = mysql_num_rows($select_usercat_list_rs);

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM userlogin WHERE uid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Profile-Doct Connect</title>
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
    <!-- begin PAGE TITLE ROW -->
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> User/Employee <small>Information</small> </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.phpl">Home</a> </li>
            <li class="active">User Profile</li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- end PAGE TITLE ROW -->
    <div class="row">
      <div class="col-lg-12">
        <div class="portlet portlet-default">
          <div class="portlet-body">
            <ul id="userTab" class="nav nav-tabs">
              <li class="active"><a href="#overview" data-toggle="tab">Overview</a> </li>
              <li><a href="#profile-settings" data-toggle="tab">Update Profile</a> </li>
            </ul>
            <div id="userTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="overview">
                <div class="row">
                 <div class="col-lg-7 col-md-5">
                    <h3>Personal Information</h3>
                    <h4>Name <small><?php echo $row_useroverview_rs['fullname']; ?></small></h4>
                    <h4>Gender <small><?php echo $row_useroverview_rs['gender']; ?></small></h4>
                    <h4>BirthDate <small><?php echo $row_useroverview_rs['birthdate']; ?></small></h4>
                    <h4>Department <small><?php echo $row_useroverview_rs['type']; ?></small></h4>
                  </div>
                  <div class="col-lg-3 col-md-4">
                    <h3>Contact Details</h3>
                    <p><i class="fa fa-arrow-circle-right"></i> <?php echo $row_useroverview_rs['address']; ?> </p>
                    <p><i class="fa fa-building-o fa-muted fa-fw"></i> <?php echo $row_useroverview_rs['city']; ?></p>
                    <p><i class="fa fa-phone fa-muted fa-fw"></i> <?php echo $row_useroverview_rs['contact']; ?></p>
                    <p><i class="fa fa-envelope-o fa-muted fa-fw"></i> <a href="#"><?php echo $row_useroverview_rs['email']; ?></a> </p>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="profile-settings">
                <div class="row">
                  <div class="col-sm-3">
                    <ul id="userSettings" class="nav nav-pills nav-stacked">
                      <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Basic Information</a> </li>
                      <li><a href="#changePassword" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> Change Authentication</a> </li>
                    </ul>
                  </div>
                  <div class="col-sm-9">
                    <div id="userSettingsContent" class="tab-content">
                      <div class="tab-pane fade in active" id="basicInformation">
                        <form method="POST" action="<?php echo $editFormAction; ?>" role="form" name="updateuser">
						  <table id="example-table" class="table table-striped table-bordered table-hover table-green">	
                           
						   
						   <div class="form-group">
                            <input type="hidden" name="id"  value="<?php echo $row_useroverview_rs['uid']; ?>" />
                         <tr> 
						 <td>  
							<label>Full Name</label>
                          </td>
						  <td> 
						    <input type="text" name="fullname"  id="fnm"onblur="makeupper(this.id);" class="form-control" value="<?php echo $row_useroverview_rs['fullname']; ?>">
                         </td>
						 </tr>
						 
						  </div>
                         
						   <div class="form-group">
                           
						    <tr> 
						 <td>  <label for="exampleInputEmail1">Gender </label>
						 </td>
						 <td>
                            <input type="radio" name="gender" value="Male" <?php if(!(strcmp($row_useroverview_rs['gender'],"MALE"))){ echo 'CHECKED'; } ?> />
                            MALE
							
							
                            <input type="radio" name="gender" Value= "Female"  <?php if(!(strcmp($row_useroverview_rs['gender'],"FEMALE"))){ echo 'CHECKED'; } ?> />
                            FEMALE 
							</td>
							</tr>
							</div>
						
                           <div class="form-group">
                          
						 <tr><td>
						   <label>BirthDate</label>
                            </td>
							<td>
							<input type="date" name="birthdate" id="bdt"onblur="makeupper(this.id);" class="form-control" value="<?php echo $row_useroverview_rs['birthdate']; ?>">
                         </td></tr>
						  </div>
						
                             <div class="form-group">
							 <tr><td>
                            <label>Address</label>
                           </td>
						   <td>
						    <textarea name="address" class="form-control" cols="15" id="add"onblur="makeupper(this.id);" rows="3"><?php echo $row_useroverview_rs['address']; ?></textarea>
                         </td>
						 </tr>
						  </div>
						  
                           <div class="form-inline">
                            <div class="form-group">
                           <tr><td>
						      <label>City</label>
                             </td>
							 <td>
							 
							  <input type="text" name="city" id="city"onblur="makeupper(this.id);" class="form-control" value="<?php echo $row_useroverview_rs['city']; ?>">
                            </td>
							</tr>
							</div>
                          </div>
						 
                          
						    <div class="form-group">
                            
							<tr><td><label><i class="fa fa-envelope-o fa-fw"></i> Contact</label>
                            </td>
							<td>
							<input type="text" class="form-control" name="contact" value="<?php echo $row_useroverview_rs['contact']; ?>">
</td></tr>
                          </div>
						  
						     <div class="form-group">
                           <tr><td>
						    <label><i class="fa fa-envelope-o fa-fw"></i> Email</label>
                            </td>
							<td>
							<input type="email" class="form-control" id="email"onblur="makeupper(this.id);" name="email" value="<?php echo $row_useroverview_rs['email']; ?>">
                          </td>
						  </tr>
						  </div>
						 
						     <div class="form-group">
                          
						  <tr><td>  <label for="exampleInputEmail1">Select Type</label>
                           </td>
						  <td>
						    <select class="form-control" name="type">
                              <option value="<?php echo $row_useroverview_rs['type']; ?>"><?php echo $row_useroverview_rs['type']; ?></option>
                              <?php
do {  
?>
                              <option value="<?php echo $row_select_usercat_list_rs['name']?>"><?php echo $row_select_usercat_list_rs['name']?></option>
                              <?php
} while ($row_select_usercat_list_rs = mysql_fetch_assoc($select_usercat_list_rs));
  $rows = mysql_num_rows($select_usercat_list_rs);
  if($rows > 0) {
      mysql_data_seek($select_usercat_list_rs, 0);
	  $row_select_usercat_list_rs = mysql_fetch_assoc($select_usercat_list_rs);
  }
?>
                            </select>
							</td></tr>
                          </div>
                        <tr><td colspan="2">   
						   <button type="submit" class="btn btn-default">Update Profile</button>
                          <button class="btn btn-green">Cancel</button>
                          <input type="hidden" name="MM_update" value="updateuser">
                       </td>
					   	</table>
					   
					    </form>
                      </div>
                      <div class="tab-pane fade in" id="changePassword">
                        <?php
			
			
			$n=$_GET['id'];
			$query_Recordset1 = "SELECT * FROM userlogin WHERE uid =$n ";
			$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
			$row_Recordset1 = mysql_fetch_assoc($Recordset1);
			$totalRows_Recordset1 = mysql_num_rows($Recordset1);
			if($totalRows_Recordset1>0) {

			 ?>
                        <h3>Change Authentication:</h3>
                        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                         <table id="example-table" class="table table-striped table-bordered table-hover table-green">	
						    <tr valign="baseline">
                              <td nowrap align="right">Password:</td>
                              <td><input type="text" class="form-control" name="password" value="<?php echo $row_Recordset1['password']; ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">&nbsp;</td>
                              <td><input type="submit"  class="btn btn-default" value="Update"></td>
                            </tr>
                          </table>
                          <input type="hidden" name="MM_update" value="form1">
                          <input type="hidden" name="uid" value="<?php echo $row_Recordset1['uid']; ?>">
                        </form>
                        <?php } else { ?>
                        <label class="btn btn-purple" >Sorry No Authenticate.</label>
                        <?php }     ?>
                        <!--<label for="exampleInputEmail1">User Name</label>
								<input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username">
								</div>
								
								<div class="form-group">
								  <label for="exampleInputEmail1">Password</label>
								  <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="Password">
								</div>
								
								<button type="submit" class="btn btn-default">Update</button>
							 
							 
							 
								</form>		
							-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.portlet-body -->
        </div>
        <!-- /.portlet -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.page-content -->
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
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($useroverview_rs);

mysql_free_result($Recordset1);
?>
