<?php include 'header.php';
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Meeting Attandence List</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <table class="table display" id="meetattend" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>title</th><th>agenda</th><th>date</th><th>present</th><th>abesent</th><th>show attendance</th></thead>
            <tbody>
                <?php 
                $query1="select meet_id,title,date,details from meeting_detail where presentstatus=1";
                 $result=mysqli_query($con,$query1);
                     

        while($row=$result->fetch_assoc())
        {
                
                 ?>
                    <tr>                 
                         <td><?php echo($row['title']);?></td>
                        <td><?php echo($row['details']);?></td>
                        <td><?php echo($row['date']);?></td>
                        <?php         
                $query2="select count(mid)as p from meeting_attendance where pa='p' and mid='".$row['meet_id']."'";      
                $result2=mysqli_query($con,$query2); 
        while($row2=$result2->fetch_assoc())
        {
                
                 ?>
                            <td><?php echo($row2['p']);?></td>
    <?php }?>
                        <?php 
        

                    $query3="select count(mid)as a from meeting_attendance where pa='a' and mid='".$row['meet_id']."'";
                $result3=mysqli_query($con,$query3);             
        while($row3=$result3->fetch_assoc())
        {
                  ?>
                            <td><?php echo($row3['a']);?></td>
        <?php }?>
                            <td><a href="attendancesheet.php?mid=<?php echo $row['meet_id'];?>">show attendance</a></td>                                          
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
<script type="text/javascript">
    $(document).ready( function () {
        $('#meetattend').DataTable({                  
                
            buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
            dom: 'lBfrtip',
            "lengthChange": true
        });
    });
</script>