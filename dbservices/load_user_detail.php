
<?php include('../config.php');

$query="";
$data = array();
if($_POST["need"]=="female")
{
    $query = "SELECT * FROM member_detail where gender like 'f'";
}
elseif($_POST["need"]=="male")
{
    $query = "SELECT * FROM member_detail where gender like 'm'";
}





$statement = $dbh->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'name'   => $row["name"],
  'birthdate'   => $row["birthdate"],
  'gender'   => $row["gender"]
  
 );
}

$str  = "<div class='row'> ";
$count=0;
foreach($data as $d)
{
    if($count%3 == 0)
    {
        $str=$str."</div><div class='row'>";
    }
    $count++;

    $str = $str.'<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">'.$d['name'].'</h3>
                <h5 class="widget-user-desc">Member Name</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">'.$d['gender'].'</h5>
                      <span class="description-text">gender</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">hello</h5>
                      <span class="description-text">Mobile NO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">'.$d['birthdate'].'</h5>
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
          <!-- /.col -->';
    
}

echo $str;
?>
