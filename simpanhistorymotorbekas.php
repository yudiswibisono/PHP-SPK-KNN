<?php
	include "conn.php";
	//session_start();
	//$namamobil=mysqli_real_escape_string($conn,$_GET["namaMobil"]);
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	$username=mysqli_real_escape_string($conn,$_SESSION["id_user"]);
	
	
    $nama = $_GET['namaMobil'];
	$harga = $_GET['harga'];
	$kota = $_GET['kota'];
	$tahun = $_GET['tahun'];
	
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	//echo $param;
	
	$q="INSERT INTO historymotorbekas (id_user,parameter,nama,harga,tahun,kota,tanggal) VALUES 
									('$username','$param','$nama','$harga','$tahun','$kota',SYSDATE())";
	//echo $q;
	mysqli_query($conn,$q);
	
	$warning="History berhasil diinputkan";
	
	$url='motorbekas.php?'.$param.'&w='.urlencode($warning);
	//echo $url;
	header('location: ./'.$url);
?>