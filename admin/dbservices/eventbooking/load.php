
<?php
$connect = new PDO('mysql:host=localhost;dbname=sms', 'root', '');

$data = array();

$query = "SELECT booking_id,fun_title,start_time,end_time FROM booking ORDER BY booking_id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["booking_id"],
  'title'   => $row["fun_title"],
  'start'   => $row["start_time"],
  'end'   => $row["end_time"]
 );
}

echo json_encode($data);
?>
