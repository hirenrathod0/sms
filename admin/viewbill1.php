<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Maintenance bills</h1></CENTER>

    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                <th>flat no</th> <th>user name</th><th>contact no</th> <th>bill-date</th>  <th>total bill</th><th>due date</th> <th>view</th><th>mail</th></thead>
            <tbody>
                <?php 
                 $dog1=$_GET['uid'];

                 $query1="select flat.fid,block,flat_num,uid,fullName,contactNo,bill_date,water_charges,property_tax,elec_charges,parking_charges,other,flat_charges,due_date,bid from users,maintenance_bill,flat where id=maintenance_bill.fid and uid=id and uid='".$dog1."'";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($row=$result->fetch_assoc())
        {
            
                 ?>
                    <tr>
                        <!-- <?php  //$id=$rows['catid']; ?> -->
                        <td ><?php echo(($row["block"]." - ".$row["flat_num"])); ?></td>
                            <td ><?php //printf("%s",$row['fid']); 
                         echo(($row["fullName"])); ?>
                            </td>
                            <td ><?php //printf("%s",$row['fid']); 
                         echo(($row["contactNo"])); ?>
                            </td>
       
                                
                        
                         <td><?php echo($row['bill_date']);?></td>
                             <td><?php $total=$row['property_tax']+$row['water_charges']+$row['flat_charges']+$row['parking_charges']+$row['other']+$row['elec_charges'];
                              echo($total);?></td>
                                <td><?php echo($row['due_date']);?></td>
                            
                                <td><a href="bill_detail.php?bill_no=<?php echo $row['bid'];?>&total=<?php echo $total; ?>"  >Print</a></td> 
                        <td><a href="mailusingphp.php?bill_no=<?php echo $row['bid'];?>&total=<?php echo $total; ?>"> email</a></td>
                        <!-- <td><a href="add_catspec.php?edit_cat=<?php //echo $rows['catid']; ?>" class="btn btn-info btn_space" >Edit</a><a href="add_catspec.php?delete_cat=<?php //echo $rows['catid']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td> -->
                    </tr>   
                    <?php 
                }
                ?>
            </tbody>
        </table>    



	
				

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>