<!DOCTYPE html>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
include "conn.php";
?>

<html>

<head>
	<title>Bootstrap Example</title>
	<style type="text/css">
	body {
	background: url(bg.png) no-repeat fixed;
	   -webkit-background-size: 100% 100%;
	   -moz-background-size: 100% 100%;
	   -o-background-size: 100% 100%;
	   background-size: 100% 100%;
	}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>


<body>

	<div class="container">
			<!-- Navigation -->
    <?php
		include "nav.php";
	?>
		
		<div class="container">
				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">HOME</h3>
						</div>
						<div class="card-body">
						<p class="h2" style="text-align: center;">Selamat Datang </p>
						<p class="h2" style="text-align: center;">Website ini merupakan sistem penunjang keputusan pemilihan mobil dan sepeda motor</p></br>
						
						<p class="h7" style="font-weight: bold;"><?php "" . ""?>Silahkan Pilih Kategori Kendaraan Yang Ingin DIcari : </p>
							<table class="table table-bordered" style="border:2;">
							   <tr>
								<td><a href="mobilbekas.php">
									<img border="0" alt="W3Schools" src="Home1.jpg" width="100%">
								</td>
								<td><a href="mobilbaru.php">
									<img border="0" alt="W3Schools" src="Home2.jpg" width="100%"></td>
							   </tr>
							   <tr>
								<td><a href="motorbekas.php">
								<img border="0" alt="W3Schools" src="Home3.jpg" width="100%"></td>
							   
								<td><a href="motorBaru.php">
								<img border="0" alt="W3Schools" src="Home4.jpg" width="100%"></td>
								</tr>
							 </table>
							 
							 
							 
							  

						</div><!--/card-block-->
					</div>
				</div>
			</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>



</html>