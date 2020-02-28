<?php 
if (!isset($_SESSION)) 
{
	session_start();
}
 if(!isset( $_SESSION['MM_DOCTOR'])) { header("Location:login.php");  }?>

<nav class="navbar-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse"> <i class="fa fa-bars"></i> Menu </button>
    <div class="navbar-brand"> <a href="index.php" style="color:#FFFFFF" ><b> Doct Connect </b></a> </div>
  </div>
  <div class="nav-top">
    <ul class="nav navbar-left" style="padding-right:20px;;">
      <li class="tooltip-sidebar-toggle"> <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right" title="Sidebar Toggle"> <i class="fa fa-bars"></i> </a> </li>
    </ul>
    <div class="navbar-header">
      <div class="navbar-brand"> <a href="index.php" style="color:#FFFFFF;font-size:14px;" class="active" >Dashboard </a> </div>
    </div>
     
    <div class="navbar-header">
      <div class="navbar-brand"> <a href="allpatients.php" style="color:#FFFFFF;font-size:14px;"> Patient History </a> </div>
    </div>
    
    
     <div class="navbar-header">
      <div class="navbar-brand"> <a href="view_medpatients.php" style="color:#FFFFFF;font-size:14px;">  IPD Patient</a> </div>
    </div>
    
    
    <!--<div class="navbar-header">
      <div class="navbar-brand"> <a href="xray_dw.php" style="color:#FFFFFF;font-size:14px;" style="alignment-adjust:middle;font-size:14px;"> X-Ray Reports </a> </div>
    </div>-->
    <div class="navbar-header">
      <div class="navbar-brand"> <a href="lab_dw.php" style="color:#FFFFFF;font-size:14px;" > Lab Reports </a> </div>
    </div>
    
    
   
   <div class="navbar-header">
      <div class="navbar-brand"> <a href="discharge_history.php" style="color:#FFFFFF;font-size:14px;" > Discharge Patients </a> </div>
    </div>
    <div class="navbar-header">
      <div class="navbar-brand"> <a href="death_pat.php" style="color:#FFFFFF;font-size:14px;" > Death Patients</a> </div>
    </div>
   
   
   
    <div class="navbar-header">
      <div class="navbar-brand"> <a href="logout.php" style="color:#FFFFFF;font-size:14px;"> Logout </a> </div>
    </div>
  </div>
  </div>
  </div>
</nav>
