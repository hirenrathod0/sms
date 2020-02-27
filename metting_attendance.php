<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Meetings</h1></CENTER>

    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>member name</th></thead>
            <tbody>
                <?php 
                 $dog1=$_GET['uid'];

                 $query1="select uid,fullName from users";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        while($row=$result->fetch_assoc())
        {
            
                 ?>
                    <tr>
         
                         <td><?php echo($row['fullName']);?></td>
                            <td><div class="form-group row">
				<div class="col-sm-7">
					<select class="form-control" id="sel1" name="type">
						<option>Select Option</option>
						<option value="present">present</option>						
						<option value="abesent">abesent</option>						
					</select>
				</div>
			</div></td>
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