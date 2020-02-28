<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["clientid"], $_POST["clientname"],$_POST["contactno"],$_POST["address"],$_POST["typeofclient"],$_POST["companyname"],$_POST["companytelno"],$_POST["emailid"]))
{
 $clientid = mysqli_real_escape_string($connect, $_POST["clientid"]);
 $clientname= mysqli_real_escape_string($connect, $_POST["clientname"]);
 $contactno = mysqli_real_escape_string($connect, $_POST["contactno"]);
 $address = mysqli_real_escape_string($connect, $_POST["address"]);
 $typeofclient= mysqli_real_escape_string($connect, $_POST["typeofclient"]);
 $companyname = mysqli_real_escape_string($connect, $_POST["companyname"]);
 $companytelno = mysqli_real_escape_string($connect, $_POST["companytelno"]);
 $emailid = mysqli_real_escape_string($connect, $_POST["emailid"]);
 
 $query = "INSERT INTO client(clientid, clientname,contactno,address,typeofclient,companyname,companytelno,emailid) VALUES('$clientid', '$clientname','$contactno','$address','$typeofclient', '$companyname', '$companytelno', '$emailid')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
 