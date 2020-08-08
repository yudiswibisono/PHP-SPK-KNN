<?php
	include "conn.php";
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
		include "nav.php";
	?>
		<div>
			<h1></h1>
		</div>
		

			<div class="container">
				<h2 style="text-align: center;">Sistem Pemilihan Mobil Dan Motor</h2></br>

				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">Riwayat Pencarian Sepeda Motor Baru</h3>
						</div>
						<?php
							if (isset($_GET["w"]))
							{
								?>
								  <div class="alert alert-warning" role="alert">
								    <?php
										echo $_GET["w"];
									?>
								  </div>
								<?php
							}
						?>
						<div class="card-body">
							<table class="table">
							  <thead>
								<tr>
								  <th scope="col">No.</th>
								  <th scope="col">Tanggal</th>
								  <th scope="col">Nama</th>
								  <th scope="col">Harga</th>
								  <th scope="col">Tahun</th>
								  <th scope="col">Lokasi</th>
								</tr>
							  </thead>
							  <tbody>
							    <?php
									$no=1;
									$q="SELECT * FROM historymotorbekas WHERE id_user='". $_SESSION["id_user"] ."'";
									echo $q;
									$res=mysqli_query($conn,$q);
									while ($row=mysqli_fetch_assoc($res))
									{
										?>
										<tr>
										  <td>
											<?php
												echo $no++;
											?>
										  </td>
										  <td>
										    <?php
												echo $row["tanggal"];
											?>
										  </td>
										  <td>
										    <?php
												echo $row["nama"];
											?>
										  </td>
										  <td>
										    <?php
												echo $row["harga"];
											?>
										  </td>
										  <td>
										    <?php
												echo $row["tahun"];
											?>
										  </td>
										  <td>
										    <?php
												
												$kota="";
												$q="SELECT * FROM lokasi WHERE id_kota='". $row["id_kota"] ."'";
												//echo $q;
												$res2=mysqli_query($conn,$q);
												if ($row2=mysqli_fetch_assoc($res2))
												{
													$kota=$row2["nama_kota"];
												}
												echo $kota;
												//echo $row["kota"];
											?>
										  </td>
										  <td>
											<a class="btn btn-primary" href="motorbekas.php?<?php echo $row["parameter"];?>">Search</a>
											<a class="btn btn-danger" href="deleteriwayatmotorbekas.php?id=<?php echo $row["id"];?>">Hapus</a>
										  </td>
										  </tr>
										<?php
									}
									
								?>
							  </tbody>
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