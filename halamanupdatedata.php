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
				<?php
					if (isset($_GET["p"]))
					{
						if ($_GET["p"]=="1")
						{
							?>
								<div class="alert alert-primary" role="alert">
								  Crawling berita berhasil dilakukan
								</div>
							<?php
						}
					}
				?>
				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">Crawling Data</h3>
						</div>
						</br>
						<h4 style="text-align: center;">Pilih kategori data yang akan di update</h2></br>
						<table class="table table-bordered" style="border:2;">
							   <tr>
								<td style="width:30%">
									<div class="card border-secondary mb-3" style="margin-left:20px;margin-top:40px;margin-right:40px;margin-bottom:20px;">
									</br>
									<h5 class="text-center"> Tekan tombol untuk dibawah </h5>
									<h5 class="text-center"> untuk mengupdate data kendaraan : </h5>
									</br>
										<a href="updatedata.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Update Data Mobil Dan Sepeda Motor</a>
									</div><!--/card-block-->
								</td>
								<td style="width:30%">
									<div class="card border-secondary mb-3" style="margin-left:40px;margin-top:40px;margin-right:40px;margin-bottom:40px;">
										</br>
										<h5 class="text-center"> Tekan tombol untuk dibawah </h5>
										<h5 class="text-center"> untuk mengupdate data Berita : </h5>
										</br>
										<a href="crawler/berita/CrawlerBerita.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Update Berita</a>
									</div><!--/card-block-->
								</td>
							   </tr>
							 </table>
						
						
					</div>
				</div>
			</div>
			
			
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

	
</html>