<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "nmc");
$columns = array('clientid', 'clientname', 'contactno' ,'address', 'typeofclient' ,'companyname', 'companytelno' ,'emailid');

$query = "SELECT * FROM client ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE clientname LIKE "%'.$_POST["search"]["value"].'%" 
 OR contactno LIKE "%'.$_POST["search"]["value"].'%" 
 OR address LIKE "%'.$_POST["search"]["value"].'%" 
 OR typeofclient LIKE "%'.$_POST["search"]["value"].'%" 
 OR companyname LIKE "%'.$_POST["search"]["value"].'%" 
 OR companytelno LIKE "%'.$_POST["search"]["value"].'%" 
 OR emailid LIKE "%'.$_POST["search"]["value"].'%" 
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
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="clientid">' . $row["clientid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="clientname">' . $row["clientname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="contactno">' . $row["contactno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="address">' . $row["address"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="typeofclient">' . $row["typeofclient"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="companyname">' . $row["companyname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="companytelno">' . $row["companytelno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="emailid">' . $row["emailid"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM client";
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
//$query = "INSERT INTO client(clientid, clientname,contactno,address,typeofclient,companyname,companytelno,emailid) VALUES('$clientid', '$clientname','$contactno','$address','$typeofclient', '$companyname', '$companytelno', '$emailid')";
?>