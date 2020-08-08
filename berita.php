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
							<h3 class="mb-0">Berita</h3>
						</div>
						<!--/card-block-->
						<ul class="list-unstyled">
							<?php
								$start=0;
								if (isset($_GET["start"]))
								{
									$start=$_GET["start"];
								}
								$limit=10;
								$pg=$start*$limit;
								$pe=$pg+$limit-1;
								
								$ttl=0;
								$q="SELECT COUNT(id) as ttl FROM berita";
								$res=mysqli_query($conn,$q);
								while ($row=mysqli_fetch_assoc($res))
								{
									$ttl=$row["ttl"];
								}
								
								$q="SELECT * FROM berita LIMIT $limit OFFSET $pg";
								$res=mysqli_query($conn,$q);
								while ($row=mysqli_fetch_assoc($res))
								{
									?>
										  <li class="media" style="margin-bottom:15px;margin-top:15px;margin-left:15px;margin-right:15px;border-style: ridge;">
											<img style="border:solid 1px #000000;width:200px;margin-top:10px;margin-left:10px;margin-bottom:10px;" src="<?php echo $row["gambar"];?>" class="mr-3" alt="...">
											<div class="media-body">
											  <u><a href="<?php echo $row["url"];?>" target="_blank" style="font-size:20px;" class="mt-0 mb-1"></u>
												<?php
													echo $row["judul"];
												?>
											  </a>
											  <br/>
											  <?php
												echo $row["text"];
											  ?>
											</div>
										  </li>
									<?php
								}
							?>
							  
						</ul>
					</div>
				</div>
				
				 <!--awal-->
				 <?php
						$totalHalaman=ceil($ttl/$limit);
				
					?>
					<div class="col-md-12">
						<nav aria-label="Page navigation example" style="margin-bottom:20px">
											
								<ul class="pagination pagination-lg justify-content-center">
								 <?php
									$sm=$start-10;
									$ss=$start+10;
									if ($sm<=0)
									{
										$sm=0;
									}
									if ($ss>$totalHalaman)
									{
										$ss=$totalHalaman;
									}
									for ($i=$sm;$i<$ss;$i++)
									{
										$active="";
										if ($i==$start)
										{
											$active="active";
										}
										?>
											   <li class="page-item  <?php echo $active;?>" >
												  <a class="page-link" href="berita.php?start=<?php echo $i;?>"><?php echo ($i+1);?></a>
											   </li>
										<?php
									}
								 ?>
							  </ul>
						</nav>
					</div>
				 <!--akhir-->
			</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>



</html>