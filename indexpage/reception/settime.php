<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_getdoctor = "-1";
$did="";
if (isset($_GET['did'])) {
$did=$_GET['did'];
  $colname_getdoctor = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_getdoctor = sprintf("SELECT * FROM `user` WHERE uid = '%s' and type='Doctor'", $colname_getdoctor);
$getdoctor = mysql_query($query_getdoctor, $cn) or die(mysql_error());
$row_getdoctor = mysql_fetch_assoc($getdoctor);
$totalRows_getdoctor = mysql_num_rows($getdoctor);
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

$(document).on("click", ".abc", function (e) {

	//e.preventDefault();

	var self1 = $(this).attr('value');

var myBookId = $(this).data('id');

var g=document.getElementById(myBookId).value;
	
	$('#sdate').val(g);
	$('#stime').val(self1);
	  document.getElementById('sbmt').style.display='block';
  //continue_button.style.visibility = 'visible';   
	
});

function sendit()
{
   var sdate4=document.getElementById('sdate').value; 
	  var stime4=document.getElementById('stime').value;
	   var did4=document.getElementById('did').value;
   
 var dd=new Array(sdate4,stime4,did4);
sessionStorage.setItem('myvalue', JSON.stringify(dd));
 window.location='setpatient.php';
 
 
}

function getdate(id)
{
alert(id);
}

</script>
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
          <h1> <?php echo $row_getdoctor['fullname']; ?> &nbsp; Appointment&nbsp;Status </h1>
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
                <a href="#" onclick="sendit()" class="btn btn-primary btn-small pull-right" id='sbmt' style="display:none"> Next</a>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="portlet-body">
            <div id="myPortletTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="tab1">
                <div class="table-responsive dashboard-demo-table">
                  <table class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <?php $a=array(); $j=0; $k=0; for($i=1;$i<=7;$i++)
				{
					$n= date('d-m-Y', strtotime("+$i day"));

 
					$weekday = date('l', strtotime($n)); 
					// note: first arg to date() is lower-case L
 
					
					$k++;
					$a[$k]=$weekday;
					
						echo " <td align='center'> <strong> $weekday </strong> <br/><input type='hidden' id='id$k' value='$n' /> ";
						echo "$n </td> ";
						
		 

				}
				?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
 $query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[1]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);




$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
		

if($totalRows_Recordset1 >0 &  $row_Recordset1['status']!='Not Available' ){	
		
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));
$n= date('d-m-Y', strtotime("+1 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did'";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{

echo "<br> <input type='radio' name='rb' data-id='id1' value='$start'";

 echo " class='abc'> ".$start;
 }
$t1=$date;
}
} 
else{
 if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }


}

?></td>
                        <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[2]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
		
		if($totalRows_Recordset1 >0 &  $row_Recordset1['status']!='Not Available' ){	
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));
$n= date('d-m-Y', strtotime("+2 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did' ";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{
echo "<br> <input type='radio' name='rb' data-id='id2' value='$start' class='abc'> ".$start;}
$t1=$date;
} 

}else{
 if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }


}

?></td>
                        <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[3]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
		
if($totalRows_Recordset1 >0 & $row_Recordset1['status']!='Not Available' ){			
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));

$n= date('d-m-Y', strtotime("+3 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did'";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{

echo "<br> <input type='radio' name='rb' value='$start' class='abc' data-id='id3' > ".$start;}
$t1=$date;
} 

}else{
if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }


}


?></td>
                        <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[4]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
		
if($totalRows_Recordset1 >0  & $row_Recordset1['status']!='Not Available' ){			
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));

$n= date('d-m-Y', strtotime("+4 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did'";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{


echo "<br> <input type='radio' name='rb' value='$start' class='abc' data-id='id4'> ".$start;}
$t1=$date;
} 

}else{
if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }
}


?></td>
                        <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[5]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
if($totalRows_Recordset1 >0  & $row_Recordset1['status']!='Not Available' ){			
		
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));

$n= date('d-m-Y', strtotime("+5 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did'";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{


echo "<br> <input type='radio' name='rb' value='$start' class='abc' data-id='id5'> ".$start;}
$t1=$date;
} 

}else{
if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }


}

?></td>
                        <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[6]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
	
if($totalRows_Recordset1 >0  & $row_Recordset1['status']!='Not Available' ){		
		
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));

$n= date('d-m-Y', strtotime("+6 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did' ";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{
echo "<br> <input type='radio' name='rb' value='$start' class='abc' data-id='id6'> ".$start;}
$t1=$date;
} 

}
else
{
  if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }
  
  
}


?></td>
 <td align="left"><?php  $colname_Recordset1 = "-1";
if (isset($_GET['did'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['did'] : addslashes($_GET['did']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did = '%s'AND dday='$a[7]' ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


$t1=$row_Recordset1['dstart'];
$t2=$row_Recordset1['dend'];
		
if($totalRows_Recordset1 >0  & $row_Recordset1['status']!='Not Available' ){			
while($t1<$t2)
{
$date = date('H:i', strtotime($t1 . ' + 15 minute'));
$date1 = date('H:i', strtotime($t1 . ' + 30 minute'));
$start=date('g:i', strtotime($date)) .'-'.date('g:i', strtotime($date1));

$n= date('d-m-Y', strtotime("+7 day"));
mysql_select_db($database_cn, $cn);
$query_getctime = "SELECT * FROM appointment WHERE timeofapp = '$start' and dateofapp='$n' and did='$did' ";
$getctime = mysql_query($query_getctime, $cn) or die(mysql_error());
$row_getctime = mysql_fetch_assoc($getctime);
$totalRows_getctime = mysql_num_rows($getctime);

if($totalRows_getctime==1){
echo "<br><i class='fa fa-circle text-red'></i>&nbsp;&nbsp;".$start;
}else{


echo "<br> <input type='radio' name='rb' value='$start' class='abc' data-id='id7'> ".$start;}
$t1=$date;
} 

}

else{
 if($row_Recordset1['status']=='Not Available'){
  
   echo '<label class="alert alert-danger">Not Available</label>';
  }
  else
  {
   echo '<label class="alert alert-warning">Time Not Set</label>';
  }

}

?></td>
                      </tr>
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
</div>
</body>
</html>
<?php
mysql_free_result($getdoctor);

mysql_free_result($Recordset1);

mysql_free_result($getctime);
?>
