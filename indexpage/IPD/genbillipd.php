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
  $P=$_GET['pid'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "ins")) {$tt='IPD';
  $insertSQL = sprintf("INSERT INTO bill(total,pid,type,status) VALUES (%s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['total'], ""),
					   GetSQLValueString($_POST['pid'], "int"),
					   GetSQLValueString($tt,"text" ),
					   GetSQLValueString("PENDING", "text")
                      );
//exit;
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());


  $insertGoTo = "instbill.php?pid=".$P;
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm")) {
	$t=$_POST['price'];
 $insertSQL = sprintf("INSERT INTO tempbill (name, price,pid,numofd,total) VALUES (%s,%s,%s,%s,%s)",
                       GetSQLValueString($_GET['name'], "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($_POST['txtdays'], "text"),
					   GetSQLValueString($_POST['txtdays']*$_POST['price'], "text"));


  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frm2")) {
	$t=$_POST['price'];
    $insertSQL = sprintf("INSERT INTO tempbill (name,price,pid,numofd,total) VALUES (%s,%s,%s,%s,%s)",
                       GetSQLValueString($_GET['name'], "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($_POST['txtdays'], "text"),
					   GetSQLValueString($_POST['txtdays']*$_POST['price'], "text")
					 );
//exit;
  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
}

mysql_select_db($database_cn, $cn);
$p=$_GET['pid'];

$query_Recordset1 = "SELECT * FROM tempbill where pid='$p' ";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_fee = "SELECT * FROM fee";
$fee = mysql_query($query_fee, $cn) or die(mysql_error());
$row_fee = mysql_fetch_assoc($fee);
$totalRows_fee = mysql_num_rows($fee);

$colname_price = "-1";
if (isset($_GET['name'])) 
{
  $c = $_GET['name'];


mysql_select_db($database_cn, $cn);
$query_price = sprintf("SELECT * FROM fee WHERE name ='$c' ");
$price = mysql_query($query_price, $cn) or die(mysql_error());
$row_price = mysql_fetch_assoc($price);
$totalRows_price = mysql_num_rows($price);
}

mysql_select_db($database_cn, $cn);
$query_fee1 = "SELECT * FROM ipd_chg";
$fee1 = mysql_query($query_fee1, $cn) or die(mysql_error());
$row_fee1 = mysql_fetch_assoc($fee1);
$totalRows_fee1 = mysql_num_rows($fee1);


mysql_select_db($database_cn, $cn);
$query_Recordset3 = "SELECT * FROM patient_admit where pid='$p'";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$date1=$row_Recordset3['dofadmit'];
//$n=date('Y-m-d');

 $sdate=strftime('%d-%m-%Y',strtotime($date1));





 $date2=$row_Recordset3['dofdischarge'];

 $sdate=strftime('%d-%m-%Y',strtotime($date2));


  $diff = abs(strtotime($date1) - strtotime($date2));

 
 $total_days = floor ($diff /  (60*60*24)) +1;


$colname_price1 = "-1";	
if (isset($_GET['name'])) 
{
  $c1 = $_GET['name'];


mysql_select_db($database_cn, $cn);
$query_price1 = sprintf("SELECT * FROM ipd_chg WHERE name ='$c1' ");
$price1 = mysql_query($query_price1, $cn) or die(mysql_error());
$row_price1 = mysql_fetch_assoc($price1);
$totalRows_price1 = mysql_num_rows($price1);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doct Connect</title>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../nurse_female/css/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
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
<script language="javascript">
$(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailpatients.php", {recordID:eval(g)}, function (data) {
                    $("#dta").html(data);
                });
	$(_self.attr('href')).modal('show');
});
</script>
<script type="text/javascript" language="javascript">

function n(name,pid)
{
	
//alert(abc);
	var string_url = "genbillipd.php?name="+name+"&pid="+pid;
	window.location = string_url;
		
}


</script>
<link rel="stylesheet" type="text/css" href="../chosen_v1.1.0/docsupport/prism.css">
<link rel="stylesheet" type="text/css" href="../chosen_v1.1.0/chosen.css">
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row"> 
      <!-- begin LEFT COLUMN --> 
      <!-- Basic Form Example -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-title">
              <h1> 
 <?php mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='$P'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h);

 echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?> </h1>
              <?php include('button.php');?>
            </div>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        <!-- /.row --> 
        <!-- end PAGE TITLE ROW -->
        <div class="row"> 
          <!-- begin LEFT COLUMN --> 
          <!-- Basic Form Example -->
          <div class="col-lg-6">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">Insert Bill Detail </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="height:300px">
                  <form action="<?php echo $editFormAction; ?>" name="frm" method="POST">
                    <table class="table">
                      <tr>
                        <td><div id="container"> <br />
                            <br />
                            <?php  
