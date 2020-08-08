<?php
	set_time_limit(180);
	include "conn.php";
	include_once('simple_html_dom.php');
	//$q2="DELETE FROM mobilbaru WHERE tipe='id.price'";
	//mysqli_query($conn,$q2);
	
	
	
	$q="SELECT * FROM kepalamotor WHERE tipe='rajamobil'";
	$res=mysqli_query($conn,$q);
	
	while ($row=mysqli_fetch_assoc($res))
	{
		//echo $row["id"]."<br/>";
		
		$ch = curl_init(); 
		$url=$row["url"];
		//echo $url."<br/>";
		
		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
		// $output contains the output string 
		$output = curl_exec($ch);
		curl_close($ch); 
			
		$html = str_get_html($output);	
		//echo $output;
		

		
		
		
		foreach($html->find('div.hmb-left') as $element) 
		{
			$htmlDalam=str_get_html($element->innertext);
			//echo "<br/>HTML mulai <br/>";
			echo $htmlDalam;
			//echo "<br/>HTML akhir<br/>";
			
			$nama=$htmlDalam->find("span.font-roboto-regular",0)->innertext;
			$varian=$htmlDalam->find("span.font-roboto-black",0)->innertext;
			$cc=$htmlDalam->find("span",3)->innertext;
			$jenis=$htmlDalam->find("span",5)->innertext;
			
			$img=$htmlDalam->find("img",0)->src;
			$random=md5(date("Ymdhis").rand(0,1000).$ctr);
			$namafile=substr($random,0,10).".jpg";
			file_put_contents("gambar/".$namafile, file_get_contents($img));
			
			echo "gambar : " . $img;
			echo "nama : " . $nama . "</br> ";
			echo "varian : " . $varian . "</br> ";
			echo "cc : " . $cc . "</br> ";
			echo "jenis : " . $jenis . "</br> ";
			
			
			$q="INSERT INTO motorbaru (nama,harga,jenis,harga,gambar,tipe) VALUES ('$href','".trim($anama)."','$tahun','$harga','$namafile','rajamobil')";
			mysqli_query($conn,$q);
			echo $q;
		}
			
	}
		
	
?>