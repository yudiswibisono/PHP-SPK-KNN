<?php
	set_time_limit(60);
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
			$url="https://www.rajamobil.com/jual/mobil/baru";
			if ($i!=1)
			{
				$url="https://www.rajamobil.com/jual/mobil/baru?page=".$i;
			}
			//echo $url."<br/>";
			curl_setopt($ch, CURLOPT_URL, $url); 

			//return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
			// $output contains the output string 
			$output = curl_exec($ch); 
		
			
	
			// close curl resource to free up system resources 
			curl_close($ch);      

			//echo $output;
			
			$html = str_get_html($output);
			$htmlA=$html->find("#wrapper-carimobil-container",0);
			$html2=str_get_html($htmlA->innertext);
			
			foreach($html2->find('div.list-mobil') as $element) 
			{
				//echo $element->innertext;
				echo "<br/>";
				$pr = str_get_html($element->innertext);
				$nama=$pr->find(".sc-merek",0)->title;
				$gambar=$pr->find(".img-responsive",0)->{"data-src"};
				$link="https://www.rajamobil.com".$pr->find("a",0)->href;
				
				echo $nama.",".$link.",".$gambar;
				echo "<br/>";
				//echo $pr->find(".sc-merek",0)->title;
				//echo "<br/>";
			}
		//echo $element->innertext;
		
			
			//sleep(3);
	}

	
	
	//echo $output;
?>