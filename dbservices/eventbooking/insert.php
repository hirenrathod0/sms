<?php

//insert.php



$connect = new PDO('mysql:host=localhost;dbname=sms', 'root', '');

if(isset($_POST["title"]))
{
 
    $query = "
 INSERT INTO booking 
        ( fun_title, fun_details, place, start_time, end_time, mem_id, date_of_booking)
 VALUES ( :fun_title, :fun_details, :place, :start_time, :end_time, :mem_id, :date_of_booking)
 ";

 $statement = $connect->prepare($query);

 $result=$statement->execute(
  array(
   ':mem_id'  => $_POST['memid'],
   ':date_of_booking'  => $_POST['dayofbooking'],
   ':start_time'  => $_POST['starttime'],
   ':end_time'  => $_POST['endtime'],
   ':fun_details'  => $_POST['details'],
   ':fun_title'  => $_POST['title'],
   ':place' => $_POST['place']
   )
 );

 echo $result;
}

?>