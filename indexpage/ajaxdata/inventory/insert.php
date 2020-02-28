<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["inventoryid"], $_POST["brand"],$_POST["type"],$_POST["price"],$_POST["date"],$_POST["dealername"],$_POST["dealercontactno"],$_POST["dealeraddress"]))
{
 $inventoryid = mysqli_real_escape_string($connect, $_POST["inventoryid"]);
 $brand = mysqli_real_escape_string($connect, $_POST["brand"]);
 $type = mysqli_real_escape_string($connect, $_POST["type"]);
 $price = mysqli_real_escape_string($connect, $_POST["price"]);
 $date = mysqli_real_escape_string($connect, $_POST["date"]);
 $dealername = mysqli_real_escape_string($connect, $_POST["dealername"]);
 $dealercontactno = mysqli_real_escape_string($connect, $_POST["dealercontactno"]);
 $dealeraddress = mysqli_real_escape_string($connect, $_POST["dealeraddress"]);
 $query = "INSERT INTO inventory(inventoryid, brand,type,price,date,dealername,dealercontactno,dealeraddress) VALUES('$inventoryid', '$brand', '$type', '$price', '$date', '$dealername', '$dealercontactno', '$dealeraddress')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
