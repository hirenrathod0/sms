<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "nmc");
$columns = array('inventoryid', 'brand', 'type' ,'price' ,'date','dealername','dealercontactno','dealeraddress');

$query = "SELECT * FROM inventory ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE brand LIKE "%'.$_POST["search"]["value"].'%" 
 OR type LIKE "%'.$_POST["search"]["value"].'%" 
 OR price LIKE "%'.$_POST["search"]["value"].'%" 
 OR date LIKE "%'.$_POST["search"]["value"].'%" 
 OR dealeraddress LIKE "%'.$_POST["search"]["value"].'%" 
 OR dealercontactno LIKE "%'.$_POST["search"]["value"].'%" 
 
 OR dealername LIKE "%'.$_POST["search"]["value"].'%" 
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
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="inventoryid">' . $row["inventoryid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="brand">' . $row["brand"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="type">' . $row["type"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="price">' . $row["price"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="date">' . $row["date"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="dealername">' . $row["dealername"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="dealercontactno">' . $row["dealercontactno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="dealeraddress">' . $row["dealeraddress"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM inventory";
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