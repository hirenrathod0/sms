<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_DOCTOR']))
{
header('login.php');
}
mysql_select_db($database_cn, $cn);
$pid = $_GET['recordID'];

$query_DetailRS1 = "SELECT * FROM certificate";
$DetailRS1 = mysql_query($query_DetailRS1, $cn) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);

?>

<div style='width:300px;margin-top:100px;' >
  <div class='portlet portlet-default'>
    <div class='portlet-heading'>
      <div class='portlet-title'>
        <h4 style='float:left'> Select Certificate </h4>
      </div>
      <div class='portlet-widgets' class='pull-right'>
      <button class='btn btn-danger' data-dismiss='modal' aria-hidden='true'><i class='fa fa-times'></i></button>
    </div>
    <div class='clearfix'></div>
  </div>
  <div id='basicFormExample' class='panel-collapse collapse in'>
    <div class='portlet-body'>
      <form action="patientcerti1.php" name="frm" method="get">
        <table  align="center"  class="table-hover table-responsive table-condensed table-bordered">
          <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
          <?php do{ 
					
					 $id=$row_DetailRS1['id'];
					$n=$row_DetailRS1['name']; ?>
          <tr>
            <td><input name="cer" type="radio" value="<?php echo $n; ?>" />
              <?php  echo $row_DetailRS1['name']; ?></td>
          </tr>
          <?php  }while($row_DetailRS1 = mysql_fetch_assoc($DetailRS1)) ?>
          <tr>
            <td><input type="submit"   name="btn" value="Create Certificate "/>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
</div>
</div>
