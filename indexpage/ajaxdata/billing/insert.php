<?php
$connect = mysqli_connect("localhost", "root", "", "nmc");
if(isset($_POST["billid"], $_POST["invoicedate"],$_POST["invoiceno"],$_POST["reversecharge"],$_POST["state"],$_POST["citycode"],$_POST["clientname"],$_POST["clientaddress"],$_POST["gstnid"],$_POST["gstnstate"],$_POST["gstncitycode"],$_POST["product"],$_POST["productdesc"],$_POST["price"],$_POST["loads"],$_POST["totalitem"],$_POST["totalloads"],$_POST["totalprice"]))
{
 $billid = mysqli_real_escape_string($connect, $_POST["billid"]);
 $invoicedate = mysqli_real_escape_string($connect, $_POST["invoicedate"]);
 $invoiceno = mysqli_real_escape_string($connect, $_POST["invoiceno"]);
 $reversecharge = mysqli_real_escape_string($connect, $_POST["reversecharge"]);
 $state = mysqli_real_escape_string($connect, $_POST["state"]);
 $citycode = mysqli_real_escape_string($connect, $_POST["citycode"]);
 $clientname = mysqli_real_escape_string($connect, $_POST["clientname"]);
 $clientaddress = mysqli_real_escape_string($connect, $_POST["clientaddress"]);
 $gstnid = mysqli_real_escape_string($connect, $_POST["gstnid"]);
 $gstnstate = mysqli_real_escape_string($connect, $_POST["gstnstate"]);
 $gstncitycode = mysqli_real_escape_string($connect, $_POST["gstncitycode"]);
 $product = mysqli_real_escape_string($connect, $_POST["product"]);
 $productdesc = mysqli_real_escape_string($connect, $_POST["productdesc"]);
 $price = mysqli_real_escape_string($connect, $_POST["price"]);
 $loads = mysqli_real_escape_string($connect, $_POST["loads"]);
 $totalitem = mysqli_real_escape_string($connect, $_POST["totalitem"]);
 $totalloads = mysqli_real_escape_string($connect, $_POST["totalloads"]);
 $totalprice = mysqli_real_escape_string($connect, $_POST["totalprice"]);
 $query = "INSERT INTO billing(billid,invoicedate,invoiceno,reversecharge,state,citycode,clientname,clientaddress,gstnid,gstnstate,gstncitycode,product,productdesc,price,loads,totalitem,totalloads,totalprice) VALUES('$billid', '$invoicedate', '$invoiceno', '$reversecharge','$state','$citycode','$clientname','$clientaddress','$gstnid','$gstnstate','$gstncitycode','$product','$productdesc','$price','$loads','$totalitem','$totalloads','$totalprice')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}

// $columns = array('billid', 'invoicedate', 'invoiceno' ,'reversecharge' ,'state','citycode','clientname','clientaddress','gstnid','gstnstate','gstncitycode','product','productdesc','price','loads','totalitem','totalloads','totalprice');
?>
