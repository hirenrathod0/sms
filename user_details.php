<?php include 'header.php'; 
$query11="select * from member_detail";
$result11=mysqli_query($con,$query11);


if(isset($_POST['insert_visitor_reg']))
{
}
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

    <button class="btn btn-primary" type="button" onclick="showfemale()">Female   </button>
    <button  class="btn btn-primary" type="button" onclick="showmale()">Male   </button>
    

    <br> <br>
    <div id="usercard">
    <?php 
    $query="select * from users";
    $result1=mysqli_query($con,$query);
    $count=0;
     while($row=mysqli_fetch_array($result1)) :;  	?>
    
        
    <?php 
            if($count==0)
            {
                echo '<div class="row">';
            }
            elseif($count%3==0)
            {
               echo "</div>";
               echo '<div class="row">';

            }
            $count++;
    ?>

    <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"> <?php echo $row[1];  ?> </h3>
                <h5 class="widget-user-desc">Member Name</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"> <?php echo $row[7];  ?></h5>
                      <span class="description-text">gender</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $row[4];  ?></h5>
                      <span class="description-text">Mobile NO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $row["dob"];  ?></h5>
                      <span class="description-text">birthdate</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
          <?php endwhile; ?>
        


        

               
          
        </div>
	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>
<script>

function showfemale()
{
    alert('called');    
    var myobj = {
        need: 'female'
    }
    
    $.ajax({
           type: "POST",
           url: 'dbservices/load_user_detail.php',
           data: myobj,
           success: function(data)
           {
               // alert(data);
                if (data) 
                {
                   alert(data);
                   document.getElementById('usercard').innerHTML = data;
                }     
                else 
                {
                    
                }    
           },
           complete:function(){
            $('#event').each(function(){
                this.reset();   //Here form fields will be cleared.
            });
       }
         });
        
    }

    function showmale()
{
    alert('called');    
    var myobj = {
        need: 'male'
    }
    
    $.ajax({
           type: "POST",
           url: 'dbservices/load_user_detail.php',
           data: myobj,
           success: function(data)
           {
               // alert(data);
                if (data) 
                {
                   alert(data);
                   document.getElementById('usercard').innerHTML = data;
                }     
                else 
                {
                    
                }    
           },
           complete:function(){
            $('#event').each(function(){
                this.reset();   //Here form fields will be cleared.
            });
       }
         });
        
    }


    

</script>
