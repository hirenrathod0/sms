<?php
$connect = mysqli_connect("localhost", "root", "", "abc");
if(isset($_POST["sr"], $_POST["department"],$_POST["projectdefinationrank1"],$_POST["studentname1"],$_POST["erno1"],$_POST["projectdefinationrank2"],$_POST["studentname2"],$_POST["erno2"],$_POST["projectdefinationrank3"],$_POST["studentname3"],$_POST["erno3"],$_POST["year"]))
{
 $sr = mysqli_real_escape_string($connect, $_POST["sr"]);
 $department = mysqli_real_escape_string($connect, $_POST["department"]);
 $projectdefinationrank1 = mysqli_real_escape_string($connect, $_POST["projectdefinationrank1"]);
 $studentname1 = mysqli_real_escape_string($connect, $_POST["studentname1"]);
 $erno1 = mysqli_real_escape_string($connect, $_POST["erno1"]);
 $projectdefinationrank2 = mysqli_real_escape_string($connect, $_POST["projectdefinationrank2"]);
 $studentname2 = mysqli_real_escape_string($connect, $_POST["studentname2"]);
 $erno2 = mysqli_real_escape_string($connect, $_POST["erno2"]);
 $projectdefinationrank3 = mysqli_real_escape_string($connect, $_POST["projectdefinationrank3"]);
 $studentname3 = mysqli_real_escape_string($connect, $_POST["studentname3"]);
 $erno3= mysqli_real_escape_string($connect, $_POST["erno3"]);
 $year= mysqli_real_escape_string($connect, $_POST["year"]);
 
 
 $query = "INSERT INTO projectreport(sr, department,projectdefinationrank1,studentname1,erno1,projectdefinationrank2,studentname2,erno2,projectdefinationrank3,studentname3,erno3,year) VALUES('$sr', '$department','$projectdefinationrank1','$studentname1','$erno1','$projectdefinationrank2','$studentname2','$erno2','$projectdefinationrank3','$studentname3','$erno3','$year')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
