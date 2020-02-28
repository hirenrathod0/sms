<?php require_once('../Connections/cn.php'); ?>
<?php
$colname_detail2 = "-1";

if (isset($_GET['kw'])) {

  if($_GET['kw']==''){
  
  echo 'abc';
  //break;
  }
  else
  {
  $colname_detail2 = (get_magic_quotes_gpc()) ? $_GET['kw'] : addslashes($_GET['kw']);}
}
mysql_select_db($database_cn, $cn);
$query_detail2 = "SELECT * FROM patient WHERE fname LIKE   '$colname_detail2%'";
$detail2 = mysql_query($query_detail2, $cn) or die(mysql_error());
$row_detail2 = mysql_fetch_assoc($detail2);
$totalRows_detail2 = mysql_num_rows($detail2);


?>
<?php if($totalRows_detail2>0){
/*
echo '<input type="text" value="'. $_GET['dt'].'" name="sdate2" id="sdate2"/>';
echo '<input type="text" value="'. $_GET['st'].'" name="stime2" id="stime2"/>';
echo '<input type="text" value="'. $_GET['d'].'" name="did2" id="did2"/>';*/
echo '<table class="table table-boardered table-hover table-bordered" style="box-shadow:1px 1px 1px #000">
<thead style="background-color:#000">
  <tr style="color:#fff">
    
    <td>Name </td>
    
   
    <td>City</td>
    <td>contact</td>
   
     <td>Action </td>
  </tr></thead>'; ?>
  <?php do { 
   echo '<tr>';
   
     echo  '<td>'.  $row_detail2['fname'].' ' . $row_detail2['mname'].' '.  $row_detail2['lname'].'</td>';
    
    
      echo  '<td>'. $row_detail2['city']. '</td>';
      echo  '<td>'.  $row_detail2['contactno1'].'</td>';
      echo  '<td><a onclick="setid('.$row_detail2['pid'].')" href='."#".' class="btn btn-success"><i class="fa fa-plus"></i></a></td>';
     
  echo '  </tr>';
    } while ($row_detail2 = mysql_fetch_assoc($detail2));  ?>


<?php echo '</table>'; } ?>
