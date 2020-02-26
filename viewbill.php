<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Maintenance bills</h1></CENTER>
		<table border="2" align="center" width="50%" >
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
							$result=mysqli_query($con,"select fid,block,flat_num,uid from flat where uid IS NOT NULL");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
                            <tr>
                        <td><?php printf("%s",$row['fid']);  ?>"><?php printf("%s",($row["block"]." - ".$row["flat_num"])); ?>
                            </td>
                                <?php
							$result=mysqli_query($con,"select fullName,contactNo,bill_date,water_charges,property_tax,elec_charges,parking_charges,other,flat_charges,due_date from users,maintenance_bill where id=fid");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
                                
                        <td><?php printf("%s",$row['fullName']);?></td>
                                <td><?php printf("%s",$row['contactNo']);?></td>
                         <td><?php printf("%s",$row['bill_date']);?></td>
                             <td><?php printf("%s",$row['water_charges']+$row['water_charges']+$row['flat_charges']);?></td>
                                <td><?php printf("%s",$row['due_date']);?></td>
              
              
                                <td><a href="maintain_details.php?uid=<?php echo $row['uid']; ?>" >send</a></td>
                        </tr>
            <td></td>
							<?php endwhile;?>
                        <?php endwhile;?>
                    </table>
				

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>