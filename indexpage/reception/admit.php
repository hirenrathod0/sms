<?php require_once('../Connections/cn.php'); ?>
<?php
//session_start();
if(!isset($_SESSION['MM_RECEPTION']))
{
header('login.php');
}
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

$maxRows_patient = 10;
$pageNum_patient = 0;
if (isset($_GET['pageNum_patient'])) {
  $pageNum_patient = $_GET['pageNum_patient'];
}
$startRow_patient = $pageNum_patient * $maxRows_patient;

$colname_patient = "-1";
if (isset($_GET['pid'])) {
  $colname_patient = $_GET['pid'];
}
mysql_select_db($database_cn, $cn);
$query_patient = sprintf("SELECT * FROM patient WHERE pid = %s", GetSQLValueString($colname_patient, "int"));
$query_limit_patient = sprintf("%s LIMIT %d, %d", $query_patient, $startRow_patient, $maxRows_patient);
$patient = mysql_query($query_limit_patient, $cn) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);

if (isset($_GET['totalRows_patient'])) {
  $totalRows_patient = $_GET['totalRows_patient'];
} else {
  $all_patient = mysql_query($query_patient);
  $totalRows_patient = mysql_num_rows($all_patient);
}
$totalPages_patient = ceil($totalRows_patient/$maxRows_patient)-1;

mysql_select_db($database_cn, $cn);
$query_special = "SELECT * FROM subcategory WHERE name = 'SPECIAL'";
$special = mysql_query($query_special, $cn) or die(mysql_error());
$row_special = mysql_fetch_assoc($special);
$totalRows_special = mysql_num_rows($special);

mysql_select_db($database_cn, $cn);
$query_semispe = "SELECT * FROM subcategory WHERE name = 'DELUXE'";
$semispe = mysql_query($query_semispe, $cn) or die(mysql_error());
$row_semispe = mysql_fetch_assoc($semispe);
$totalRows_semispe = mysql_num_rows($semispe);

mysql_select_db($database_cn, $cn);
$query_ICU = "SELECT * FROM subcategory WHERE name = 'FEMALE WARD'";
$ICU = mysql_query($query_ICU, $cn) or die(mysql_error());
$row_ICU = mysql_fetch_assoc($ICU);
$totalRows_ICU = mysql_num_rows($ICU);

mysql_select_db($database_cn, $cn);
$query_ICU1 = "SELECT * FROM subcategory WHERE name = 'MALE WARD'";
$ICU1 = mysql_query($query_ICU1, $cn) or die(mysql_error());
$row_ICU1 = mysql_fetch_assoc($ICU1);
$totalRows_ICU1 = mysql_num_rows($ICU1);


mysql_select_db($database_cn, $cn);
$query_admspe = "SELECT * FROM patient_admit WHERE rtype = 'SPECIAL' and status='admit'";
$admspe = mysql_query($query_admspe, $cn) or die(mysql_error());
 //$row_admspe = mysql_fetch_assoc($admspe);
$totalRows_admspe = mysql_num_rows($admspe);

mysql_select_db($database_cn, $cn);
$query_admsemispe = "SELECT * FROM patient_admit WHERE rtype = 'DELUXE' and status='admit'";
$admsemispe = mysql_query($query_admsemispe, $cn) or die(mysql_error());
//$row_admspe = mysql_fetch_assoc($admsemispe);
$totalRows_admsemispe = mysql_num_rows($admsemispe);

mysql_select_db($database_cn, $cn);
$query_admicu = "SELECT * FROM patient_admit WHERE rtype = 'FEMALE WARD' and status='admit'";
$admicu = mysql_query($query_admicu, $cn) or die(mysql_error());
//$row_admspe = mysql_fetch_assoc($admsemispe);
$totalRows_admicu = mysql_num_rows($admicu);


mysql_select_db($database_cn, $cn);
$query_admicu1 = "SELECT * FROM patient_admit WHERE rtype = 'MALE WARD' and status='admit'";
$admicu1 = mysql_query($query_admicu1, $cn) or die(mysql_error());
//$row_admspe1 = mysql_fetch_assoc($admsemispe1);
$totalRows_admicu1 = mysql_num_rows($admicu1);
?>
<!-- Start Array of special rooms -->
<?php
	  //$count = mysql_num_rows($padmit);
	  $i = 0;
	  $a = array();
	  while ($row_admspe = mysql_fetch_assoc($admspe)) 
	  { 
		$a[] = $row_admspe['bedno'];						
		
	  }
 ?>
