<?php 
include('../config.php');


    // echo "<script> alert('".$_SESSION['type']."'); </script>";

if(isset($_SESSION['type']) && $_SESSION['type']=="admin")  
{

}
else{

   header('location:../login.php');
  
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../plugins/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Datatable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-bootstrap/main.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
 
    </ul>



    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="Admindashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SMS</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin / Member</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Event Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="complaint_admin.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Complaint Admin</p>
                </a>
              </li>
             
            </ul>
          </li> -->
           <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Event Menu
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="EventBooker.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Add Event Booking</p>
                </a>
              </li>
               <li class="nav-item">
            <a href="BookedEventDetails.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Upcoming Events
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="event_book_tbl.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Event Booking Table
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>           
            </ul>
          </li>
         <!--  <li class="nav-item">
            <a href="maintenance.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Maintenance
                <span class="right badge badge-danger">New</span> 
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="EventBooker.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Add Event Booking
                <span class="right badge badge-danger">New</span> 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="BookedEventDetails.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Upcoming Events
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="event_book_tbl.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Event Booking Table
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="flat_allot_tbl.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Flat Allotment Table
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>-->
           <li class="nav-item">
            <a href="user_reg.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                User Reg
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Vehical Menu
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
            <a href="vehical_add.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Add Vehical
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="vehical_list.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Vehical List
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>           
            </ul>
          </li>

          
          <!-- <li class="nav-item">
            <a href="add_flat.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Add New Flat
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->

         

          <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Flat
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_flat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Flat </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addflat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Flat 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="flat_allot_tbl.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flat Allotment List</p>
                </a>
              </li>            
              <li class="nav-item">
                <a href="flatdesc.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flat Deallotment List</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                form example
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Maintainance Menu
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="maintenance_bill_history.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maintanainace History </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="maintenance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Maintainance</p>
                </a>
              </li>            
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Complaint Admin
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_notice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Notice to All User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_cate.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="not_pro.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Not Processsed</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="pend_comp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Comp</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="closed_comp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Closed Comp</p>
                </a>
              </li>             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Complaint User
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cmp_reg.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Complaint</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cmp_history.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Complaint History</p>
                </a>
              </li>            
            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="complaint.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Visitor Menu
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="visitor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Visitor </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="visitor_tbl.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Visitor History</p>
                </a>
              </li>            
            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Logout
                <i class="fas fa-angle-left right"></i>
 
              </p>
            </a>
          </li>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>