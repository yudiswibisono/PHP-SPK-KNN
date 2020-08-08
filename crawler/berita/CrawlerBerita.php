<?php
	set_time_limit(300);
	include "conn.php";
	include_once('simple_html_dom.php');
	
	// create curl resource 
	
	$q="DELETE FROM berita WHERE tipe='autonetmagz'";
	mysqli_query($conn,$q);
	
	$ctr=1;
	for ($i=1;$i<=5;$i++)
	{
			$ch = curl_init(); 
			// set url 
			$url="https://autonetmagz.com/";
			if ($i!=1)
			{
				$url="https://autonetmagz.com/page/".$i."/";
			}
			echo "url : " . $url;
			//return the transfer as a string 
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
			// $output contains the output string 
			$output = curl_exec($ch); 
			
			// close curl resource to free up system resources 
			curl_close($ch);      

			$html = str_get_html($output);
			foreach($html->find('article.autonetmagz__blog--grid') as $element) 
			{
				//echo $element->innertext;
				//echo "<br/><br/>";
				$htmlDalam=str_get_html($element->innertext);
				//echo "<br/>HTML mulai <br/>";
				//echo $htmlDalam;
				//echo "<br/>akhir<br/>";
				
				$judul=$htmlDalam->find("a",2)->innertext;
				$isi=$htmlDalam->find("div.entry-summary",0)->innertext;
				$href=$htmlDalam->find("a",0)->href;
				
				$gambar=$htmlDalam->find("img",0)->{"data-src"};
				$gambar="https://autonetmagz.com/".$gambar;
				$random=md5(date("Ymdhis").rand(0,1000).$ctr);
				$namafile=substr($random,0,10).".jpg";
				
				
				//echo "gambar ".$gambar."<br/>";
				/*
				file_put_contents("gambar/".$namafile, file_get_contents($gambar));
				
				echo "judul : " . $judul . "</br>";
				echo "isi : " . $isi. "</br>";
				echo "link : " . $href. "</br>";
				echo "gambar : " . $gambar;
				*/
				/*echo $posSpan=0;
				foreach($htmlDalam->find('img') as $element) 
				{
					echo $posSpan.",".$element->src."<br/>";
					$posSpan++;
				}*/
				
				$q="INSERT INTO berita (judul,text,url,gambar,tipe) VALUES ('$judul','$isi','https://autonetmagz.com/$href','$gambar','autonetmagz')";
				mysqli_query($conn,$q);
				
				echo $q."<br/>";
				//	echo $q ."<br/>";
			}
			
			sleep(3);
	}

	
	//header("location:halamanupdatedata.php?p=1");
	//echo $output;
?>
<script>
	window.location="../../halamanupdatedata.php?p=1";
</script>