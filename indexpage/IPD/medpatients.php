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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  
}

if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
$id=$_GET['pid'];

mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM patient where pid='$id'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_getkist = "SELECT * FROM medicine";
$getkist = mysql_query($query_getkist, $cn) or die(mysql_error());
$row_getkist = mysql_fetch_assoc($getkist);
$totalRows_getkist = mysql_num_rows($getkist);
session_start();
$did=$_SESSION['MM_DOCTOR'];

if(isset($_POST['add_medicine'])){
	
	$dosageM=$_POST['dosageM'];
	$dosageA=$_POST['dosageA'];
	$dosageE=$_POST['dosageE'];
	$dosageN=$_POST['dosageN'];
	
	
	
	$dosage=$dosageM."-".$dosageA."-".$dosageE."-".$dosageN;
  echo   $insertSQL = sprintf("INSERT INTO p_medicine (mid,pid,did,noofdays,dosage,quantity) VALUES (%s,%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['medicine'], "int"),
                       GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($did, "int"),
					   GetSQLValueString($_POST['noofdays'], "text"),
				   	   GetSQLValueString($dosage, "text"),
				       GetSQLValueString($_POST['quantity'], "text")
					);
					
	$dM=$_POST['dosageM'];
	if($dM=="0"){$ss='None';}else{$ss='Pending';}			
	$dA=$_POST['dosageA'];
	if($dA=="0"){$ss1='None';}else{$ss1='Pending';}
	$dE=$_POST['dosageE'];
	if($dE=="0"){$ss2='None';}else{$ss2='Pending';}
	$dN=$_POST['dosageN'];
	if($dN=="0"){$ss3='None';}else{$ss3='Pending';}
	mysql_select_db($database_cn, $cn);
  	$Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
	$tt=mysql_insert_id();
	
	mysql_query("INSERT INTO morning(mid,status) VALUES('$tt','$ss') ");
	
	mysql_query("INSERT INTO afternoon(mid,status) VALUES('$tt','$ss1') ");
	
	mysql_query("INSERT INTO evening(mid,status) VALUES('$tt','$ss2') ");
	
	mysql_query("INSERT INTO night(mid,status) VALUES('$tt','$ss3') ");
	$insertGoTo = "medpatients.php?pid=".$_GET['pid'];
 
  header(sprintf("Location: %s", $insertGoTo));
}

if(isset($_POST['submit_remark'])){
	
	$updateSQL = "UPDATE p_medicine SET remarks='". $_POST['remarks'] ."'  WHERE pid='$id' and status='0'";
	mysql_select_db($database_cn, $cn);
  	$Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());
 	header("location:generateMedPDF.php?pid=".$id);
	
}	

