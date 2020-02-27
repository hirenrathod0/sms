<?php include('header.php');
if(isset($_POST['insert_vehical']))
{
  // echo("alert('$_POST['uid'].$_POST['number'].$_POST['type']');");
  $query="INSERT into vehicle_detail(uid,number,type) VALUES('".$_POST["uid"]."', '".$_POST["number"]."', '".$_POST["type"]."')";
  $row=mysqli_query($con,$query);
    

  //echo "$dummy";

  
  // echo "$row";
  if(isset($row))
  {     
    echo "<script> alert('Vehical is Added'); location.href='vehical_add.php';</script>";
    //header('location:user_reg.php');  
  }else{
    die('Could not Insert: '. mysql_error());   
  }
}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vehical Add</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">

        <form class="form-horizontal" name="vehical_add" method="post" style="padding-left:5%">
     <div class="form-group row">
        <label class="control-label col-sm-3" for="email">Select User Name:</label>
        <div class="col-sm-7">
          <select class="form-control" id="sel1" name="uid">
            <option>Select Option</option>
            <?php
              $result=mysqli_query($con,"select * from users ");           
              // $row=$result->fetch_assoc(); 
              while($row=mysqli_fetch_assoc($result)):;   ?>
                <option value="<?php echo($row['id']);  ?>"><?php echo($row["fullName"]); ?></option>
              <?php endwhile;?>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Enter Vehical No:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="email" placeholder="Enter Vehical No" name="number">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="control-label col-sm-3" for="">Vehical Type:</label>
        <div class="col-sm-7">
          <select class="form-control" id="sel1" name="type">
            <option>Select Option</option>
            <option value="2">2 wheel</option>            
            <option value="4">4 wheel</option>            
          </select>
        </div>
      </div>
      
        
      
      <div class="form-group row">        
        <div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
          <button type="submit" class="btn btn-primary " name="insert_vehical">Submit</button>
          <button type="reset" class="btn btn-primary">Reset</button>
        </div>        
      </div>
    </form>
        
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php'); ?>


