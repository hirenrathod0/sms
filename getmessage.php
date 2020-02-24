<?php 

$connect = new PDO('mysql:host=localhost;dbname=society', 'root', '');

$query = "Select * from notices ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $data="";
    foreach($result as $row)
    {
        $data = $data.$row["msg_data"]." ".$row["msg_date"]." ".$row["isread"]." "."<br/>";
    }
    echo $data;

?>