/* Delete*/	
if ((isset($_GET['mid'])) && ($_GET['mid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM p_medicine WHERE mid=%s",
                       GetSQLValueString($_GET['mid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());
  
  $dc=mysql_num_rows($Result1);
  
  
  $deleteGoTo = "medpatients.php?pid=".$_GET['pid'];
 
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Medicine-Doct Connect</title>
	<link href="css/plugins/pace/pace.css" rel="stylesheet">
	<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
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
	<link rel="stylesheet" href="../chosen_v1.1.0/chosen.css">
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
	<script src="new/throttle-debounce-min.js"></script>
	<script src="new/extensions.js"></script>
	<script>
	$(document).ready(function(){
		$(".txt").each(function() {
			$(this).keyup(function(){
				calculateSum();
			});
		});
	});

	function calculateSum() {
		var sum = 0;
		$(".txt").each(function() {
			if(!isNaN(this.value) && this.value.length!=0) {
				sum += parseFloat(this.value);
			}
		});
		
		var nod=noofdays.value;
		var qty =sum.toFixed(2) * nod;
		
		 
		document.getElementById('quantity').value=qty;
	// $("#sum").html(sum.toFixed(2));
	
	}
	</script>
	<script language="javascript">


		


	function makeupper(obj)
	{
		
		var f=document.getElementById(obj).value;
		document.getElementById(obj).value= f.toUpperCase();
	}

function  getc(id,pid)
	{
	
	
if( confirm('Are you sure you want to delete?'))
{

 window.location='givepre.php?dpmid='+id+'&pid='+pid;
    

}
else
{
return false;
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
              <h1>  <?php echo $row_Recordset1['fname']. "  ".$row_Recordset1['mname']."  ".$row_Recordset1['lname'] ; ?> </h1>
                <?php include('button.php')?>
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
              
              <div class="col-lg-5">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left"> Selected Medicine</h4>
                      <input type="hidden" value="<?php echo $_GET["pid"]; ?>" name="pidd" id="pidd" />
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="basicFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form name='f1' method="post" action='<?php echo $editFormAction; ?>'>
                        <table  align="center"  class="table-hover table-responsive table-condensed table-bordered " style="width:100%">
                          <tr>
                            <td> Select Medicine</td>
                            <td><select name="medicine" required data-placeholder="Choose Medicine" class="chosen-select form-control" style="height:35px;">
                                <option value=""></option>
                                <?php  do { ?>
                                <?php  //if(!in_array($row_getkist['mid'],$selected_medicine)) { ?>
                                <option value="<?php echo $row_getkist['mid']?>"
	  
	  <?php if(isset($_GET['id'])){ if($row_getkist['mid']==$_GET['id']) { echo 'selected';} } ?>
	  
	   ><?php echo $row_getkist['name']; ?></option>
                                <?php
//} 
} while ($row_getkist = mysql_fetch_assoc($getkist));
  $rows = mysql_num_rows($getkist);
  if($rows > 0) {
      mysql_data_seek($getkist, 0);
	  $row_getkist = mysql_fetch_assoc($getkist);
  } 
?>
                              </select></td>
                          </tr>
                          <tr>
                            <td>No of Days</td>
                            <td><input type="text" value="1" class="form-control " onblur="makeupper(this.id)" id="noofdays"   name="noofdays" /></td>
                          </tr>
                          <tr>
                          <tr>
                            <td>Dosage</td>
                            <td><table>
                                <tr align="center">
                                <td class="alert alert-info">Morning</td>
                                <td  class="alert alert-info">After Noon</td>
                              </tr>
                                <tr>
                                <td><input type="number" onchange="" class="form-control txt" id="dosageM"  value="0" name="dosageM"/></td>
                                <td><input type="number" class="form-control txt" id="dosageA"  value="0" name="dosageA" /></td>
                              </tr>
                                <tr align="center" >
                                <td  class="alert alert-info">Evening</td>
                                <td  class="alert alert-info">Night</td>
                              </tr>
                                <tr style="width:20px">
                                <td><input type="number" class="form-control txt" id="dosageE" value="0"   name="dosageE"/></td>
                                <td><input type="number" class="form-control txt" id="dosageN" value="0" name="dosageN" /></td>
                              </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td>Quantity</td>
                            <td><input type="text" id="quantity" name="quantity" style="color:#F00"  /></td>
                          </tr>
                          <tr>
                            <td colspan=3><button type="submit" name="add_medicine"  class="btn btn-default" style="float:right">Add</button></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="f1">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="portlet portlet-default">
                  <div class="portlet-heading">
                    <div class="portlet-title">
                      <h4 style="float:left">Selected Medicine</h4>
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
                              <td nowrap=""><textarea name="remarks" cols="40" rows="5"></textarea></td>
                            </tr>
                            <?php  
			
		$query_Recordset2 = "SELECT *,p_medicine.dosage FROM p_medicine JOIN medicine ON medicine.mid=p_medicine.mid WHERE status='0' and  pid=".$_GET['pid'];
					$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
					$totalRows_Recordset2 = mysql_num_rows($Recordset2);
						
						//$date = strtotime($row1['created_time']);
						//$date2 = strtotime('+2min');
						//echo 'date'.$date;
						//echo 'date2'.$date2;
						//echo 'date3'. date("Y-m-d G:i:s");
						
						 'date4'.strtotime(date("Y-m-d G:i:s"));
						// || strtotime($date) == strtotime(date('Y-m-d'))
		//if($totalRows_Recordset2 !=0) {			
		?>
                            <?php if($totalRows_Recordset2 > 0) { ?>
                            <tr>
                              <td colspan="2"><table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                  <thead>
                                  <tr>
                                      <td>Selected Medicine</td>
                                      <td>Dosage</td>
                                      <td>Quantity</td>
                                      <td></td>
                                    </tr>
                                </thead>
                                  <tbody>
                                  <?php
						while($row = mysql_fetch_assoc($Recordset2)){ ?>
                                  <tr>
                                      <td><?php echo $row['name']; ?></td>
                                      <td><?php echo $row['dosage']; ?></td>
                                      <td><?php echo $row['quantity']; ?></td>
                                      <td><button type="button" class="btn btn-danger" onclick="getp(<?php echo $row['mid'];?>,<?php echo $_GET['pid']; ?>); "><i class="fa fa-times"></i></button></td>
                                    </tr>
                                  <?php  } ?>
                                  <script>
						function  getp(mid,pid) {
							if( confirm('Are you sure you want to delete?')) {
						 		window.location='medpatients.php?mid='+ mid + '&pid=' + pid;
							} else { 
								return false;
							}	 
						}
					</script>
                                </tbody>
                                </table>
                                <?php // } ?></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap="" align="right" colspan="2"><input type="submit" value="Submit" class="btn btn-green " name="submit_remark"></td>
                            </tr>
                            <?php } else { ?>
                              <label class="label label-info" class="pull-right">
                          Zero Medicine Selected.
                            </label>
                          
                          <label></label>
                          <?php } ?>
                            </tbody>
                          
                        </table>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.portlet --> 
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
    <!-- Button to trigger modal --> 
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script> 
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script> 
    <script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script> 
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
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
    <script src="../chosen_v1.1.0/chosen.jquery.js"></script> 
    <script src="../chosen_v1.1.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script> 
    <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</body>
</html>

