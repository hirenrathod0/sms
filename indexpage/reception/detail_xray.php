
<?php require_once('../Connections/cn.php'); ?><?php
if(!isset($_SESSION['MM_RECEPTION']))
{
header('login.php');
}


mysql_select_db($database_cn, $cn);
$recordID = $_GET['recordID'];
$query_DetailRS1 = "SELECT * FROM patient WHERE pid = $recordID";
$DetailRS1 = mysql_query($query_DetailRS1, $cn) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);
?>

        <?php  echo "  
            <div class='portlet portlet-default'>
              <div class='portlet-heading'>
                <div class='portlet-title'>
                  <h4 style='float:left'> Patient Details </h4>
                </div>
                <div class='portlet-widgets' class='pull-right'> <button class='btn btn-danger' data-dismiss='modal' aria-hidden='true'><i class='fa fa-times'></i></button></div>
                <div class='clearfix'></div>
              </div>
              <div id='basicFormExample' class='panel-collapse collapse in'>
                <div class='portlet-body'> " ;?>
               <?php echo '  <table  align="center"  class="table-hover table-responsive table-condensed table-bordered">
  
  <tr>
    <td>Id</td>
    <td> ' ?><?php echo $row_DetailRS1['pid']; ?><?php echo ' </td>
  </tr>
  <tr>
    <td>First Name</td>
    <td> '?><?php echo $row_DetailRS1['fname']; ?><?php echo ' </td>
  </tr>
  <tr>
    <td>Middle Name</td>
    <td> ' ?><?php echo $row_DetailRS1['mname']; ?><?php echo ' </td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td> ' ?> <?php echo $row_DetailRS1['lname']; ?> <?php echo ' </td>
  </tr>
  <tr>
    <td>Age</td>
    <td> ' ?> <?php echo $row_DetailRS1['bdate']; ?> <?php echo ' </td>
  </tr>
  <tr>
    <td>City</td>
    <td>' ?><?php echo $row_DetailRS1['city']; ?><?php echo ' </td>
  </tr>
  <tr>
    <td>Contactno1</td>
    <td> ' ?><?php echo $row_DetailRS1['contactno1']; ?> <?php echo '</td>
  </tr>
  
  <tr>
    <td>Emailid</td>
    <td> ' ?><?php echo $row_DetailRS1['emailid']; ?><?php echo ' </td>
  </tr>
  <tr>
    <td>Gender</td>
    <td> ' ?><?php echo $row_DetailRS1['gender']; ?><?php echo ' </td>
  </tr>
  
   <tr>
    <td>Date Of Add</td>
    <td> ' ?><?php echo $row_DetailRS1['dtofadd']; ?><?php echo ' </td>
  </tr>
   <tr>
    <td>Blood Group</td>
    <td> ' ?><?php echo $row_DetailRS1['bgroup']; ?><?php echo ' </td>
  </tr>
 
  
</table>' ?>
             