<!-- End Array of special rooms -->
<!-- Start Array of semi-special rooms -->
<?php
	  //$count = mysql_num_rows($padmit);
	  $j = 0;
	  $b = array();
	  while ($row_admsemispe = mysql_fetch_assoc($admsemispe)) 
	  { 
	
		$b[] = $row_admsemispe['bedno'];						
		
		  }
 ?>
<?php
	  //$count = mysql_num_rows($padmit);
	  $k = 0;
	  $c = array();
	  while ($row_admicu = mysql_fetch_assoc($admicu)) 
	  { 
	
		$c[] = $row_admicu['bedno'];						
		
	  }
 ?>
<?php
	  //$count = mysql_num_rows($padmit);
	  $kk = 0;
	  $cc = array();
	  while ($row_admicu1 = mysql_fetch_assoc($admicu1)) 
	  { 
	
		$cc[] = $row_admicu1['bedno'];						
		
	  }
 ?>

<!-- End Array of semi-special rooms -->
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
<script src="new/throttle-debounce-min.js"></script>
<script src="new/extensions.js"></script>
<style>
.gett {
	position: absolute;
	top: 10%;
	left: 50%;
}
</style>
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> Patient Admit </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Patients Admit </li>
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
                  <h4 style="float:left"> Patient Admit </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <table style="overflow:auto;width:100%" class="table-bordered table-condensed table-green table-hover table-responsive table">
                    <tr>
                      <th>Case No</th>
                      <th>Name</th>
                      <th>Bdate</th>
                      <th>City</th>
                      <th>Contact No</th>
                      <th>Gender</th>
                      <th>Blood Group</th>
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_patient['pid']; ?></td>
                        <td><?php echo $row_patient['fname'].' '.$row_patient['mname'].' '.$row_patient['lname']; ?></td>
                        <td><?php echo $row_patient['bdate']; ?></td>
                        <td><?php echo $row_patient['city']; ?></td>
                        <td><?php echo $row_patient['contactno1']; ?></td>
                        <td><?php echo $row_patient['gender']; ?></td>
                        <td><?php echo $row_patient['bgroup']; ?></td>
                      </tr>
                      <?php } while ($row_patient = mysql_fetch_assoc($patient)); ?>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
          <!-- SPECIAL START -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">Special Room</h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php  for($j = 1; $j <= $row_special["no_of"]; $j++){  ?>
                  <a data-id="SPECIAL"  rel="<?php echo $j ?>" class="btn btn-success spe abc" href="admitp.php?pid=<?php echo $_GET['pid'] ?>&rooms=SPECIAL&id=<?php echo $j ?>">Room NO <?php echo $j ?> </a>
                  <?php }?>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
          <!-- SPECIAL END --> 
          <!-- SEMI-SPECIAL START -->
          <?php $i=1; 
	 for($m = 1; $m <= $row_semispe["no_of"]; $m++){  
					 ?>
          <div class="col-lg-3">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">Deluxe Room No <?php echo $i; ?></h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body"> <a data-id="SEMI-SPECIAL"  rel="<?php echo $m ?>" class="btn btn-success semi abc" href="admitp.php?pid=<?php echo $_GET['pid'] ?>&rooms=DELUXE&id=<?php echo $m ?>">Bed NO <?php echo $m ?> </a> <a data-id="SEMI-SPECIAL"  rel="<?php echo $m+1 ?>" class="btn btn-success semi abc" href="admitp.php?pid=<?php echo $_GET['pid'] ?>&rooms=DELUXE&id=<?php echo $m+1 ?>">Bed NO <?php echo $m+1 ?> </a> </div>
              </div>
            </div>
          </div>
          <?php $m++;$i++; }?>
          
          <!-- /.portlet --> 
          
          <!-- SEMI-SPECIAL END --> 
          <!-- ICU START -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">FEMALE WARD </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php for($j = 1; $j <= $row_ICU["no_of"]; $j++){  ?>
                  <div style="display:none;position:absolute;width:30%;height:20%;" class="mm" id="mm2"></div>
                  <a data-id="ICU"  rel="<?php echo $j ?>" class="btn btn-success icu abc" href="admitp.php?pid=<?php echo $_GET['pid'] ?>&rooms=FEMALE WARD&id=<?php echo $j ?>"> BED NO <?php echo $j ?> </a>
                  <?php
					}
					?>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
          <!-- ICU END --> 
          <!--Male Ward Room-->
          
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">MALE WARD </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php for($jj = 1; $jj <= $row_ICU1["no_of"]; $jj++){  ?>
                  <div style="display:none;position:absolute;width:30%;height:20%;" class="mmm" id="mmm2"></div>
                  <a data-id="ICU1"  rel="<?php echo $jj ?>" class="btn btn-success icu1 abc" href="admitp.php?pid=<?php echo $_GET['pid'] ?>&rooms=MALE WARD&id=<?php echo $jj ?>"> BED NO <?php echo $jj ?> </a>
                  <?php
					}
					?>
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
<!-- Start special room --> 
<script type="text/javascript">
	var data2 = new Array( '<?php sort($a); echo implode("', '", $a); ?>' );
	data2 = eval(data2);
    
	$(document).ready(function() {
       	$(".spe").each(function(index, element) {
           	$id = $(this).attr("rel");
			
		for($j=0;$j<data2.length;$j++){
			if(data2[$j]==$id)		{
				$(this).addClass("btn-danger ");
				//$(this).val(data[$j2]);
				$(this).removeClass("btn-success");
				$(this).attr('href','#');
			}	}
        } );
    });
