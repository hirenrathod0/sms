<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["logid"], $_POST["vehicleno"],$_POST["vehiclename"],$_POST["loads"],$_POST["drivername"],$_POST["driverid"],$_POST["drivercontactno"],$_POST["clientid"],$_POST["clientname"],$_POST["date"],$_POST["companyname"],$_POST["typeofmaterial"]))
{
 $logid = mysqli_real_escape_string($connect, $_POST["logid"]);
 $vehicleno = mysqli_real_escape_string($connect, $_POST["vehicleno"]);
 $vehiclename = mysqli_real_escape_string($connect, $_POST["vehiclename"]);
 $loads = mysqli_real_escape_string($connect, $_POST["loads"]);
 $drivername = mysqli_real_escape_string($connect, $_POST["drivername"]);
 $driverid = mysqli_real_escape_string($connect, $_POST["driverid"]);
 $drivercontactno = mysqli_real_escape_string($connect, $_POST["drivercontactno"]);
 $clientid = mysqli_real_escape_string($connect, $_POST["clientid"]);
 $clientname = mysqli_real_escape_string($connect, $_POST["clientname"]);
 $date = mysqli_real_escape_string($connect, $_POST["date"]);
 $companyname = mysqli_real_escape_string($connect, $_POST["companyname"]);
 $typeofmaterial = mysqli_real_escape_string($connect, $_POST["typeofmaterial"]);
 $query = "INSERT INTO logofsend_receive(logid,vehicleno,vehiclename,loads,drivername,driverid,drivercontactno,clientid,clientname,date,companyname,typeofmaterial) VALUES('$logid', '$vehicleno', '$vehiclename', '$loads','$drivername','$driverid','$drivercontactno','$clientid','$clientname','$date','$companyname', '$typeofmaterial')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}

//$columns = array('logid', 'vehicleno', 'vehiclename' ,'loads','drivername','driverid','drivercontactno','clientid', 'clientname','date','companyname' ,'typeofmaterial');
?>

