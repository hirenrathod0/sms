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


$colname_billid = "-1";
if (isset($_GET['pid'])) {
  $colname_billid = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_billid = sprintf("SELECT * FROM bill WHERE pid = %s ORDER BY id DESC", GetSQLValueString($colname_billid, "int"));
$billid = mysql_query($query_billid, $cn) or die(mysql_error());
$row_billid = mysql_fetch_assoc($billid);
$totalRows_billid = mysql_num_rows($billid);

$maxRows_tempbill = 10;
$pageNum_tempbill = 0;
if (isset($_GET['pageNum_tempbill'])) {
  $pageNum_tempbill = $_GET['pageNum_tempbill'];
}
$startRow_tempbill = $pageNum_tempbill * $maxRows_tempbill;

$colname_tempbill = "-1";
if (isset($_GET['pid'])) {
  $colname_tempbill = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_tempbill = sprintf("SELECT * FROM tempbill WHERE pid = %s", GetSQLValueString($colname_tempbill, "int"));
$query_limit_tempbill = sprintf("%s LIMIT %d, %d", $query_tempbill, $startRow_tempbill, $maxRows_tempbill);
$tempbill = mysql_query($query_limit_tempbill, $cn) or die(mysql_error());
$row_tempbill = mysql_fetch_assoc($tempbill);

if (isset($_GET['totalRows_tempbill'])) {
  $totalRows_tempbill = $_GET['totalRows_tempbill'];
} else {
  $all_tempbill = mysql_query($query_tempbill);
  $totalRows_tempbill = mysql_num_rows($all_tempbill);
}
$totalPages_tempbill = ceil($totalRows_tempbill/$maxRows_tempbill)-1;
	$pid=$_GET['pid'];
	$i=1;


$s=mysql_query("select * from billhistry where pid='$pid'");
$s1=mysql_fetch_assoc($s);
$i=$s1['bhid'];

do{
 echo $insertSQL = sprintf("INSERT INTO billhistry (name, price,numofd, total,pid, bid, type, status,ttl) VALUES (%s, %s, %s, %s,$pid, %s, %s,'PENDING','$i')",
                       GetSQLValueString($row_tempbill['name'], "text"),
                       GetSQLValueString($row_tempbill['price'], "int"),
					   GetSQLValueString($row_tempbill['numofd'],"text"),
					  GetSQLValueString($row_billid['total'], "int"),
                       GetSQLValueString($row_billid['id'], "int"),
					GetSQLValueString($row_billid['type'], "text")
						);

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
	 
	
}while($row_tempbill = mysql_fetch_assoc($tempbill));
//exit;
 
$id=$row_billid['id'];
$p=$_GET['pid'];
 $DELSQL = sprintf("DELETE FROM tempbill where pid='$p'",$cn);

  mysql_select_db($database_cn, $cn);
  $Result2 = mysql_query($DELSQL, $cn) or die(mysql_error());

  $DELGoTo = "genbillipd.php?pid=$p&bid=".$id;
  header(sprintf("Location: %s", $DELGoTo));
 
  
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
          <h1> Billing </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage Bill </li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <div class="row">
      <div class="col-lg-12">
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
              <table class="table table-striped">
                <tr>
                  <td><?php echo  $row_billid['id']; ?>
                    <input type="hidden" id="bid" name="bid" value="<?php echo  $row_billid['id']; ?>" /></td>
                  <td><?php echo  $row_billid['pid']; ?>
                    <input type="hidden" id="pid" name="pid" value="<?php echo  $row_billid['pid']; ?>" /></td>
                  <td><?php echo  $row_billid['total']; ?>
                    <input type="hidden" id="total" name="total" value="<?php echo  $row_billid['total']; ?>" /></td>
                  <td><?php echo $row_billid['type']; ?>
                    <input type="text" id="type" name="type" value="<?php echo $row_billid['type']; ?>" /></td>
                </tr>
              </table>
              <form action="<?php echo $editFormAction; ?>" name="frm" method="POST">
                <table border="1" class="table">
                  <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>price</td>
                    <td>Num of days</td>
                    <td>total</td>
                    <td>pid</td>
                  </tr>
                  <?php do { ?>
                    <tr>
                      <td><?php echo $row_tempbill['id']; ?>
                        <input type="text" id="id" name="pid" value="<?php echo $row_tempbill['id']; ?>" /></td>
                      <td><?php echo $row_tempbill['name']; ?>
                        <input type="text" id="name" name="name" value="<?php echo $row_tempbill['name']; ?>" /></td>
                      <td><?php echo $row_tempbill['price']; ?>
                        <input type="text" id="price" name="price" value="<?php echo $row_tempbill['price']; ?>" /></td>
                      <td><?php echo $row_tempbill['numofd']; ?>
                        <input type="text" id="numofd" name="numofd" value="<?php echo $row_tempbill['numofd']; ?>" /></td>
                      <td><?php echo $row_tempbill['total']; ?>
                        <input type="text" id="price" name="total" value="<?php echo $row_tempbill['total']; ?>" /></td>
                      <td><?php echo $row_tempbill['pid']; ?>
                        <input type="text" id="pid" name="pid" value="<?php $_GET['pid']; ?>" /></td>
                    </tr>
                    <?php } while ($row_tempbill = mysql_fetch_assoc($tempbill)); ?>
                </table>
                <input type="hidden" name="MM_insert" value="frm" />
              </form>
            </div>
          </div>
          
        </div>
      </div>
      <!-- Button to trigger modal --> </div>
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
mysql_free_result($billid);

mysql_free_result($tempbill);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
