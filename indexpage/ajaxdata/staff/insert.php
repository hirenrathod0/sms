<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["staffid"], $_POST["staffname"],$_POST["address"],$_POST["contactno"], $_POST["birthdate"], $_POST["dateofjoining"], $_POST["designation"], $_POST["aadharcard"],$_POST["passbookno"]))
{
 $staffid = mysqli_real_escape_string($connect, $_POST["staffid"]);
 $staffname = mysqli_real_escape_string($connect, $_POST["staffname"]);
 $address = mysqli_real_escape_string($connect, $_POST["address"]);
 $contactno = mysqli_real_escape_string($connect, $_POST["contactno"]);
 $birthdate = mysqli_real_escape_string($connect, $_POST["birthdate"]);
 $dateofjoining = mysqli_real_escape_string($connect, $_POST["dateofjoining"]);
 $designation = mysqli_real_escape_string($connect, $_POST["designation"]);
 $aadharcard = mysqli_real_escape_string($connect, $_POST["aadharcard"]);
 $passbookno = mysqli_real_escape_string($connect, $_POST["passbookno"]);
 $query = "INSERT INTO staff(staffid, staffname,address,contactno,birthdate,dateofjoining,designation,aadharcard,passbookno) VALUES('$staffid', '$staffname', '$address', '$contactno','$birthdate','$dateofjoining','$designation','$aadharcard', '$passbookno')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}

//$columns = array('staffid', 'staffname', 'address' ,'contactno', 'birthdate', 'dateofjoining','designation','aadharcard' ,'passbookno');
?>
