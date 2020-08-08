<?php
	set_time_limit(180);
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
		
			
	$q="DELETE FROM mobilbekas WHERE tipe='olx'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=1;$i++)
	{
			$ch = curl_init(); 

			// set url 
			$url="https://www.olx.co.id/mobil/bekas/";
			if ($i!=1)
			{
				$url="https://www.olx.co.id/mobil/bekas/?page=".$i;
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
					/*
					echo "<br/>HTML mulai <br/>";
					echo $htmlDalam;
					echo "<br/>akhir<br/>";
					echo "<br/><br/>";
					*/
					$tanggal=$htmlDalam->find("p",0)->innertext;
					
					$img=$htmlDalam->find("img",0)->src;
					$nama=mysqli_real_escape_string($conn,$htmlDalam->find("a",2)->innertext);
					//echo "<br/>test nama : ".$nama."<br/>";
					
					/*
					for ($ix=0;$ix<=5;$ix++)
					{
						$baca=$htmlDalam->find("span",$ix)->innertext;
						echo $ix.":".$baca."<br/>";
					}
					echo "<br/>";
					*/
					$lokasi=$htmlDalam->find("span",4)->innertext;
					//echo "Lokksi ".$lokasi;
					
					$namamobil=($htmlDalam->find("a.detailsLink",0)->innertext);
					echo $namamobil." : <br/>";
					
					$mile=getmile($htmlDalam->find("div.mileage",0)->innertext);
					$tahun=$htmlDalam->find("div.year",0)->innertext;
					$harga=getharga($htmlDalam->find("strong.c000",0)->innertext);
					
					$iHref=$htmlDalam->find("a",1)->href;
					$href=mysqli_real_escape_string($conn,$iHref);
					
					
					$random=md5(date("Ymdhis").rand(0,1000).$ctr);
					$namafile=substr($random,0,10).".jpg";
					file_put_contents("gambar/".$namafile, file_get_contents($img));
					
					
					echo "tanggal ".$tanggal." : <br/>";
					echo "nama ".$nama."<br/>";
					echo "lokasi ".$lokasi."<br/>";
					echo "mile ".$mile."<br/>";
					echo "tahun ".$tahun."<br/>";
					echo "harga".$harga."<br/>";
					echo "link ".$href."<br/>";
					echo "<br/><br/>";
					
					
					$q="INSERT INTO mobilbekas (url,nama,tahun,harga,gambar,kota,tipe) VALUES ('$href','".trim($nama)."','$tahun','$harga','$namafile','$lokasi','olx')";
					mysqli_query($conn,$q);
					echo $q;
					
					/*
					echo $posSpan=0;
				
					foreach($htmlDalam->find('span') as $element2) 
					{
						echo $posSpan.",".$element2->innertext."<br/>";
						$posSpan++;
					}*/
					echo "<br/><br/>";
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