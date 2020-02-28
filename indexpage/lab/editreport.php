<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>

<?php  
mysql_connect('localhost','root','');
mysql_select_db('doc_connect');

if(isset($_GET['id']))
{
$ids=$_GET['id'];
$query="select * from reportdata where id=".$ids;
$res=mysql_query($query);
$row=mysql_fetch_assoc($res);
}

if(isset($_POST['MM_update']))
{
	   
	$ids=$_POST['ids'];
	
$inv=$_POST['inv'];

$nmv=$_POST['nmv'];
echo $query="UPDATE `reportdata`  SET `investigation`='$inv',`normalvalue`='$nmv' WHERE  id=".$ids;
mysql_query($query);
header("location:labreport.php");
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lab - Doct Connect</title>
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
	 
		function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
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
          <h1>Edit Lab Reports  </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Home</a> </li>
            <li class="active">Edit Report </li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <div class="row">
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-6">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4>Edit Lab Report </h4>
                </div>
                <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form method="POST" action="editreport.php"  name="adduser" enctype="multipart/form-data" >
                    <table align="center" class="table-responsive table-condensed table-bordered ">
                    
					<tr valign="baseline">
                      <td nowrap align="left"><strong> Investigation :</strong></td>
                      <td><input type="text" class="form-control" name="inv"  id="exampleInputEmail1" onblur="makeupper(this.id);" placeholder="Enter Investigation" value="<?php  echo $row['investigation']; ?>"></td>
                    </tr>
					
					<tr valign="baseline">
                      <td nowrap align="left"><strong> Normal Value :</strong></td>
                      <td><input type="text" class="form-control" name="nmv"  id="nmv" placeholder="Enter Normal Value" value="<?php echo $row['normalvalue']; ?>" onblur="makeupper(this.id);"></td>
                    </tr>
					
					                    
                    
                    </tr>
                    <tr valign="baseline" >
                      <td  align="center" colspan="2" ><button type="submit"  name="submit" class="btn btn-default">Edit</button></td>
                    </tr></table>
                    <input type="hidden" name="ids" value="<?php echo $_GET['id'];?>">
                    <input type="hidden" name="MM_update" value="adduser">
                  </form>
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
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>

