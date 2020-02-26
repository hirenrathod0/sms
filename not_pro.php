<?php include('header.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Closed Complaints</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">

        
        <script language="javascript" type="text/javascript">
  var popUpWin=0;
  function popUpWindow(URLStr, left, top, width, height)
  {
    if(popUpWin)
    {
      if(!popUpWin.closed) popUpWin.close();
    }
    popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+500+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
  }

</script>

<div class="wrapper">
  <div class="container">
    <div class="row">

      <div class="span9">
        <div class="content">

          <div class="module">
            <div class="module-head">
            </div>
            <div class="module-body table">


              
              <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" >
                <thead>
                  <tr>
                    <th>Complaint No</th>
                    <th> complainant Name</th>
                    <th>Reg Date</th>
                    <th>Status</th>
                    
                    <th>Action</th>
                    
                    
                  </tr>
                </thead>
                
                <tbody>
                  <?php 
                  $query=mysqli_query($con,"select tblcomplaints.*,users.fullName as name from tblcomplaints join users on users.id=tblcomplaints.userId where tblcomplaints.status is null ");
                  while($row=mysqli_fetch_array($query))
                  {
                    ?>                    
                    <tr>
                      <td><?php echo htmlentities($row['complaintNumber']);?></td>
                      <td><?php echo htmlentities($row['name']);?></td>
                      <td><?php echo htmlentities($row['regDate']);?></td>
                      
                      <td><button type="button" class="btn btn-danger">Not process yet</button></td>
                      
                      <td>   <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>"> View Details</a> 
                      </td>
                    </tr>

                  <?php  } ?>
                </tbody>
              </table>
            </div>
          </div>            

          
          
        </div><!--/.content-->
      </div><!--/.span9-->
    </div>
  </div><!--/.container-->
</div><!--/.wrapper-->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php') ?>

