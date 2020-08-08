<?php
	include "conn.php";
	include "simple_html_dom.php";
	
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
	function hapusspasi($param)
	{
		return str_replace("                                                "," ",$param);
	}
	function hapuscc($param)
	{
		return str_replace("cc","",$param);
	}
	function hapusdiv($param)
	{
		return str_replace("                                              </div>","",$param);
	}
	function hapusjenis($param)
	{
		$array = array('<h3 title="Sport Bike">                                                     ',
		'<h3 title="Matic">                                                     ',
		'<h3 title="Cub / Moped">                                                     ',
		'<h3 title="Naked Bike">                                                     ',
		"                                                 ",
		"                                                ",
		'<div class="sc-model lh">',
		"   </h3>",
		" ");
		return str_replace($array," ",$param);
	}
	
		
			
	$q = "DELETE FROM motorbaru WHERE tipe='rajamobil'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=4;$i++)
	{
			$ch = curl_init(); 
			// set url 
			$url="https://www.rajamobil.com/motor/cari-motor-baru/";
			if ($i!=1)
			{
				$url="https://www.rajamobil.com/motor/cari-motor-baru/?page=".$i;
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
			foreach($html->find('div.list-mobil') as $element) 
			{
				
				$htmlDalam=str_get_html($element->innertext);
				echo "<br/>HTML mulai <br/>";
				//echo $htmlDalam;
				echo "<br/>akhir<br/>";
					
				
				$nama=hapusjenis($htmlDalam->find("h2",0)->innertext);
				$href=$htmlDalam->find("a",0)->href;
				$harga=getharga($htmlDalam->find("div.harga-dr",0)->innertext);
				$jenis=hapusjenis($htmlDalam->find("li",0)->innertext);
				$transmisi=$htmlDalam->find("li",3)->innertext;
				$cc=hapuscc($htmlDalam->find("li",1)->innertext);
				//echo "harga : " . $harga . "</br> ";
				echo "nama : " . $nama . "</br> ";
				//echo "href : " . $href . "</br> ";
				echo "jenis : " . $jenis . "</br> ";
				echo "transmisi : " . $transmisi . "</br> ";
				echo "cc : " . $cc . "</br> ";
				$gambar=$htmlDalam->find("img",0)->src;
				$random=md5(date("Ymdhis").rand(0,1000).$ctr);
				$namafile=substr($random,0,10).".jpg";
				file_put_contents("gambar/".$namafile, file_get_contents($gambar));
				
				
				$test = hapusspasi($nama);
				$atest = hapusdiv($test);
				/*echo $posSpan=0;
				foreach($htmlDalam->find('li') as $element) 
				{
					echo $posSpan.",".$element->innertext."<br/>";
					$posSpan++;
				}*/
				
				//echo $gambar;
				/*
				echo $nama;
				echo $href;
				*/
				//$q="INSERT INTO kepalamotor (nama,url,tipe,harga,gambar) VALUES ('$bnama','$href','rajamobilre','$harga','$namafile')";
				//mysqli_query($conn,$q);
				//echo $q;
				
				
					
					
					/*
					echo $tanggal." : <br/>";
					echo $nama."<br/>";
					echo $lokasi."<br/>";
					echo $mile."<br/>";
					echo $tahun."<br/>";
					echo $harga."<br/>";
					echo $href."<br/>";
					*/
					
					$jenis = strip_tags(trim($jenis));
					$transmisi = strip_tags(trim($transmisi));
					
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
					
					$q="INSERT INTO motorbaru (nama,harga,tipe,cc,jenis,url,gambar,id_transmisi_crawling) VALUES ('$atest','$harga','rajamobil','$cc','$jenis','$href','$namafile',$transmisi)";
					mysqli_query($conn,$q);
					echo $q ."<br/>";
			
					
					//file_put_contents("gambar/".$namafile.".jpg", file_get_contents($img));
					
					
					//echo $img."<br/>";
					//echo "Tanggal ".;
					//echo "<br/>";
					
					//$ctr++;
					//echo $element->innertext  . '<br/><br/><br/>';
				
			}
			
			sleep(3);
	}

	
	
	//echo $output;
?>