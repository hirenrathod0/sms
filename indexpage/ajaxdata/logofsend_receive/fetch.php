<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "nmc");
$columns = array('logid', 'vehicleno', 'vehiclename' ,'loads','drivername','driverid','drivercontactno','clientid', 'clientname','date','companyname' ,'typeofmaterial');

$query = "SELECT * FROM logofsend_receive ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE vehicleno LIKE "%'.$_POST["search"]["value"].'%" 
 OR vehiclename LIKE "%'.$_POST["search"]["value"].'%" 
 OR loads LIKE "%'.$_POST["search"]["value"].'%" 
 OR drivername LIKE "%'.$_POST["search"]["value"].'%" 
 OR drivercontactno LIKE "%'.$_POST["search"]["value"].'%" 
 OR clientname LIKE "%'.$_POST["search"]["value"].'%" 
 OR date LIKE "%'.$_POST["search"]["value"].'%" 
 OR driverid LIKE "%'.$_POST["search"]["value"].'%" 
 OR companyname LIKE "%'.$_POST["search"]["value"].'%" 
 OR typeofmaterial LIKE "%'.$_POST["search"]["value"].'%" 
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
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="logid">' . $row["logid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="vehicleno">' . $row["vehicleno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="vehiclename">' . $row["vehiclename"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="loads">' . $row["loads"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="drivername">' . $row["drivername"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="driverid">' . $row["driverid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="drivercontactno">' . $row["drivercontactno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="clientid">' . $row["clientid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="clientname">' . $row["clientname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="date">' . $row["date"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="companyname">' . $row["companyname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="typeofmaterial">' . $row["typeofmaterial"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM logofsend_receive";
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