<?php require_once('../Connections/cn.php'); ?>
<?php
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
$u=$_GET['pid'];
if ((isset($_GET['dpmid'])) && ($_GET['dpmid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM patient_medicine WHERE pmid=%s",
                       GetSQLValueString($_GET['dpmid'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());
  $u=$_GET['pid'];
  $deleteGoTo = "givepre.php?pid=".$u;
 
  header(sprintf("Location: %s", $deleteGoTo));
}

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "f1")) {
	if(isset($_GET["pmid"]) && $_GET["pmid"] !="") { 
	$qty = ($_POST['dosageM'] + $_POST['dosageA'] +$_POST['dosageE'] +$_POST['dosageN']) * $_GET['nn'];
  $insertSQL = sprintf("UPDATE patient_medicine as pm,medicine SET pm.strength= '".$_POST['strength']."',pm.dosageM =".$_POST['dosageM'].",pm.dosageA =".$_POST['dosageA'].",pm.dosageE = ".$_POST['dosageE'].",pm.dosageN =".$_POST['dosageN'].",pm.dosage='".$_POST['dosage']."',pm.qty=".$qty.", medicine.strength='".$_POST['strength']."',medicine.dosage='".$_POST['dosage']."' WHERE pm.pmid=".$_GET["pmid"]." AND medicine.mid=".$_GET["id"]);
	}else {
  $qty = ($_POST['dosageM'] + $_POST['dosageA'] +$_POST['dosageE'] +$_POST['dosageN']) * $_GET['nn'];
  $insertSQL = sprintf("INSERT INTO patient_medicine (mid, strength, dosageM, dosageA, dosageE, dosageN, dosage,pid,qty) VALUES (%s, %s, %s, %s, %s, %s, %s,%s,%s)",
                       GetSQLValueString($_POST['medicine'], "int"),
                       GetSQLValueString($_POST['strength'], "text"),
                       GetSQLValueString($_POST['dosageM'], "int"),
                       GetSQLValueString($_POST['dosageA'], "int"),
                       GetSQLValueString($_POST['dosageE'], "int"),
                       GetSQLValueString($_POST['dosageN'], "int"),
                       GetSQLValueString($_POST['dosage'], "text"),
					   GetSQLValueString($_GET['pid'], "text"),
					   GetSQLValueString($qty, "text")
					   					   
					   );
	
  
	}
	mysql_select_db($database_cn, $cn);
  	$Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());
  	$insertGoTo = "givepre.php?pid=".$u."&nd=".$_GET['nn'];
 
  header(sprintf("Location: %s", $insertGoTo));
}

if(!isset($_SESSION['MM_Username']))
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
$query_getkist = "SELECT * FROM medicine";
$getkist = mysql_query($query_getkist, $cn) or die(mysql_error());
$row_getkist = mysql_fetch_assoc($getkist);
$totalRows_getkist = mysql_num_rows($getkist);

$colname_getmlist = "-1";
if (isset($_GET['id'])) {
  $colname_getmlist =  $_GET['id'] ;
}
mysql_select_db($database_cn, $cn);
if(isset($_GET["pmid"]) && $_GET["pmid"]!= "") {
$query_getmlist =sprintf( "SELECT pm.*,medicine.*,medicinetype.name as mtype FROM patient_medicine as pm JOIN medicine ON medicine.mid=pm.mid JOIN medicinetype ON medicinetype.mtid=medicine.mtid WHERE pm.pmid=".$_GET["pmid"]);

}

else {
$query_getmlist = "SELECT medicine.mid, medicine.mtid, medicine.name, medicine.strength, medicine.dosage, medicine.manufcuturer, medicine.genericname, medicine.extra, medicine.remarks, medicinetype.name as mtype FROM medicine JOIN medicinetype ON medicine.mtid=medicinetype.mtid where medicine.mid='$colname_getmlist'";
}
$getmlist = mysql_query($query_getmlist, $cn) or die(mysql_error());
$row_getmlist = mysql_fetch_assoc($getmlist);
$totalRows_getmlist = mysql_num_rows($getmlist);

