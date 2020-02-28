<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "abc");
$columns = array('sr', 'department','projectdefinationrank1','studentname1','erno1','projectdefinationrank2','studentname2','erno2','projectdefinationrank3','studentname3','erno3','year');

$query = "SELECT * FROM projectreport ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE department LIKE "%'.$_POST["search"]["value"].'%" 
 OR erno1 LIKE "%'.$_POST["search"]["value"].'%" 
 OR erno2 LIKE "%'.$_POST["search"]["value"].'%" 
 OR erno3 LIKE "%'.$_POST["search"]["value"].'%" 
 OR studentname1 LIKE "%'.$_POST["search"]["value"].'%" 
 OR studentname2 LIKE "%'.$_POST["search"]["value"].'%" 
 OR studentname3 LIKE "%'.$_POST["search"]["value"].'%" 
 OR projectdefinationrank1 LIKE "%'.$_POST["search"]["value"].'%" 
 OR projectdefinationrank2 LIKE "%'.$_POST["search"]["value"].'%" 
 OR projectdefinationrank3 LIKE "%'.$_POST["search"]["value"].'%" 
 OR year LIKE "%'.$_POST["search"]["value"].'%" 
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
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="sr">' . $row["sr"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="department">' . $row["department"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="projectdefinationrank1">' . $row["projectdefinationrank1"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="studentname1">' . $row["studentname1"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="erno1">' . $row["erno1"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="projectdefinationrank2">' . $row["projectdefinationrank2"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="studentname2">' . $row["studentname2"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="erno2">' . $row["erno2"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="projectdefinationrank3">' . $row["projectdefinationrank3"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="studentname3">' . $row["studentname3"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="erno3">' . $row["erno3"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="year">' . $row["year"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM projectreport";
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