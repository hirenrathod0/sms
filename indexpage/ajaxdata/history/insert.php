<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["historyid"], $_POST["clientname"],$_POST["address"],$_POST["companyname"],$_POST["loads"],$_POST["typeofmaterial"],$_POST["date"],$_POST["contactno"],$_POST["vehicleno"],$_POST["emailid"]))
{
 $historyid = mysqli_real_escape_string($connect, $_POST["historyid"]);
 $clientname = mysqli_real_escape_string($connect, $_POST["clientname"]);
 $address = mysqli_real_escape_string($connect, $_POST["address"]);
 $companyname = mysqli_real_escape_string($connect, $_POST["companyname"]);
 $loads = mysqli_real_escape_string($connect, $_POST["loads"]);
 $typeofmaterial = mysqli_real_escape_string($connect, $_POST["typeofmaterial"]);
 $date = mysqli_real_escape_string($connect, $_POST["date"]);
 $contactno = mysqli_real_escape_string($connect, $_POST["contactno"]);
 $vehicleno = mysqli_real_escape_string($connect, $_POST["vehicleno"]);
 $emailid = mysqli_real_escape_string($connect, $_POST["emailid"]);
 $query = "INSERT INTO history(historyid, clientname,address,companyname,loads,typeofmaterial,date,contactno,vehicleno,emailid) VALUES('$historyid', '$clientname', '$address', '$companyname','$loads','$typeofmaterial','$date', '$contactno','$vehicleno','$emailid')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
