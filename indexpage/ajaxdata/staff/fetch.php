<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "nmc");
$columns = array('staffid', 'staffname', 'address' ,'contactno', 'birthdate', 'dateofjoining','designation','aadharcard' ,'passbookno');

$query = "SELECT * FROM staff ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE staffname LIKE "%'.$_POST["search"]["value"].'%" 
 OR address LIKE "%'.$_POST["search"]["value"].'%" 
 OR contactno LIKE "%'.$_POST["search"]["value"].'%" 
 OR birthdate LIKE "%'.$_POST["search"]["value"].'%" 
 OR dateofjoining LIKE "%'.$_POST["search"]["value"].'%" 
 OR designation LIKE "%'.$_POST["search"]["value"].'%" 
 OR aadharcard LIKE "%'.$_POST["search"]["value"].'%" 
 OR passbookno LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="staffid">' . $row["staffid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="staffname">' . $row["staffname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="address">' . $row["address"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="contactno">' . $row["contactno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="birthdate">' . $row["birthdate"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="dateofjoining">' . $row["dateofjoining"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="designation">' . $row["designation"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="aadharcard">' . $row["aadharcard"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="passbookno">' . $row["passbookno"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM staff";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>