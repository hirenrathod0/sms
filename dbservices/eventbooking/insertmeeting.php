<?php

//insert.php



$connect = new PDO('mysql:host=localhost;dbname=sms', 'root', '');

if(isset($_POST["title"]))
{
 //$str="1";
    $query = "
 INSERT INTO meeting_detail
        ( title, details, place, stime, etime,date,presentstatus)
 VALUES ( :fun_title, :fun_details, :place, :start_time, :end_time,:date_of_booking,1)
 ";

 $statement = $connect->prepare($query);
 
//$str=$str."2";
 $result=$statement->execute(
  array(
   ':date_of_booking'  => $_POST['dayofbooking'],
   ':start_time'  => $_POST['starttime'],
   ':end_time'  => $_POST['endtime'],
   ':fun_details'  => $_POST['details'],
   ':fun_title'  => $_POST['title'],
   ':place' => $_POST['place']
   )
 );
//$str=$str."3";
 echo $result;
}

?>