<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_Username']))
{
header('login.php');
}
$msg=0;
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

if ((isset($_GET['did'])) && ($_GET['did'] != "")) {
  $deleteSQL = sprintf("DELETE FROM subcategory WHERE scid=%s",
                       GetSQLValueString($_GET['did'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "sub_category.php?msg=d";
 
  header(sprintf("Location: %s", $deleteGoTo));
}

$editFormAction = $_SERVER['PHP_SELF'];


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fsub")) {

if($_POST['editid']){


$g=$_POST['editid'];

 $insertSQL = sprintf("update subcategory set cid=%s, name=%s, no_of= %s where scid='$g'",
                       GetSQLValueString($_POST['dd'], "int"),
                       GetSQLValueString($_POST['sname'], "text"),
                       GetSQLValueString($_POST['sqty'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "sub_category.php?msg=e";
 
  header(sprintf("Location: %s", $insertGoTo));


}

else{

  $insertSQL = sprintf("INSERT INTO subcategory (cid, name, no_of) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['dd'], "int"),
                       GetSQLValueString($_POST['sname'], "text"),
                       GetSQLValueString($_POST['sqty'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "sub_category.php?msg=s";
 
  header(sprintf("Location: %s", $insertGoTo));
  }
}

mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM category";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cn, $cn);
$query_sublist = "SELECT category.name as catname, subcategory.scid, subcategory.cid, subcategory.name, subcategory.no_of FROM category, subcategory where category.cid=subcategory.cid ORDER BY subcategory.scid DESC";
$sublist = mysql_query($query_sublist, $cn) or die(mysql_error());
$row_sublist = mysql_fetch_assoc($sublist);
$totalRows_sublist = mysql_num_rows($sublist);

$colname_editlist = "-1";
if (isset($_GET['eid'])) {
  $colname_editlist = (get_magic_quotes_gpc()) ? $_GET['eid'] : addslashes($_GET['eid']);
}
mysql_select_db($database_cn, $cn);
$query_editlist = sprintf("SELECT * FROM subcategory WHERE scid = %s", $colname_editlist);
$editlist = mysql_query($query_editlist, $cn) or die(mysql_error());
$row_editlist = mysql_fetch_assoc($editlist);
$totalRows_editlist = mysql_num_rows($editlist);
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
         
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active">Sub category</li>
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
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4>Inline Form Example</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#inlineFormExample"><i class="fa fa-chevron-down"></i></a>                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="inlineFormExample" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                            <form class="form-inline" role="form" name="fsub" action="<?php echo $editFormAction; ?>" method="POST">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Select Category</label>
                                                  <select name="dd" class="form-control">
												  <option value="0">Select Category</option>
                                                    <?php
do {  
?>
                                                    <option value="<?php echo $row_Recordset1['cid']?>"
													<?php if(isset($_GET['cid'])){  
													
													if($_GET['cid']==$row_Recordset1['cid']){
													?> selected="selected"
													<?php } }?>
													
													><?php echo $row_Recordset1['name']?></option>
                                                    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?></select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2"></label>
                                                    <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Sub-Category" name="sname" onblur="makeupper(this.id);" required value="<?php echo $row_editlist['name']; ?>" >
                                                </div>
												<input type="hidden" value="<?php echo $row_editlist['scid']; ?>" name="editid" />
												  <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2"></label>
                                                    <input type="number" class="form-control" id="exampleInputPassword2" placeholder="No of beds" name="sqty" required value="<?php echo $row_editlist['no_of']; ?>">
                                                </div>
                                              
                                                <button type="submit" class="btn btn-default">Save</button>
												<?php if(isset($_GET['msg'])){ 
					$hh=$_GET['msg'];
					?>
					<?php if($hh=="s"){ ?>
					<label class="alert alert-success" >Created Successfully </label>
					<?php } ?>
					
					<?php if($hh=="d"){ ?>
					<label class="alert alert-success" >Deleted Successfully </label>
					<?php } ?>
					
					<?php if($hh=="e"){ ?>
					<label class="alert alert-success" >Updated Successfully </label>
					<?php } ?>
					
					 <?php }?>
                                                <input type="hidden" name="MM_insert" value="fsub">
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
	
	 <div class="row">

                    <!-- Bordered Responsive Table -->
					
                    <div class="col-lg-12">
                        <div class="portlet portlet-blue">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Sub Category List</h4>
                                </div>
								<div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample1"><i class="fa fa-chevron-down"></i></a> </div>
                                <div class="clearfix"></div>
                            </div>
							 <div id="basicFormExample1" class="panel-collapse collapse in">
                            <div class="portlet-body">
                                <div class="table-responsive">
								   <?php if($totalRows_sublist >0){ ?>
                                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                    <tr>
                                      <td>Room Type</td>
                                     
                                      <td>Room Name </td>
                                      <td>No of Beds </td>
									   <td>Action</td>
                                    </tr>
									   </thead>
                                        <tbody>
										
                                    <?php do { ?>
                                      <tr>
									   <td><?php echo $row_sublist['catname']; ?></td>
                                        <td><?php echo $row_sublist['name']; ?></td>
                             
                                       
                                        <td><?php echo $row_sublist['no_of']; ?></td>
										<td> <a href="sub_category.php?eid=<?php echo $row_sublist['scid']; ?>&cid=<?php echo $row_sublist['cid']; ?>" class="btn btn-info"><i class="fa fa-edit"> </i></a>
												  <button  type="button" class="btn btn-danger"	 onclick="getc(<?php echo $row_sublist['scid']; ?>)" ><i class="fa fa-times"></i></button></td>
                                      </tr>
                                      <?php } while ($row_sublist = mysql_fetch_assoc($sublist)); ?>
									  
                                          
                                  </tbody>
								  </table>
								    	<?php }else{ ?>
					<label class="alert alert-info">Data Empty</label>
					
				<?php } ?>
                                </div>
                            </div></div>
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
mysql_free_result($Recordset1);

mysql_free_result($sublist);

mysql_free_result($editlist);
?>
