<?php
	include "conn.php";
	$id=$_GET["id"];
	$val=$_GET["val"];
	$q="UPDATE warna_crawling SET id_warna='$val' WHERE id='$id'";
	mysqli_query($conn,$q);
	
	$hasil["kembalian"]="suskes";
	echo json_encode($hasil);
?>