$d=$_GET["pid"]; ?>
                            <select data-placeholder="Select Charge.." style="width:100%;height:auto" name="name" value=""  onchange="n(this.value,<?php echo $d; ?>)"class="chosen-select" style="width:350px;" tabindex="2">
                            <option value=""></option>
                            <option value="">Select Charge</option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_fee['name']; ?>"  <?php if(isset($_GET['name'] )){  if($row_fee['name']==$_GET['name']){  echo "selected"; } } ?> ><?php echo $row_fee['name']?></option>
                            <?php
} while ($row_fee = mysql_fetch_assoc($fee));
  $rows = mysql_num_rows($fee);
  if($rows > 0) {
      mysql_data_seek($fee, 0);
	  $row_fee = mysql_fetch_assoc($fee);
  }
?>
                            </select>
                          </div></td>
                      </tr>
                      <tr>
                        <td><?php if (isset($_GET['name'])) 
{
 if($totalRows_price<=0)
							  {
								  ?>
                          <input type="text" value="--"  />
                          <?php  
							  }
							  
                              else
                              {
                             
  								
               ?>
                          <div   class="input-prepend input-append">
                            <input type="text" style="height:auto" class="form-control" readonly="readonly" name="price" value="<?php echo $row_price['price']; ?>" />
                          </div>
                          <br />
                          <div class="input-prepend input-append">
                            <input type="text" style="height:auto" class="form-control"  name="txtdays" value="1" placeholder="Enter No Of Days" />
                          </div>
                          <?php               
do {  
?>
                          <?php
} while ($row_price = mysql_fetch_assoc($price));
							  }}
							  
?></td>
                      </tr>
                      <tr>
                        <td><input type="hidden" id="pid" name="pid" value="<?php $_GET['pid'] ?>" />
                          <input type="submit" class="btn btn-success" /></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frm" />
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
          
          
          <!-- /.row (nested) --> 
          <!-- Modal -->
          <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-body" id="dta"> </div>
          </div>
          <!-- begin MAIN PAGE ROW --> 
          <!-- begin LEFT COLUMN --> 
          <!-- Basic Form Example -->
          <div class="col-lg-6">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Bill Details </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="overflow:scroll; text-align:center">
                  <form action="<?php echo $editFormAction; ?>" name="ins" method="POST" >
                    <?php if($totalRows_Recordset1>0) {  ?>
                    <table   class="table table-striped table-bordered table-hover table-green">
                      <thead>
                        <tr>
                          <td>Name</td>
                          <td>Price</td>
                          <td>Days </td>
                          <td>Total </td>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $total=0; do { ?>
                          <tr>
                            <?php $row_Recordset1['id']; ?>
                            <input  type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>"/>
                            <td><?php echo $row_Recordset1['name']; ?>
                              <input  type="hidden" name="name" value="<?php echo $row_Recordset1['name']; ?>"/></td>
                            <td><?php echo $row_Recordset1['price']; ?>
                              <input  type="hidden" name="price" value="<?php echo $row_Recordset1['id']; ?>"/>
                              <input  type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>"/>
                              <input  type="hidden" name="date" value="<?php echo date('d-m-Y') ?>"/></td>
                            <td><?php echo $row_Recordset1['numofd']; ?></td>
                            <td><?php echo $row_Recordset1['total']; ?></td>
                            <td><a href="deltempbill1.php?id=<?php echo $row_Recordset1['id']; ?>&amp;pid=<?php echo $_GET['pid']; ?>" class="btn-danger btn">Delete</a></td>
                          </tr>
                          <?php  $total = $total+$row_Recordset1['total']; ?>
                          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                        <tr>
                          <td colspan="5"><div align="right" style="margin-right:25%"> Total :- <?php echo $total; ?>
                              <input  type="hidden" name="total" value="<?php echo $total; ?>"/>
                            </div></td>
                        </tr>
                      </tbody>
                    </table>
                    <input  type="submit" class="btn btn-success"/>
                    <?php    } else 
					{  ?>
                    <label class="alert-danger"> NO DATA FOUND </label>
                    <?php } ?>
                    <input type="hidden" name="MM_insert" value="ins" />
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        
        <!-- /.row (nested) --> 
        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Button to trigger modal -->
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
<!-- dropdown search --> 
<script src="../chosen_v1.1.0/chosen.jquery.js" type="text/javascript"></script> 
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
<?php

mysql_free_result($Recordset1);

mysql_free_result($fee);

?>
