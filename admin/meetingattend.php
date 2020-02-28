<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>meetings</h1></CENTER>

    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>title</th><th>agenda</th><th>date</th><th>present</th><th>abesent</th></thead>
            <tbody>
                <?php 
        

                 $query1="select meet_id,title,date,details from meeting_detail where presentstatus=1";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($row=$result->fetch_assoc())
        {
            
                 ?>
                    <tr>
                        
       
                                
                        
                         <td><?php echo($row['title']);?></td>
                        <td><?php echo($row['details']);?></td>
                        <td><?php echo($row['date']);?></td>
                        <?php 
        

                 $query1="select count(mid)as p from meeting_attendance where pa='p'group by uid";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($row=$result->fetch_assoc())
        {
            
                 ?>
                            <td><?php echo($row['p']);?></td>
                            <?php }?>
                        <?php 
        

                 $query1="select count(mid)as p from meeting_attendance where pa='a'group by uid";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($row=$result->fetch_assoc())
        {
            
                 ?>
                            <td><?php echo($row['p']);?></td>
                            <?php }?>
                                                                    
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