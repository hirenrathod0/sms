<?php include '../config.php' ;

$query = "INSERT INTO notice_votes VALUES(:nid, :usrid, :ans) ";

$statement = $dbh->prepare($query);
$result=$statement->execute(
  array(
   ':nid'  => $_POST['nid'],
   ':usrid'  => $_POST['usrid'],
   ':ans'  => $_POST['ans']
   )
);

 echo $result;

?>