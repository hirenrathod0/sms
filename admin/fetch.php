<?php

//fetch.php

include("config.php");


 $result = mysqli_query($con, "SELECT * FROM flat"); 
    
    if ($result) 
    { 
        // it return number of rows in the table. 
        $total_row = mysqli_num_rows($result);             
    } 
// $statement = $con->prepare($query);
// $statement->execute();
// $result = $statement->fetchAll();
// $total_row = $statement->rowCount();
$output = '
<table class="table table-striped table-bordered display" width="100%" id="tbl_flat">
	<tr>
		<th>Block</th>
		<th>Flat No.</th>
		<th>Area</th>
		<th>BHK</th>
		<th>Floor No.</th>
		<th>Price</th>
		<th>Owner Name</th>
		<th>Owner Contact</th>
		<th>Owner Email</th>

		<th>Edit</th>
		<th>Delete</th>
	</tr>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td width="40%">'.$row["block"].'</td>
			<td width="40%">'.$row["flat_num"].'</td>
			<td width="40%">'.$row["area"].'</td>
			<td width="40%">'.$row["BHK"].'</td>
			<td width="40%">'.$row["floor_no"].'</td>
			<td width="40%">'.$row["price"].'</td>
			<td width="40%">'.$row["owner"].'</td>
			<td width="40%">'.$row["ownercno"].'</td>
			<td width="40%">'.$row["owneremail"].'</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["fid"].'">Edit</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["fid"].'">Delete</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>