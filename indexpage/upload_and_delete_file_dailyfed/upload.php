0<html>
	<head>
		<meta charset="utf-8"/>
		<link href="bootstrap.min.css" rel="stylesheet"/>
	</head>

<?php
$dbh=new PDO("mysql:host=localhost;dbname=abc","root","");

	if(isset($_POST["submit"]))
	{
		$file=$_FILES["file"]["name"];
		$type=$_FILES['file']['type'];
		$data=file_get_contents($_FILES['file']['tmp_name']);
		$d=$_POST['des'];
		$tmp_name=$_FILES["file"]["tmp_name"];
		$path="upload/".$file;
		$file1=explode(".",$file);
		$ext=$file1[1];
		$allowed=array("jpg","png","pdf","docx","java","txt","mp3","mp4","zip","rar","zrchive","exe","word document");
		if(in_array($ext,$allowed))
		{
			move_uploaded_file($tmp_name,$path);
			
			
			$stmt=$dbh->prepare("insert into upload(file,description,mime,data)values(?,?,?,?)");
		$stmt->bindParam(1,$file);
		$stmt->bindParam(2,$d);
		$stmt->bindParam(3,$type);
		$stmt->bindParam(4,$data);
		
		
		$stmt->execute();
			}
		
	}
?>
<body>
Each uploaded file name must be unique...
<form enctype="multipart/form-data" method="post">
<TextArea cols="40" rows="2" placeholder="write description here..." name="des"></TextArea>
	<input type="file" name="file">
	<input type="submit" name="submit" value="upload">
</form>

	<p></p>
	<br><br>
	
		<p><br/></p>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<tr>
						
						<th>file Name</th>
						<th>Description</th>
						<th>file type</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include "config.php";
					$stmt=$db->prepare("select *from upload");
					$stmt->execute();
					while($row=$stmt->fetch()){
				
				?>
				<tr>
							
							<td><?php echo $row['file'] ?></td>
							<td><?php echo $row['description'] ?></td>
							<td><?php echo $row['mime'] ?></td>
							<td class="text-center"><a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Delete</a></td>
					
				</tr>
				<?php
				}
				?>
					
				</tbody>
			</table>
		</div>
		<script src="jquery.min.js"></script>
		<script src="bootstrap.min.js"></script>
</body>	
</html>

