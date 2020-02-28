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
$query_Recordset1 = "SELECT * FROM identification";
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






$insertSQL = sprintf("INSERT INTO physio (fname, mname, lname, bdate, city, contactno1, contactno2, emailid, gender,bgroup,iden_type,iden_no,religion,state,smoker,tobacco,alcohol,pincode,height,weight,adds,remark,mnm,gnm) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['mname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['bdate'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['contactno1'], "text"),
                       GetSQLValueString($_POST['contactno2'], "text"),
                       GetSQLValueString($_POST['emailid'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
					   GetSQLValueString($_POST['bgp'], "text"),
					   GetSQLValueString($_POST['iden_type'], "text"),
					   GetSQLValueString($_POST['iden_no'], "text"),
					   GetSQLValueString($_POST['religion'], "text"),
					   GetSQLValueString($_POST['state'], "text"),
					   GetSQLValueString($_POST['smoker'], "text"),
					   GetSQLValueString($_POST['tobacco'], "text"),
					   GetSQLValueString($_POST['alcohol'], "text"),
					   GetSQLValueString($_POST['pincode'], "text"),
					   GetSQLValueString($_POST['height'], "text"),
					   GetSQLValueString($_POST['weight'], "text"),
					   GetSQLValueString($_POST['add'], "text"),
					    GetSQLValueString($_POST['remark'], "text"),
						 GetSQLValueString($_POST['mnm'], "text"),
						  GetSQLValueString($_POST['gnm'], "text")
					   );

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());




$FN=$_POST['fname'];
$LN=$_POST['lname'];

//Your authentication key
$authKey = "801AMGuJzQjY554b10cb";
$dn=$_POST['contactno1'];

//Multiple mobiles numbers separated by comma
$mobileNumber = $dn;

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "SHRDHA";

$NK=date('d/m/y');

mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT pid FROM patient ORDER BY pid DESC";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);



$NN=$row_Recordset2['pid'];

//Your message to send, Add URL encoding here.
$message = urlencode(" DEAR $FN  $LN... CASE NO:- $NN.... AS PER REGISTERED ON $NK.. HAVE A GOOD HEALTH - BY SHRADDHA HOSPITAL TEAM ");

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



  $insertGoTo = "all_physio.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
		{
		   function	chk(dd)
		   {
			   document.location="patient.php?dd="+dd;
		   }
			
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
              <h1> Add New Physio </h1>
              <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                <li class="active"> Add New Physio </li>
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
                      <h4 style="float:left"> New Data </h4>
                    </div>
                    <div class="portlet-widgets"> <a href="all_physio.php"  class="pull-right btn-orange btn"> All Physio Data </a> </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form method="post" name="form1" action="<?php echo $editFormAction; ?>" id="f1">
                        <table align="center" class="table-responsive table-condensed table-bordered table ">
                          <tr valign="baseline">
                            <td nowrap ><strong>First Name:</strong></td>
                            <td><input type="text" name="fname" value="" size="30" placeholder="Enter First Name " class="form-control" onblur="makeupper(this.id);" ></td>
                            <td nowrap ><strong>Middle Name:</strong></td>
                            <td><input type="text" name="mname" value="" size="30" placeholder="Enter Middle Name"  class="form-control" id="mname" onblur="makeupper(this.id);"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Mother Name:</strong></td>
                            <td><input type="text" name="mnm" value="" size="30" placeholder="Enter Mother Name" class="form-control" onblur="makeupper(this.id);"></td>
                            <td nowrap ><strong>Grandfather Name:</strong></td>
                            <td><input type="text" name="gnm" value="" size="30" placeholder="Enter Grandfather Name"  class="form-control" onblur="makeupper(this.id);"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Last Name:</strong></td>
                            <td><input type="text" name="lname" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Last Name " class="form-control"></td>
                            <td nowrap ><strong>Age:</strong></td>
                            <td><input type="text" name="bdate" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Age" class="form-control"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>City:</strong></td>
                            <td><input type="text" name="city" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter City"  class="form-control" id="city"></td>
                            <td nowrap ><strong>State:</strong></td>
                            <td><input type="text" name="state" onblur="makeupper(this.id);" value="Gujarat" size="30" placeholder="Enter State"  class="form-control" id="state"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Pin Code:</strong></td>
                            <td><input type="number" name="pincode" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Pin Code"  class="form-control" id="pincode"></td>
                            <td nowrap  ><strong>Height:</strong></td>
                            <td><input type="text" name="height" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Height"  class="form-control" id="height"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Weight:</strong></td>
                            <td><input type="text" name="weight" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Weight"  class="form-control"></td>
                            <td nowrap ><strong>Address:</strong></td>
                            <td><textarea name="add" onblur="makeupper(this.id);" value="" size="" cols="27" rows="3" placeholder="Enter Address" class="form-control" id="add"></textarea></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Primary Contact No :</strong></td>
                            <td><input type="number" name="contactno1" value="" size="70" placeholder=" Primary Contact No" class="form-control" ></td>
                            <td nowrap ><strong>Secondary Contact No (If Any) :</strong></td>
                            <td><input type="number" name="contactno2" value="" size="30" placeholder="Secondary Contact No" class="form-control"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Email Id (If Any):</strong></td>
                            <td><input type="email" name="emailid" id="emailid" onblur="makeupper(this.id);" value="" size="32" placeholder="Enter E-Mail Id "  class="form-control"></td>
                            <td nowrap ><strong>Religion:</strong></td>
                            <td><select name="religion" id="religion"  class="form-control">
                                <option>----Select----</option>
                                <option>Hindu</option>
                                <option>Muslim</option>
                                <option>Sikh</option>
                                <option>Christian</option>
                                <option>Other</option>
                              </select></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Gender:</strong></td>
                            <td valign="baseline"><input type="radio" name="gender" value="MALE" required>
                              Male
                              <input type="radio" name="gender" value="FEMALE" >
                              Female</td>
                            <td nowrap ><strong>Blood Group:</strong></td>
                            <td><select name="bgp" id="bgp1"class="form-control">
                                <option value=""><?php echo "Select"; ?></option>
                                <option value="<?php echo "A Positive";?>"><?php echo "A Positive"; ?></option>
                                <option value="<?php echo "A Negative";?>"><?php echo "A Negative"; ?></option>
                                <option value="<?php echo "B Positive";?>"><?php echo "B Positive"; ?></option>
                                <option value="<?php echo "B Negative";?>"><?php echo "B Negative"; ?></option>
                                <option value="<?php echo "O Positive";?>"><?php echo "O Positive"; ?></option>
                                <option value="<?php echo "O Negative";?>"><?php echo "O Negative"; ?></option>
                                <option value="<?php echo "AB Positive";?>"><?php echo "AB Positive"; ?></option>
                                <option value="<?php echo "AB Negative";?>"><?php echo "AB Negative"; ?></option>
                                <option value="<?php echo "Misc";?>"><?php echo "Misc"; ?></option>
                              </select></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap ><strong>Identification Type:</strong></td>
                            <td><select name="iden_type" onblur="makeupper(this.id);"  class="form-control" id="iden_type" >
                                <option value="value">----Identification Type----</option>
                                <?php
do {  
?>
                                <option value="<?php echo $row_Recordset1['type']?>"><?php echo $row_Recordset1['type']?></option>
                                <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                              </select></td>
                            <td nowrap ><strong>Identification No:</strong></td>
                            <td><input type="text" name="iden_no" id="iden_no" onblur="makeupper(this.id);" value="" size="30" placeholder="Enter Identification No "  class="form-control"></td>
                          </tr>
                          </td>
                          
                          </tr>
                          
                          <tr valign="baseline">
                            <td nowrap colspan="4"><strong> Smoker:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" name="smoker" id="smoker">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong> Tobacco:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" name="tobacco"  >
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong> Alcohol:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" name="alcohol"  ></td>
                          </tr>
                          <tr valign="baseline" >
                            <td nowrap colspan="2"><strong>Reason To Visit Hospital:</strong></td>
                            <td colspan="2"><textarea name="remark" id="remark" onblur="makeupper(this.id);" value="" cols="40" rows="3" placeholder="Enter Reason To Visit Hospital "  class="form-control"></textarea></td>
                          </tr>
                          <tr valign="baseline">
                            <td colspan="4" align="center"><input type="submit" value="Submit" class="btn btn-green " name="submit"></td>
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
<?php
mysql_free_result($Recordset1);
?>
