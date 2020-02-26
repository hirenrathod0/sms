<?php include 'header.php'; ?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="module">
                <div class="module-head">
                  <h3>Bill Details</h3>
                </div>
                <div class="module-body table">
                  <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                    
                    <tbody>

                      <?php $total=$_GET['total'];
                      $query=mysqli_query($con,"select fullName,contactNo,bill_date,water_charges,property_tax,elec_charges,parking_charges,other,flat_charges,due_date,bid,fid from users,maintenance_bill where bid='".$_GET['bill_no']."' and id=fid");
                      while($row=mysqli_fetch_array($query))
                      {

                        ?>  
                        <tr>
                      	<td colspan="4"> <center><h3>User Details</h3></center></td>
                      </tr>                
                        <tr>
                          <td><b> Number</b></td>
                          <td><?php echo htmlentities($row['fullName']);?></td>
                          <td><b>Contact no</b></td>
                          <td> <?php echo htmlentities($row['contactNo']);?></td>                          
                        </td>
                      </tr>
                      <tr>
                          <td><b>Bill Date</b></td>
                          <td><?php echo htmlentities($row['bill_date']);?></td>
                          <td><b>Due Date</b></td>
                          <td> <?php echo htmlentities($row['due_date']);?></td>                          
                        </td>
                      </tr>
                      <tr>
                      	<td colspan="4"> <center><h3>Charges</h3></center></td>
                      </tr>
                      <tr>
                          <td><b>Water Charge</b></td>
                          <td><?php echo htmlentities($row['water_charges']);?></td>
                          <td><b>Property Tax</b></td>
                          <td> <?php echo htmlentities($row['property_tax']);?></td>                          
                        </td>
                      </tr>
                      <tr>
                          <td><b>Eletric Charge</b></td>
                          <td><?php echo htmlentities($row['elec_charges']);?></td>
                          <td><b>Parking Charge</b></td>
                          <td> <?php echo htmlentities($row['parking_charges']);?></td>                          
                        </td>
                      </tr>
                      <tr>
                          <td><b>Other Charge</b></td>
                          <td><?php echo htmlentities($row['other']);?></td>
                          <td><b>Flat Charge</b></td>
                          <td> <?php echo htmlentities($row['flat_charges']);?></td>                          
                        </td>
                      </tr>
                      <tr>
                          <td colspan="2"><b>Total Charges</b></td>
                          <td colspan="2"><b><u><?php echo ($total);?></u></b></td>
                          
                        </td>
                      </tr>
                     
                      
                      
                    </tr>

                  </tr>
                    

                 <!--  <?php //$ret=mysqli_query($con,"select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='".$_GET['cid']."'");
//                  while($rw=mysqli_fetch_array($ret))
                  {
                    ?>
                    <tr>
                      <td><b>Remark</b></td>
                      <td colspan="5"><?php// echo  htmlentities($rw['remark']); ?> <b>Remark Date :</b><?php //echo  htmlentities($rw['rdate']); ?></td>
                    </tr>

                    <tr>
                      <td><b>Status</b></td>
                      <td colspan="5"><?php// echo  htmlentities($rw['sstatus']); ?></td>
                    </tr>
                  <?php }?> -->





                  <tr >
                    <td colspan="2"><b>Action</b></td>
                    
                    <td  colspan="2"> 
                      
                          <button type="button" class="btn btn-primary">Print</button></td>
                        </a><?php } ?></td>
                           
                          </tr>
                        
                        
                      </table>
                    </div>
                  </div>
                   </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php include 'footer.php'; ?>