<?php include('header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" >Notice Board</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid" style="padding-left: 5%; padding-right: 10%;">

      <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-bullhorn"></i>
              Notice
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
  
</div>
  </section>
</div>

        <!-- <div>
          <table class="table display" id="noticetable" width="100%" >
            <thead>
              <tr style="text-align: center;"><th ><h4>Title</h4></th><th colspan="1"><h4>Date</h4></th></tr>

            </thead>
            <tbody>
              <?php 
           //   $query1="select * from notice order by nid desc";
            //  $result=mysqli_query($con,$query1);

              //if($result === FALSE) { 
            //die(mysql_error()); // TODO: better error handling
          //}
         // while($rows=$result->fetch_assoc())
          //{
            //?>
            <tr style="text-align: center;">
              <?php  //$id=$rows['catid']; ?>
              <td><a data-toggle="modal" href="#modal<?php //echo $rows['nid']; ?>" ><?php// echo $rows['title']; ?></a></td>
              <td><?php //echo $rows['date']; ?></td>                       
            </tr>  -->

           <!--  <div class="modal fade" id="modal<?php// echo $rows['nid']; ?>" >
              <div class="modal-dialog" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><?php //echo $rows['title']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p><?php //echo $rows['descr']; ?></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
             
              </div>
             
             </div> -->

        <!-- </tbody>
   

      </div>
      /.modal -->
      <!-- /.container-fluid -->
  
    <!-- /.content -->

    <!-- /.content-wrapper -->

 <?php include('footer.php'); ?>