<?php
//eventDetails.php

$connect = new PDO('mysql:host=localhost;dbname=sms', 'root', '');

$query = "SELECT * FROM booking  WHERE booking_id=:id";

$statement = $connect->prepare($query);

$statement->execute(
    array(
    ':id' => $_POST['bookingid']
    )
);

$result = $statement->fetch();

$r = $result['fun_title'].",".$result['fun_details'].",".$result['start_time'].",".$result['end_time'].",".$result['place'];




echo $r;

?>
