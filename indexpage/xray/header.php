<?php session_start(); if(!isset( $_SESSION['MM_xray'])) { header("Location:login.php");  }?>
<nav class="navbar-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse"> <i class="fa fa-bars"></i> Menu </button>
    <div class="navbar-brand"> <a href="index.html" style="color:#FFFFFF" > Doct Connect </a> </div>
  </div>
  <div class="nav-top">
    <ul class="nav navbar-left">
      <li> <a class="active" href="index.php"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
       <li> <a href="category.php"> Manage Category </a> </li>
      <li> <a href="all_xray.php"> History </a> </li>
      <li> <a href="logout.php"> Logout </a> </li>
    </ul>
  </div>
</nav>
