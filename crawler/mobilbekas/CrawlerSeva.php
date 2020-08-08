<?php
	set_time_limit(120);
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
	
	
	//for ()
		
	$q="DELETE FROM mobilbekas WHERE tipe='seva'";
	mysqli_query($conn,$q);
	
	for ($page=0;$page<4;$page++)
	{
		$ch = curl_init(); 
		$url="https://www.seva.id/otomotif/in/oto/mobil/bekas/tipe/c/USEDCARTYPE?q=%3Arelevance&page=".$page;
		//return the transfer as a string 
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
		// $output contains the output string 
		$output = curl_exec($ch); 

		$output = curl_exec($ch);
				
		//echo $output;
		$ctr=1;
		$html=str_get_html($output);
		foreach($html->find('div.wishlist-items') as $detailli) 
		{
			$isi=$detailli->innertext;
			//echo $isi."<br/><br/>";
			
			$htmlDalam=str_get_html($isi);
			
			/*$nomor=0;
			foreach($detailli->find('span') as $detailli)
			{
				echo $nomor.":".$detailli->innertext;
				echo "<br/>";
			}*/
			
			//echo $htmlDalam."<br/>";
			$namaMobil=$htmlDalam->find("span.prod_name",0)->innertext;
			$tipeMobil=$htmlDalam->find("span.prod_name",1)->innertext;
			$brand=$htmlDalam->find("span._brand-name",0)->innertext;
			$sharga=$htmlDalam->find("span._rp",0)->innertext;
			$tahun=$htmlDalam->find("span.product_year",0)->innertext;
			$kilometer=$htmlDalam->find("span.product_km",0)->innertext;
			$bahanBakar=$htmlDalam->find("span.product_fuel",0)->innertext;
			
			$srcgambar=$htmlDalam->find("img",1)->src;
			$href=$htmlDalam->find("a",0)->href;
			
			//echo "gambar : ".$srcgambar;
			$random=md5(date("Ymdhis").rand(0,1000).$ctr);
			$namafile=substr($random,0,10).".jpg";
			file_put_contents("gambar/".$namafile, file_get_contents($srcgambar));
					
			
					
			$harga=0;
			if (strtolower(trim($sharga))!="hubungi kami")
			{
				$harga=getharga($sharga);
			}
			
			
			echo $harga."<br/>";
			$bahanBakar = trim($bahanBakar);
			if ($harga!=0)
			{
				// Check bahan bakar
				$sqlCheck = "SELECT id FROM bahanbk_crawling where bahanbk IN ('$bahanBakar')";
				$resultCheck = mysqli_query($conn,$sqlCheck);
				
				if($rowID = mysqli_fetch_assoc($resultCheck))
				{
					$bahanBakar=$rowID['id'];
				}
				else
				{
					// Insert ke tabel lokasi_crawling
					$sqlInsert = "INSERT INTO bahanbk_crawling (bahanbk) VALUES ('$bahanBakar')";
					mysqli_query($conn,$sqlInsert);
					
					// Get last insert id 
					$bahanBakar = mysqli_insert_id($conn);
				}
					
			   $q="INSERT INTO mobilbekas (nama,harga,tahun,id_bk_crawling,jarak_tempuh,url,gambar,tipe) VALUES ('$namaMobil$tipeMobil','$harga','$tahun','$bahanBakar','$kilometer','https://www.seva.id$href','$namafile','seva')";
			   mysqli_query($conn,$q);
			   //echo $brand.",".$produk."<br/>";
			}
			$ctr++;
		}
	}
			
?>

	