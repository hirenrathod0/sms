<?php require_once('../Connections/cn.php'); ?>

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
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1>Que Maintain </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active">Que </li>
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
      
	  <div class="col-lg-6">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Dr. Pankaj Parikh </h4>
                </div>
                <div class="portlet-widgets">  </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  
				  <form name="ppque" >
				  <table style="overflow:auto;width:100%" class="table-bordered table-condensed table-green table-hover table-responsive table">
            		
				  <?php  
			  
				mysql_select_db($database_cn, $cn);
					
					$weekday = date('l');
					
					$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '1' AND dday='$weekday' ");
					
					$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
					
					$row_Recordset1 = mysql_fetch_assoc($Recordset1);
					
					$totalRows_Recordset1 = mysql_num_rows($Recordset1);
					
					$t1=$row_Recordset1['dstart'];
					$t2=$row_Recordset1['dend'];
							
						mysql_select_db($database_cn, $cn);
						
						$j=date('Y-m-d');
						
						
						$query_Recordset12 = "SELECT booking.pid,patient.fname,patient.mname,patient.lname FROM booking INNER JOIN patient on booking.pid = patient.pid  WHERE docid = 1 and date(bdt)='$j'";
						$Recordset12 = mysql_query($query_Recordset12, $cn) or die(mysql_error());
						//$row_Recordset12 = mysql_fetch_assoc($Recordset12);
						$totalRows_Recordset12 = mysql_num_rows($Recordset12);
						
						
						while($row_Recordset12 = mysql_fetch_assoc($Recordset12) )
						{
					
											
							$date = date('H:i', strtotime($t1 . ' + 10 minute'));
							
							$start=date('g:i', strtotime($date));
							
							echo "<tr>
								<td>$start</td>
								
								<td>"
								
									.$row_Recordset12["fname"]." ".$row_Recordset12["mname"]." ".$row_Recordset12["lname"]."</td>
								
								<td>Waiting</td>
							</tr>
							";
					
				
						//$t1=$date;
						
						}	
						
						
						
						
					mysql_select_db($database_cn, $cn);
										
					$weekday = date('l');
					$query_Recordset = sprintf("SELECT * FROM drtime WHERE did = '1' AND dday='$weekday' ");
					$Recordset = mysql_query($query_Recordset, $cn) or die(mysql_error());
					$row_Recordset = mysql_fetch_assoc($Recordset);
					$totalRows_Recordset = mysql_num_rows($Recordset);
					$t1=$row_Recordset['dstart'];
					$t2=$row_Recordset['dend'];
					
				
					$day = date('d-m-Y');
					$query_Recordset1 = sprintf("SELECT * FROM `appointment` WHERE did = '1' AND dateofapp='$day'  ");
					$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
					$row_Recordset1 = mysql_fetch_assoc($Recordset1);
					$totalRows_Recordset1 = mysql_num_rows($Recordset1);
					
					do
					{
						echo "<tr>
								<td></td>
								<td>".$row_Recordset1["pname"]."</td>
								<td>Waiting</td>
						</tr>
						";
					
					}while($row_Recordset1 = mysql_fetch_assoc($Recordset1) )
					
						
						
						
			     ?>
					
				</table>
                 
				 </form>
			  
			    </div>
              
              </div>
            </div>
            <!-- /.portlet -->
          </div>
         
              
         
        </div>
        <!-- /.row (nested) -->
       
 
<!-- Modal -->

      </div>
	  
	  <div class="col-lg-6">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Dr. Samir Raval  </h4>
                </div>
                <div class="portlet-widgets">  </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  
				  <form name="ppque" >
				  <table style="overflow:auto;width:100%" class="table-bordered table-condensed table-green table-hover table-responsive table">
            		
				  <?Php  
			  
					mysql_select_db($database_cn, $cn);
					
					$weekday = date('l');
					
					$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '2' AND dday='$weekday' ");
					
					$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
					
					$row_Recordset1 = mysql_fetch_assoc($Recordset1);
					
					$totalRows_Recordset1 = mysql_num_rows($Recordset1);
					
					$t1=$row_Recordset1['dstart'];
					$t2=$row_Recordset1['dend'];
							
					while($t1<$t2)
					{
						$date = date('H:i', strtotime($t1 . ' + 10 minute'));
						
						$start=date('g:i', strtotime($date));
						
						echo "
						<tr>
							<td>
							$start
							</td>
						</tr>
						";
						
						
						$t1=$date;
					}	
					
			     ?>
					
				</table>
                 
				 </form>
			  
			    </div>
              
			  </div>
              
              </div>
            </div>
       
          </div>
         
              
         
        </div>
		
        

    
	
	
	</div>
	  
	  
	  
	  
    </div>
  </div>
</div>
	   
	   
	   
	   
	   

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
            <img class="img-circle img-logout" src="img/profile-pic.jpg" alt="">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href="login.html" class="btn btn-green">
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
?>
