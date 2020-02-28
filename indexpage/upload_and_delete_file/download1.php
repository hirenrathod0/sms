<html>
	<head>
		<meta charset="utf-8"/>
		<link href="bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<p><br/></p>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<tr>
						
						<th>file Name</th>
						<th>Description</th>
						<th>file type</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include "download2.php";
					$stmt=$db->prepare("select *from upload");
					$stmt->execute();
					while($row=$stmt->fetch()){
				
				?>
				<tr>
							
							<td><?php echo $row['file'] ?></td>
							<td><?php echo $row['description'] ?></td>
							<td><?php echo $row['mime'] ?></td>
							<td class="text-center"><a href="upload/<?php echo $row["file"];?>" class="btn btn-primary">Download</a></td>
					
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