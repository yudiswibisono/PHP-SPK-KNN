<?php
	include "conn.php";
	$id=$_GET["id"];
	$val=$_GET["val"];
	$q="UPDATE bahanbk_crawling SET id_bahanbk='$val' WHERE id='$id'";
	mysqli_query($conn,$q);
	
	$hasil["kembalian"]="suskes";
	echo json_encode($hasil);
?>