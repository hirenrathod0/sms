<?php include('config.php');

if(isset($_POST['insert_user_buffer']))
{
  // echo ($_POST['fullName'].$_POST['userEmail'].$_POST['password'].$_POST['contactNo'].$_POST['type'].$_POST['gender'].$_POST['dob'].$_POST['flat']);
  $query="INSERT into user_buffer(fullName,userEmail,password,contactNo,type,gender,dob,fid) VALUES('".$_POST["fullName"]."', '".$_POST["userEmail"]."', '".$_POST["password"]."', '".$_POST["contactNo"]."', '".$_POST["type"]."', '".$_POST["gender"]."', '".$_POST["dob"]."', '".$_POST["flat"]."')";
  $row=mysqli_query($con,$query);
  
  //$dummy=mysqli_insert_id($con);

  //echo "$dummy";

 // $query1="UPDATE flat SET uid = '".$dummy."' WHERE fid = '".$_POST["flat"]."'";
  //$row1=mysqli_query($con,$query1);
  // echo "$row";
  if(isset($row) )
  {   
    echo "<script>alert('Request is Send to Admin'); </script>";   
    //header('location:user_reg.php');  
  }else{
    die('Could not Insert: '. mysql_error());   
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box" style="    width: 55%;">
  <div class="register-logo">
    <a href="#"><b>Signup</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      
      <form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Full Name:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="email" placeholder="Enter Full Name" name="fullName">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Enter Email:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="email" placeholder="Enter email" name="userEmail">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Enter Password:</label>
        <div class="col-sm-7">
          <input type="password" class="form-control" id="email" placeholder="Enter Password" name="password">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Enter Contact No:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="email" placeholder="Enter Contact no" name="contactNo">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3" for="email">User  Type:</label>
        <div class="col-sm-7">
          <select class="form-control" id="sel1" name="type">
            <option>Select Option</option>
            <option value="admin">Admin</option>            
            <option value="user">User</option>            
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3" for="email">Gender:</label>
        <div class="col-sm-7">
          <select class="form-control" id="sel1" name="gender">
            <option>Select Option</option>
            <option value="Male">Male</option>            
            <option value="Female">Female</option>            
          </select>
        </div>
      </div>  
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">birth date:</label>
        <div class="col-sm-7">
          <input type="date" class="form-control" id="email" placeholder="Enter birth date" name="dob">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Select Flat:</label>
        <div class="col-sm-7">
          <select class="form-control" id="sel1" name="flat">
            <option>Select Option</option>
            <?php
              $result=mysqli_query($con,"select fid,block,flat_num from flat where uid IS NULL");           
              // $row=$result->fetch_assoc(); 
              while($row=mysqli_fetch_assoc($result)):;   ?>
                <option value="<?php printf("%s",$row['fid']);  ?>"><?php printf("%s",($row["block"]." - ".$row["flat_num"])); ?></option>
              <?php endwhile;?>
          </select>
        </div>
      </div>  
      
      <div class="form-group row">        
        <div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
         
                     <?php //$sql=mysqli_query($con,"select id from users order by id desc limit 1"); --> -->
  //while($row1=mysqli_fetch_array($sql)){?>
                    <!-- <a href="addmember.php?uid=<?php// echo $row1['id'];?>" class="btn btn-primary"  >submit</a> -->
                    <?php 
      //  }
        ?><button type="submit" class="btn btn-primary" name="insert_user_buffer">Submit</button> 
        <button type="reset" class="btn btn-primary">Reset</button>
        </div>        

      </div>
       <p class="mb-1">
        <a href="login.php">Login</a>
      </p>
    </form>


    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
