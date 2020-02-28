<?php session_start(); if(!isset( $_SESSION['MM_RECEPTION'])) { header("Location:login.php");
}?>

<nav class="navbar-top" role="navigation"> 
  
  <!-- begin BRAND HEADING -->
  <div class="navbar-header">
     <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse"> <i class="fa fa-bars"></i> Menu </button>
    <div class="navbar-brand"> <a href="index.php" style="color:#FFFFFF" > Doct Connect </a> </div>
  </div>
  <!-- end BRAND HEADING -->
  
  <div class="nav-top">
    <ul class="nav navbar-left">
      <li> <a class="active" href="index.php"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
      <li> <a class="active" href="allpatients.php">All Patients</a> </li>
      <li> <a href="allbooking.php">Show Booking </a> </li>
      <li> <a class="active" href="showadmitp1.php"> IPD Patients</a> </li>
      <li> <a class="active" href="billpatient.php">OPD Billing</a> </li>
      <li> <a class="active" href="discharge_history.php"> IPD Billing</a> </li>
      <li> <a href="logout.php"> Logout </a> </li>
    </ul>
  </div>
</nav>
