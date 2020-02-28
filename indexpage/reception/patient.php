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


mysql_select_db($database_cn, $cn);
$query_Recordset11 = "SELECT * FROM case_fee";
$Recordset11 = mysql_query($query_Recordset11, $cn) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);



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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$fn=$_POST['fname'];
$ln=$_POST['lname'];
$mno=$_POST['contactno1'];

mysql_select_db($database_cn, $cn);
 $query_Recordset3 = "SELECT pid FROM patient WHERE fname = '$fn' and lname='$ln' and contactno1='$mno' ";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

if($totalRows_Recordset3>0) 
{
$ih=$row_Recordset3['pid']; 

echo ("<script> alert('Patient Is Already Registered with $ih case no'); </script>"); 
echo ("<script> window.location='allpatients.php'; </script>"); 

}
else
{

$insertSQL = sprintf("INSERT INTO patient (fname,mnm, mname, lname, bdate, city, contactno1,  emailid, gender, bgroup,  state, pincode, adds, remark,type,case_fee) VALUES (%s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
					    GetSQLValueString($_POST['mnm'], "text"),
                       GetSQLValueString($_POST['mname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['bdate'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['contactno1'], "text"),
                       GetSQLValueString($_POST['emailid'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['bgp'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['pincode'], "text"),
                       GetSQLValueString($_POST['add'], "text"),
                       GetSQLValueString($_POST['remark'], "text"),
                   	   GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['case_fee'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

$fv=mysql_insert_id();


$FN=$_POST['fname'];
$LN=$_POST['lname'];

//Your authentication key
$authKey = "733AIv8mM7RNp5528aa6c";

$dn=$_POST['contactno1'];

//Multiple mobiles numbers separated by comma
$mobileNumber = $dn;

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "INFOBI";

$NK=date('d/m/y');

mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT pid FROM patient ORDER BY pid DESC";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);



$NN=$row_Recordset2['pid'];

//Your message to send, Add URL encoding here.
$message = urlencode(" DEAR $FN  $LN
CASE NO:- $NN 
DATE:- $NK
HAVE A GOOD HEALTH 
HOSPITAL TEAM ");

//Define route s
$route = "default";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://www.tripadasmsbox.com/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);
//echo $output;
  $insertGoTo = "case_bill.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?pid=".$fv;
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"  />
	<title>Patient-Doct Connect</title>
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
	<script>
	function makeupper(obj)
	{
	var f=document.getElementById(obj).value;
	document.getElementById(obj).value=f.toUpperCase();
	}	
	</script>
	<script type="text/javascript">
		   function	chk(dd)
		   {
			   window.location="patient.php?dd="+dd;
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
            <div class="page-title"> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> New Patient </h4>
                    </div>
                    <div class="portlet-widgets"> <a href="allpatients.php"  class="pull-right btn-orange btn"> All Patients </a> </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form method="post" name="form1" action="<?php echo $editFormAction; ?>" id="f1">
                        <table align="center" class="table-responsive table-condensed table-bordered table ">
                          <tr valign="baseline">
                            <td nowrap ><strong>Type:</strong></td>
                            <td><select type="text" name="type" class="form-control" onchange="chk(this.value)" id="dd">
                                <option value="">----Select Type---</option>
                                <?php
do {  
?>
                                <option value="<?php echo $row_Recordset11['name']?>" <?php if(isset($_GET['dd'])){
							  
				if($_GET['dd']==$row_Recordset11['name']){			  
							  
							  
							   ?> selected="selected"<?php }}?>><?php echo $row_Recordset11['name']?></option>
                                <?php
} while ($row_Recordset11 = mysql_fetch_assoc($Recordset11));
  $rows = mysql_num_rows($Recordset11);
  if($rows > 0) {
      mysql_data_seek($Recordset11, 0);
	  $row_Recordset11 = mysql_fetch_assoc($Recordset11);
  }
?>
                              </select></td>
                            <?php if(isset($_GET['dd']))
		
		{
		$ii=$_GET['dd'];
		mysql_select_db($database_cn, $cn);
$query_Recordset111	 = "SELECT * FROM case_fee where name='$ii'";
$Recordset111 = mysql_query($query_Recordset111, $cn) or die(mysql_error());
$row_Recordset111 = mysql_fetch_assoc($Recordset111);
$totalRows_Recordset111 = mysql_num_rows($Recordset111);

		?>
                            <td nowrap><strong>Case Fee:</strong></td>
                            <td><input type="text" name="case_fee" value="<?php echo $row_Recordset111['price']; ?>" size="30" class="form-control" readonly="" /></td>
                            <?php }?>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>First Name:</strong></td>
                            <td><input type="text" name="fname" value="" size="30" placeholder="Enter First Name" class="form-control" onblur="makeupper(this.id);" id="fnm" ></td>
                            <td nowrap ><strong>Father Name:</strong></td>
                            <td><input type="text" name="mname" value="" size="30" placeholder="Enter Middle Name"  class="form-control" onblur="makeupper(this.id);" id="mnm" ></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Mother Name:</strong></td>
                            <td><input type="text" name="mnm" value="" size="30" placeholder="Enter Mother Name" id="mm" class="form-control" onblur="makeupper(this.id);"></td>
                            <td nowrap ><strong>Surname:</strong></td>
                            <td><input type="text" name="lname" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Last Name " class="form-control" id="lname"></td>
                          <tr valign="baseline">
                            <td nowrap ><strong>Age:</strong></td>
                            <td><input type="text" name="bdate" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Age" class="form-control" id="bdate"></td>
                            <td nowrap ><strong>City/Village:</strong></td>
                            <td><input type="text" name="city" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter City"  class="form-control" id="city"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>State:</strong></td>
                            <td><input type="text" name="state" onblur="makeupper(this.id);" value="Gujarat" size="30" placeholder="Enter State"  class="form-control" id="state"></td>
                            <td nowrap ><strong>Pin Code:</strong></td>
                            <td><input type="number" name="pincode" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Pin Code"  class="form-control" id="pincode"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Address:</strong></td>
                            <td><textarea name="add" onblur="makeupper(this.id);" value="" size="" cols="25" rows="3" placeholder="Enter Address" class="form-control" id="add"></textarea></td>
                            <td nowrap ><strong>Primary Contact No :</strong></td>
                            <td><input type="number" name="contactno1" value="" size="70" placeholder=" Primary Contact No" class="form-control" id="contactno1"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Email Id (If Any):</strong></td>
                            <td><input type="email" name="emailid" id="emailid" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter E-Mail Id "  class="form-control"></td>
                            <td nowrap ><strong>Gender:</strong></td>
                            <td valign="baseline"><input type="radio" name="gender" value="MALE" required>
                              Male
                              <input type="radio" name="gender" value="FEMALE" >
                              Female</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Blood Group:</strong></td>
                            <td><select name="bgp" id="bgp1"class="form-control">
                                <option value="<?php echo "A Positive";?>"><?php echo "A Positive"; ?></option>
                                <option value="<?php echo "A Negative";?>"><?php echo "A Negative"; ?></option>
                                <option value="<?php echo "B Positive";?>"><?php echo "B Positive"; ?></option>
                                <option value="<?php echo "B Negative";?>"><?php echo "B Negative"; ?></option>
                                <option value="<?php echo "O Positive";?>"><?php echo "O Positive"; ?></option>
                                <option value="<?php echo "O Negative";?>"><?php echo "O Negative"; ?></option>
                                <option value="<?php echo "AB Positive";?>"><?php echo "AB Positive"; ?></option>
                                <option value="<?php echo "AB Negative";?>"><?php echo "AB Negative"; ?></option>
                                <option selected="selected" value="<?php echo "Misc";?>"><?php echo "Misc"; ?></option>
                              </select></td>
                            <td nowrap colspan=""><strong>Reason To Visit Hospital:</strong></td>
                            <td colspan=""><textarea name="remark" id="remark" onblur="makeupper(this.id);" value="" cols="40" rows="3" placeholder="Enter Reason To Visit Hospital"  class="form-control"></textarea></td>
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
