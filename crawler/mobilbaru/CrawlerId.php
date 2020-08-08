<?php
	set_time_limit(300);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	// create curl resource 
	
		
	
			
	$q="DELETE FROM mobil WHERE tipe='id.price'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=12;$i++)
	{
			$ch = curl_init(); 
			// set url 
			$url="https://id.priceprice.com/mobil/";
			if ($i!=1)
			{
				$url="https://id.priceprice.com/mobil/?page=".$i;
			}
			
			//return the transfer as a string 
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
			// $output contains the output string 
			$output = curl_exec($ch); 
			
			// close curl resource to free up system resources 
			curl_close($ch);      

			$html = str_get_html($output);
			foreach($html->find('div.modelSum_cont') as $element) 
			{
				
				$htmlDalam=str_get_html($element->innertext);
				//echo "<br/>HTML mulai <br/>";
				//echo $htmlDalam;
				//echo "<br/>akhir<br/>";
					
				
				$nama=$htmlDalam->find("a.modelSum_tlLink",0)->innertext;
				$href=$htmlDalam->find("a",0)->href;
				
				$gambar=$htmlDalam->find("img",0)->src;
				$random=md5(date("Ymdhis").rand(0,1000).$ctr);
				$namafile=substr($random,0,10).".jpg";
				file_put_contents("gambar/".$namafile, file_get_contents($gambar));
				
				//echo $gambar;
				$anama = trim($nama);
				/*
				echo $nama;
				echo $href;
				*/
				$q="INSERT INTO mobil (nama,url,tipe,gambar) VALUES ('$anama','https://id.priceprice.com$href','id.price','$namafile')";
				mysqli_query($conn,$q);
				echo $q;
					
					
					/*
					echo $tanggal." : <br/>";
					echo $nama."<br/>";
					echo $lokasi."<br/>";
					echo $mile."<br/>";
					echo $tahun."<br/>";
					echo $harga."<br/>";
					echo $href."<br/>";
					*/
					
					
					//$q="INSERT INTO mobilbekas (url,nama,tahun,harga,gambar,tipe) VALUES ('$href','".trim($nama)."','$tahun','$harga','$namafile','olx')";
					//mysqli_query($conn,$q);
					//echo $q;
					
					/*
					echo $posSpan=0;
				
					foreach($htmlDalam->find('span') as $element2) 
					{
						echo $posSpan.",".$element2->innertext."<br/>";
						$posSpan++;
					}*/
					//file_put_contents("gambar/".$namafile.".jpg", file_get_contents($img));
					
					
					//echo $img."<br/>";
					//echo "Tanggal ".;
					//echo "<br/>";
					
					$ctr++;
					//echo $element->innertext  . '<br/><br/><br/>';
				
			}
			
			sleep(3);
	}

	
	
	//echo $output;
?>