<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "nmc");
$columns = array('billid', 'invoicedate', 'invoiceno' ,'reversecharge' ,'state','citycode','clientname','clientaddress','gstnid','gstnstate','gstncitycode','product','productdesc','price','loads','totalitem','totalloads','totalprice');

$query = "SELECT * FROM billing ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE billid LIKE "%'.$_POST["search"]["value"].'%" 
 OR invoicedate LIKE "%'.$_POST["search"]["value"].'%" 
 OR reversecharge LIKE "%'.$_POST["search"]["value"].'%" 
 OR state LIKE "%'.$_POST["search"]["value"].'%" 
 OR citycode LIKE "%'.$_POST["search"]["value"].'%" 
 OR clientname LIKE "%'.$_POST["search"]["value"].'%" 
 OR clientaddress LIKE "%'.$_POST["search"]["value"].'%" 
 OR gstncitycode LIKE "%'.$_POST["search"]["value"].'%" 
 OR gstnstate LIKE "%'.$_POST["search"]["value"].'%" 
 OR product LIKE "%'.$_POST["search"]["value"].'%" 
 OR price LIKE "%'.$_POST["search"]["value"].'%" 
 OR loads LIKE "%'.$_POST["search"]["value"].'%" 
 OR totalprice LIKE "%'.$_POST["search"]["value"].'%" 
 OR invoiceno LIKE "%'.$_POST["search"]["value"].'%" 
 OR totalloads LIKE "%'.$_POST["search"]["value"].'%" 
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
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["billid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["invoicedate"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["invoiceno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["reversecharge"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["state"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["citycode"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["clientname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["clientaddress"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["gstnid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["gstnstate"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["gstncitycode"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["product"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["productdesc"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["price"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["loads"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["totalitem"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["totalloads"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="adminid">' . $row["totalprice"] . '</div>';
 
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM billing";
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