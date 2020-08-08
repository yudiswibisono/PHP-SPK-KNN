<?php
	include "conn.php";
	include_once('simple_html_dom.php');
	set_time_limit(900);
	$q="SELECT * FROM mobilbekas WHERE tipe='olx'";
	$res=mysqli_query($conn,$q);
	while ($row=mysqli_fetch_assoc($res))
	{
		//echo $row["id_mobil_bekas"]."<br/>";
		$ch = curl_init(); 
		$url=$row["url"];
		curl_setopt($ch, CURLOPT_URL, $url); 

		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
		// $output contains the output string 
		$output = curl_exec($ch);
		curl_close($ch); 
			
		$html = str_get_html($output);
		//echo $output."<br/>";
		//$sp=$html->find('ul.spesifikasi');
		if ($html!=null)
		{
			$spesifikasi=$html->find('ul.spesifikasi',0)->innertext;
		
			$detailli=str_get_html($spesifikasi);
			$nomor=0;
			$tahun="";
			$transmisi="";
			foreach($detailli->find('li') as $detailli) 
			{
				$dhtml=str_get_html($detailli->innertext);
				$text=strtolower($detailli->innertext);
				/*
				echo $text."<br/>";
				
				echo $nomor.":".$detailli->innertext;
				
				echo "<br/>";
				*/
				$pos = strpos($text, "tahun");
				if ($pos===false)
				{
				}
				else 
				{
					$tahun=$dhtml->find("a",0)->innertext;	
				}
				
				$pos = strpos($text, "warna");
				if ($pos===false)
				{
				}
				else 
				{
					$awarna=explode(":",trim(strip_tags($detailli->innertext)));
					$warna=trim($awarna[count($awarna)-1]);
				}
				
				$pos = strpos($text, "tipe bahan bakar");
				if ($pos===false)
				{
				}
				else 
				{
					$abahanBakar=explode(":",trim(strip_tags($detailli->innertext)));
					$bahanBakar=trim($abahanBakar[count($abahanBakar)-1]);
				}
				
				$pos = strpos($text, "jarak tempuh");
				if ($pos===false)
				{
				}
				else 
				{
					$aJaraktempuh=explode(":",trim(strip_tags($detailli->innertext)));
					$jaraktempuh=trim($aJaraktempuh[count($aJaraktempuh)-1]);
				}
				
				$pos = strpos($text, "transmisi");
				if ($pos===false)
				{
				}
				else 
				{
					$atransmisi=explode(":",trim(strip_tags($detailli->innertext)));
					$transmisi=trim($atransmisi[count($atransmisi)-1]);
				}
				//$kota=mysqli_real_escape_string($conn,$htmlDalam->find("a",2)->innertext);
				
				$nomor++;
				
			}
				
			
			$aJarakTempuh=explode("-",$jaraktempuh);
			if (count($aJarakTempuh)>=2)
			{
				$jrk=str_replace(".","",$aJarakTempuh[1]);
				$jaraktempuh=$jrk;
			}
			
		
			
			
			if (strpos($tahun, "<") !== false)
			{
				$tahun=str_replace("<","",$tahun);
				//echo "aaa";
			}
			if (strpos($tahun, ">") !== false)
			{
				$tahun=str_replace(">","",$tahun);
			}
			
			$bahanBakar = trim($bahanBakar);
			$transmisi = trim($transmisi);
			$warna = trim($warna);
			
			// Check BAHAN BAKAR
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
			
			// Check TRANSMISI
			$sqlCheck = "SELECT id FROM transmisi_crawling where transmisi IN ('$transmisi')";
			$resultCheck = mysqli_query($conn,$sqlCheck);
			
			if($rowID = mysqli_fetch_assoc($resultCheck))
			{
				$transmisi=$rowID['id'];
			}
			else
			{
				// Insert ke tabel lokasi_crawling
				$sqlInsert = "INSERT INTO transmisi_crawling (transmisi) VALUES ('$transmisi')";
				mysqli_query($conn,$sqlInsert);
				
				// Get last insert id 
				$transmisi = mysqli_insert_id($conn);
			}
			
			// Check WARNA
			$sqlCheck = "SELECT id FROM warna_crawling where warna IN ('$warna')";
			$resultCheck = mysqli_query($conn,$sqlCheck);
			
			if($rowID = mysqli_fetch_assoc($resultCheck))
			{
				$warna=$rowID['id'];
			}
			else
			{
				// Insert ke tabel lokasi_crawling
				$sqlInsert = "INSERT INTO warna_crawling (warna) VALUES ('$warna')";
				mysqli_query($conn,$sqlInsert);
				
				// Get last insert id 
				$warna = mysqli_insert_id($conn);
			}
			
			
			$q="UPDATE mobilbekas SET jarak_tempuh='$jaraktempuh',id_bk_crawling='$bahanBakar',id_warna_crawling='$warna',tahun='$tahun',id_transmisi_crawling='$transmisi' WHERE url='". $row["url"] ."'";
			//echo $q."<br/>";
			
			
			mysqli_query($conn,$q);
		}
		else {
			$q="DELETE FROM mobilbekas WHERE id_mobil_bekas='". $row["id_mobil_bekas"] ."'";
			mysqli_query($conn,$q);
		}
		
		
	}
?>