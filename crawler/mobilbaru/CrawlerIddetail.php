<?php
	set_time_limit(620);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	$q2="DELETE FROM mobilbaru WHERE tipe='id.price'";
	mysqli_query($conn,$q2);
	function getharga($param)
	{
		$hasil=str_replace(".","",$param);
		return str_replace("Rp","",$hasil);
	}
	function hapusspan($param)
	{
		$hasil=str_replace('<span class="variantTbl_nameTxt">'," ",$param);
		return str_replace("</span>"," ",$hasil);
		
	}
	
	$q="SELECT * FROM mobil WHERE tipe='id.price' LIMIT 5";
	$res=mysqli_query($conn,$q);
	
	while ($row=mysqli_fetch_assoc($res))
	{
		
		$idm=$row["id"];
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
		

		
		
		foreach($html->find('tr.variantTbl_trLink') as $element)
		{
			$htmlDalam=str_get_html($element->innertext);
			echo "<br/>HTML mulai <br/>";
			//echo $htmlDalam;
			echo "<br/>HTML akhir<br/>";
			
			/*echo $posSpan=0;
				
					foreach($htmlDalam->find('span') as $element) 
					{
						echo $posSpan.",".$element->innertext."<br/>";
						$posSpan++;
					}*/
			
			$tipe=$htmlDalam->find("span",2)->innertext;
			
			if ($tipe == '<span class="modelDtl_promoTxt promoLabel">Ada Promo</span>')
			{
				$nama=hapusspan($htmlDalam->find("h3",0)->innertext);
				$harga=getharga($htmlDalam->find("span",1)->innertext);
				$tipebody=$htmlDalam->find("span",4)->innertext;
				$transmisi=$htmlDalam->find("span",5)->innertext;
				$bahanBakar=$htmlDalam->find("span",6)->innertext;
			}
			else
			{
				$nama=hapusspan($htmlDalam->find("h3",0)->innertext);
				$atipe=$htmlDalam->find("span",0)->innertext;
				$harga=getharga($htmlDalam->find("span",1)->innertext);
				$tipebody=$htmlDalam->find("span",2)->innertext;
				$transmisi=$htmlDalam->find("span",3)->innertext;
				$bahanBakar=$htmlDalam->find("span",4)->innertext;
			}
			
			
			//$harga2=$htmlDalam->getAttribute("data-variant_price")->innertext;
			
			
			
			if(stripos($harga, "Milyar") !== false)
			{
				$ganti = str_replace(",", ".", $harga);
				(int)$jumlah = (int)$ganti * 1000000000;
			}
			else
			{
				$ganti = str_replace(",", ".", $harga);
				(int)$jumlah = (int)$ganti * 1000000;
			}
				
			//echo "awal : " . $ganti . "<br/>";
			//echo "ubah : " . $jumlah . "<br/>";
			
			
			
			//$harga2=$htmlDalam->find("data-variant_price",0)->innertext;
			
			$test = strip_tags($nama);
			//var_dump($test);
			
			/*
			echo "nama : ".$test ."<br/>";
			echo "tipe : ".$tipe ."<br/>";
			echo "harga : ".$harga."<br/>";
			echo "transmisi : ". $transmisi."<br/>";
			echo "bahanbakar : ".$bahanBakar."<br/>";
			*/
			//$href=$htmlDalam->find("a",0)->href;
			
			//$anama = trim($nama);
			/*
			echo $nama;
			echo $href;
			*/
			if($jumlah==0)
			{
				echo "gamasuk";
			}
			else
			{
				$transmisi = trim($transmisi);
				$bahanBakar = trim($bahanBakar);
				// Check TRANSMISI
				$sqlCheck = "SELECT id FROM transmisi_crawling where transmisi IN ('$transmisi')";
				$resultCheck = mysqli_query($conn,$sqlCheck);
				if($rowID = mysqli_fetch_assoc($resultCheck))
				{
					$transmisi=$rowID['id'];
				}
				else
				{
					// Insert ke tabel transmisi_crawling
					$sqlInsert = "INSERT INTO transmisi_crawling (transmisi) VALUES ('$transmisi')";
					mysqli_query($conn,$sqlInsert);
					
					// Get last insert id 
					$transmisi = mysqli_insert_id($conn);
				}
				// Check BAHAN BAKAR
				$sqlCheck = "SELECT id FROM bahanbk_crawling where bahanbk IN ('$bahanBakar')";
				$resultCheck = mysqli_query($conn,$sqlCheck);
				
				if($rowID = mysqli_fetch_assoc($resultCheck))
				{
					$bahanBakar=$rowID['id'];
				}
				else
				{
					// Insert ke tabel bahanbk_crawling
					$sqlInsert = "INSERT INTO bahanbk_crawling (bahanbk) VALUES ('$bahanBakar')";
					mysqli_query($conn,$sqlInsert);
					
					// Get last insert id 
					$bahanBakar = mysqli_insert_id($conn);
				}
				
				$q="INSERT INTO mobilbaru (nama,harga,tipebody,id_transmisi_crawling,id_bk_crawling,id_mobil,tipe) VALUES ('$nama','$jumlah','$tipebody','$transmisi','$bahanBakar','".$idm ."','id.price')";
				mysqli_query($conn,$q);
				echo $q . "<br/>";
			}
			
			
			
				
		}
			
	}
		
	
?>