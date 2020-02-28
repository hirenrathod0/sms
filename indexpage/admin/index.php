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
$query_Recordset1 = "SELECT * FROM patient";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM subcategory";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_cn, $cn);
$query_Recordset3 = "SELECT * FROM `user`";
$Recordset3 = mysql_query($query_Recordset3, $cn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$n=date("Y-m-d");
mysql_select_db($database_cn, $cn);
$query_Recordset4 = "SELECT * FROM patient where date(dtofadd)='$n'";
$Recordset4 = mysql_query($query_Recordset4, $cn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);


mysql_select_db($database_cn, $cn);
$query_fee = "SELECT * FROM login_history where (start_dt> DATE_SUB(NOW(), INTERVAL 1 DAY)) ORDER BY id desc";
$fee = mysql_query($query_fee, $cn) or die(mysql_error());
$row_fee = mysql_fetch_assoc($fee);

  $all_fee = mysql_query($query_fee);
  $totalRows_fee = mysql_num_rows($fee); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doct Connect</title>

    <link href="css/plugins/pace/pace.css" rel="stylesheet">
    <script src="js/plugins/pace/pace.js"></script>

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

</head>

<body>

    <div id="wrapper">
	<?php include("header.php")?>
<?php include("sidebar.php")?>

        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h4>Dashboard
                               
                          </h4>
                          
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->

                <!-- begin DASHBOARD CIRCLE TILES -->
               
               
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                           
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                          
                          <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                   Total Patients
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo $totalRows_Recordset1;?>
                                   
                                </div>
                              
                          </div>
                        </div>
                    </div>
                   <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-money fa-fw fa-3x"></i>
                                </div>
                      
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                  Total Rooms
                                </div>
                                
                                <div class="circle-tile-number text-faded">
                                   <?php echo $totalRows_Recordset2; ?>
                                </div>
                               
                            </div>
                        </div>
                  </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-bell fa-fw fa-3x"></i>
                                </div>
                          
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                   Total Employees
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo $totalRows_Recordset3; ?>
                                </div>
                               
                               
                               
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-money fa-fw fa-3x"></i>
                                </div>
                      
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                  TODAY PATIENTS
                                </div>
                                
                                <div class="circle-tile-number text-faded">
                                   <?php echo $totalRows_Recordset4; ?>
                                </div>
                               
                            </div>
                        </div>
                </div>
              
               <div class="col-lg-2 col-sm-4">
                        <div class="circle-tile">
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                  <a href="../reception/index.php"style="font-size:14px;"><strong>Reception Login</strong></a>   
                                </div>
                                <div class="circle-tile-number text-faded">
                                </div>
                               
                            </div>
                        </div>
                  </div>
                    
                    
                    
                    
                     <div class="col-lg-3 col-sm-5">
                        <div class="circle-tile">
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                  <a href="../doctor/index.php"style="font-size:14px;"><strong> Doctor Login</a>   
                                </div>
                                <div class="circle-tile-number text-faded">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                
                
               
                
                
                
              <div class="col-lg-2 col-sm-5">
                        <div class="circle-tile">
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                  <a href="../IPD/login.php" style="font-size:14px;"><strong></strong>IDP Login</a>   
                                </div>
                                <div class="circle-tile-number text-faded">
                                </div>
                               
                            </div>
                        </div>
                  </div>  
                
   
                    
                    <div class="col-lg-3 col-sm-5">
                        <div class="circle-tile">
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                  <a href="../lab/index.php"style="font-size:14px;"><strong>Lab Login</strong></a>   
                                </div>
                                <div class="circle-tile-number text-faded">
                                </div>
                               
                            </div>
                        </div>
                    </div> 
                
                
                
                    
                    <div class="col-lg-2 col-sm-4">
                        <div class="circle-tile">
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                  <a href="../xray/index.php"style="font-size:14px;"><strong>X-ray Login</strong></a>   
                                </div>
                                <div class="circle-tile-number text-faded">
                                </div>
                               
                            </div>
                        </div>
                  </div>
                    

            </div>
            <!-- /.page-content -->

        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->

    </div>
    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->
    <script src="../../ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="js/plugins/popupoverlay/defaults.js"></script>
    <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
        
        
          <img class="img-circle" src="../images/vihar logo.png" alt="" height="150" width="150"  style="height:150;width:150;border:2px solid #ccc;box-shadow:7px 7px 7px #000">
        
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href="login.php" class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
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

mysql_free_result($Recordset4);
?>
