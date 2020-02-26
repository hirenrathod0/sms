<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Maintenance bills</h1></CENTER>
		<table border="2" id="example1" align="center" width="50%" >
		<tr>
			<th>flat no</th>
            <th>user name</th>
            <th>contact no</th>
            <th>bill-date</th>
            <th>total bill</th>
            <th>due date</th>
            <th>view</th>
        </tr>
                        
						<?php
							$result=mysqli_query($con,"select fid,block,flat_num,uid,fullName,contactNo from flat,users where uid IS NOT NULL and uid=id
");	
                            $result1=mysqli_query($con,"select fullName,contactNo,bill_date,water_charges,property_tax,elec_charges,parking_charges,other,flat_charges,due_date,bid from users,maintenance_bill where id=fid");  					
							// $row=$result->fetch_assoc();	
                            $dummy = mysqli_num_rows($result1); 
							while($row=mysqli_fetch_assoc($result)):; 
                                // print_r($row); 
                            	?>
                            <tr>
                        <td rowspan="<?php echo($dummy);  ?>"><?php //printf("%s",$row['fid']); 
                         printf("%s",($row["block"]." - ".$row["flat_num"])); ?>
                            </td>
                            <td rowspan="<?php echo($dummy);  ?>"><?php //printf("%s",$row['fid']); 
                         printf("%s",($row["fullName"])); ?>
                            </td>
                            <td rowspan="<?php echo($dummy);  ?>"><?php //printf("%s",$row['fid']); 
                         printf("%s",($row["contactNo"])); ?>
                            </td>
                                <?php
												
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result1)):; 	?>
                                
                        <!-- <td rowspan="<?php //echo($dummy);   printf("%s",$row['fullName']);?></td> -->
                                <!-- <td ><?php// printf("%s",$row['contactNo']);?></td> -->
                         <td><?php printf("%s",$row['bill_date']);?></td>
                             <td><?php $total=$row['property_tax']+$row['water_charges']+$row['flat_charges']+$row['parking_charges']+$row['other']+$row['elec_charges'];
                              echo($total);?></td>
                                <td><?php printf("%s",$row['due_date']);?></td>
                            
                                <td><a href="bill_detail.php?bill_no=<?php echo $row['bid'];?>&total=<?php echo $total; ?>"  >Print</a></td>
                        </tr>
            <!-- <td></td> -->
							<?php endwhile;?>
                        <?php endwhile;?>
                    </table>
				

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>