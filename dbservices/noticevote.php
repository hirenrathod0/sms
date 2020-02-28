<?php include '../config.php' ;

if($_POST['need'] == 'voting')
{
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
}

if($_POST['need']  == 'votingstatus')
{

  $query = "SELECT COUNT(mid) yes, COUNT(mid) total from notice_votes where nid=:nid and ans like 'y'";
  $statement = $dbh->prepare($query);
  $statement->execute(
    array(
     ':nid'  => $_POST['nid']
     )
  );

  $result = $statement->fetch();
  $str = $result['yes'].",".$result['total'];
  

  echo $str;
  



}


?>