<?php include 'header.php';?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Show Meeting List (Remaining)</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
		<!-- <CENTER><h1>show meetings</h1></CENTER> -->

    <table class="table display" id="showmeet" width="100%">
            <thead>
                <!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
                 <th>title</th><th>date</th><th>Action</th></thead>
            <tbody>
                <?php 
        

                 $query1="select meet_id,title,date from meeting_detail where presentstatus=0";
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
                        <td><?php echo($row['date']);?></td>                                                    
                                <td><a href="addattendance.php?mid=<?php echo $row['meet_id'];?>">add attendance</a></td>                                           
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
        $('#showmeet').DataTable({                  
                
            buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
            dom: 'lBfrtip',
            "lengthChange": true
        });
    });
</script>