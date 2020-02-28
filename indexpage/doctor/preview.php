<?php 
mysql_connect('localhost','root','');
mysql_select_db('doc_connect');
$id=$_GET['id'];
$query="SELECT `bhid`, `name`, sum(`price`) as sum, `numofd`, `ttl`, `pid`, `total`, `bid`, `date`, `type`, `status` FROM `billhistry` WHERE pid=  $id   group by name";
$res=mysql_query($query);
$row=mysql_fetch_assoc($res);
$t=mysql_num_rows($row);
 $query1="SELECT `pid`, `fname`, `mname`, `lname` FROM `patient` WHERE  pid=".$id;
$res1=mysql_query($query1);
$row1=mysql_fetch_assoc($res1);


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
<script language="javascript">
$(document).on("click", ".open-AddBookDialog", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailpatients.php", {recordID:eval(g)}, function (data) {
                    $("#dta").html(data);
                });
	$(_self.attr('href')).modal('show');
});
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
          <h1> Preview</h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Preview Detail </li>
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
                  <h4 style="float:left"> Preview Detail </h4>
                </div>
                <div class="portlet-widgets">  </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body" style="overflow:scroll">
                  
              <table   class="table table-striped table-bordered table-hover table-green">
                 
                    
                      <tr>
					  <?php if($t>0) {   ?>
                        <td colspan="6"><b> Patient Name:</b></td>
						
						</tr>
						<tr>
						<td colspan="6"><?php  echo $row1['fname'].'  '. $row1['lname'] ;  ?> </td>
                    		<input type="hidden" value="<?php $id=$row['pid']; ?>" />    
							</tr>
							<tr>
                  	    <td>
						 <b>  charges</b>
						</td>
						<td>
						 <b>  price</b>
						</td>
						<td>
						 <b>  days</b>
						</td>
						
        				</tr>          		
                        
						<?php   do{
					
											
											echo "<tr>";
											
												echo "<td>";
									echo $row['name'];
					
								echo "</td>";
									echo "<td>";
									echo $row['sum'];
									echo "</td>";
									echo "<td>";
									echo $row['numofd'];
									echo  "</td>";
							
									echo "</tr>";
						
								}while($row=mysql_fetch_assoc($res));
						      
							   ?>
                        <input type="hidden" value="<?php //$pid=$row_bill['pid']; ?>" />
                        </td>
						<tr>
						
                        <td  colspan="6"align="center"> <a href="editbill.php?pid=<?php echo $row1['pid']; ?>" class="pull btn-orange btn"><i class="fa fa-paperclip">Edit</i></a> <?php }else{
							  echo "No Data Found";
							  
							  }   ?>
						</td>
</tr>						
                        
                      </tr>
                      
                  </table>
                   
           
              <?php //} ?>
                </div>
              
              </div>
            </div>
            <!-- /.portlet -->
          </div>
        </div>
        <!-- /.row (nested) -->
       
 
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  
  <div class="modal-body" id="dta">
   
  </div>
 
</div>
      </div>
    </div>
  </div>
</div>
<!-- Button to trigger modal -->


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
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>

