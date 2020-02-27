<?php include('header.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vehical List</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
         <table class="table display" id="vehicaltbl" width="100%">
      <thead>
        <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
        <tr><th>User Name</th><th>Vehical No.</th><th>Vehical Type</th></tr>
      </thead>
      <tbody>
        <?php 
        $query1="select fullName,id,number,v.type,uid from vehicle_detail v,users where uid=id ORDER BY uid DESC ";
        $result=mysqli_query($con,$query1);

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($rows=$result->fetch_assoc())
        {
          ?>
          <tr>
            <!-- <?php  //$id=$rows['catid']; ?> -->
            <td><?php echo $rows['fullName']; ?></td>           
            <td><?php echo $rows['number']; ?></td>            
            <td><?php echo ($rows['type']." Wheeler"); ?></td>                        
            <!-- <td><a href="add_catspec.php?edit_cat=<?php //echo $rows['catid']; ?>" class="btn btn-info btn_space" >Edit</a><a href="add_catspec.php?delete_cat=<?php //echo $rows['catid']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td> -->
          </tr> 
          <?php 
        }
        ?>
      </tbody>
    </table>    
      
        
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php') ?>
<script type="text/javascript">
  $(document).ready( function () {
    $('#vehicaltbl').DataTable({              
        
      buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
      dom: 'lBfrtip',
      "lengthChange": true
    });
  });
</script>