<?php
	include "conn.php";
	$id=$_GET["id"];
	$val=$_GET["val"];
	$q="UPDATE transmisi_crawling SET id_transmisi='$val' WHERE id='$id'";
	mysqli_query($conn,$q);
	
	$hasil["kembalian"]="suskes";
	echo json_encode($hasil);
?>