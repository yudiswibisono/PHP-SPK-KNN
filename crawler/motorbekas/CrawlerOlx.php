<?php
	set_time_limit(500);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	
	// create curl resource 
	function getmile($param)
	{
		$aData=explode(" ",$param);
		$hasil=$aData[count($aData)-1];
		$hasil=str_replace(".","",$hasil);
		return str_replace("km","",$hasil);
	}
	function getharga($param)
	{
		$hasil=str_replace(".","",$param);
		return str_replace("Rp","",$hasil);
	}
		
			
	$q="DELETE FROM motorbekas WHERE tipe='olx'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=2;$i++)
	{
			$ch = curl_init(); 

			// set url 
			$url="https://www.olx.co.id/motor/bekas/";
			if ($i!=1)
			{
				$url="https://www.olx.co.id/motor/bekas/?page=".$i;
			}
			curl_setopt($ch, CURLOPT_URL, $url); 

			//return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
			// $output contains the output string 
			$output = curl_exec($ch); 
		
			

			// close curl resource to free up system resources 
			curl_close($ch);      

			
			$html = str_get_html($output);
			foreach($html->find('tr.cursor') as $element) 
			{
				$class=$element->class;
				$aClass=explode(" ",$class);
				//print_r($class);
				//echo "<br/><br/>";
				if (!in_array("promoted",$aClass))
				{
					$htmlDalam=str_get_html($element->innertext);
					//echo "<br/>HTML mulai <br/>";
					//echo $htmlDalam;
					//echo "<br/>akhir<br/>";
					
					$tanggal=$htmlDalam->find("p",0)->innertext;
					
					$img=$htmlDalam->find("img",0)->src;
					$nama=mysqli_real_escape_string($conn,$htmlDalam->find("a",2)->innertext);
					//echo "<br/>test nama : ".$nama."<br/>";
					
					$lokasi=$htmlDalam->find("span",4)->innertext;
					
					$namamobil=($htmlDalam->find("a.detailsLink",0)->innertext);
					//echo $namamobil." : <br/>";
					
					//$mile=getmile($htmlDalam->find("div.mileage",0)->innertext);
					$tahun=$htmlDalam->find("div.year",0)->innertext;
					$harga=getharga($htmlDalam->find("strong.c000",0)->innertext);
					
					$iHref=$htmlDalam->find("a",1)->href;
					$href=mysqli_real_escape_string($conn,$iHref);
					
					
					$random=md5(date("Ymdhis").rand(0,1000).$ctr);
					$namafile=substr($random,0,10).".jpg";
					file_put_contents("gambar/".$namafile, file_get_contents($img));
					/*
					echo $tanggal." : <br/>";
					echo $nama."<br/>";
					echo $lokasi."<br/>";
					//echo $mile."<br/>";
					echo $tahun."<br/>";
					echo $harga."<br/>";
					echo $href."<br/>";
					*/
					
					// kolom kota --> id_kota_crawling di tabel motorbekas
					$lokasi = trim($lokasi);
					$sqlCheck = "SELECT id FROM lokasi_crawling where lokasi IN ('$lokasi')";
					$resultCheck = mysqli_query($conn,$sqlCheck);
					
					if($rowID = mysqli_fetch_assoc($resultCheck)){
						$id = $rowID['id'];
						$q="INSERT INTO motorbekas (url,nama,tahun,id_kota_crawling,harga,gambar,tipe) VALUES ('$href','".trim($nama)."','$tahun','$id','$harga','$namafile','olx')";
						mysqli_query($conn,$q);
						echo "SUDAH ADA";
					}
					else{
						// Insert ke tabel lokasi_crawling
						$sqlInsert = "INSERT INTO lokasi_crawling (lokasi) VALUES ('$lokasi')";
						mysqli_query($conn,$sqlInsert);
						
						// Get last insert id 
						$lastid = mysqli_insert_id($conn);
						
						$q="INSERT INTO motorbekas (url,nama,tahun,id_kota_crawling,harga,gambar,tipe) VALUES ('$href','".trim($nama)."','$tahun','$lastid','$harga','$namafile','olx')";
						mysqli_query($conn,$q);
						echo $q;
					}
					
					//$q="INSERT INTO motorbekas (url,nama,tahun,kota,harga,gambar,tipe) VALUES ('$href','".trim($nama)."','$tahun','$lokasi','$harga','$namafile','olx')";
					//mysqli_query($conn,$q);
					//echo $q;
					
					
					echo $posSpan=0;
				
					/*foreach($htmlDalam->find('span') as $element2) 
					{
						echo $posSpan.",".$element2->innertext."<br/>";
						$posSpan++;
					}*/
					//echo "<br/><br/>";
					//file_put_contents("gambar/".$namafile.".jpg", file_get_contents($img));
					
					
					//echo $img."<br/>";
					//echo "Tanggal ".;
					//echo "<br/>";
					
					$ctr++;
					//echo $element->innertext  . '<br/><br/><br/>';
				}
				
			}
			
			sleep(3);
	}

	
	
	//echo $output;
?>