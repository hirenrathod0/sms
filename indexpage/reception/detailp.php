<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_Recordset1 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['pid'] : addslashes($_GET['pid']);
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM patient WHERE pid = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$g=0;
echo '
<table align="center" class="table-responsive table-condensed table-bordered table ">
                      <tr valign="baseline">
					  
                        <td nowrap align="right"><strong>Full Name:</strong></td>
                        <td><input type="text" name="fname" value="'.$row_Recordset1['fname']  .''. $row_Recordset1['mname'].''. $row_Recordset1['lname'].'" style="width:42%" placeholder="Enter First Name " required class="form-control" onblur="makeupper(this.id);" onkeyup="getdetail(this.value)" id="fname"><div  id="id4"></div></td>
						
                      </tr>
                     
                      
                      <tr valign="baseline">
                        <td nowrap align="right"><strong>City:</strong></td>
                        <td><input type="text" name="city3" onblur="makeupper(this.id);" value="'.$row_Recordset1['city'].'" style="width:42%" placeholder="Enter City"  class="form-control" id="city"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right"> <strong>Primary Contact No :</strong></td>
                        <td><input type="number" name="contactno13" value="'.$row_Recordset1['contactno1'].'"  style="width:42%" placeholder=" Primary Contact No"  class="form-control" id="contactno1"></td>
                      </tr>
                      
                    
                     
                      <tr valign="baseline">
                        
                        <td colspan="2" align="center"><input type="submit" value="Submit" class="btn btn-green "></td>
                      </tr>
                    </table>';

?>
