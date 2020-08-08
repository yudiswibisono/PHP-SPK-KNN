<?php
	include "conn.php";
	include_once('simple_html_dom.php');
	set_time_limit(900);
	$q="SELECT * FROM mobilbekas WHERE tipe='carmudi'";
	$res=mysqli_query($conn,$q);
	while ($row=mysqli_fetch_assoc($res))
	{
		echo $row["id_mobil_bekas"]."<br/>";
		
		
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
		foreach($html->find('div.py-1') as $element) 
		{
			$htmlDalam=str_get_html($element->innertext);
			//echo "<br/>HTML mulai <br/>";
			echo $htmlDalam;
			//echo "<br/>HTML akhir<br/>";
			
			$warna=$html->find("div.col-6",1)->innertext;
			echo "warna : ".$warna."</br>";
			
			$warna = strip_tags(trim($warna));
			
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
			
			$q="UPDATE mobilbekas SET id_warna_crawling='$warna' WHERE url='". $row["url"] ."'";
			mysqli_query($conn,$q);
			echo $q;
		}
		
		
	}
?>