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
</head>


<body>

	<div class="container">
		<!-- Navigation -->
    <?php
		include "nav.php";
	?>
		
		<div class="container">
				<h2 style="text-align: center;">Sistem Penunjang Keputusan Pemilihan Mobil Dan Motor</h2></br>

				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">LOGIN ADMIN</h3>
						</div>
						<div class="card-body" style="opacity:0.9;">
							<form method="post" action="cekloginadmin.php" autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form">
							
							<?php
								if (isset($_GET["error"]))
								{
									?>
									   <div class="alert alert-warning" role="alert">
										  <?php
											echo $_GET["error"];
										  ?>
										</div>
									<?php
								}
							?>
							
							  <div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
							  </div>
							  <div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" name="password" placeholder="Password">
							  </div>
							  
							  
							  <button type="submit" value="LOGIN" class="btn btn-primary">Login</button>
							</form>
						</div><!--/card-block-->
					</div>
				</div>
			</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>



</html>