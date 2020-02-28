<?php 
require_once('../Connections/cn_vihar.php');

session_start();
$colname_Recordset2 = $_SESSION['MM_DOCTOR'];

mysql_select_db($database_cn, $cn);$n=date('d-m-Y');
 $query_Recordset2 = sprintf("SELECT * FROM appointment WHERE did = %s  AND dateofapp='$n'", $colname_Recordset2);
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
  <?php  do {   
              
               echo '<label >';
              
           echo '<i class="fa fa-wrench fa-fw text-faded"></i>'.$row_Recordset2['pname'].' <span class="task-time text-faded pull-right" style="color:#FF6600;">'.$row_Recordset2['timeofapp'].'</span> 
			  </label>';
            }while($row_Recordset2 = mysql_fetch_assoc($Recordset2)) ?>