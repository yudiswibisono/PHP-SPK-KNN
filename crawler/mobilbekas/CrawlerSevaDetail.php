<?php

	include "conn.php";
	include_once('simple_html_dom.php');
	$q="SELECT * FROM mobilbekas WHERE tipe='seva'";
	$res=mysqli_query($conn,$q);
	while ($row=mysqli_fetch_assoc($res))
	{
		//echo $row["id_mobil_bekas"]."<br/>";
		
		$ch = curl_init(); 
		$url=$row["url"];
		//echo $url."<br/>";
		curl_setopt($ch, CURLOPT_URL, $url); 
		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
		// $output contains the output string 
		$output = curl_exec($ch);
		curl_close($ch); 
			
			
		//echo $output;
		$html = str_get_html($output);
		
		//echo $spesifikasi;
		$spesifikasi2=$html->find("ul.take-journey-items",0)->innertext;
		$spesifikasi3=$html->find('ul.col-lg-6',1)->innertext;
		$spesifikasi=$html->find('ul.col-lg-6',0)->innertext;
		
		//echo $spesifikasi2;
		$html4 = str_get_html($spesifikasi3);
		$html3 = str_get_html($spesifikasi);
		$html2 = str_get_html($spesifikasi2);
		
		$transmisi=$html2->find('p',1)->innertext;
		$warna=$html3->find('span',4)->innertext;
		$lokasi=$html4->find('span',2)->innertext;
		
		echo "transmisi : ". $transmisi . "<br/>";
		echo "warna : ". $warna . "<br/>"."<br/>";
		echo "lokasi : ". $lokasi . "<br/>";

		/*
		for ($ix=0;$ix<=10;$ix++)
		{
			$baca=$html4->find('span',$ix)->innertext;
			echo $ix.",".$baca."<br/>";
		}*/
		
		
		/*
		$detailli=str_get_html($spesifikasi);
		foreach($html->find('..slick-slide') as $detailli) 
		{
			$isi=$detailli->innertext;
			$htmlDalam=str_get_html($isi);
			$warna==$htmlDalam->find("span.prdt-specs__value,",2)->innertext;
			echo $warna;
			
		}*/
		
		$transmisi = trim($transmisi);
		$warna = trim($warna);
		$lokasi = trim($lokasi);
		
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
		
		// Check LOKASI
		$sqlCheck = "SELECT id FROM lokasi_crawling where lokasi IN ('$lokasi')";
		$resultCheck = mysqli_query($conn,$sqlCheck);
		
		if($rowID = mysqli_fetch_assoc($resultCheck))
		{
			$lokasi=$rowID['id'];
		}
		else
		{
			// Insert ke tabel lokasi_crawling
			$sqlInsert = "INSERT INTO lokasi_crawling (lokasi) VALUES ('$lokasi')";
			mysqli_query($conn,$sqlInsert);
			
			// Get last insert id 
			$lokasi = mysqli_insert_id($conn);
		}
		
		$q="UPDATE mobilbekas SET id_transmisi_crawling='$transmisi',id_warna_crawling='$warna',id_kota_crawling='$lokasi' WHERE url='". $row["url"] ."'";
		mysqli_query($conn,$q);
	}
?>