$colname_getmedicine = "-1";
if (isset($_GET['pid'])) {
  $colname_getmedicine =  $_GET['pid'] ;
}
$d=date('Y-m-d');
mysql_select_db($database_cn, $cn);

$query_getmedicine = sprintf("SELECT  medicine.mid,medicine.name,patient_medicine.pmid,patient_medicine.strength, patient_medicine.dosage,patient_medicine.dosageM,patient_medicine.dosageA,patient_medicine.dosageE,patient_medicine.dosageN,patient_medicine.qty,patient_medicine.dateofpm,patient_medicine.pmid,patient_medicine.mid from medicine INNER JOIN patient_medicine ON medicine.mid=patient_medicine.mid where patient_medicine.pid='$colname_getmedicine' AND date(patient_medicine.dateofpm)='$d'");

$getmedicine = mysql_query($query_getmedicine, $cn) or die(mysql_error());
$row_getmedicine = mysql_fetch_assoc($getmedicine);
$totalRows_getmedicine = mysql_num_rows($getmedicine);

$query = "SELECT mid FROM patient_medicine WHERE date(dateofpm)='".date("Y-m-d")."'";
$record = mysql_query($query,$cn);


while($name = mysql_fetch_array($record)){
$selected_medicine[] = $name["mid"];
}


