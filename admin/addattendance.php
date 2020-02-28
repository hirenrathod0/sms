<?php include 'header.php';

if (isset($_POST['insert_btn'])) {
  

  $query1="select id,fullName from users";
                 
        $result=mysqli_query($con,$query1);
                $num_of_rows=mysqli_num_rows($result);
        

      $x=1;
      echo "<script>alert(".$_POST['att1'].");</script>";                
      while($rows=mysqli_fetch_array($result)){
      	$query="INSERT into meeting_attendance(uid,mid,pa)VALUES('".$rows['id']."','".$_REQUEST['mid']."','".$_POST['att'.$x]."')";
        $x++;
      	$data=mysqli_query($con,$query);
}
    
       $query="update meeting_details set presentstatus=1 where mid='".$_REQUEST['mid']."'";
	     $row=mysqli_query($con,$query); 
 
}
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>member details</h1></CENTER>
<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>member name</th><th>date</th></thead>
            <tbody>
                <?php 
        

               
        // echo "$dummy1";
      $query1="select id,fullName from users";
                 
        $result=mysqli_query($con,$query1);
       
        $counter=1;        
        while($row=$result->fetch_assoc())
        {          
                 ?>
                    <tr>
                        
               <td><?php echo $row['fullName']; ?></td>
                                                    
          <td><select class="form-control"  name="att<?php echo $counter;?>"  >
						<option value="p">present</option>						
						<option value="a">abesent</option>						
					</select></td>
                            
                                                                  
                        <!-- <td><a href="add_catspec.php?edit_cat=<?php //echo $rows['catid']; ?>" class="btn btn-info btn_space" >Edit</a><a href="add_catspec.php?delete_cat=<?php //echo $rows['catid']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td> -->
                    </tr> 
                
                    <?php 
        $counter++;        
        }
                ?>
            </tbody>
        </table>    

<br/>
     <button type="submit" name="insert_btn" >Make Attandence</button>
        </form>
				

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>