
<?php
mysql_connect('localhost','root','');
mysql_select_db('vihar');
$query="select * from medicine";
$rr=mysql_query($query);


$res=mysql_fetch_assoc($rr);

if ((isset($_GET['removeid'])) && ($_GET['removeid'] != "")) {
  
$query1="delete from medicine where mid=".$_GET['removeid'];
mysql_query($query1);
header("location:editmedicine.php");

}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Medicine - Doct Connect</title>
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

  
</head>

<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1> Medicine
                                <small>Listing</small>                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>                                </li>
                                <li class="active">Medicine</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->

                <!-- begin ADVANCED TABLES ROW -->
                <div class="row">

                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Listing Medicine</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
							<?php if($res['name']!== NULL) { ?>
                                <div class="table-responsive">
								<form name="listinguser" method="GET" action="">
                                 
                                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                      <tr>
									  
                                      
                                      <td> Name</td>
									  <td>Form</td>
                                      <td>Strength</td>
									  <td>Dosage</td>
									  <td>Manufacture</td>
									  <td>genericname</td>
									  <td>remarks</td>
									  <td>extra</td>
									  <td>Action</td>
                                    </tr>
                                        </thead>
                                        <tbody>
                                          
									  <?php  do { ?>
                                      <tr>
                                       
                                        <td><?php echo $res['name']; ?></td>
 										<?php  		
										$query1="select * from medicinetype where mtid=".$res['mtid'];
										$r1=mysql_query($query1);
										$res1=mysql_fetch_assoc($r1);
										
										?>
	                                  	<td><?php echo $res1['name']; ?></td>
                                        <td><?php echo $res['strength']; ?></td>
										<td><?php echo $res['dosage']; ?></td>
										<td><?php echo $res['manufcuturer']; ?></td>
										<td><?php echo $res['genericname']; ?></td>
										<td><?php echo $res['remarks']; ?></td>
										<td><?php echo $res['extra']; ?></td>
										<td>
										<a href="editm.php?id=<?php echo $res['mid']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<b>Edit</b></a>
										
										
										<a href="editmedicine.php?removeid=<?php echo $res['mid']; ?>" class="btn btn-sm btn-red">
										<i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;&nbsp;<b>Remove</b></a></td></tr>
							<?php } while($res=mysql_fetch_assoc($rr))  ?>
							</table> 
														 </form>
                              </div><?php  } else { ?> 
							  <span class="alert-danger"> No Record Found </span>
							  <?php  } ?>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.page-content -->

</div>
		
		  <script src="../../ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="js/plugins/popupoverlay/defaults.js"></script>
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
