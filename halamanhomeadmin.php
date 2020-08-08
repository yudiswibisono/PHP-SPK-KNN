<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
		
	
	

	
?>
<!DOCTYPE html>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
		include "navadmin.php";
	?>
	</div>
		

			<div class="container">
				<h2 style="text-align: center;">Sistem Penunjang Keputusan Pemilihan Mobil Dan Motor</h2></br>

				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">Selamat datang di halaman admin</h3>
						</div>
						<div class="card-body">
								
								<h5 class="text-center">Pilih kategori aksi pada navigasi bar diatas untuk melakukan aksi yang akan dilakukan</h5>

									
						</div><!--/card-block-->
					</div>
				</div>
			</div>
			
			
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

	
</html>