</script> 
<!-- End special room --> 
<!-- Start semi-special room --> 
<script type="text/javascript">
	var data = new Array( '<?php sort($b); echo implode("', '", $b); ?>' );
	data = eval(data);
	$(document).ready(function() {
       	$(".semi").each(function(index, element) {
           	$id2 = $(this).attr("rel");
			
		for($m=0;$m<data.length;$m++){
			if(data[$m]==$id2)		{
				$(this).addClass("btn-danger");
				$(this).removeClass("btn-success");
				$(this).attr('href','#');
			}	}
        } );
    });
</script> 
<!-- End semi-special room --> 
<!-- Start icu room --> 
<script type="text/javascript">
	var data3 = new Array( '<?php sort($c); echo implode("', '", $c); ?>' );
	data3 = eval(data3);
	$(document).ready(function() {
       	$(".icu").each(function(index, element) {
           	$id2 = $(this).attr("rel");
			
			
		for($m=0;$m<data3.length;$m++){
			if(data3[$m]==$id2)		{
				$(this).addClass("btn-danger kbc");
				$(this).attr('href','#');
				$(this).removeClass("btn-success");
			}	}
        } );
    });
	
	

	
	
	
</script> 
<script type="text/javascript">
	var data4 = new Array( '<?php sort($cc); echo implode("', '", $cc); ?>' );
	data4 = eval(data4);
	$(document).ready(function() {
       	$(".icu1").each(function(index, element) {
           	$id2 = $(this).attr("rel");
			
			
		for($m=0;$m<data4.length;$m++){
			if(data4[$m]==$id2)		{
				$(this).addClass("btn-danger kbc");
				$(this).attr('href','#');
				$(this).removeClass("btn-success");
			}	}
        } );
    });
	
	

	
	
	
</script> 

<!-- End icu room --> 
<!-- start hover data --> 
<script src="new/throttle-debounce-min.js"></script> 
<script src="new/extensions.js"></script> 
<script type="text/javascript">

        function resizeBodyContent() {

            var footerHeight = $("footer").outerHeight(true);
            var contentHeight = $(".row-offcanvas").outerHeight(true);
            var navBarHeight = $(".navbar").outerHeight(true);
            var totalContentHeight = (footerHeight + contentHeight + navBarHeight);

            // resize logic here ...
            //
        }

        function pad(value) {
            return value < 10 ? '0' + value : value;
        }

      
        $(document).ready(function () {

            $(".btn-danger").popoverasync({
                "placement": "bottom", "trigger": "hover", "title": "Patient Detail", "html": true, "content": function (callback, extensionRef) {
   					 $rtyp=$(this).data('id');
                     $id2 = $(this).attr("rel");
					 $.get("getdetail.php", {bedno:$id2,rtype:$rtyp}, function (data) {
					    callback(extensionRef, data);
                    });

                }
            });
			
            $('[data-toggle=offcanvas]').click(function () {
                $('.row-offcanvas').toggleClass('active');
            });

            $(window).resize($.throttle(300, resizeBodyContent));
            resizeBodyContent();
        });


    </script> 

<!--end hover data --> 

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
</body>
</html>
<?php
mysql_free_result($patient);

mysql_free_result($special);

mysql_free_result($semispe);

mysql_free_result($ICU);

mysql_free_result($admspe);
?>
