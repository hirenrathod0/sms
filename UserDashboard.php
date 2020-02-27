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
            <h1 class="m-0 text-dark">Dashboard v2</h1>
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
        <div><h2>Your vehicles </h2></div>
        <div id="vehicles"></div>

        <div><h2>family members </h2></div>
        <div id="memberdetails"></div>

        <div><h2>Your registered events </h2></div>
        <div id="ownevents"></div>

        <div><h2>Bills </h2></div>
        <div id="billcount"></div>

        <div><h2>Complaint Status </h2></div>
        <div id="compstatus"></div>

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


