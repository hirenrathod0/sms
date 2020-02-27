<?php include 'header.php';

?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>member details</h1></CENTER>

    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>member name</th><th>date</th></thead>
            <tbody>
                <?php 
        

                 $query1="select id,fullName from users";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($row=$result->fetch_assoc())
        {
            $counter=0;
                 ?>
                    <tr>
                        
               <td><?php echo $row['fullName']; ?></td>
                                
                        
                         <td><select class="form-control" id="sel1" name="att".<?php echo "$counter";?>  >
						<option value="p">present</option>						
						<option value="a">abesent</option>						
					</select></td>
                            
                                                                  
                        <!-- <td><a href="add_catspec.php?edit_cat=<?php //echo $rows['catid']; ?>" class="btn btn-info btn_space" >Edit</a><a href="add_catspec.php?delete_cat=<?php //echo $rows['catid']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td> -->
                    </tr> 
                
                    <?php 
                }
                ?>
            </tbody>
        </table>    

<br/>
    <input type="submit" name="submit" value="Mark Attendance" />

	
				

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>