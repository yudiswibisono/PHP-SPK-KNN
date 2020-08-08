<?php
	set_time_limit(120);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	function getnama($param)
	{
		return substr($param,5);;
	}
	function gettahun($param)
	{
		return substr($param,0,5);;
	}
	function getharga($param)
	{
		return str_replace("Juta "," ",$param);
		echo " getnama " . $param;
	}
	
	
		
			
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
			foreach($html->find('div.catalog-listing-item') as $detailli) 
			{
				$isi=$detailli->innertext;
				//echo "sisi<>";
				//echo $isi."<br/><br/>";
				
				$htmlDalam=str_get_html($isi);
				
				
				$html2=str_get_html($htmlDalam);
				$srcgambar=$html2->find("img",0)->{"data-original"};
				$nama=getnama($html2->find("a.c-item-title",0)->innertext);
				echo "nama : ".$nama ."</br>";
				$tahun=gettahun($html2->find("a.c-item-title",0)->innertext);
				echo "tahun : ".$tahun ."</br>";
				$harga=$html2->find("a",2)->innertext;
				if(stripos($harga, "Milyar") !== false)
				{
					$ganti = str_replace("Milyar"," ",$harga);
					(int)$jumlah = (int)$ganti * 1000000000;
					
				}
				else
				{
					$ganti = str_replace("Juta"," ",$harga);
					(int)$jumlah = (int)$ganti * 1000000;
				}
				echo "harga : ".$jumlah ."</br>";
				/*foreach($html2->find('a') as $element2) 
					{
						echo $posSpan.",".$element2->innertext."<br/>";
						$posSpan++;
					}*/
				
				$km="";
				$transmisi="";
				$bahanbakar="";
				$lokasi="";
				$href="";
				//echo "Before<br/>";
				$nomor=1;
				foreach($html2->find('a') as $detailli)
				{
					//echo $nomor.":".$detailli->href;
					if ($nomor==1)
					{
						$href=$detailli->href;
					}
					$nomor++;
					
				}
				//echo "After<br/><br/>";
				
				$nomor=1;
				foreach($html2->find('li.column') as $detailli)
				{
					$isi=$detailli->innertext;
					//echo $nomor.":".$isi;
					//echo "<br/>";
					
					if ($nomor==1)
					{
						$km=$isi;
					}
					else if ($nomor==2)
					{
						$transmisi=$isi;
					}
					else if ($nomor==3)
					{
						$bahanbakar=$isi;
					}
					else if ($nomor==4)
					{
						$lokasi=$isi;
					}
					$nomor++;
				}
				
				
				
				echo "Gambar :".$srcgambar."<br/>";
				echo "HREF :".$href."<br/>";
				echo "KM : ".$km."<br/>";
				echo "Transmisi : ".$transmisi."<br/>";
				echo "Bahan Bakar : ".$bahanbakar."<br/>";
				echo "<br/><br/>";
				
				$q="INSERT INTO mobilbekas (nama,harga,tahun,bahan_bakar,jarak_tempuh,url,tipe) VALUES ('$nama','$jumlah','$tahun','$bahanBakar','$km','https://www.carmudi.co.id/$href','carmudi')";
				mysqli_query($conn,$q);
				
				/*$nomor=0;
				foreach($detailli->find('span') as $detailli)
				{
					echo $nomor.":".$detailli->innertext;
					echo "<br/>";
				}*/
				
				
				/*
				for ($ix=0;$ix<=20;$ix++)
				{
					$baca=$html->find('li.hidden',$ix)->innertext;
					echo $ix.",".$baca."<br/>";
				}*/
				
				/*
				$namaMobil=$htmlDalam->find("div.catalog-listing-description-data",0)->innertext;
				echo $namaMobil . "</br>";
				$kilometer=$htmlDalam->find("span",0)->innertext;
				echo "kilometer :" . $kilometer . "</br>";
				$transmisi=$htmlDalam->find("li.hidden",0)->innertext;
				echo "transmisi :" . $transmisi . "</br>";
				$kilome=$htmlDalam->find("li.attribute-distance",1)->innertext;
				echo "bahan bakar :" . $bahanBakar . "</br>";
				*/
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
				   $q="INSERT INTO mobilbekas (nama,harga,tahun,bahan_bakar,jarak_tempuh,url,tipe) VALUES ('$merekMobil$namaMobil$tipeMobil','$harga','$tahun','$bahanBakar','$kilometer','https://www.carmudi.co.id/$href','seva')";
				   mysqli_query($conn,$q);
				   //echo $brand.",".$produk."<br/>";
				}*/
				
			}
			
			echo "<br/><br/><br/>";
			
			sleep(3);
	
	}
	
	
	//echo $output;
?>