<?php include 'header.php'; 

$query="select id,fullName from users";
$result1=mysqli_query($con,$query);


if(isset($_POST['insert_visitor_reg']))
{
	$query="INSERT into visitor(name,cno,ref,email) VALUES('".$_POST["fullName"]."', '".$_POST["cno"]."', '".$_POST["name"]."', '".$_POST["visitorEmail"]."')";
	$row=mysqli_query($con,$query);
	
	if(isset($row))
	{		
		echo "<script>alert('Visitor Entry Inserted');</script>";		
		//header('location:user_reg.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Visitor Details</h1></CENTER>	

		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Full Name:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter Full lName" name="fullName">
				</div>
			</div>


			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Email:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter email" name="visitorEmail">
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Contact no:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="cno" placeholder="Enter contact no" name="cno">
				</div>
			</div>
						
						
				
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Select Name:</label>
				<div class="col-sm-7">
					<select class="form-control" id="sel1" name="name" onchange="showflat()">
						<option > select name</option>
						<?php while($row1=mysqli_fetch_array($result1)) :;  ?>	
						<option value="<?php echo $row1[0]; ?>" onclick="showflat()"> <?php echo $row1[1]; ?> </option>							
						<?php endwhile; ?>	


					</select>
				</div>
			</div>	

			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Flat NO:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="flat_no"  name="flat_no" >
				</div>
			</div>
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="submit" class="btn btn-primary " name="insert_visitor_reg">Submit</button>
					<button type="reset" class="btn btn-primary">Reset</button>
				</div>				
			</div>
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>

<script>

	function showflat()
	{
		var id=document.getElementById('sel1').value;
		//alert(id);
		var obj  = { 
			id: id
		}
		$.ajax({
			type: "POST",
			url: 'ajaxcode.php',
			data: obj,
			success:function(data)
			{
				//alert(data);
				document.getElementById('flat_no').value=data;
			}
		})		
	}

	</script>