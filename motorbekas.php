<?php
	include "conn.php";
	
	$red=0;
	$green=0;
	$blue=0;
	$nred=0;
	$ngreen=0;
	$nblue=0;
	if (isset($_GET["red"]))
	{
		$nred=$_GET["red"];
		$red=mysqli_real_escape_string($conn,$_GET["red"])/255;
	}
	if (isset($_GET["green"]))
	{
		$ngreen=$_GET["green"];
		$green=mysqli_real_escape_string($conn,$_GET["green"])/255;
	}
	if (isset($_GET["blue"]))
	{
		$nblue=$_GET["blue"];
		$blue=mysqli_real_escape_string($conn,$_GET["blue"])/255;
	}
	
	$uname1="";
	if (isset($_GET["namaMobil"]))
	{
		$uname1=mysqli_real_escape_string($conn,$_GET["namaMobil"]);
	}
	$ukota="";
	if (isset($_GET["kota"]))
	{
		$ukota=mysqli_real_escape_string($conn,$_GET["kota"]);
	}
	$uharga="";
	if (isset($_GET["harga"]))
	{
		$uharga=mysqli_real_escape_string($conn,$_GET["harga"]);
	}
	$warna="";
	if (isset($_GET["warna"]))
	{
		$warna=mysqli_real_escape_string($conn,$_GET["warna"]);
	}
	$utahun="";
	if (isset($_GET["tahun"]))
	{
		$utahun=mysqli_real_escape_string($conn,$_GET["tahun"]);
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
	background: url(bgmotor.jpg) no-repeat fixed;
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
				<h2 style="text-align: center;">Sistem Pemilihan Mobil Dan Motor</h2></br>

				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">Cari Sepeda Motor Bekas</h3>
						</div>
						<?php
							if (isset($_GET["w"]))
							{
								?>
								  <div class="alert alert-success" role="alert">
								    <?php
										echo $_GET["w"];
									?>
								  </div>
								<?php
							}
						?>
						<div class="card-body" style="opacity:0.9;">
							<form autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form">
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Nama Motor : </label>
									<div class="col-sm-10">
									  <input class="form-control" placeholder="Masukkan nama/merek sepeda motor" id="uname1" value="<?php echo $uname1;?>" name="namaMobil" type="text" value="">
									</div>
								</div>	
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Kota : </label>
									<div class="col-sm-10">
										<select class="form-control" name="kota" id="ukota">
										<option value="" disabled selected>Pilih kota</option>
										<option></option>
											<?php
												$q="SELECT * FROM lokasi
													ORDER BY nama_kota ASC;
													";
													
													$res=mysqli_query($conn,$q);
													while ($row=mysqli_fetch_assoc($res))
													{
													$selected="";
													if ($row["nama_kota"]==$ukota)
													{
														$selected="selected";
													}
													?>
													  
													  <option <?php echo $selected;?> value="<?php echo $row["id_kota"];?>">
														<?php
															echo $row["nama_kota"];
														?>
													  </option>
													<?php
												}
												/*$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													?>
													  <option value="<?php echo $row["kota"];?>">
														<?php
															echo $row["kota"];
														?>
													  </option>
													<?php
												}*/
											?>
												
											
											
											<?php
												/*$q="SELECT distinct tahun FROM mobilbekas
													ORDER BY tahun ASC;
													";
												$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													?>
													  <option value="<?php echo $row["tahun"];?>">
														<?php
															echo $row["tahun"];
														?>
													  </option>
													<?php
												}*/
											?>
										</select>
									</div>
								</div>	
								<div class="form-group row">
									<label for="uname1" class="col-sm-2 col-form-label" style="text-align:right">Harga : </label> 
									<div class="col-sm-10">
									<input class="form-control" placeholder="Masukkan harga sepeda motor" value="<?php echo $uharga;?>" onkeyup="komaharga();" id="harga" name="harga" type="text">
									<label id="lharga"></label>
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Tahun : </label>
									<div class="col-sm-10">
									  <input class="form-control" placeholder="Masukkan tahun sepeda motor" value="<?php echo $utahun;?>" name="tahun" type="number" value="">
									</div>
								</div>	
								<?php
										function rgb2hex($r, $g, $b, $uppercase=false, $shorten=false)
										{
											  // The output
											  $out = "";
											 
											  // If shorten should be attempted, determine if it is even possible
											  if ($shorten && ($r + $g + $b) % 17 !== 0) $shorten = false;
											 
											  // Red, green and blue as color
											  foreach (array($r, $g, $b) as $c)
											  {
												// The HEX equivalent
												$hex = base_convert($c, 10, 16);
											 
												// If it should be shortened, and if it is possible, then
												// only grab the first HEX character
												if ($shorten) $out .= $hex[0];
											 
												// Otherwise add the full HEX value (if the decimal color
												// is below 16 then we have to prepend a 0 to it)
												else $out .= ($c < 16) ? ("0".$hex) : $hex;
											  }
											  // Package and away we go!
											  return $uppercase ? strtoupper($out) : $out;
										}
								?>
								
								<button name="submit" type="submit" class="btn btn-success btn-lg float-right" type="submit">cari</button>
							</form>
							
							
							
						</div><!--/card-block-->
					</div>
					<?php
						if (isset($_SESSION["username"]))
						{
							if (isset($_GET["harga"]))
							{
							?>
								<div class="card card-outline-secondary">
										<form autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form">
											<a onclick="simpanpencarian();" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Simpan Pencaraian</a>
											<a href="riwayatmotorbekas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">History Pencarian</a>
										</form>
								</div>
							<?php
							}
						}
					?>
					
				</div>
			</div>
			
			<div class="container" style="margin-top:10px">
				<div class="row">
					<?php
					
						
					    $fieldNormalisasi=array("harga","tahun");
						$dataN=array();
						$dataV=array();
						$minVal=0;
						$maxVal=1;
						
						$syarat="";
						if ($uname1!="")
						{
							$syarat=$syarat." AND m.nama LIKE '%$uname1%' ";
						}
						
						if ($warna!="")
						{
							$syarat=$syarat." AND m.warna IN (SELECT Warna FROM warna WHERE GroupWarna='$warna') ";
						}
						
						if ($ukota!="")
						{
							$syarat=$syarat." AND c.id_kota = $ukota";
						}
						$q="SELECT id_motor_bekas,nama,harga,tahun,b.lokasi as kota,gambar,url ".
						   "FROM motorbekas m INNER JOIN lokasi_crawling b ON m.id_kota_crawling=b.id LEFT JOIN lokasi c ON b.id_kota = c.id_kota ".
						   "WHERE TRUE $syarat"; 
						
						$res=mysqli_query($conn,$q);
						while ($row=mysqli_fetch_assoc($res))
						{
							  
							  array_push($dataV,array(0,0,0));
							  array_push($dataN,$row);
							  
						}
						
						for ($ix=0;$ix<count($fieldNormalisasi);$ix++)
						{
							 
								 $data=array();
								  for ($j=0;$j<count($dataN);$j++)
								  {
									  $row=$dataN[$j];
									  array_push($data,$row[$fieldNormalisasi[$ix]]);
								  }
								  
								  
								  $minVal1=1000000000;
								  $maxVal1=-1000000;
								  for ($i=0;$i<count($data);$i++)
								  {
									  if ($data[$i]<$minVal1)
									  {
										  $minVal1=$data[$i];
									  }
									  if ($data[$i]>$maxVal1)
									  {
										  $maxVal1=$data[$i];
									  }
								  }
								  
								   for ($i=0;$i<count($data);$i++)
								   {
										  //echo $data[$i];
										  //echo $maxVal1."<br/>".$minVal1."<br/>";
										  
										  $pembagi=$maxVal1-$minVal1;
										  
										  $normalisasi=0;
										  if ($pembagi!=0)
										  {
											  $normalisasi=($data[$i]-$minVal1)/$pembagi;
										  }
										  
										  //$dataV[$i][$ix]=$normalisasi;
										  $dataN[$i]["n".$fieldNormalisasi[$ix]]=$normalisasi;
										  $dataN[$i]["max_".$fieldNormalisasi[$ix]]=$maxVal1;
										  $dataN[$i]["min_".$fieldNormalisasi[$ix]]=$minVal1;
										  
								   }
							
								 /*
								  for ($j=0;$j<count($dataN);$j++)
								  {
									  $row=$dataN[$j];
									  $dataN[$j]["nwarna"]=(($row["R"]/255)+($row["G"]/255)+($row["B"]/255))/1;
								  }
								  */
							 
							  
						}
						  
						  
						//print_r($dataN);
						
						
						//$q="SELECT * FROM mobilbekas";
						//$res=mysqli_query($conn,$q);
						//while ($row=mysqli_fetch_assoc($res))
						$harga=0;
						if (isset($_GET["harga"]))
						{
							$harga=mysqli_real_escape_string($conn,$_GET["harga"]);
						}
						
						$normalisasiHarga=0;
						
						//hitung normalisasi harga
						if ($harga!="")
						{
							$maxHarga=0;
							$minHarga=0;
							if (count($dataN)>=1)
							{
								$maxHarga=$dataN[0]["max_harga"];
								$minHarga=$dataN[0]["min_harga"];
							}

							$pembagi=$maxHarga-$minHarga;
							$normalisasi=0;
							
							if ($pembagi!=0)
							{
								  $normalisasiHarga=($harga-$minHarga)/$pembagi;
							}
							
						}
						
						
						
						//hitung normalisasi tahun
						$tahun=0;
						if (isset($_GET["tahun"]))
						{
							$tahun=mysqli_real_escape_string($conn,$_GET["tahun"]);
						}
						
						$normalisasiTahun=0;
						
						if ($tahun!="")
						{
							$maxTahun=0;
							$minTahun=0;
							if (count($dataN)>=1)
							{
								$maxTahun=$dataN[0]["max_tahun"];
								$minTahun=$dataN[0]["min_tahun"];
							}
							
							
							
							
							$pembagi=$maxTahun-$minTahun;
							$normalisasi=0;
							if ($pembagi!=0)
							{
								  $normalisasiTahun=($tahun-$minTahun)/$pembagi;
							}
						}
						
						
						//=================================================================
						
						//jarakTempuh
						$jarakTempuh=0;
						if (isset($_GET["jaraktempuh"]))
						{
							$jarakTempuh=mysqli_real_escape_string($conn,$_GET["jaraktempuh"]);
						}
						$normalisasijarakTempuh=0;
						
						if ($jarakTempuh!="")
						{
							$maxJarakTempuh=$dataN[0]["max_jarak_tempuh"];
							$minJarakTempuh=$dataN[0]["min_jarak_tempuh"];
							
							
							
							$pembagi=$maxJarakTempuh-$minJarakTempuh;
							$normalisasi=0;
							if ($pembagi!=0)
							{
								  $normalisasijarakTempuh=($jarakTempuh-$minJarakTempuh)/$pembagi;
							}
						}
						
						
						//=================================================================
						
						//jenis bahan bakar
						
						$bahanbakar=0;
						if (isset($_GET["bahanbakar"]))
						{
							$bahanbakar=mysqli_real_escape_string($conn,$_GET["bahanbakar"]);
						}
						
						$normalisasibahanbakar=0;
						
						if ($bahanbakar=="Bensin")
						{
							$maxbahanbakar=1;
							$minbahanbakar=0;
							$pembagi=$maxbahanbakar-$minbahanbakar;
							$normalisasi=0;
							$normalisasibahanbakar=(1-$minbahanbakar)/$pembagi;
							
						}
						else if ($bahanbakar=="Diesel")
						{
							$maxbahanbakar=1;
							$minbahanbakar=0;
							$pembagi=$maxbahanbakar-$minbahanbakar;
							$normalisasi=0;
							$normalisasibahanbakar=(0-$minbahanbakar)/$pembagi;
							
						}
						
						//=================================================================
						
						//warna
						/*
						$bahanbakar=0;
						if (isset($_GET["bahanbakar"]))
						{
							$bahanbakar=mysqli_real_escape_string($conn,$_GET["bahanbakar"]);
						}
						echo $bahanbakar."<br/>";
						$normalisasibahanbakar=0;
						
						if ($bahanbakar!="")
						{
							$maxbahanbakar=1;
							$minbahanbakar=0;
							$pembagi=$maxbahanbakar-$minbahanbakar;
							$normalisasi=0;
							if ($pembagi!=0)
							{
								  $normalisasibahanbakar=($bahanbakar-$minjarakTempuh)/$pembagi;
							}
						
						echo $normalisasibahanbakar."<br/>";
						}*/
						//=================================================================
						
						$rumus="";
						$q="SELECT * FROM rumus WHERE status='aktif'";
					    $res=mysqli_query($conn,$q);
						if ($row=mysqli_fetch_assoc($res))
						{
							$rumus=$row["nama"];
						}
						
						//echo "rumus :".$rumus;
						for ($i=0;$i<count($dataN);$i++)
						{
							$jarakTahun=$normalisasiTahun-$dataN[$i]["ntahun"];
							$jarakHarga=$normalisasiHarga-$dataN[$i]["nharga"];
							//$jarakWarna=(($red+$green+$blue)/3)-$dataN[$i]["nwarna"];
							//$jarakBahan=$normalisasibahanbakar-$dataN[$i]["nbahan_bakar"];
							$jarakBahan=0;
							if ($bahanbakar=="Bensin")
							{
								$jarakBahan=0;
							}
							else if ($bahanbakar=="Diesel")
							{
								$jarakBahan=1;
							}
							//ecluedian distance = masih isinya harga, tahun, kilometer
							//$dataN[$i]["distance"]=sqrt(pow($jarakHarga,2)+pow($jarakTahun,2)+pow($jarakJarak,2)+pow($jarakBahan,2));
							$total=0;
							if ($rumus=="Eucledian Distance")
							{
								if ($harga!="" && $harga!="0")
								{
									$Dharga=$total+=pow($jarakHarga,2);
								}
								if ($tahun!="" && $tahun!="0")
								{
									$Dtahun=$total+=pow($jarakTahun,2);
								}
								if ($jarakTempuh!="" && $jarakTempuh!="0")
								{
									$Djaraktempuh=$total+=pow($jarakJarak,2);
								}
								if ($bahanbakar!="" && $bahanbakar!="0")
								{
									$Dbahanbakar=$total+=pow($jarakBahan,2);
								}
								$dataN[$i]["distance"]=sqrt($total);
							}
							
							else if ($rumus=="Minkowski Distance")
							{
								if ($harga!="" && $harga!="0")
								{
									$Dharga=$total+=pow(abs($jarakHarga),3);
								}
								if ($tahun!="" && $tahun!="0")
								{
									$Dtahun=$total+=pow(abs($jarakTahun),3);
								}
								if ($jarakTempuh!="" && $jarakTempuh!="0")
								{
									$Djaraktempuh=$total+=pow(abs($jarakJarak),3);
								}
								if ($bahanbakar!="" && $bahanbakar!="0")
								{
									$Dbahanbakar=$total+=pow(abs($jarakBahan),3);
								}
								
								$dataN[$i]["distance"]=pow($total,1/3);
							}
							
							else if ($rumus=="Manhattan Distance")
							{
								if ($harga!="" && $harga!="0")
								{
									$Dharga=$total+=abs($jarakHarga);
								}
								if ($tahun!="" && $tahun!="0")
								{
									$Dtahun=$total+=abs($jarakTahun);
								}
								if ($jarakTempuh!="" && $jarakTempuh!="0")
								{
									$Djaraktempuh=$total+=abs($jarakJarak);
								}
								if ($bahanbakar!="" && $bahanbakar!="0")
								{
									$Dbahanbakar=$total+=abs($jarakBahan);
								}
								
								$dataN[$i]["distance"]=($total);
							}
							
							
							//mahattan distance
							//$dataN[$i]["distance"]=abs($jarakHarga)+abs($jarakTahun)+abs($jarakJarak)+abs($jarakBahan);
							
							
							//minkowski distance
							/*$total=0;
							if ($harga!="" && $harga!="0")
							{
								$Dharga=$total+=abs(pow($jarakHarga,3));
							}
							if ($tahun!="" && $tahun!="0")
							{
								$Dtahun=$total+=abs(pow($jarakTahun,3));
							}
							if ($jarakTempuh!="" && $jarakTempuh!="0")
							{
								$Djaraktempuh=$total+=abs(pow($jarakJarak,3));
							}
							if ($bahanbakar!="" && $bahanbakar!="0")
							{
								$Dbahanbakar=$total+=abs(pow($jarakBahan,3));
							}
							
							$dataN[$i]["distance"]=sqrt($total);*/
						}							
						for ($i=0;$i<count($dataN);$i++)
						{
							for ($j=$i+1;$j<count($dataN);$j++)
							{
								if ($dataN[$i]["distance"]>$dataN[$j]["distance"])
								{
									$temp=$dataN[$j];
									$dataN[$j]=$dataN[$i];
									$dataN[$i]=$temp;
								}
							}
						}
						
						
						$start=0;
						if (isset($_GET["start"]))
						{
							$start=$_GET["start"];
						}
						$limit=12;
						$pg=$start*$limit;
						$pe=$pg+$limit-1;
						
						$kepala="";
						if (isset($_GET["kepala"]))
						{
							$kepala=$_GET["kepala"];
						}
						
						if ($kepala!="-1")
						{
							$q="INSERT INTO kepala (tanggal,keyword,kategori) VALUES (SYSDATE(),'$uname1','mobil bekas') ";
							mysqli_query($conn,$q);
							$idk=mysqli_insert_id($conn);
						}
						
						for ($i=0;$i<count($dataN);$i++)
						{
							$row=$dataN[$i];
							$namaK=$row["nama"];
							$score=$row["distance"];
							
							/*if ($kepala!="-1")
							{
								$q="INSERT INTO hasilpencarian (namakendaraan,score,id_kepala) VALUES ('$namaK','$score','$idk') ";
								mysqli_query($conn,$q);
							}*/
							
							
							
							if ($i>=$pg && $i<=$pe)
							{
								//awal
								?> 
									  <div style="height:500px;" class="col-md-4">
										<div class="row" style="border-style: solid;background-color: white;opacity:0.97;">
											
											<div class="col-md-12">
											<?php
													$gambar=$row["gambar"];
													
													//if (strpos($gambar, $findme))
													$pos = strpos($gambar, "static.carmudi.co.id/");
													$url="";
													if ($pos !== false) {												
														$gambar=$row["gambar"];
														$url="http://".$row["gambar"];
													}
													else if ($gambar =="" || !file_exists("crawler/motorbekas/gambar/".$gambar))
													{
														//$gambar="nopict.png";
														$url="crawler/motorbekas/gambar/nopict.png";
													}
													else {
														$url="crawler/motorbekas/gambar/".$row["gambar"];
													}
												?>
												
												<img  src="<?php echo $url;?>" style="border-style: solid;display:block;margin:auto;height:150px">
												<table class="table table-bordered">
												   <tr>
													 <td bgcolor="#DCDCDC">
													   <strong>
													   <div style="height:50px;font-size:15px;text-align:Center;overflow:hidden">
													   <?php
														echo $row["nama"];
													   ?>
													   </div>
													   </strong>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Harga :</b> Rp.". number_format($row["harga"])//." ".$Dharga;
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Tahun : </b>". $row["tahun"]//." ".$Dtahun;
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Kota : </b>". $row["kota"]//." ".$row["nwarna"];
													   ?>
													 </td>
												   </tr>
													<tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:Center">
													   <?php
														echo "<b>Hasil Distance : </b>". $row["distance"]."<br/>";
													   ?>
													 </td>
												   </tr>
												   
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:Center"> 
													   <a href="<?php echo $row["url"];?>">
														 Detail
													   </a>
													 </td>
												   </tr>
												</table>
											</div>
										</div>
									  </div>
									<?php
								//akhir
							}
							
							
							
							
						}
					?>
				</div>
			</div>
			<?php
				$totalHalaman=ceil(count($dataN)/$limit);
				
			?>
			<div class="col-md-12">
				<nav aria-label="Page navigation example" style="margin-top:10px;margin-bottom:20px">
					  <ul class="pagination pagination-lg justify-content-center">
						 <li class="page-item " >
							<a class="page-link" href="motorbekas.php?start=0&kepala=-1&namaMobil=<?php echo $uname1;?>&kota=<?php echo $ukota;?>&harga=<?php echo $harga;?>&tahun=<?php echo $tahun;?>">Awal</a>
						 </li>
						 <?php
						    $sm=$start-5;
							$ss=$start+5;
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
									      <a class="page-link" href="motorbekas.php?start=<?php echo $i;?>&kepala=-1&namaMobil=<?php echo $uname1;?>&harga=<?php echo $harga;?>"><?php echo ($i+1);?></a>
									   </li>
								<?php
							}
						 ?>
						 <li class="page-item " >
								  <a class="page-link" href="motorbekas.php?start=<?php echo $totalHalaman-1;?>&kepala=-1&namaMobil=<?php echo $uname1;?>&kota=<?php echo $ukota;?>&harga=<?php echo $harga;?>&tahun=<?php echo $tahun;?>">Akhir</a>
						 </li>
					  </ul>
				</nav>
			</div>
			
			
			<div class="card" style="margin-top:10px">
				<div class="card-header">
					<b>Perhitungan Normalisasi</b>
				</div>
				<div class="card-body">
					<h5 class="card-title">============================================================================</h5>
					
						<?php
						if (count($dataN)>=1)
						{
							echo "Input Harga : ". $harga."<br/>";
							echo "Input Tahun : ". $tahun."<br/>";
							//echo "Input warna : ". $jarakWarna."<br/>"."<br/>";
							
							echo "min harga : ". $dataN[0]["min_harga"]."<br/>";
							echo "max harga : ". $dataN[0]["max_harga"]."<br/>";
							echo "min tahun : ". $dataN[0]["min_tahun"]."<br/>";
							echo "max tahun : ". $dataN[0]["max_tahun"]."<br/>"."<br/>";
							//echo "min warna : ". $dataN[0]["min_warna"]."<br/>"."<br/>";
							//echo "max warna : ". $dataN[0]["max_warna"]."<br/>"."<br/>";
						
							echo "NorHarga : ". $normalisasiHarga."<br/>";
							echo "NorTahun : ".$normalisasiTahun."<br/>";
							//echo "NorBahanBakar : ".$normalisasibahanbakar."<br/>"."<br/>";
							//echo "NorWarna : ".$."<br/>"."<br/>";
						}
						
						
						?>
						<h5 class="card-title">============================================================================</h5>
				</div>
			</div>
	</div>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
   function hexToRgb(hex) {
		  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		  return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		  } : null;
  }
  function getDollar(num) {
    var p = num.toFixed(2).split(".");
    return "Rp" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num=="-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
  }
  function test(t)
  {
	  getColor();
	  //console.log(t.value);
  }
  function getColor()
  {
	  var val=document.getElementById("color").value;
	  //console.log(val);
	  var color=hexToRgb(val);
	  //console.log(color.r+","+color.g+","+color.b)
	  $("#red").val(color.r);
	  $("#green").val(color.g);
	  $("#blue").val(color.b);
	  //console.log("in here");
	  //var color=$("#color").val();
	  
  }
  function simpanpencarian()
  {
	  var param=window.location.search;
      console.log(param);
	  window.location="simpanhistorymotorbekas.php"+param;
  }
  function komaharga()
  {
	var harga=$("#harga").val();
	$("#lharga").html(getDollar(harga*1));
		
  }
  $(document).ready(function()
  {
	  getColor();
	  //alert("1234");
  });
  

</script>	


</html>