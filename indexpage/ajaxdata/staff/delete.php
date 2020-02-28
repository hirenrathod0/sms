<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM staff WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>