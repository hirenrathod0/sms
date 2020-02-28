<?php require_once('../Connections/cn.php'); ?>
<?php

if(!isset($_SESSION['MM_Username']))
{
header('login.php');
}
$did=$_GET['did'];

$dday=$_GET['dday'];

mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM drtime WHERE did='%s' AND dday='%s'",$did,$dday);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 
if($totalRows_Recordset1>0)
{ 
  echo ' <div class="form-group">
                                  <label  for="exampleInputPassword2">In Time</label>
                                  <input type="time" class="form-control" required id="intime" placeholder="start time" name="intime"  value="'.$row_Recordset1['dstart'].'" ';
								 
								echo '  " >
                                </div>';
                               
								
                           echo '     <div class="form-group">
                                  <label  for="exampleInputPassword2">Out Time</label>
                                  <input type="time" class="form-control" required id="outtime" placeholder="outtime" name="outtime"  value="'.$row_Recordset1['dend'].'"';
								 
								  
								echo '  " >
                                </div> ';
  
}
else
{
echo ' <div class="form-group">
                                  <label  for="exampleInputPassword2">In Time</label>
                                  <input type="time" class="form-control" required id="intime" placeholder="start time" name="intime"  value="11:00:00" >
                                </div>';
                               
								
                           echo '     <div class="form-group">
                                  <label  for="exampleInputPassword2">Out Time</label>
                                  <input type="time" class="form-control" required id="outtime" placeholder="outtime" name="outtime"  value="17:00:00" >
                                </div> ';





}



?>