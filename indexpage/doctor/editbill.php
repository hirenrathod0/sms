<?php

echo $id=$_GET['pid'];
mysql_connect('localhost','root','');
mysql_select_db('vihar');


$query1="SELECT `pid`, `fname`, `lname` FROM `patient` WHERE  pid=".$id;
$res1=mysql_query($query1);
$row1=mysql_fetch_assoc($res1);



echo $query="SELECT `bhid`, `name`, `price` , `numofd`, `ttl`, `pid`, `total`, `bid`, `date`, `type`, `status` FROM `billhistry` WHERE  pid=".$id."  ";
$res=mysql_query($query);
$row=mysql_fetch_assoc($res);

if(isset($_POST['remove']))
{

header('location:chargesremove.php');
}
if(isset($_POST['done']))
{
$query="UPDATE `billhistry` SET  `status`='approval' WHERE  pid=".$id;
mysql_query($query);

$query="UPDATE `bill` SET `status`='approval' WHERE  pid=".$id;
mysql_query($query);
header('location:index.php');
}

//$ch=array($_POST['charges']);
//for($i=0;$i<count($ch);$i++)
//{
//$query="UPDATE `billhistry` `name`=,`price`=,`numofd`=,`ttl`=`pid`=,`total`=,`bid`=,`date`=,`type`=,`status`= WHERE  pid= "


//}


//}


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Patient-Doct Connect</title>
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
<script language="javascript" type="text/javascript">
	function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
	}
	function findtotal(obj,dy)
	{
	var p=document.getElementById('price'+dy).value;
	var q=document.getElementById('days'+dy).value;
	
	document.getElementById('total'+dy).value=p*q;
	
	
	//alert(dy);
	}
	function data1(obj,bh)
	{
	window.location('chargesedit.php?id='+bh);
	
	}
	
	
	</script>
	<script type="text/javascript">
	function shy(id)
	{
	var p=document.getElementById('bhid'+id).value;
	var d=document.getElementById('days'+id).value;
	window.location='chargesedit.php?bhid='+p+'&days='+d;
  
	}
	
	</script>
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-30">
        <div class="page-title">
          <h1> Add New Patient </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Add New Patient </li>
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
      <div class="col-lg-30">
        <div class="row">
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient </h4>
                </div>
                <div class="portlet-widgets"> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form name="f1"  method="post" action="">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                      <tr valign="baseline">
                        <td nowrap  ><strong>Name:</strong></td>
                        <td  colspan="7"><input type="text" name="fname" value=" <?php echo $row1['fname'] .'  '.$row1['lname']; ?> " size="32" placeholder="Enter  Name " required class="form-control" onblur="makeupper(this.id);" id="fname"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap ><strong>Charges</strong></td>
                        <td nowrap ><strong>Price</strong></td>
                        <td nowrap ><strong>Days</strong></td>
                        <td nowrap ><strong>Total</strong></td>
                        <td nowrap  colspan="2"><strong>Action</strong></td>
                      </tr>
                      <?php $i=0;  do{   $i=$i+1; ?>
                      <tr>
                        <td><?php echo $row['name'] ;  ?>
                          <input type="hidden" value="<?php echo $row['bhid'] ;  ?>" name="bhid" id="bhid<?php echo $i; ?>"/>
                        </td>
                        <td><input type="text" name="price" disabled="disabled" onblur="makeupper(this.id);" value="<?php  echo $row['price']; ?>" size="15" placeholder="Enter Price " required class="form-control" id="price<?php echo ($i);?>"></td>
                        <td><input type="text" name="days" onblur="makeupper(this.id,);" onkeyup="findtotal(this.value,<?php echo ($i); ?>)" value="<?php echo $row['numofd'] ?>" size="15" placeholder="Enter Days " required class="form-control" id="days<?php echo $i; ?>"></td>
                        <td><input type="text" disabled="disabled" name="total" onblur="makeupper(this.id,);" value="<?php echo $row['ttl']; ?>" size="15" placeholder="Enter Total " required class="form-control" id="total<?php echo $i; ?>"></td>
                        <td >
						
						<a  class="btn btn-warning" onclick="shy(<?php echo ($i); ?>);"  style="height:auto;width:auto"   /><i class="fa fa-paperclip"> Edit</i></a>
						
						
                        <a href="chargesremove.php?id=<?php echo $row['bhid']; ?>" class="btn btn-info "><i class="fa fa-paperclip">Delete</i></a> </td>
                      </tr>
                      <?php   }while($row=mysql_fetch_assoc($res));   ?>
                      <tr valign="baseline">
                        <td colspan="6" align="center"><input type="submit" value="Done" name="done" class="btn btn-green "></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1">
               </form>
                  <p>&nbsp;</p>
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
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
