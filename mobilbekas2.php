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
						<div class="card-body" style="opacity:0.9;">
							<form autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form">
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Nama Mobil : </label>
									<div class="col-sm-10">
									  <input class="form-control" id="uname1" value="<?php echo $uname1;?>" name="namaMobil" type="text" value="">
									</div>
								</div>	
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Kota : </label>
									<div class="col-sm-10">
									  <input class="form-control" type="text" value="">
									</div>
								</div>	
								<div class="form-group row">
									<label for="uname1" class="col-sm-2 col-form-label" >Harga : </label> 
									<div class="col-sm-10">
									<input class="form-control" onkeyup="komaharga();" id="harga" name="harga" type="text">
									<label id="lharga"></label>
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:right">Tahun : </label>
									<div class="col-sm-10">
									  <input class="form-control" name="tahun" type="text" value="">
									</div>
								</div>	
								<div class="form-group row">
									<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Jenis Bahan Bakar : </label>
									<div class="col-sm-10">
									<select class="form-control" name="bahanbakar" id="exampleFormControlSelect1" >
										<option></option>
										<option>Bensin</option>
										<option>Diesel</option>
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
									<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Warna : </label>
									<div class="col-sm-10">
									<input class="form-control" type="color" value="#<?php echo rgb2hex($nred,$ngreen,$nblue,false,true); ?>" onchange="test(this)" onkeyup="test(this)" id="color"/>
									<input type="hidden" name="red" id="red"/>
									<input type="hidden" name="green" id="green"/>
									<input type="hidden" name="blue" id="blue"/>
									</div>
								</div>
								<div class="form-group row">
									<label for="uname1" class="col-sm-2 col-form-label">Jarak Tempuh : </label> 
									<div class="col-sm-10">
									<input class="form-control" id="uname1" name="jaraktempuh" type="text">
								</div>
								</div>
								<button name="submit" type="submit" class="btn btn-success btn-lg float-right" type="submit">cari</button>
							</form>
							
							
							
						</div><!--/card-block-->
					</div>
					<?php
						if (isset($_SESSION["username"]))
						{
							?>
								<div class="card card-outline-secondary">
										<form autocomplete="off" class="form" id="formMobilBekas" name="formLogin" role="form">
											<a onclick="simpanpencarian();" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Simpan Pencaraian</a>
											<a href="riwayatuser.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">History Pencarian</a>
										</form>
								</div>
							<?php
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
						$q="SELECT m.*,COALESCE(w.R,0) AS R,COALESCE(w.G,0) as G,COALESCE(w.B,0) as B ".
						   "FROM mobilbekas m ".
						   "LEFT JOIN warna w ON (w.Warna=m.warna) ".
						   "WHERE TRUE $syarat";
						   
						   
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
						
						for ($ix=0;$ix<count($fieldNormalisasi);$ix++)
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
								  for ($j=0;$j<count($dataN);$j++)
								  {
									  $row=$dataN[$j];
									  $dataN[$j]["nwarna"]=(($row["R"]/255)+($row["G"]/255)+($row["B"]/255))/1;
								  }
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
						
						
						
						//tahun
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
						
					    for ($i=0;$i<count($dataN);$i++)
						{
							$jarakJarak=$normalisasijarakTempuh-$dataN[$i]["njarak_tempuh"];
							$jarakTahun=$normalisasiTahun-$dataN[$i]["ntahun"];
							$jarakHarga=$normalisasiHarga-$dataN[$i]["nharga"];
							$jarakWarna=(($red+$green+$blue)/3)-$dataN[$i]["nwarna"];
							//$jarakBahan=$normalisasibahanbakar-$dataN[$i]["nbahan_bakar"];
							$jarakBahan=0;
							if ($bahanbakar=="Bensin")
							{
								$jarakBahan=1;
							}
							else if ($bahanbakar=="Diesel")
							{
								$jarakBahan=0;
							}
							//ecluedian distance = masih isinya harga, tahun, kilometer
							//$dataN[$i]["distance"]=sqrt(pow($jarakHarga,2)+pow($jarakTahun,2)+pow($jarakJarak,2)+pow($jarakBahan,2));
							
							//mahattan distance
							//$dataN[$i]["distance"]=abs($jarakHarga)+abs($jarakTahun)+abs($jarakJarak)+abs($jarakBahan);
							
							//minkowski distance
							
							$total=0;
							if ($harga!="" && $harga!="0")
							{
								$Dharga=$total+=abs(pow($jarakHarga,3));
							}
							if ($tahun!="" && $tahun!="0")
							{
								$total+=abs(pow($jarakTahun,3));
							}
							if ($jarakTempuh!="" && $jarakTempuh!="0")
							{
								$total+=abs(pow($jarakJarak,3));
							}
							if ($bahanbakar!="" && $bahanbakar!="0")
							{
								$total+=abs(pow($jarakBahan,3));
							}
							
							$dataN[$i]["distance"]=sqrt($total);
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
						
						for ($i=0;$i<count($dataN);$i++)
						{
							$row=$dataN[$i];
							$namaK=$row["nama"];
							$score=$row["distance"];
							
							if ($kepala!="-1")
							{
								$q="INSERT INTO hasilpencarian (namakendaraan,score,id_kepala) VALUES ('$namaK','$score','$idk') ";
								mysqli_query($conn,$q);
							}
							
							
							
							if ($i>=$pg && $i<=$pe)
							{
								//awal
								?> 
									  <div style="height:650px;" class="col-md-4">
										<div class="row" style="border-style: solid;background-color: white;opacity:0.9;">
											
											<div class="col-md-12">
											<?php
													$gambar=$row["gambar"];
													/*
													if ($gambar=="" || !file_exists("gambar/".$gambar))
													{
														$gambar="nopict.png";
													}*/
												?>
												
												<img src="gambar/<?php echo $gambar;?>" style="border-style: solid;display:block;margin:auto;height:150px">
												<table class="table table-bordered">
												   <tr>
													 <td bgcolor="#DCDCDC">
													   <strong>
													   <div style="height:80px;font-size:15px;text-align:Center;overflow:hidden">
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
														echo "<b>Harga : </b>". number_format($row["harga"])." ".$Dharga;
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Tahun : </b>". $row["tahun"]." ".$row["ntahun"];
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Jarak Tempuh : </b>". number_format($row["jarak_tempuh"])." ".$row["njarak_tempuh"];
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Bahan Bakar : </b>". $row["bahan_bakar"]." ".$row["sbahan_bakar"];
													   ?>
													 </td>
												   </tr>
												   <tr>
													 <td bgcolor="#ffffff" style="font-size:15px;text-align:left">
													   <?php
														echo "<b>Warna : </b>". $row["warna"]." ".$row["nwarna"];
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
			<nav aria-label="Page navigation example" style="margin-top:10px;margin-bottom:20px">
				  <ul class="pagination">
					 <?php
						for ($i=0;$i<$totalHalaman;$i++)
						{
							$active="";
							if ($i==$start)
							{
								$active="active";
							}
							?>
								   <li class="page-item  <?php echo $active;?>" ><a class="page-link" href="mobilbekas.php?start=<?php echo $i;?>&kepala=-1&namaMobil=<?php echo $uname1;?>&harga=<?php echo $harga;?>"><?php echo $i;?></a></li>
							<?php
						}
					 ?>
				  </ul>
			</nav>
			
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
	  window.location="simpanhistory.php"+param;
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