<?php 
include('../config.php');
//$connect = new PDO('mysql:host=localhost;dbname=sms', 'root', '');

$query = "";
if($_POST['need'] == 'users')
{
    $query = "SELECT COUNT(id) from users";
}
if($_POST['need'] == 'tenants')
{
    $query = " SELECT COUNT(id) from users where type like 'tenent'";
}
if($_POST['need'] == 'activecomplaints')
{
    $query = "SELECT COUNT(complaintNumber) FROM `tblcomplaints` WHERE status like 'in process'"; 
}
if($_POST['need'] == 'nonactivecomplaints')
{
    $query = "SELECT COUNT(complaintNumber) FROM `tblcomplaints` WHERE status is null ";
}
if($_POST['need'] == 'guests')
{
    $query = "SELECT COUNT(vid) from visitor";
}
if($_POST['need'] == 'emptyflats')
{
    $query = "SELECT COUNT(fid) from flat where uid is NULL ";
}
if($_POST['need'] == 'allocatedflats')
{
    $query = "SELECT COUNT(uid) from flat where uid is NOT null" ;
}


$statement = $dbh->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$str="";

foreach($result as $row)
{
    $str = $row[0];
}

echo $str;
?>
