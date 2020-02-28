<?php include 'header.php'; 

?>

<head>
<title>Payment Gateway</title>
</head>



  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

        <CENTER><h1>Payment Gateway</h1></CENTER>	
        <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>  
        <script>paypal.Buttons().render('body');</script>        
        
	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>
