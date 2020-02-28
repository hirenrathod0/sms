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
            <a href="add_notice.php" >
              <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">  
                <span class="info-box-text">Notices</span>
                <span class="info-box-number">
                  Current Notice
                </span>
              </div>
              <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </a>
          </div>
          <!-- /.col -->
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="BookedEventDetails.php" >
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Upcoming Events</span>
                <span class="info-box-number">Club, Hall</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <a href="add_flat.php"> 
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Add New Members</span>
                <span class="info-box-number">+1</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>
          <!-- /.col -->


          <div class="col-12 col-sm-6 col-md-3">
          <a href="user_details.php"> 
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">All Members</span>
                <span class="info-box-number">current members</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->




        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a href="maintenance.php" >
              <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">  
                <span class="info-box-text">Maintainence</span>
                <span class="info-box-number">
                    New Maintainance
                </span>
              </div>
              <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </a>
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <a href="visitor_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Past Guests</span>
                <span class="info-box-number" id="guests"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>
          <!-- /.col -->

          
          <div class="col-12 col-sm-6 col-md-3">
          <a href="flat_allot_tbl.php" >
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Allocated Flats</span>
                <span class="info-box-number" id="allocatedflats"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3">
          <a href="flat_allot_tbl.php" >
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Empty Flats</span>
                <span class="info-box-number" id="emptyflats"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="maintenance_bill_history.php" >
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Due Payments</span>
                <span class="info-box-number" id="">
                  <?php 
                  $sql=mysqli_query($con,"SELECT COUNT(*) COUNT from maintenance_bill where ispaid = 0");
                  while($row=mysqli_fetch_array($sql))
                  {
                    $cmpn=$row['COUNT'];
                  }
                  echo $cmpn;
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
       </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-3">
          <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Current Users</span>
                <span class="info-box-number" id="currentusers"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon" ><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Current Tenants</span>
                <span class="info-box-number" id="tenants"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
            <!-- /.info-box -->
            <div class="col-md-3">
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">On Going Complaints</span>
                <span class="info-box-number" id="acomp"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </div>
            <!-- /.info-box -->
            <div class="col-md-3">
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Not Processed complaints</span>
                <span class="info-box-number" id="nacomp"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
        </div>
      </div>
    </section>
  </div>

<?php
include('footer.php');
?>

<script>

$(function() {
  var myobj1 = {
    need: 'users'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj1,
     success: function(data)
     {
       //alert(data);
       document.getElementById('currentusers').innerHTML = data;
     }
   })


   var myobj2 = {
    need: 'tenants'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj2,
     success: function(data)
     {
       //alert(data);
       document.getElementById('tenants').innerHTML = data;
     }
   })



   var myobj3 = {
    need: 'activecomplaints'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj3,
     success: function(data)
     {
       //alert(data);
       document.getElementById('acomp').innerHTML = data;
     }
   })




   var myobj4 = {
    need: 'nonactivecomplaints'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj4,
     success: function(data)
     {
       //alert(data);
       document.getElementById('nacomp').innerHTML = data;
     }
   })

   var myobj5 = {
    need: 'currcomp'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj5,
     success: function(data)
     {
       //alert(data);
       document.getElementById('currcomp').innerHTML = data;
     }
   })

   var myobj6 = {
    need: 'guests'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj6,
     success: function(data)
     {
       //alert(data);
       document.getElementById('guests').innerHTML = data;
     }
   })

   var myobj7 = {
    need: 'emptyflats'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj7,
     success: function(data)
     {
       //alert(data);
       document.getElementById('emptyflats').innerHTML = data;
     }
   })

   var myobj8 = {
    need: 'allocatedflats'
  }
   $.ajax({
     type: "POST",
     url: 'dbservices/fetchadmindashboard.php',
     data: myobj8,
     success: function(data)
     {
       //alert(data);
       document.getElementById('allocatedflats').innerHTML = data;
     }
   })

});

</script>


