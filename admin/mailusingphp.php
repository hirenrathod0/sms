
<?php include 'header.php';
$query="select userEmail from users where id=2";
$r=mysqli_query($con,$query);
$row = mysqli_fetch_array($r);
$to ='patelpriyanshi0807@gmail.com';
$subject = 'maintenance bill';
$from = 'ompriyanshipatel@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 $query="select bill_date,due_date from maintenance_bill where bid='".$_REQUEST['bill_no']."'";

$mtotal=$_REQUEST['total'];
$r=mysqli_query($con,$query);
$row = mysqli_fetch_array($r);
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">bill date</h1>'.$row['bill_date'];
$message .= '<p style="color:#080;font-size:18px;">due-date</p>'.$row['due_date'];
$message .= '<p style="color:#080;font-size:18px;">total</p>'.$mtotal;
$message .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
?>