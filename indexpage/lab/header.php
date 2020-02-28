<?php session_start(); if(!isset( $_SESSION['MM_LAB'])) { header("Location:login.php");  }?>

<nav class="navbar-top" role="navigation"> 
  
  <!-- begin BRAND HEADING -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse"> <i class="fa fa-bars"></i> Menu </button>
    <div class="navbar-brand"> <a href="index.php" style="color:#FFFFFF" > Doct Connect </a> </div>
  </div>
  <!-- end BRAND HEADING -->
  
  <div class="nav-top">
  
    <div class="navbar-brand"> <a href="index.php" style="color:#FFFFFF;font-size:14px;" >Dashboard </a> </div>
  </div>
 
   
      <div class="navbar-brand"> <a href="category.php" style="color:#FFFFFF;font-size:14px;" > Manage Category</a> </div>
    </div>
    
      <div class="navbar-brand"> <a href="sel-lab-cat.php" style="color:#FFFFFF;font-size:14px;" > Lab Report</a> </div>
    </div>
    
      <div class="navbar-brand"> <a href="running_queue.php" style="color:#FFFFFF;font-size:14px;" >Patient History</a> </div>

      
       <div class="navbar-brand" style="padding-left:45%;"> <a href="logout.php" style="color:#FFFFFF;font-size:14px;"><i  class="fa fa-power-off"></i></a> </div>
      
      
    </div>
  </div>
  <!-- /.nav-top --> 
</nav>
