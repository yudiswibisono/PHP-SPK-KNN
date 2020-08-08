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
		include "nav.php";
	?>
		<div class="container">
				<h2 style="text-align: center;">Sistem Penunjang Keputusan Pemilihan Mobil Dan Motor</h2></br>
				
				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">Daftar User</h3>
						</div>
						<div class="card-body" style="opacity:0.9;">
							<form action="send_register.php" autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form" method="post">
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
								else if (isset($_GET["berhasil"]))
								{
									?>
									   <div class="alert alert-success" role="alert">
										  <?php
											echo $_GET["berhasil"];
										  ?>
										</div>
									<?php
								}
							?>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label">Username : </label>
									<div class="col-sm-10">
									  <input class="form-control" id="uusername" name="username" required="" type="text" value="" placeholder="Masukan Username">
									</div>
								</div>	
								<div class="form-group row">
									<label for="exampleInputPassword1" class="col-sm-2 col-form-label">Password : </label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" required="" id="upassword" name="password" placeholder="Password">
									</div>
								</div>	
								<div class="form-group row">
									<label for="exampleInputPassword1" class="col-sm-2 col-form-label">Ulangi Password : </label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" required="" id="urepassword" name="repassword" placeholder="Ulangi Password">
									</div>
								</div>	
								<button type="submit" class="btn btn-primary" value="REGISTER">Daftar</button>
								<a href="loginuser.php" type="button" class="btn btn-danger">Kembali</a>
							</form>
						</div><!--/card-block-->
					</div>
				</div>
			</div>
	</div>
</body>





</html>