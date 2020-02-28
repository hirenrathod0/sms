<?php
$n=$_GET['cer'];
$h=$_GET['pid'];

if($n=="FITNESS")
{
header("location:fitness.php?pid=$h");
}

if($n=="DEATH")
{
header("location:death.php?pid=$h");
}

if($n=="MEDICIAL")
{
header("location:medical.php?pid=$h");
}

if($n=="DISCHARGE CARD")
{
header("location:dcard.php?pid=$h");
}


?>