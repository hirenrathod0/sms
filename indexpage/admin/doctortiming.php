<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_Username']))
{
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fsub")) {

$colname_gettco = $_POST['dday'];
$dddid=$_POST['did'];


if($colname_gettco=="Week"){
  
  $deleteSQL = sprintf("DELETE FROM drtime WHERE did=%s",
                       GetSQLValueString($_POST['did'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  
  
  
  
  $a=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
  
   foreach($a as $value )
   {
     
      $insertSQL = sprintf("INSERT INTO drtime (did, dday, dstart, dend) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($dddid, "int"),
                       GetSQLValueString($value, "text"),
                       GetSQLValueString($_POST['intime'], "text"),
                       GetSQLValueString($_POST['outtime'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

	 
	 
   
   }
   
  
  
  
  $insertGoTo = "doctortiming.php?msg=s";

  header(sprintf("Location: %s", $insertGoTo));
  
  
}
else
{

mysql_select_db($database_cn, $cn);
$query_gettco = sprintf("SELECT * FROM drtime WHERE dday = '%s' AND did='%s'", $colname_gettco,$dddid);
$gettco = mysql_query($query_gettco, $cn) or die(mysql_error());
$row_gettco = mysql_fetch_assoc($gettco);
$totalRows_gettco = mysql_num_rows($gettco);

if($totalRows_gettco > 0){
$drid=$row_gettco['drid'];
$insertSQL = sprintf("update drtime set dstart=%s, dend=%s where drid=%s",
                       GetSQLValueString($_POST['intime'], "text"),
                       GetSQLValueString($_POST['outtime'], "text"),
                       GetSQLValueString($drid, "text")
                     );

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "doctortiming.php?msg=e";

  header(sprintf("Location: %s", $insertGoTo));



}
else
{
  
  $insertSQL = sprintf("INSERT INTO drtime (did, dday, dstart, dend) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['did'], "int"),
                       GetSQLValueString($_POST['dday'], "text"),
                       GetSQLValueString($_POST['intime'], "text"),
                       GetSQLValueString($_POST['outtime'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "doctortiming.php?msg=s";

  header(sprintf("Location: %s", $insertGoTo));
  
  }
}
}

/* doctor list*/
mysql_select_db($database_cn, $cn);
$query_getdoctor = "SELECT * FROM `user` WHERE type = 'Doctor'";
$getdoctor = mysql_query($query_getdoctor, $cn) or die(mysql_error());
$row_getdoctor = mysql_fetch_assoc($getdoctor);
$totalRows_getdoctor = mysql_num_rows($getdoctor);



/* end */

/* gettimedr*/

function getdrtime($did,$day)
{
/*
mysql_select_db($database_cn, $cn);
$query_gettt = "SELECT * FROM drtime WHERE dday='$day' AND did='$did'";
$gettt = mysql_query($query_gettt, $cn) or die(mysql_error());
$row_gettt = mysql_fetch_assoc($gettt);
$totalRows_gettt = mysql_num_rows($gettt);

$colname_Recordset1 = "-1";
if (isset($_POST['dday'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_POST['dday'] : addslashes($_POST['dday']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE dday = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$tt=$row_gettt['dstart']+'To'+$row_gettt['dend'];
return $tt;
*/


}

/* end */

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
	 $(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');

	
	document.getElementById("day").innerHTML=myBookId;
	
	var g=_self.data('kb');
	document.getElementById("dname").innerHTML='Dr.'+ g;
	var hh=_self.data('di');
	$("#did").val(hh);
	$("#dday").val(myBookId);
	  
  $.get("getdataa.php", {did:hh,dday:myBookId}, function (data) {
                   
						
						if(data!=null){
						
						
						
						$("#replace1").html(data);
						
						
						}
				
                });

	$(_self.attr('href')).modal('show');
});
	 function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
	}
	
	function  getc(id)
	{
	
if( confirm('are you sure you want to delete?'))
{

 window.location='sub_category.php?did='+id;
    

}
else
{
return false;
}

	
	
	}
	
	$(document).ready(function () {
    $(document).on('mouseenter', '.divbutton', function () {
        $(this).find(".abc").show();
    }).on('mouseleave', '.divbutton', function () {
        $(this).find(".abc").hide();
    });
});

	
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
          <h1>Doctor Timing<small>Manage</small> </h1>
          <div class="pull-right">
            <?php if(isset($_GET['msg'])){ 
					$hh=$_GET['msg'];
					?>
            <?php if($hh=="s"){ ?>
            <div class="alert  alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Time Set Successfully</strong> 
</div>
            <?php } ?>
           
            <?php if($hh=="e"){ ?>
            <div class="alert alert-info alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Updated Successfully</strong> 
</div>
            <?php } ?>
            <?php }?>
          </div>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index-2.html">Dashboard</a> </li>
            <li class="active">Doctor Timing</li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- end PAGE TITLE ROW -->
    <!-- begin MAIN PAGE ROW -->
    <div class="row">
      <!-- Bordered Responsive Table -->
      <div class="col-lg-12">
        <div class="portlet portlet-blue">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4>Doctor Timing</h4>
            </div>
            <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample1"><i class="fa fa-chevron-down"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample1" class="panel-collapse collapse in">
            <div class="portlet-body">
              <div class="table-responsive">
                <table  class="table table-striped table-bordered table-hover table-green">
                  <thead>
                    <tr>
                      <th>Doctor</th>
                      <th>Monday</th>
                      <th>Tuesday</th>
                      <th>Wednesday</th>
                      <th>Thursday</th>
                      <th>Friday</th>
                      <th>Saturday</th>
					  <th>Sunday</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
do {  
?>
                    <tr class="odd gradeX">
                      <td><?php echo $row_getdoctor['fullname']?>
                      </td>
					  <td> <div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Monday' ");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'. date("g:i a", strtotime($row_Recordsetds['dstart'])); ?> To 
					  <?php echo date("g:i a", strtotime($row_Recordsetds['dend'])) .'</strong>'; }  else {?>
					  
					 <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Monday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div></td>
                      <td>
					  <div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Tuesday'");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'.date("g:i a", strtotime($row_Recordsetds['dstart'])); ?> To 
					  <?php echo  date("g:i a", strtotime($row_Recordsetds['dend'])).'</strong>'; }else {?>
					  
					  <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Tuesday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div>
					  
					  
					  </td>
                      <td >
					  <div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Wednesday'");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'. date("g:i a", strtotime($row_Recordsetds['dstart'])); ?> To 
					  <?php echo date("g:i a", strtotime($row_Recordsetds['dend'])).'</strong>'; }else {?>
					  
					  <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Wednesday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div>
					  
					  
					  
					  
					  </td>
                      <td ><div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Thursday'");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'. date("g:i a", strtotime($row_Recordsetds['dstart']));  ?> To 
					  <?php echo date("g:i a", strtotime($row_Recordsetds['dend'])).'</strong>'; }else {?>
					  
					  <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Thursday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div></td>
                      <td >
					  <div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Friday'");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'.date("g:i a", strtotime($row_Recordsetds['dstart']));  ?> To 
					  <?php echo date("g:i a", strtotime($row_Recordsetds['dend'])).'</strong>'; }else {?>
					  
					  <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Friday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div>
					  
					  </td>
					    <td >
					  <div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Saturday'");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'. date("g:i a", strtotime($row_Recordsetds['dstart'])); ?> To 
					  <?php echo date("g:i a", strtotime($row_Recordsetds['dend'])).'</strong>'; }else {?>
					  
					  <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Saturday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div>
					  
					  </td>
					  
					  <td >
					  <div class="divbutton"><?php $uid=$row_getdoctor['uid'];  

mysql_select_db($database_cn, $cn);
$query_Recordsetds = sprintf("SELECT * FROM drtime WHERE did = '$uid' and dday='Sunday'");
$Recordsetds = mysql_query($query_Recordsetds, $cn) or die(mysql_error());
$row_Recordsetds = mysql_fetch_assoc($Recordsetds);
$totalRows_Recordsetds = mysql_num_rows($Recordsetds); 
?>  
					  <?php if($totalRows_Recordsetds>0){   echo '<strong>'. date("g:i a", strtotime($row_Recordsetds['dstart'])); ?> To 
					  <?php echo date("g:i a", strtotime($row_Recordsetds['dend'])).'</strong>'; }else {?>
					  
					  <label style="color:#FF0000"> Set Time </label>
					  <?php } ?>
                      <a data-id='Sunday' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="Set Time" class="open-AddBookDialog btn btn-success abc" href="#myModal" style="min-width:20px;display:none;"><i class="fa fa-edit"></i></a> </div>
					  
					  </td>
					  
					  
                      <td > <a data-id='Week' data-kb='<?php echo $row_getdoctor['fullname']?>' data-di='<?php echo $row_getdoctor['uid']?>' title="All At once" class="open-AddBookDialog btn btn-success " href="#myModal" style="min-width:20px;"><i class="fa fa-list"></i>&nbsp;All At Once</a></td>
                    </tr>
                    <?php
} while ($row_getdoctor = mysql_fetch_assoc($getdoctor));
  $rows = mysql_num_rows($getdoctor);
  if($rows > 0) {
      mysql_data_seek($getdoctor, 0);
	  $row_Recordset1 = mysql_fetch_assoc($getdoctor);
  }
?>
                  </tbody>
                </table>
                <!-- Modal -->
                <div id="myModal" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">
                      <div id="dname"></div>
                    </h3>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <!-- Basic Form Example -->
                      <div class="col-lg-12">
                        <div class="portlet portlet-green">
                          <div class="portlet-heading">
                            <div class="portlet-title">
                              <h4>
                                <div id="day" ></div>
                              </h4>
                            </div>
                            <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#inlineFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                            <div class="clearfix"></div>
                          </div>
                          <div id="inlineFormExample" class="panel-collapse collapse in">
                            <div class="portlet-body">
                              <form class="form-inline" role="form" name="fsub" action="<?php echo $editFormAction; ?>" method="POST">
							   <input type="hidden" value="" name="did" id="did"/>
                                <input type="hidden" value="" name="dday" id="dday"/>
							<div id="replace1">
							
							</div>
							
                                <div class="form-group">
                                  <label  for="exampleInputPassword2"></label>
                                  <button type="submit" class="btn btn-default" style="margin-top:25px;">Save</button>
                                </div>
                                <input type="hidden" name="MM_insert" value="fsub">
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- /.portlet -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet -->
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



?>
