<?php
$connect = mysqli_connect("localhost", "root", "", "abc");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM projectreport WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>