<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>meetings</h1></CENTER>

    <table class="table display" id="cattable" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>Name</th><th>p/a</th></thead>
            <tbody>
                <?php 
        

          $query1="select id,fullName from users";
                 
        $result=mysqli_query($con,$query1);
                $num_of_rows=mysqli_num_rows($result);
                
      while($rows=mysqli_fetch_array($result)){
            
                 ?>
                    <tr>
                         <td><?php echo($rows['fullName']);?></td>
                
                        <?php 
        $query2="select pa from meeting_attendance where uid='".$rows['id']."' and mid='".$_REQUEST['mid']."'";
        $result1=mysqli_query($con,$query2);
        
        // echo "$dummy1";

        while($row=$result1->fetch_assoc())
        {
            
                 ?>
                            <td><?php echo($row['pa']);?></td>
                            <?php }?>
                        
        
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