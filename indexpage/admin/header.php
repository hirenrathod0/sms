<?php session_start(); if(!isset( $_SESSION['MM_Username'])) { header("Location:login.php");  }?>

<nav class="navbar-top" role="navigation"> 
  
  <!-- begin BRAND HEADING -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse"> <i class="fa fa-bars"></i> Menu </button>
    <div class="navbar-brand"> <a href="index.php" style="color:#FFFFFF" > Doct Connect </a> </div>
  </div>

  <div class="nav-top"> 
   
    <ul class="nav navbar-left">
      <li> <a class="active" href="index.php"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
      <!-- end DASHBOARD LINK --> 
      <!-- begin CHARTS DROPDOWN -->
      
     
      <li> <a class="active" href="usercat.php"> Employees Category</a> </li>
      <li> <a href="userlist.php">All Employees </a> </li>
      <li> <a class="active" href="visit_doctor.php"> Visit Doctor</a> </li>
      <li> <a class="active" href="login_rep.php"> Login History</a> </li>
      <li> <a href="logout.php"> Logout </a> </li>
    </ul>
    
    
  </div>
</nav>
