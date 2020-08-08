<?php
    include "conn.php";
	include_once('simple_html_dom.php');
	
	include "crawler/mobilbaru/crawlerid.php";
	include "crawler/motorbaru/crawlerid.php";
	include "crawler/mobilbekas/CrawlerOlx.php";
	include "crawler/mobilbekas/CrawlerSeva.php";
	include "crawler/mobilbekas/Crawlercarmudi.php";
	include "crawler/motorbekas/Crawlercarmudi.php";
	include "crawler/motorbaru/CrawlerId.php";
	include "crawler/motorbaru/CrawlerOlx.php";
	
?>

<script>

  var jam=1;
  var detik=jam*3600*1000;
  setTimeout(function(){ window.location="updatedata.php"; }, 3600);
  
</script>