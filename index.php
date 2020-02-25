<?php include('header.php') ?>

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
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">

        <div>
          <table class="table display" id="noticetable" width="100%">
        <thead>
          <tr style="text-align: center;"><th colspan="1"><h2>Notice Board</h2></th></tr>
          
        </thead>
        <tbody>
          <?php 
          $query1="select * from notice";
          $result=mysqli_query($con,$query1);

          if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($rows=$result->fetch_assoc())
        {
          ?>
          <tr>
            <!-- <?php  //$id=$rows['catid']; ?> -->            
            <td><a href="add_product.php?edit_product=<?php echo $rows['nid']; ?>" ><?php echo $rows['title']; ?></a></td>
            <td><?php echo $rows['date']; ?></td>                       
          </tr> 
          <?php 
        }
        ?>
      </tbody>
    </table>
        </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php') ?>

