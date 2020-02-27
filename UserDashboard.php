<?php
include('header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="visitor_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-car-side"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Your vehicles </span>
                <span class="info-box-number" id="vehicles"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
          <a href="visitor_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas  fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">family members  </span>
                <span class="info-box-number" id="memberdetails"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>

      <div class="col-12 col-sm-6 col-md-3">
          <a href="visitor_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning  elevation-1"><i class="fas fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Your registered events  </span>
                <span class="info-box-number" id="ownevents"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div> 
          
          <div class="col-12 col-sm-6 col-md-3">
          <a href="visitor_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-receipt "></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bills</span>
                <span class="info-box-number" id="billcount"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="visitor_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Complaint Status  </span>
                <span class="info-box-number" id="compstatus"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>    
          </div>     

           <section class="content-header">
      <div class="container-fluid">
          <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-bullhorn"></i>
              Notice Board
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <?php 
              $query1="select * from notice order by nid desc";
              $result=mysqli_query($con,$query1);
              // print_r($result);l
              if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
          }
          while($rows=$result->fetch_assoc())
          {
            ?>
            <div class="callout callout-info">
            
            <h5><?php echo ($rows['title']); ?></h5>

            <p><?php echo ($rows['descr']); ?></p>
            <p><?php echo ($rows['date']); ?></p>
          </div>
        <?php } ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
        
        

      </div><!-- /.container-fluid -->
    </section>
        <!-- <div><h2></h2></div>
        <div id="vehicles"></div> -->

        <!-- <div><h2>family members </h2></div>
        <div id="memberdetails"></div> -->

       <!--  <div><h2>Your registered events </h2></div>
        <div id="ownevents"></div>

        <div><h2>Bills </h2></div>
        <div id="billcount"></div>

        <div><h2>Complaint Status </h2></div>
        <div id="compstatus"></div> -->



      </div>
    </section>
  </div>


<?php
include('footer.php');
?>

<script>
  <?php
  
      echo "var id=".$_SESSION['uid'].";var name='".$_SESSION['fullName']."';";

  ?>

   
$(function() {
  
  var myobj1 = {
     uid: id,
     uname: name,
     need: 'vehicles'
   }

   $.ajax({
     type: "POST",
     url: 'dbservices/fetchuserdashboard.php',
     data: myobj1,
     success: function(data)
     {
       document.getElementById('vehicles').innerHTML = data;
     }
   })


   var myobj2 = {
     uid: id,
     uname: name,
     need: 'members'
   }

   $.ajax({
     type: "POST",
     url: 'dbservices/fetchuserdashboard.php',
     data: myobj2,
     success: function(data)
     {
       document.getElementById('memberdetails').innerHTML = data;
     }
   })

   var myobj3 = {
     uid: id,
     uname: name,
     need: 'billcount'
   }

   $.ajax({
     type: "POST",
     url: 'dbservices/fetchuserdashboard.php',
     data: myobj3,
     success: function(data)
     {
       document.getElementById('billcount').innerHTML = data;
     }
   })

   var myobj4 = {
     uid: id,
     uname: name,
     need: 'myevents'
   }

   $.ajax({
     type: "POST",
     url: 'dbservices/fetchuserdashboard.php',
     data: myobj4,
     success: function(data)
     {
       document.getElementById('ownevents').innerHTML = data;
     }
   })

   var myobj5 = {
     uid: id,
     uname: name,
     need: 'compstatus'
   }

   $.ajax({
     type: "POST",
     url: 'dbservices/fetchuserdashboard.php',
     data: myobj5,
     success: function(data)
     {
       document.getElementById('compstatus').innerHTML = data;
     }
   })





});
</script>


