<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["adminid"], $_POST["adminname"],$_POST["username"],$_POST["password"],$_POST["contactno"]))
{
 $adminid = mysqli_real_escape_string($connect, $_POST["adminid"]);
 $adminname = mysqli_real_escape_string($connect, $_POST["adminname"]);
 $username = mysqli_real_escape_string($connect, $_POST["username"]);
 $password = mysqli_real_escape_string($connect, $_POST["password"]);
 $contactno = mysqli_real_escape_string($connect, $_POST["contactno"]);
 $query = "INSERT INTO admin(adminid, adminname,username,password,contactno) VALUES('$adminid', '$adminname', '$username', '$password', '$contactno')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
