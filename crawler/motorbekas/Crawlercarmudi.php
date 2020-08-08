<?php
	set_time_limit(120);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	function getnama($param)
	{
		return substr($param,5);
	}
	function gettahun($param)
	{
		return substr($param,0,5);
	}
	function getharga($param)
	{
		return str_replace("Juta "," ",$param);
		echo " getnama " . $param;
	}
	function getgambar($param)
	{
		$hasil=str_replace(" ","",$param);
		return str_replace("//","",$hasil);
		//echo " getgambar " . $param;
	}
	function getlink($param)
	{
		$hasil=str_replace(".","",$param);
		$hasil2=str_replace(" </span>"," ",$param);
		$hasil3=str_replace("<span>"," ",$param);
		return str_replace('<i class="icon-location"></i> <span>'," ",$hasil3);
		
	}
	  
	
	
		
			
	$q="DELETE FROM motorbekas WHERE tipe='carmudi'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=5;$i++)
	{
			$ch = curl_init(); 

			// set url 
			$url="https://www.carmudi.co.id/motorcycles/used/";
			if ($i!=1)
			{
				$url="https://www.carmudi.co.id/motorcycles/used/?page=".$i;
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
				//echo $html2;
				$nama=getnama($html2->find("a.c-item-title",0)->innertext);
				echo "nama : ".$nama ."</br>";
				$tahun=gettahun($html2->find("a.c-item-title",0)->innertext);
				echo "tahun : ".$tahun ."</br>";
				$harga=$html2->find("a",2)->innertext;
				$kota=$html2->find("li.catalog-listing-item-location",0)->innertext;
				echo "ini kota :". $kota;
				
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
				
				
				
				$srcgambar=getgambar($html2->find("img",0)->{"data-original"});
				$random=md5(date("Ymdhis").rand(0,1000).$ctr);
				$namafile=substr($random,0,10).".jpg";
				
				
				/*$posSpan = 0;
				foreach($html2->find('a') as $element2) 
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
						strip_tags($href=$detailli->href, '<i><span>');
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
				echo "kota : ".$kota."<br/>";
				echo "<br/><br/>";
				
				//$q="INSERT INTO motorbekas (nama,harga,tahun,bahan_bakar,jarak_tempuh,url,tipe) VALUES ('$nama','$jumlah','$tahun','$bahanBakar','$km','https://www.carmudi.co.id/$href','carmudi')";
				//mysqli_query($conn,$q);
				
				/*$nomor=0;
				foreach($detailli->find('span') as $detailli)
				{
					echo $nomor.":".$detailli->innertext;
					echo "<br/>";
				}*/
				
				
				
				/*for ($ix=0;$ix<=20;$ix++)
				{
					$baca=$html->find('span',$ix)->innertext;
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
				}*/
				$kotaa=trim(strip_tags($kota));
				echo "kotaa : " . $kotaa;
				
				//echo $harga."<br/>";
				/*
				if ($harga!=0)
				{
				   $q="INSERT INTO motorbekas (nama,harga,tahun,gambar,kota,url,tipe) VALUES ('$nama','$jumlah','$tahun','$srcgambar','$kotaa','https://www.carmudi.co.id$href','carmudi')";
				   mysqli_query($conn,$q);
				}
				*/
				
				if ($harga!=0)
				{
					$sqlCheck = "SELECT id FROM lokasi_crawling where lokasi IN ('$kotaa')";
					$resultCheck = mysqli_query($conn,$sqlCheck);
					
					if($rowID = mysqli_fetch_assoc($resultCheck)){
						$id = $rowID['id'];
						$q="INSERT INTO motorbekas (nama,harga,tahun,gambar,id_kota_crawling,url,tipe) VALUES ('$nama','$jumlah','$tahun','$srcgambar','$id','https://www.carmudi.co.id$href','carmudi')";
						mysqli_query($conn,$q);
						echo "SUDAH ADA";
					}
					else{
						// Insert ke tabel lokasi_crawling
						$sqlInsert = "INSERT INTO lokasi_crawling (lokasi) VALUES ('$kotaa')";
						mysqli_query($conn,$sqlInsert);
						
						// Get last insert id 
						$lastid = mysqli_insert_id($conn);
						
						$q="INSERT INTO motorbekas (nama,harga,tahun,gambar,id_kota_crawling,url,tipe) VALUES ('$nama','$jumlah','$tahun','$srcgambar','$lastid','https://www.carmudi.co.id$href','carmudi')";
						mysqli_query($conn,$q);
						echo $q;
					}
				}
				
				
				
			}
			
			echo "<br/><br/><br/>";
			
			sleep(3);
	
	}
	
	
	//echo $output;
?>