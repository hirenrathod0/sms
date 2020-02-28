<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["itemid"], $_POST["typeofmaterial"],$_POST["kgsofmaterial"]))
{
 $itemid = mysqli_real_escape_string($connect, $_POST["itemid"]);
 $typeofmaterial = mysqli_real_escape_string($connect, $_POST["typeofmaterial"]);
 $kgsofmaterial = mysqli_real_escape_string($connect, $_POST["kgsofmaterial"]);
 
 $query = "INSERT INTO itemdata(itemid, typeofmaterial,kgsofmaterial) VALUES('$itemid', '$typeofmaterial', '$kgsofmaterial')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}

//$columns = array('itemid', 'typeofmaterial', 'kgsofmaterial' );
?>
