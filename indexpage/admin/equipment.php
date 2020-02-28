<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_Username']))
{
header('login.php');
}
mysql_select_db($database_cn, $cn);
$query_getlist = "SELECT 
equipment.eid,
equipment.etid,
equipment.name,
equipment.batchno,
equipment.amc,
equipment.cno,
equipment.expdate,equipment.con_person,equipment.remark,
equipmenttype.name as tname FROM equipment inner join equipmenttype where equipment.etid=equipmenttype.etid ORDER BY eid DESC";
$getlist = mysql_query($query_getlist, $cn) or die(mysql_error());
$row_getlist = mysql_fetch_assoc($getlist);
$totalRows_getlist = mysql_num_rows($getlist);

mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM equipmenttype ORDER BY etid DESC";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_editlist = "-1";
if (isset($_GET['eid'])) {
  $colname_editlist = (get_magic_quotes_gpc()) ? $_GET['eid'] : addslashes($_GET['eid']);
}
mysql_select_db($database_cn, $cn);
$query_editlist = sprintf("SELECT * FROM equipment WHERE eid = %s", $colname_editlist);
$editlist = mysql_query($query_editlist, $cn) or die(mysql_error());
$row_editlist = mysql_fetch_assoc($editlist);
$totalRows_editlist = mysql_num_rows($editlist);

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
  $deleteSQL = sprintf("DELETE FROM equipment WHERE eid=%s",
                       GetSQLValueString($_GET['did'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "equipment.php?msg=d";
 
  header(sprintf("Location: %s", $deleteGoTo));
}

$editFormAction = $_SERVER['PHP_SELF'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fsub")) {

if($_POST['editid']){
$g=$_POST['editid'];
 $insertSQL = sprintf("update equipment set etid=%s, name=%s, batchno=%s,amc=%s,expdate=%s,con_person=%s,remark=%s,cno=%s where eid='$g' ",
                       GetSQLValueString($_POST['dd'], "int"),
                       GetSQLValueString($_POST['ename'], "text"),
                       GetSQLValueString($_POST['batchno'], "text"),
					   GetSQLValueString($_POST['amc'], "text"),			           			   GetSQLValueString($_POST['expdate'], "text"),
					   GetSQLValueString($_POST['con_person'], "text"),
					   GetSQLValueString($_POST['remark'], "text"),
					   GetSQLValueString($_POST['cno'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "equipment.php?msg=e";

  header(sprintf("Location: %s", $insertGoTo));
}
else
{
 $insertSQL = sprintf("INSERT INTO equipment (etid, name, batchno,amc,expdate,con_person,remark,cno) VALUES (%s, %s, %s,%s, %s, %s,%s,%s)",
                       GetSQLValueString($_POST['dd'], "int"),
                       GetSQLValueString($_POST['ename'], "text"),
                       GetSQLValueString($_POST['batchno'], "text"),
					   GetSQLValueString($_POST['amc'], "text"),
					   GetSQLValueString($_POST['expdate'], "text"),
					   GetSQLValueString($_POST['con_person'], "text"),
					   GetSQLValueString($_POST['remark'], "text"),
					   GetSQLValueString($_POST['cno'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "equipment.php?msg=s";

  header(sprintf("Location: %s", $insertGoTo));
  }
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

 window.location='equipment.php?did='+id;
    

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
              <h1>Equipment <small>Manage</small> </h1>
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
                      <h4>Equipment</h4>
                    </div>
                    <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#inlineFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="inlineFormExample" class="panel-collapse collapse in">
                    <div class="portlet-body">
                      <form class="form-inline" role="form" name="fsub" action="<?php echo $editFormAction; ?>" method="POST">
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputEmail2">Select Equipment</label>
                          <select name="dd" class="form-control">
                            <option value="0">Select Type</option>
                            <?php
do{  
?>
                            <option value="<?php echo $row_Recordset1['etid']?>"
													<?php if(isset($_GET['cid'])){  
													
													if($_GET['cid']==$row_Recordset1['etid']){
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
?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword2" placeholder="EQUIMENT NAME" onblur="makeupper(this.id);" name="ename"  value="<?php echo $row_editlist['name']; ?>" >
                        </div>
                        <input type="hidden" value="<?php echo $row_editlist['eid']; ?>" name="editid" />
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword1"  placeholder="BATCH NO"  name="batchno"  value="<?php echo $row_editlist['batchno']; ?>" onblur="makeupper(this.id);">
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword1"  placeholder="AMC"  name="amc"  value="<?php echo $row_editlist['amc']; ?>" onblur="makeupper(this.id);">
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword1"  placeholder="Exp Date"  name="expdate"  value="<?php echo $row_editlist['expdate']; ?>" onblur="makeupper(this.id);">
                        </div>
                        <br />
                        <br />
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword1"  placeholder="Contact Person"  name="con_person"  value="<?php echo $row_editlist['con_person']; ?>" onblur="makeupper(this.id);">
                        </div>
                        
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword1"  placeholder="Contact No"  name="cno"  value="<?php echo $row_editlist['cno']; ?>" onblur="makeupper(this.id);">
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2"></label>
                          <input type="text" class="form-control" id="exampleInputPassword1"  placeholder="Remark"  name="remark"  value="<?php echo $row_editlist['remark']; ?>" onblur="makeupper(this.id);">
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
                    <?php if($totalRows_getlist >0){ ?>
                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Batch No</th>
                          <th>AMC</th>
                          <th>Exp Date</th>
                          <th>Contact Person</th>
                          <th>Contact No</th>
                          <th>Remark</th>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php do { ?>
                          <tr>
                          <td><?php echo $row_getlist['name']; ?></td>
                          <td><?php echo $row_getlist['tname']; ?></td>
                          <td><?php echo $row_getlist['batchno']; ?></td>
                          <td><?php echo $row_getlist['amc']; ?></td>
                          <td><?php echo $row_getlist['expdate']; ?></td>
                          <td><?php echo $row_getlist['con_person']; ?></td>
                          <td><?php echo $row_getlist['cno']; ?></td>
                          <td><?php echo $row_getlist['remark']; ?></td>
                          <td><a href="equipment.php?eid=<?php echo $row_getlist['eid']; ?>&cid=<?php echo $row_getlist['etid']; ?>" class="btn btn-info"><i class="fa fa-edit"> </i></a>
                              <button  type="button" class="btn btn-danger"	 onclick="getc(<?php echo $row_getlist['eid']; ?>)" ><i class="fa fa-times"></i></button></td>
                        </tr>
                          <?php } while ($row_getlist = mysql_fetch_assoc($getlist)); ?>
                      </tbody>
                    </table>
                    <?php }else{ ?>
                    <label class="alert alert-info">Data Empty</label>
                    <?php } ?>
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
