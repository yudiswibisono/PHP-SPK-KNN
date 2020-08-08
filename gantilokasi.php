<?php
	include "conn.php";
	$id=$_GET["id"];
	$val=$_GET["val"];
	$q="UPDATE lokasi_crawling SET id_kota='$val' WHERE id='$id'";
	mysqli_query($conn,$q);
	
	$hasil["kembalian"]="suskes";
	echo json_encode($hasil);
?>