<?php require_once('../Connections/cn.php'); ?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Appointment-Doct Connect</title>
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
<script language="javascript" type="text/javascript">


function closeit(id)
{
var f='#hide'+id;

var k=1;
 
 $(f).toggle('slow');

 


}
</script>
<script language="javascript" type="text/javascript">
function getconfirn(rid)
{
if(confirm('Are you sure you wants to cancel appointment?')){

window.location='delapp.php?rid='+rid;


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
        <h1>  &nbsp; Appointment&nbsp;Status </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
          <li><a href="apointment.php">Select Doctor</a> </li>
          <li class="active">Select Time</li>
        </ol>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="portlet portlet-default">
        <div class="portlet-heading">
          <div class="portlet-title">
            <h4>Select Relevent Doctor Timings </h4>
          </div>
          <div class="portlet-widgets">
            <ul id="myPortletTab" class="list-inline tabbed-portlets">
              <input type="hidden" value="" name="sdate" id="sdate"/>
              <input type="hidden" value="" name="stime" id="stime"/>
              <input type="hidden" value="<?php echo $_GET['did'];?>" name="did" id="did"/>
              <a href="#" onclick="sendit()" class="btn btn-primary btn-small pull-right" id='sbmt' style="display:none" > Next</a>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="portlet-body">
          <div id="myPortletTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
              <div class="table-responsive dashboard-demo-table">
                <table class=" table table-bordered table-striped table-hover ">
                  <thead>
                    <?php $a=array(); $j=0; $k=0; for($i=1;$i<=7;$i++)
				{
				$j=$i-1;
					$n= date('d-m-Y', strtotime("+$j day"));

 
					$weekday = date('l', strtotime($n)); 
					// note: first arg to date() is lower-case L
 
					
					$k++;
					$a[$k]=$weekday;
					$p='btn'+$i;
						echo " <tr><td align='center'> <strong> $weekday </strong> <br/><input type='hidden'  id='id$k' value='$n' /> ";
						echo "<strong> $n </strong> <button type='button' onClick='closeit($i);' id='$p' class='pull-right' style='border-style:none'><i class='fa fa-arrow-circle-up'></i></button> </td></tr> ";
						
						mysql_select_db($database_cn, $cn);
$query_getapp = "SELECT * FROM appointment WHERE dateofapp = '$n'";
$getapp = mysql_query($query_getapp, $cn) or die(mysql_error());
$row_getapp = mysql_fetch_assoc($getapp);
$totalRows_getapp = mysql_num_rows($getapp); ?>
						<tr><td>
						<?php if($totalRows_getapp >0){ ?>
<div id="hide<?php echo $i; ?>">
		 <table class="table-green table-bordered table-hover table ">
		 <thead>
  <tr>
    
    <strong><td>Doctor Name </td>
 
    <td>Time Of Appointment </td>
    <td>Patient Name</td>
    <td>Patient Village</td>
    <td>Contact No</td></strong>
	<td> Actions </td>
  </tr>
  </thead>
  <tbody>
 <?php  do { ?>
    <tr>
     
      <td><?php $n=$row_getapp['did']; if($n==1) { echo("Dr Pankaj Parikh");  } else { echo("Dr Samir Patel"); }?></td>
     
      <td><?php echo $row_getapp['timeofapp']; ?></td>
      <td><?php echo $row_getapp['pname']; ?></td>
      <td><?php echo $row_getapp['pvillage']; ?></td>
      <td><?php echo $row_getapp['pcontactno']; ?></td>
	  <td>
	  <?php if(date('d-m-Y')!=$row_getapp['dateofapp']){ ?>
	  <a href="editapp.php?did=<?php echo $row_getapp['did']; ?>&aid=<?php echo $row_getapp['aid']; ?>" class="btn-blue btn"> <i class="fa fa-pencil">  </i> </a> <?php } ?>
						
						 
						 <button type="button" onclick="getconfirn(<?php echo $row_getapp['aid']; ?>)" class="btn-red btn"><i class="fa fa-trash-o">  </i> </button>
						 
						  </td>
						  
    </tr>
    <?php } while ($row_getapp = mysql_fetch_assoc($getapp)); ?>
	</tbody>
</table>
</div>
<br /> <br /> 
<?php }else{ echo "<label class='alert alert-warning ' align='center'>No appointment</label>"; } ?>

</td></tr>

			<?php 	}
				?>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
</html>
<?php
mysql_free_result($getapp);
?>
