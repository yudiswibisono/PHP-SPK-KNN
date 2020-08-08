<?php
	set_time_limit(120);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	
	
		
			
	$q="DELETE FROM mobilbekas WHERE tipe='carmudi'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=2;$i++)
	{
			$ch = curl_init(); 

			// set url 
			$url="https://www.carmudi.co.id/cars/used/";
			if ($i!=1)
			{
				$url="https://www.carmudi.co.id/cars/used/?page=".$i;
			}
			curl_setopt($ch, CURLOPT_URL, $url); 

			//return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
			// $output contains the output string 
			$output = curl_exec($ch); 
			//echo $output."</br>";
			

			// close curl resource to free up system resources 
			curl_close($ch);      

			
			$html=str_get_html($output);
			foreach($html->find('div.catalog-listing-description-top') as $detailli) 
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
				//$namaMobil=$htmlDalam->find("div.catalog-listing-description-data",0)->innertext;
				//echo $namaMobil . "</br>";
				
				/*for ($ix=0;$ix<=5;$ix++)
				{
					$baca=$html->find('i',$ix)->innertext;
					echo $ix.",".$baca."<br/>";
				}*/
				
				$transmisi=$htmlDalam->find("i.icon-gearshift",0)->innertext;
				//echo $transmisi . "</br>";
				/*
				//echo $htmlDalam."<br/>";
				$merekMobil==$htmlDalam->find("span._brand-name",0)->innertext;
				$namaMobil=$htmlDalam->find("span.prod_name",0)->innertext;
				$tipeMobil=$htmlDalam->find("span.prod_name",1)->innertext;
				$brand=$htmlDalam->find("span._brand-name",0)->innertext;
				$sharga=$htmlDalam->find("span._rp",0)->innertext;
				$tahun=$htmlDalam->find("span.product_year",0)->innertext;
				$kilometer=$htmlDalam->find("span.product_km",0)->innertext;
				$bahanBakar=$htmlDalam->find("span.product_fuel",0)->innertext;
				
				$srcgambar=$htmlDalam->find("img",0)->src;
				$href=$htmlDalam->find("a",0)->href;
				
				
				$harga=0;
				if (strtolower(trim($sharga))!="hubungi kami")
				{
					$harga=getharga($sharga);
				}
				
				
				echo $harga."<br/>";
				if ($harga!=0)
				{
				   $q="INSERT INTO mobilbekas (nama,harga,tahun,bahan_bakar,jarak_tempuh,url,tipe) VALUES ('$merekMobil$namaMobil$tipeMobil','$harga','$tahun','$bahanBakar','$kilometer','https://www.seva.id$href','seva')";
				   mysqli_query($conn,$q);
				   //echo $brand.",".$produk."<br/>";
				}*/
				
			}
			
			sleep(3);
	
	}
	
	
	//echo $output;
?>