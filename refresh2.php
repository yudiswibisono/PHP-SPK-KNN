<?php
    include "conn.php";
	include_once('simple_html_dom.php');
	
	//include "crawlerOlx.php";
	if(date("h:i") !== "00:30")
	{
	}
	else
	{
		include "crawler/mobilbaru/CrawlerIddetail.php";
		include "crawler/motorbaru/CrawlerOlxDetail.php";
		include "crawler/mobilbekas/CrawlerSevaDetail.php";
		include "crawler/mobilbekas/CrawlerIddetail.php";
	}
?>

<script>

  var jam=1;
  var detik=jam*3600*1000;
  setTimeout(function(){ window.location="refresh2.php"; }, 1800);
  
</script>