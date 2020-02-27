<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>members details</h1></CENTER>

    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                <th>name</th> <th>birth-date</th>  <th>gender</th> <th>edit</th></thead>
            <tbody>
                <?php 
                 $dog1=$_SESSION['uid'];

                 $query1="select *from member_detail where uid='".$dog1."'";
        $result=mysqli_query($con,$query1);
        
        // echo "$dummy1";

    
        while($row=$result->fetch_assoc())
        {
            
                 ?>
                    <tr>
       
                                
                        
                         <td><?php echo($row['name']);?></td>
                        <td><?php echo($row['birthdate']);?></td>
                        <td><?php echo($row['gender']);?></td>
                        
                                <td><a href="editmember.php?mid=<?php echo $row['uid'];?>"  >edit</a></td>                                           
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