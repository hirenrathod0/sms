<?php 
include('../config.php');
//$connect = new PDO('mysql:host=localhost;dbname=sms', 'root', '');
$str="";
$query = "";
if($_POST['need'] == 'vehicles')
{
    $query = "SELECT * from vehicle_detail where uid=:uid";


$statement = $dbh->prepare($query);

$statement->execute(
    array(
        ':uid' =>   $_POST['uid'] 
    )
);

$result = $statement->fetchAll();


foreach($result as $row)
{
    $str=$row['number'];
    // $str = $str.'<div class="col-md-3">
    // <div class="info-box mb-3 bg-danger">
    //   <div class="info-box-content">
    //     <span class="info-box-text">'.$row['number'].'</span>
    //   </div>
    // </div>';
}

echo $str;
}

if($_POST['need'] == 'members')
{
    $query = "SELECT * from member_detail where uid=:uid";


    $statement = $dbh->prepare($query);
    
    $statement->execute(
        array(
            ':uid' =>   $_POST['uid'] 
        )
    );
    
    $result = $statement->fetchAll();
    
    $str="<div class='row'>";
    foreach($result as $row)
    {
        $str=$row['name'];
        // $str = $str.'<div class="col-md-3">
        // <div class="info-box mb-3 bg-info">
        //   <div class="info-box-content">
        //     <span class="info-box-text">'.$row['name'].'</span>
        //   </div>
        // </div>
        // </div>';
    }
    $str=$str."</div>";
    echo $str;
    
}


if($_POST['need'] == 'billcount')
{
    $query = "SELECT fid from flat where uid=:uid";
    $statement = $dbh->prepare($query);
    $statement->execute(
        array(
            ':uid' =>   $_POST['uid'] 
        )
    );
    
    $result = $statement->fetch();
    $fid = $result[0];

    $query = "SELECT COUNT(bid) FROM maintenance_bill where fid=".$fid;

    $statement = $dbh->prepare($query);
    $statement->execute();
    
    $result = $statement->fetch();
    $count = $result[0];

    $str=$count;
    // $str="<div class='row'>";
    // $str = $str.'<div class="col-md-3">
    //     <div class="info-box mb-3 bg-info">
    //       <div class="info-box-content">
    //       <span class="info-box-text">Current Bills</span>
    //         <span class="info-box-text">'.$count.'</span>
    //       </div>
    //     </div>
    //     </div>';

    $str=$str."</div>";
    echo $str;
    
}


if($_POST['need'] == 'myevents')
{
    $query = "SELECT * from booking where mem_id=:uid";
    $statement = $dbh->prepare($query);
    $statement->execute(
        array(
            ':uid' =>   $_POST['uid'] 
        )
    );
    
    $result = $statement->fetchAll();
    $str="<div class='row'>";
    foreach($result as $row)
    {
        $str=$row['fun_title'];
        // $str = $str.'<div class="col-md-3">
        // <div class="info-box mb-3 bg-warning">
        //   <div class="info-box-content">
        //   <span class="info-box-text">Events</span>
        //     <span class="info-box-text">'.$row['fun_title'].'</span>
        //   </div>
        // </div>
        // </div>';
    }

    $str=$str."</div>";
    echo $str;
    
}



if($_POST['need'] == 'compstatus')
{
    $query = "SELECT COUNT(*) COUNT from tblcomplaints where userId=:uid";
    $statement = $dbh->prepare($query);
    $statement->execute(
        array(
            ':uid' =>   $_SESSION['uid'] 
        )
    );
    
    $result = $statement->fetchAll();
    $str="<div class='row'>";
    foreach($result as $row)
    {
        $str=$row['COUNT'];
        // $str = $str.'<div class="col-md-3">
        // <div class="info-box mb-3 bg-warning">
        //   <div class="info-box-content">
        //     <span class="info-box-text">'.$row['complaintTitle'].'</span>
        //   </div>
        // </div>
        // </div>';
    }

    $str=$str."</div>";
    echo $str;
    
}



?>
