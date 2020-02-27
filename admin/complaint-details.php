<?php include('header.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Complaint Details</h1>
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
            popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
          }

        </script>
        

        <div class="module">
                <div class="module-head">
                  <h3>Complaint Details</h3>
                </div>
                <div class="module-body table">
                  <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                    
                    <tbody>

                      <?php $st='closed';
                      $query=mysqli_query($con,"select tblcomplaints.*,users.fullName as name,category.categoryName as catname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category where tblcomplaints.complaintNumber='".$_GET['cid']."'");
                      while($row=mysqli_fetch_array($query))
                      {

                        ?>                  
                        <tr>
                          <td><b>Complaint Number</b></td>
                          <td><?php echo htmlentities($row['complaintNumber']);?></td>
                          <td><b>Complainant Name</b></td>
                          <td> <?php echo htmlentities($row['name']);?></td>
                          <td><b>Reg Date</b></td>
                          <td><?php echo htmlentities($row['regDate']);?>
                        </td>
                      </tr>

                      <tr>
                        <td><b>Category </b></td>
                        <td><?php echo htmlentities($row['catname']);?></td>
                     
                        <td><b>Complaint Title</b></td>
                        <td colspan="3"><?php echo htmlentities($row['complaintTitle']);?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Complaint Details </b></td>
                      
                      <td colspan="5"> <?php echo htmlentities($row['complaintDetails']);?></td>
                      
                    </tr>

                  </tr>

                    <tr>
                      <td><b>Final Status</b></td>
                      
                      <td colspan="5"><?php if($row['status']=="")
                      { echo "Not Process Yet";
                    } else {
                      echo htmlentities($row['status']);
                    }?></td>
                    
                  </tr>

                  <?php $ret=mysqli_query($con,"select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='".$_GET['cid']."'");
                  while($rw=mysqli_fetch_array($ret))
                  {
                    ?>
                    <tr>
                      <td><b>Remark</b></td>
                      <td colspan="5"><?php echo  htmlentities($rw['remark']); ?> <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remark Date :</b><?php echo  htmlentities($rw['rdate']); ?></td>
                    </tr>

                    <tr>
                      <td><b>Status</b></td>
                      <td colspan="5"><?php echo  htmlentities($rw['sstatus']); ?></td>
                    </tr>
                  <?php }?>


                  <tr>
                    <td><b>Action</b></td>
                    
                    <td colspan="5"> 
                      <?php if($row['status']=="closed"){

                      } else {?>
                        <a href="javascript:void(0);" onClick="popUpWindow('updatecomplaint.php?cid=<?php echo htmlentities($row['complaintNumber']);?>');" title="Update order">
                          <button type="button" class="btn btn-primary">Take Action</button></td>
                        </a><?php } ?></td>

                            
                          </tr>
                        <?php  } ?>
                        
                      </table>
                    </div>
                  </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

        <script>
          $(document).ready(function() {
            $('.datatable-1').dataTable();
            $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
          } );
        </script>
<?php include('footer.php') ?>

