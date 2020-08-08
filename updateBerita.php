<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
	
	$urumus="";
	if (isset($_GET["rumus"]))
	{
		$urumus=mysqli_real_escape_string($conn,$_GET["rumus"]);
	}
	$syarat="";
	if ($urumus!="")
	{
		$syarat=$syarat." nama='$urumus'";
	}
	else
	{ 
	}
		$q="UPDATE rumus SET status='tidak aktif' WHERE status='aktif'";
		$res=mysqli_query($conn,$q);
		$q2="UPDATE rumus SET status='aktif' WHERE $syarat";
		$res2=mysqli_query($conn,$q2);
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
							<h3 class="mb-0">Pilih Rumus</h3>
						</div>
						<div class="card-body">
								<?php 
									$sql = mysqli_query($conn,"SELECT * FROM rumus WHERE status='aktif'");
									$data = mysqli_fetch_array($sql);
								?>
								<h5 class="text-center">Rumus yang dipakai saat ini : <?php echo  $data['nama']?> </h5>
							<form autocomplete="off" class="form" id="formLogin" name="formLogin" role="form">
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Rumus : </label>
									<div class="col-sm-10">
										<select class="form-control" required="" name="rumus" id="urumus">
										<option></option>
											<?php
												$q="SELECT nama FROM rumus";
												$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													?>
													  <option value="<?php echo $row["nama"];?>">
														<?php
															echo $row["nama"];
														?>
													  </option>
													<?php
												}
											?>
										</select>
									</div>
								</div>	
								
								
								
								<button type="submit" class="btn btn-primary"> Ganti Rumus </button>
								
								
							</form>
						</div><!--/card-block-->
					</div>
				</div>
			</div>
			
			
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

<script>
	window.location="halamanupdatedata.php?p=2";
</script>
	
</html>