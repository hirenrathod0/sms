<?php

$connect = new PDO('mysql:host=localhost;dbname=society', 'root', '');

if(isset($_POST['message']))
{
    $mydate=getdate(date("U"));
    $msg_date = "$mydate[year]-$mydate[mon]-$mydate[mday]";
    echo $msg_date."<br>"  ;

    $query = "INSERT INTO notices ( msg_data,  msg_date, isread) VALUES (:msg_data, :msg_date, 'n' )";
    $statement = $connect->prepare($query);

    $result = $statement->execute(
     array(
      ':msg_data'  => $_POST['message'],
      ':msg_date'  => $msg_date
      )
    );
    echo $result;

}



?>
