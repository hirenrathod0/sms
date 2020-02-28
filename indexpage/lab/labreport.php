<?php

$row="";
mysql_connect('localhost','root','');
mysql_select_db('doc_connect');
if(isset($_GET['remove']))
{
echo $_GET['remove'];
$query4="delete from reportdata where id=".$_GET['remove'];
mysql_query($query4);
}
if(isset($_GET['id']))
{
$id=$_GET['id'];
$_SESSION['ids']=$id;
$query3="select * from rep_cat where rid=".$id;
$a=mysql_query($query3);
$row=mysql_fetch_assoc($a);
}
else if(isset($_SESSION['ids'])){
$query3="select * from rep_cat where rid=".$_SESSION['ids'];
$a=mysql_query($query3);
$row=mysql_fetch_assoc($a);
}
$query1="select * from rep_cat";
$res1=mysql_query($query1);
$row1=mysql_fetch_assoc($res1);
if(isset($_POST['m1']))
{
$id1=$_SESSION['ids'];
$inv=$_POST['inv'];
$nm1=$_POST['nm1'];
$query2="INSERT INTO reportdata( cid, investigation,  normalvalue) VALUES (".$id1.",'".$inv."','".$nm1."')";
mysql_query($query2);
}
$query3="SELECT  * FROM reportdata where cid=".$_SESSION['ids'];
$res5=mysql_query($query3);
$row5=mysql_fetch_assoc($res5);
?>
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
<script language="javascript">
function makeupper(obj){
var f=document.getElementById(obj).value;
document.getElementById(obj).value=f.toUpperCase();}
$(document).on("click", ".open-AddBookDialog", function (e) {
	e.preventDefault();
	var _self = $(this);
	var g=_self.data('id');
   $.get("detailmedicine.php", {recordID:eval(g)}, function (data) {
                    $("#dta").html(data);
                });
	$(_self.attr('href')).modal('show');
});
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
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> Lab Report </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Lab-Report </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left">Lab Report</h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                 
				 <div>
				  <div id="basicFormExample" class="panel-collapse collapse in">
				  <div class="portlet-body">
				  <form name="f1" method="post" action="labreport.php">
                    <table   class="table table-striped table-bordered table-hover table-green" >
					<thead>
                      <tr>
					  	<td>Category</td>
                        <td>Investigation</td>
                        <td>Normal value</td>
                        <td>Action</td> 
                      </tr>
					 </thead>
					 <tbody>
                        <tr>	                       
							<td>
							 <?php if(isset($_GET['id'])){  echo $row['name']; $_SESSION['name']=$row['name'];    } else {echo $_SESSION['name'];} 
							  ?>  
							 </td>                        
                          <td><input type="text" name="inv" id="invv"  onblur="makeupper(this.id);" /></td>
						   <td><input type="text" name="nm1" id="nm1" onblur="makeupper(this.id);"/></td>
						  <td><button type="submit" name="m1" class="btn  btn-success"><i class="fa fa-plus"></i></button></td>
                        </tr>
						</tbody>
                    </table>
					<div class="row">
                   	<form name="listcat" >
                      <div class="col-lg-12" >
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title" >
                                    <h4>List All Report</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="example-table" class="table table-condensed table-green" width="">
                                        <thead>
										<tr>
										  <td>Category</td>
										  <td>Investigation</td>
										  <td>Normal Value</td>
			 							  <td>Action</td>
										</tr>
                                        </thead>
                                        <tbody>   
                        <?php if($row5['cid']==''){   }else{ do {     ?>
                          <tr>
						  	<td><?php $query7="SELECT `rid`, `name`, `price` FROM `rep_cat` where rid=".$row5['cid'];
							 $res7=mysql_query($query7);
							 $row7=mysql_fetch_assoc($res7);
							 echo $row7['name'];    ?></td>
                            <td><?php echo $row5['investigation']; ?></td>
						
							<td> ( <?php echo $row5['normalvalue']; ?> )</td>
							<td>
							<a class="btn btn-orange" href="editreport.php?id=<?php echo $row5['id'];  ?>"><i class="fa fa-edit">
							</i></a>&nbsp;&nbsp;<a class="btn btn-danger" href="labreport.php?remove=<?php echo $row5['id'];  ?>"><i class="fa fa-times">
							</i></a>
							</td>
	  </tr>
                        <?php }while($row5=mysql_fetch_assoc($res5)); }?>  
                      </table>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					</form>
    </div>
	
  </div>
</div>

					
					
					
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
        <!-- /.row (nested) -->
        <!-- Modal -->
      </div>
    </div>
  </div>
</div>

  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta" > 
		  
		  
		  
		  
		  </div>
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
</body>
</html>
