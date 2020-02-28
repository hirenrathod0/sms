<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_Recordset1 = "-1";
if (isset($_GET['aid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['aid'] : addslashes($_GET['aid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM appointment WHERE aid = %s", $colname_Recordset1);
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
echo   $insertSQL = sprintf("update appointment set dateofapp=%s,timeofapp=%s where aid=%s",
                      
					   GetSQLValueString($_POST['sdate1'], "text"),
					   GetSQLValueString($_POST['stime1'], "text"),
                       GetSQLValueString($_POST['aid'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "allappointment.php";
  
  header(sprintf("Location: %s", $insertGoTo));
}



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
<link href="css/demo.css" rel="stylesheet">
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

<script type="text/javascript">






function setid(obj)
{
     /*document.getElementById('sdate1').value= document.getElementById('sdate2').value; 
	document.getElementById('stime1').value= document.getElementById('stime2').value;
	   document.getElementById('did1').value= document.getElementById('did2').value;*/
	   
	  /*  $.get("detailp.php",{pid:obj},function(data){
	 /* if(data!=null){
	  $('#replace1').html(data);
	  $('#replace1').show();

	  $('#replace').hide();
	  }
	  else{
	//  $('#replace').hide();
	  }
	  
	  });*/
	  window.location='setpatient.php?pid='+obj;

}
	function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
	}
	
	function getdetail(obj)
	{
	
  var sdate3=document.getElementById('sdate1').value; 
	  var stime3=document.getElementById('stime1').value;
	   var did3=document.getElementById('did1').value;
	  
	  
	 
	  $.get("getpdetail.php",{kw:obj,dt:sdate3,st:stime3,d:did3},function(data){
	  if(data!=null){
	  
	  if(data=='abc')
	  { $('#id4').hide();
	   document.getElementById('city').value='';
	
	   document.getElementById('contactno1').value='';
	 
	  }else{
	   $('#id4').show();
	  $('#id4').html(data);
	  }
	  }
	  
	  else{
	  $('#id4').hide();
	
	  }
	  
	  });
	
	 
	   
	
	
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
      <h1><label id="drname"></label>&nbsp; Appointment&nbsp;Status </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
		<li> <a href="apointment.php">Select Doctor</a> </li>
		<li> <a href="#" id="br1">Select Time</a> </li>
        <li class="active">Appointment Booking</li>
      </ol>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="portlet portlet-default">
      <div class="portlet-heading">
        <div class="portlet-title">
          <h4>Patient Detail </h4>
        </div>
        <div class="portlet-widgets">
          <ul id="myPortletTab" class="list-inline tabbed-portlets">
            <?php /*?> <form name="frrr" id="frrr" action="test.php" method="post">
		  <input type="hidden" value="" name="sdate" id="sdate"/>
		  <input type="hidden" value="" name="stime" id="stime"/>
		    <input type="hidden" value="<?php echo $_GET['did'];?>" name="did" id="did"/>
		  
		  <input type="submit" value="Next" class="btn btn-primary btn-small pull-right" id='sbmt' style="display:none" />
 		  </form><?php */?>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="portlet-body">
        <div id="myPortletTabContent" class="tab-content">
          <div class="tab-pane fade in active" id="tab1">
            <div class="table-responsive dashboard-demo-table">
              <form method="POST" name="form1" action="" id="f1">
        
		         
		  
	   			 
		
				 
			
			<div id="replace1" style="display:none"></div>
		
			<div id="replace">
			
				    <table align="center" class="table-responsive table-condensed table-bordered table ">
					 <tr valign="baseline">
			 <td nowrap align="right"><strong>Doctor:</strong></td>
			   <td> <label id="fad" name="fad"></label>  <input type="hidden" name="did1" id="did1" style="background-color:#FFFFFF;border:none"/></td>
			 </tr>
             <tr valign="baseline">
			 <td nowrap align="right"><strong>Selected Date:</strong></td>
			   <td> <input type="text"  name="sdate1" id="sdate1"  style="background-color:#FFFFFF;border:none" readonly/></td>
			 </tr>
			    <tr valign="baseline">
			 <td nowrap align="right"><strong>Selected Time:</strong></td>
			   <td>  <input type="text"  name="stime1" id="stime1"  style="background-color:#FFFFFF;border:none" readonly/>
			   <input type="hidden" value="" name="aid" id="aid" /></td>
			 </tr>
			  
			          <tr valign="baseline">
					 
            
			            <td nowrap align="right"><strong>Full Name:</strong></td>
      
		                <td><input type="text" name="fname" value="<?php echo $row_Recordset1['pname']; ?>" style="width:42%" readonly placeholder="Enter First Name " readonly required class="form-control" onblur="makeupper(this.id);"  id="fname"><div  id="id4" style="position:absolute;top:53%;left:45.5%;"></div></td>
						
                      </tr>
                     
                      
                      <tr valign="baseline">
                        <td nowrap align="right"><strong>City:</strong></td>
                        <td><input type="text" name="city3" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['pvillage']; ?>" style="width:42%" readonly placeholder="Enter City"  class="form-control" id="city" required></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right"> <strong>Primary Contact No :</strong></td>
                        <td><input type="number" name="contactno13" value="<?php echo $row_Recordset1['pcontactno']; ?>"  style="width:42%" placeholder=" Primary Contact No" readonly class="form-control" id="contactno1" required></td>
                      </tr>
                      
                    
                     
                      <tr valign="baseline">
                        
                        <td colspan="2" align="center"><input type="submit" value="Submit" class="btn btn-green "><a href="allappointment.php" class="btn btn-danger">Cancel</a></td>
                      </tr>
                    </table>
				</div>
                    <input type="hidden" name="MM_insert" value="form1">
              </form>
            </div>
			<?php if(isset($_GET['msg'])){ 
					$hh=$_GET['msg'];
					?>
					<?php if($hh=="s"){ ?>
					<label class="alert alert-success" >Appointment Booked Successfully </label>
					<?php } }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

var dd = JSON.parse(sessionStorage.getItem('myvalue'));
	document.getElementById('sdate1').value= dd[0];
	document.getElementById('stime1').value= dd[1];
	document.getElementById('did1').value= dd[2];
	document.getElementById('aid').value= dd[3];
	var g=dd[2];
	var a=dd[3];
	//var f='settime.php?did='+g;
  // document.getElementById('br1').attr('href','settime.php');
	 document.getElementById("br1").href="settime.php?did="+g+"&aid="+a; 
	$.get("getdoctor.php",{did:g},function(data){
	 
	 
	  $('#drname').html(data);
	 
 $('#fad').html(data);
	
	  });

</script>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

