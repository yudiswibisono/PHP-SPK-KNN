<?php
	include "conn.php";
	
	$red=0;
	$green=0;
	$blue=0;
	$nred=0;
	$ngreen=0;
	$nblue=0;
	if (isset($_POST['submit'])) {
		if(isset($_POST['groupkota']))
		{
			echo "You have selected :".$_GET['groupkota'];  //  Displaying Selected Value
		}
	}
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
	if (isset($_GET["groupkota"]))
	{
		//$ukota=mysqli_real_escape_string($conn,$_GET["groupkota"]);
		$ukota = $_GET['groupkota'];  
	}
	
	$utransmisi="";
	if (isset($_GET["grouptransmisi"]))
	{
		$utransmisi=mysqli_real_escape_string($conn,$_GET["grouptransmisi"]);
	}
	$uwarna="";
	if (isset($_GET["warna"]))
	{
		$uwarna=mysqli_real_escape_string($conn,$_GET["warna"]);
	}
	$ubakar="";
	if (isset($_GET["groupbk"]))
	{
		$ubakar=mysqli_real_escape_string($conn,$_GET["groupbk"]);
	}
	$uharga="";
	if (isset($_GET["harga"]))
	{
		$uharga=mysqli_real_escape_string($conn,$_GET["harga"]);
	}
	$ujaraktempuh="";
	if (isset($_GET["jaraktempuh"]))
	{
		$ujaraktempuh=mysqli_real_escape_string($conn,$_GET["jaraktempuh"]);
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
	background: url(bgMobil.jpg) no-repeat fixed;
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
							<h3 class="mb-0">Cari Mobil Bekas</h3>
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
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Nama Mobil : </label>
									<div class="col-sm-10">
									  <input class="form-control" placeholder="Masukkan nama/merek/tipe mobil" id="namaMobil" value="<?php echo $uname1;?>" name="namaMobil" type="text" value="">
									</div>
								</div>	
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Kota : </label>
									<div class="col-sm-10">
										<select class="form-control"  selected="<?php echo $ukota;?>" name="groupkota" id="groupkota">
										<option value="" disabled selected>Pilih Kota</option>
										<option></option>
											<?php
												$q="SELECT * FROM lokasi
													ORDER BY nama_kota ASC;
													";
												$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													$selected="";
													if ($row["id_kota"]==$ukota)
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
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Trasnmisi : </label>
									<div class="col-sm-10">
										<select class="form-control" name="grouptransmisi" id="grouptransmisi">
										<option value="" disabled selected>Pilih Transmisi</option>
										<option></option>
											<?php
												$q="SELECT * FROM transmisi
													ORDER BY nama_transmisi ASC;
													";
												$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													$selected="";
													if ($row["nama_transmisi"]==$utransmisi)
													{
														$selected="selected";
													}
													?>
													  
													  <option <?php echo $selected;?> value="<?php echo $row["id_transmisi"];?>">
														<?php
															echo $row["nama_transmisi"];
														?>
													  </option>
													<?php
												}
											?>
											
											
										</select>
									</div>
								</div>	
								<div class="form-group row">
									<label for="uname1" class="col-sm-2 col-form-label" style="text-align:right">Harga : </label> 
									<div class="col-sm-10">
									<input class="form-control" placeholder="Masukkan harga yang diinginkan"  onkeyup="komaharga();" id="harga" value="<?php echo $uharga;?>" name="harga" type="number">
									<label id="lharga"></label>
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Tahun : </label>
									<div class="col-sm-10">
									  <input class="form-control" name="tahun" placeholder="Masukkan tahun mobil yang diinginkan" onkeyup="checktahun();"; id="tahun" value="<?php echo $utahun;?>" type="number" value="">
									</div>
								</div>	
								<div class="form-group row">
									<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label" style="text-align:right">Jenis Bahan Bakar : </label>
									<div class="col-sm-10">
									<select class="form-control" name="groupbk" id="groupbk" >
										<option value="" disabled selected>Pilih Jenis Bahan Bakar</option>
										<option></option>
										<?php
												$q="SELECT * FROM bahanbk
													ORDER BY nama_bahanbk ASC;
													";
												$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													$selected="";
													if ($row["nama_bahanbk"]==$ubakar)
													{
														$selected="selected";
													}
													?>
													  
													  <option <?php echo $selected;?> value="<?php echo $row["id_bahanbk"];?>">
														<?php
															echo $row["nama_bahanbk"];
														?>
													  </option>
													<?php
												}
											?>
											
											
											
									</select>
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
								<div class="form-group row">
									<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label" style="text-align:right">Warna : </label>
									<div class="col-sm-10">
										<select class="form-control" name="warna" id="uwarna">
										<option value="" disabled selected>Pilih Warna</option>
										<option></option>
											<?php
												
												$q="SELECT * FROM warna
												ORDER BY nama_warna ASC;
												";
													
												$res=mysqli_query($conn,$q);
												while ($row=mysqli_fetch_assoc($res))
												{
													$selected="";
													if ($row["nama_warna"]==$uwarna)
													{
														$selected="selected";
													}
													?>
													  <option <?php echo $selected;?> value="<?php echo $row["id_warna"];?>">
														<?php
															echo $row["nama_warna"];
														?>
													  </option>
													<?php
												}
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
									<label for="uname1" class="col-sm-2 col-form-label" style="text-align:right">Jarak Tempuh : </label> 
									<div class="col-sm-10">
									<input class="form-control" id="jaraktempuh" placeholder="Masukkan jarak tempuh yang diinginkan" value="<?php echo $ujaraktempuh;?>" name="jaraktempuh" type="text">
								</div>
								</div>
								<button name="submit" type="submit" class="btn btn-success btn-lg float-right" type="submit">cari</button>
							</form>
							
							
							
						</div><!--/card-block-->
					</div>
					<?php
						if (isset($_SESSION["username"]))
						{
							if (isset($_GET["tahun"]))
							{
								?>
									<div class="card card-outline-secondary">
											<form autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form">
												<a onclick="simpanpencarian();" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="margin-top:10px;margin-bottom:10px;margin-left:10px;">Simpan Pencaraian</a>
												<a href="riwayatuser.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="margin-top:10px;margin-bottom:10px;">History Pencarian</a>
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
					
						
					    $fieldNormalisasi=array("harga","tahun","jarak_tempuh","warna");
						$dataN=array();
						$dataV=array();
						$minVal=0;
						$maxVal=1;
						
						$syarat="";
						if ($uname1!="")
						{
							$syarat=$syarat." AND m.nama LIKE '%$uname1%' ";
						}
						
						if ($uwarna!="")
						{
							$syarat=$syarat." AND ww.id_warna = $uwarna";
						}
						if ($ukota!="")
						{
							$syarat=$syarat." AND ll.id_kota=$ukota ";
						}
						/*if ($uharga!="")
						{
							$syarat=$syarat." AND Harga >= $uharga ";
						}*/
						if ($ubakar!="")
						{
							$syarat=$syarat." AND bkk.id_bahanbk=$ubakar";
						}
						if ($utransmisi!="")
						{
							$syarat=$syarat." AND tt.id_transmisi=$utransmisi";
						}
						$q="SELECT m.nama,m.harga,m.tahun,bk.bahanbk as bahan_bakar, w.warna as warna,t.transmisi as transmisi,".
							"jarak_tempuh,gambar,url,l.lokasi as kota,tipe ".
						   "FROM mobilbekas m ".
						   "INNER JOIN warna_crawling w ON (m.id_warna_crawling=w.id) ".
						   "LEFT JOIN warna ww ON (w.id_warna = ww.id_warna) ".
						   "INNER JOIN lokasi_crawling l ON (m.id_kota_crawling = l.id) ".
						   "LEFT JOIN lokasi ll ON (l.id_kota = ll.id_kota) ".
						   "INNER JOIN transmisi_crawling t ON (m.id_transmisi_crawling = t.id) ".
						   "LEFT JOIN transmisi tt ON (t.id_transmisi = tt.id_transmisi) ".
						   "INNER JOIN bahanbk_crawling bk ON (m.id_bk_crawling = bk.id) ".
						   "LEFT JOIN bahanbk bkk ON (bk.id_bahanbk = bkk.id_bahanbk) ".
						   "WHERE TRUE $syarat ";
						   //echo "<br/>".$q."<br/>";
					//var_dump($q);
						   //"WHERE tipe = 'carmudi' ";
						   //"ORDER BY m.harga ASC,m.tahun DESC,m.jarak_tempuh ASC";
						 
						//echo "q = " . $q;
						 
						$res=mysqli_query($conn,$q);
						while ($row=mysqli_fetch_assoc($res))
						{
							  if (strtolower($row["bahan_bakar"])=="bensin")
							  {
								  $row["sbahan_bakar"]=0;
							  }
							  else if (strtolower($row["bahan_bakar"])=="diesel")
							  {
								  $row["sbahan_bakar"]=1;
							  }
							  array_push($dataV,array(0,0,0));
							  array_push($dataN,$row);
							  
						}
						
						for ($ix=0;$ix<count($fieldNormalisasi);$ix++)//hitung jumlah data
						{
							 if ($fieldNormalisasi[$ix]!="warna")
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
							 }
							 else {
								 /*
								  for ($j=0;$j<count($dataN);$j++)
								  {
									  $row=$dataN[$j];
									  $dataN[$j]["nwarna"]=(($row["R"]/255)+($row["G"]/255)+($row["B"]/255))/1;
								  }
								  */
							 }
							  
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
							$jarakJarak=$normalisasijarakTempuh-$dataN[$i]["njarak_tempuh"];
							$jarakTahun=$normalisasiTahun-$dataN[$i]["ntahun"];
							$jarakHarga=$normalisasiHarga-$dataN[$i]["nharga"];//nor.input-nor.mobil
							/*if ($jarakHarga<0)
							{
								$jarakHarga=$jarakHarga*10000000000000000000000000000;
							}
							if ($jarakJarak<0)
							{
								$jarakJarak=$jarakJarak*10000000000000000000000000000;
							}*/
							//else if ($jarakHarga>0)
							//{
								//$jarakHarga=1-$jarakHarga;
							//}
							//$dataN[$i]["jarakHarga"]=$jarakHarga;
							
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
							
							///echo "Rumus ".$rumus;
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
						$limit=9;
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
						
						$adaPrint=false;
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
							
							
								$adaPrint=true;
							if ($i>=$pg && $i<=$pe)
							{
								//awal
								?> 
									  <div style="height:700px;" class="col-md-4">
										<div class="row" style="border-style: solid;background-color: white;">
											
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
													else if ($gambar =="" || !file_exists("crawler/mobilbekas/gambar/".$gambar))
													{
														//$gambar="nopict.png";
														$url="crawler/mobilbekas/gambar/nopict.png";
													}
													else {
														$url="crawler/mobilbekas/gambar/".$row["gambar"];
													}
												?>
												
												<img  src="<?php echo $url;?>" style="border-style: solid;display:block;margin:auto;height:150px">
												<table class="table table-bordered">
												   <tr>
													 <td bgcolor="#DCDCDC">
													   <strong>
													   <div style="height:20px;font-size:15px;text-align:Center;overflow:hidden">
													   <?php
														echo $row["nama"];
														//echo ",".$dataN[$i]["jarakHarga"]
													   ?>
													   </div>
													   </strong>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Harga : </b> Rp." . number_format($row["harga"])//." ". $row["nharga"];
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Tahun : </b>". $row["tahun"]//." ".$row["ntahun"];
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Jarak Tempuh : </b>". number_format($row["jarak_tempuh"])/*." ".$Djaraktempuh.*///. " km". " " . $row["njarak_tempuh"];;
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Bahan Bakar : </b>". $row["bahan_bakar"]//." ".$Dbahanbakar;
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Warna : </b>". $row["warna"]//." ".$row["nwarna"];
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Transmisi : </b>". $row["transmisi"]//." ".$row["nwarna"];
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
						
						if (!$adaPrint)
						{
							?>
								<div class="container">
									<div class="alert alert-danger" role="alert">
									  Data tidak ditemukan
									</div>
								</div>
							<?php
						}
					?>
				</div>
			</div>
			<?php
				$totalHalaman=ceil(count($dataN)/$limit);
				
			?>
			<div class="col-md-12">
				<nav aria-label="Page navigation example" style="margin-bottom:20px">
									
						<ul class="pagination pagination-lg justify-content-center">
						 <li class="page-item " >
									      <a class="page-link" href="mobilbekas.php?start=0&kepala=-1&namaMobil=<?php echo $uname1;?>&kota=<?php echo $ukota;?>&harga=<?php echo $harga;?>&tahun=<?php echo $tahun;?>&bahanbakar=<?php echo $ubakar;?>&warna=<?php echo $uwarna;?>&jaraktempuh=<?php echo $jarakTempuh;?>">Awal</a>
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
									      <a class="page-link" href="mobilbekas.php?start=<?php echo $i;?>&kepala=-1&namaMobil=<?php echo $uname1;?>&kota=<?php echo $ukota;?>&harga=<?php echo $harga;?>&tahun=<?php echo $tahun;?>&bahanbakar=<?php echo $ubakar;?>&warna=<?php echo $uwarna;?>&jaraktempuh=<?php echo $jarakTempuh;?>"><?php echo ($i+1);?></a>
									   </li>
								<?php
							}
						 ?>
						 <li class="page-item " >
								  <a class="page-link" href="mobilbekas.php?start=<?php echo $totalHalaman-1;?>&kepala=-1&namaMobil=<?php echo $uname1;?>&kota=<?php echo $ukota;?>&harga=<?php echo $harga;?>&tahun=<?php echo $tahun;?>&bahanbakar=<?php echo $ubakar;?>&warna=<?php echo $uwarna;?>&jaraktempuh=<?php echo $jarakTempuh;?>">Akhir</a>
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
							echo "Input Jarak Tempuh : ". $jarakTempuh."<br/>";
							echo "Input Bahan Bakar : ". $bahanbakar."<br/>"."<br/>";
							//echo "Input warna : ". $jarakWarna."<br/>"."<br/>";
							
							echo "min harga : ". $dataN[0]["min_harga"]."<br/>";
							echo "max harga : ". $dataN[0]["max_harga"]."<br/>";
							echo "min jaraktempuh : ". $dataN[0]["min_jarak_tempuh"]."<br/>";
							echo "max jaraktempuh : ". $dataN[0]["max_jarak_tempuh"]."<br/>";
							echo "min tahun : ". $dataN[0]["min_tahun"]."<br/>";
							echo "max tahun : ". $dataN[0]["max_tahun"]."<br/>"."<br/>";
							//echo "min warna : ". $dataN[0]["min_warna"]."<br/>"."<br/>";
							//echo "max warna : ". $dataN[0]["max_warna"]."<br/>"."<br/>";
						
							echo "NorHarga : ". $normalisasiHarga."<br/>";
							echo "NorJarak : ". $normalisasijarakTempuh."<br/>";
							echo "NorTahun : ".$normalisasiTahun."<br/>";
							//echo "NorBahanBakar : ".$normalisasibahanbakar."<br/>"."<br/>";
							//echo "NorWarna : ".$."<br/>"."<br/>";
							
							echo "You have selected :".$_GET['groupkota'];
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
  function checktahun()
  {
		var val=$("#tahun").val();
		var nl=val*1;
		if (val>=3000)
		{
			$("#tahun").val(3000);
		}
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
	  //var msg="";
	  if ($("#namaMobil").val()=="" && $("#harga").val()=="" && 
		  $("#groupkota").val()=="" && $("#grouptransmisi").val()=="" &&
		  $("#harga").val()=="" && $("#tahun").val()=="" && $("#groupbk").val()=="" && 
		  $("#uwarna").val()=="" && $("#jaraktempuh").val()==""
		  )
	  {
		  alert("Salah satu inputan harus diisi");
	  }
	  else 
	  {
		  var param=window.location.search;
		  console.log(param);
		  window.location="simpanhistory.php"+param;
	  }
	  
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