if(isset($_POST['add_days'])){

	header("location:givepre.php?pid=1&nn=".$_POST["nofdy"]);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prescription-Doct Connect</title>
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
<link rel="stylesheet" href="../chosen_v1.1.0/chosen.css">
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
<script language="javascript">

/*$(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	//var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
//var g=_self.data('id');//pmid
//$("#themeid").val(_self.data('kb'));
//var f=_self.data('kb');//pid
  // $.get("editpmedicine.php", {pmid:eval(g)}, function (data) {
              //      $("#dta").html(data);
             //   });
	//$(_self.attr('href')).modal('show');
//});

</script>
<script type="text/javascript">

function dn(id,pid,nfd)
{

	if(nfd==0){
		window.location='givepre.php?pid='+pid+'&msg=error';	
	}
	else {
		window.location='givepre.php?id='+id+'&pid='+pid+'&nn='+nfd;
	}
}
function  getc(id,pid)
	{
	
	
if( confirm('Are you sure you want to delete?'))
{

 window.location='givepre.php?dpmid='+id+'&pid='+pid;
    

}
else
{
return false;
}

	
	
	}

</script>
<style>
.gett
{
position:absolute;
	top:10%;
	left:50%;
	
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
      <div class="col-lg-9">
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
              <table style="overflow:auto;width:100%" class="table-bordered table-condensed table-green table-hover table-responsive table">
			 
                <tr>
                  <td>pid</td>
                  <td>fname</td>
                  <td>mname</td>
                  <td>lname</td>
                  <td>bdate</td>
                  <td>city</td>
                  <td>contactno1</td>
                  <td>contactno2</td>
                  <td>emailid</td>
                  <td>gender</td>
                  <td>Blood Group</td>
                </tr>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_patient['pid']; ?></td>
                    <td><?php echo $row_patient['fname']; ?></td>
                    <td><?php echo $row_patient['mname']; ?></td>
                    <td><?php echo $row_patient['lname']; ?></td>
                    <td><?php echo $row_patient['bdate']; ?></td>
                    <td><?php echo $row_patient['city']; ?></td>
                    <td><?php echo $row_patient['contactno1']; ?></td>
                    <td><?php echo $row_patient['contactno2']; ?></td>
                    <td><?php echo $row_patient['emailid']; ?></td>
                    <td><?php echo $row_patient['gender']; ?></td>
                    <td><?php echo $row_patient['bgroup']; ?></td>
                  </tr>
                  <?php } while ($row_patient = mysql_fetch_assoc($patient)); ?>
              </table>
              <div>
                <div id="basicFormExample" class="panel-collapse collapse in">
                  <div class="portlet-body"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet -->
      </div>
      <div class="col-lg-3">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left">No of Days</h4>
            </div>
            <div class="portlet-widgets"> </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <div class="portlet-body">
              <div>
                <div id="basicFormExample" class="panel-collapse collapse in">
                  <div class="portlet-body"> 
				   <form name="ff" method="post" action="<?php echo $_SERVER['../nurse_female/PHP_SELF']; ?>">
				  <table>
				  <tr><td><input type="text" name="nofdy" value="<?php echo (isset($_GET['nn'])) ? $_GET['nn'] : "" ; ?>" class="input-mini" style="width:90px;" required/></td><td>&nbsp;
				  <button type="submit" class="btn btn-success" name="add_days">Add</button></td></tr>
				  
				  </table>
				  </form>
				  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.portlet -->
      </div>
      <!-- ICU END -->
    </div>
    <div class="row">
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row">
          <!-- Basic Form Example -->
          <!-- SPECIAL START -->
          <div class="col-lg-5">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Medicine </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form name='f1' method='POST' action='<?php echo $editFormAction; ?>'>
                    <table  align="center"  class="table-hover table-responsive table-condensed table-bordered " style="width:100%">
                      <tr>
                        <td>Medicine</td>
                        <td>
							<?php if(isset($_GET["pmid"])) {  ?>
								<label><?php echo $row_getmlist['name']; ?>
                        	<?php  } else { ?>
						<select name="medicine" data-placeholder="Choose Medicine" class="chosen-select form-control" style="height:30px;" onchange="dn(this.value,<?php echo $_GET['pid']; ?>,<?php echo (isset($_GET['nn'])) ? $_GET['nn'] : 0; ?>);">
                            <option value=""></option> <?php } ?>
                            <?php  do { ?>
							<?php  if(!in_array($row_getkist['mid'],$selected_medicine)) { ?>
							<option value="<?php echo $row_getkist['mid']?>"
	  
	  <?php if(isset($_GET['id'])){ if($row_getkist['mid']==$_GET['id']) { echo 'selected';} } ?>
	  
	   ><?php echo $row_getkist['name']; ?></option>
                            <?php
} } while ($row_getkist = mysql_fetch_assoc($getkist));
  $rows = mysql_num_rows($getkist);
  if($rows > 0) {
      mysql_data_seek($getkist, 0);
	  $row_getkist = mysql_fetch_assoc($getkist);
  } 
?>
                          </select>
                        </td>
                      </tr>
					  <?php if(isset($_GET['msg'])) { 
					  			if($_GET['msg'] == "error"){ ?>
							<label class="alert alert-warning">Please select No of Days</label>			
							<?php 	}
							} ?> 
                      <?php if(isset($_GET['id']) ){?>
                      <tr>
                        <td>Manufacturer</td>
                        <td><label><?php echo $row_getmlist['manufcuturer']; ?></label>
                        </td>
                      </tr>
                      <tr>
                        <td>Generic Name</td>
                        <td><label><?php echo $row_getmlist['genericname']; ?></label>
                        </td>
                      </tr>
                      <tr>
                        <td>Medicine Form</td>
                        <td><label><?php echo $row_getmlist['mtype']; ?></label>
                        </td>
                      </tr>
                      <tr>
                        <td>Strength</td>
                        <td><input type="text"  class="form-control"  name="strength" value="<?php echo $row_getmlist['strength']; ?>"/>
                        </td>
                      </tr>
                      <tr>
                        <td>Dosage</td>
                        <td><table class="table table-bordered" >
                            <tr>
                              <td>M</td>
                              <td><input type="number"  class="form-control" name="dosageM" value="<?php echo $row_getmedicine['dosageM']; ?>"/></td>
                              <td>A</td>
                              <td><input type="number" class="form-control" name="dosageA" value="<?php echo $row_getmedicine['dosageA']; ?>"/></td>
                            </tr>
                            <tr>
                              <td>E</td>
                              <td><input type="number" class="form-control" name="dosageE" value="<?php echo $row_getmedicine['dosageE']; ?>"/></td>
                              <td>N</td>
                              <td><input type="number" class="form-control" name="dosageN" value="<?php echo $row_getmedicine['dosageN']; ?>"/>
                              </td>
                            </tr>
                          </table></td>
                      <tr>
                        <td>Dosage Timing</td>
                        <td><input type="text" name="dosage" class="form-control" value="<?php echo $row_getmlist['dosage']; ?>" onblur="makeupper(this.id);" id="dosage1" placeholder="Enter Dosage">
                        </td>
                      </tr>
                      <tr>
                        <td colspan=3><button type="submit" name="edit"  class="btn btn-default" style="float:right">Add To Prescription</button>
                          <button type="submit" name="edit"  class="btn btn-danger" style="float:left">Reset</button></td>
                      </tr>
                      <?php } ?>
                    </table>
                    <input type="hidden" name="MM_insert" value="f1">
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet -->
          </div>
          <div class="col-lg-7">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">Selected Medicine</h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
				<form name="generate_presc" method="post" action="generatePrescPDF.php?pid=<?php echo $_GET["pid"]; ?>">
                  <?php if($totalRows_getmedicine>0){ ?>
                  <table class="table-hover table-responsive table-condensed table-bordered ">
                    <tr>
                      <th>Medicine</td>
					  <th>Form</th>
                      <th>strength</td>
                      <th>Dosage</td>
                      <th>Timing</td>
                      <th>Quantity</td>
                      <th>Action</td>
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_getmedicine['name']; ?></td>
						<td><?php echo $row_getmlist['mtype'];?></td>
                        <td><?php echo $row_getmedicine['strength']; ?></td>
                        <td><?php echo ($row_getmedicine['dosageM'].'-'. 
     $row_getmedicine['dosageA'].'-'.
    $row_getmedicine['dosageE'].'-'. 
   $row_getmedicine['dosageN']); ?></td>
                        <td><?php echo $row_getmedicine['dosage']; ?></td>
                        <td><?php echo $row_getmedicine['qty']; ?></td>
                        <td><?php $nd=($row_getmedicine['qty']/($row_getmedicine['dosageM'] +$row_getmedicine['dosageA'] +$row_getmedicine['dosageE'] + $row_getmedicine['dosageN'])); ?>
						<a href="givepre.php?pmid=<?php echo $row_getmedicine['pmid']; ?>&amp;pid=<?php echo $_GET['pid']; ?>&amp;nn=<?php echo $nd;?>&amp;id=<?php echo $row_getmedicine["mid"]; ?>" class="btn btn-info"><i class="fa fa-edit"> </i></a>
                              <button type="button" class="btn btn-danger" onclick="getc(<?php echo $row_getmedicine['pmid']; ?>,<?php echo $_GET['pid']; ?>)"><i class="fa fa-times"></i></button>
						</td>
                      </tr>
                      <?php } while ($row_getmedicine = mysql_fetch_assoc($getmedicine)); ?>
					  <tr><td colspan="7" align="center"><button id="gen_prescp" type="submit" name="edit" class="btn btn-default">Generate Prescription</button></td></tr>
                  </table></form>
				  <?php if(isset($_GET['msg']) && $_GET['msg'] == 'spresc'){ ?>
					<label class="alert alert-success" style="margin:8px 0px -2px 0px;">PDF is created Successfully </label>
				<?php	}
				      }else { ?>
                  <label class="alert alert-warning">No medicine selected</label>
                  <?php } ?>
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-body" id="dta" > </div>
</div>
<!--end hover data -->
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
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
<script src="../chosen_v1.1.0/chosen.jquery.js"></script>
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
mysql_free_result($getkist);

mysql_free_result($getmlist);

mysql_free_result($getmedicine);
?>
